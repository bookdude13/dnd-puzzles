<?php

require_once __DIR__ . "/Persistence.php";
require_once __DIR__ . "/RoomState.php";
require_once __DIR__ . "/DtoRoom.php";
require_once __DIR__ . "/DtoRoomPair.php";

class RoomPersistence
{
    private static ?RoomPersistence $_instance = null;

    private PDOStatement $stmt_insert_room;
    private PDOStatement $stmt_insert_room_pair;
    private PDOStatement $stmt_get_room;
    private PDOStatement $stmt_clear_rooms;
    private PDOStatement $stmt_clear_room_pairs;
    private PDOStatement $stmt_update_room;
    private PDOStatement $stmt_get_room_pair;
    private PDOStatement $stmt_get_room_pairs;

    public static function instance(): RoomPersistence {
        if ( null === self::$_instance ) {
            self::$_instance = new RoomPersistence();
        }

        return self::$_instance;
    }

    public function __construct() {
        $pdo = Persistence::get_pdo();

        $this->stmt_insert_room = $pdo->prepare(
            "INSERT INTO twowaycombo_room (
                room_id,
                code_0, code_1, code_2, code_3,
                wheel_0, wheel_1, wheel_2, wheel_3
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $this->stmt_insert_room_pair = $pdo->prepare(
            "INSERT INTO twowaycombo_room_pair (room_id_a, room_id_b)
            VALUES (?, ?)"
        );
        $this->stmt_get_room = $pdo->prepare(
            "SELECT * FROM twowaycombo_room
            WHERE room_id = ?"
        );
        $this->stmt_clear_rooms = $pdo->prepare(
            "DELETE FROM twowaycombo_room"
        );
        $this->stmt_clear_room_pairs = $pdo->prepare(
            "DELETE FROM twowaycombo_room_pair"
        );
        $this->stmt_update_room = $pdo->prepare(
            "UPDATE twowaycombo_room
            SET wheel_0 = :w0, wheel_1 = :w1, wheel_2 = :w2, wheel_3 = :w3
            WHERE room_id = :rid"
        );
        $this->stmt_get_room_pair = $pdo->prepare(
            "SELECT room_id_a, room_id_b
            FROM twowaycombo_room_pair
            WHERE room_id_a = :rid OR room_id_b = :rid"
        );
        $this->stmt_get_room_pairs = $pdo->prepare(
            "SELECT room_id_a, room_id_b
            FROM twowaycombo_room_pair"
        );
    }

    private function _add_room( RoomState $room ): void {
        $this->stmt_insert_room->execute([
            $room->id,
            $room->white_gem_states[0],
            $room->white_gem_states[1],
            $room->white_gem_states[2],
            $room->white_gem_states[3],
            $room->wheel_states[0],
            $room->wheel_states[1],
            $room->wheel_states[2],
            $room->wheel_states[3]
        ]);
    }

    private function _add_room_pair( string $room_id_a, string $room_id_b ): void {
        $this->stmt_insert_room_pair->execute([
            $room_id_a,
            $room_id_b
        ]);
    }

    private function _clear_rooms(): void {
        $this->stmt_clear_room_pairs->execute();
        $this->stmt_clear_rooms->execute();
    }

    private function _get_room( string $room_id ): DtoRoom {
        $this->stmt_get_room->setFetchMode( PDO::FETCH_CLASS, "DtoRoom" );
        $this->stmt_get_room->execute([ $room_id ]);
        $result = $this->stmt_get_room->fetch();
        if ( false === $result ) {
            throw new Exception("RoomNotFound");
        }
        return $result;
    }

    private function _get_room_pair( string $room_id ): DtoRoomPair {
        $this->stmt_get_room_pair->setFetchMode( PDO::FETCH_CLASS, "DtoRoomPair" );
        $this->stmt_get_room_pair->bindValue( ':rid', $room_id );
        $this->stmt_get_room_pair->execute();
        $result = $this->stmt_get_room_pair->fetch();
        if ( false === $result ) {
            throw new Exception("RoomPairNotFound");
        }
        return $result;
    }

    private function _get_room_pairs(): array {
        $this->stmt_get_room_pairs->setFetchMode( PDO::FETCH_CLASS, "DtoRoomPair" );
        $this->stmt_get_room_pairs->execute();
        $result = $this->stmt_get_room_pairs->fetchAll();
        if ( false === $result ) {
            throw new Exception("RoomPairsNotFound");
        }
        return $result;
    }

    private function _update_room( string $room_id, array $wheel_states ): void {
        $this->stmt_update_room->bindValue( ':w0', $wheel_states[0], PDO::PARAM_STR );
        $this->stmt_update_room->bindValue( ':w1', $wheel_states[1], PDO::PARAM_STR );
        $this->stmt_update_room->bindValue( ':w2', $wheel_states[2], PDO::PARAM_STR );
        $this->stmt_update_room->bindValue( ':w3', $wheel_states[3], PDO::PARAM_STR );
        $this->stmt_update_room->bindValue( ':rid', $room_id, PDO::PARAM_STR );
        $this->stmt_update_room->execute();
        $count = $this->stmt_update_room->rowCount();
    }

    public function add_rooms( RoomState $room_a, RoomState $room_b ): bool {
        try {
            $this->_add_room( $room_a );
            $this->_add_room( $room_b );
            $this->_add_room_pair( $room_a->id, $room_b->id );
        } catch ( PDOException $ex ) {
            error_log( "Failed to add rooms: " . $ex->getMessage() );
            return false;
        }
        
        return true;
    }

    public function clear_rooms(): bool {
        try {
            $this->_clear_rooms();
        } catch ( PDOException $ex ) {
            error_log( "Failed to clear rooms: " . $ex->getMessage() );
            return false;
        }

        return true;
    }

    public function get_rooms_for_id( string $room_id ): ?array {
        try {
            $room_pair = $this->_get_room_pair( $room_id );
            if ( $room_id === $room_pair->room_id_a ) {
                $room_main = $this->_get_room( $room_pair->room_id_a );
                $room_secondary = $this->_get_room( $room_pair->room_id_b );    
            } else {
                $room_main = $this->_get_room( $room_pair->room_id_b );
                $room_secondary = $this->_get_room( $room_pair->room_id_a );    
            }
        } catch ( Exception $ex ) {
            error_log( "Failed to get rooms: " . $ex->getMessage() );
            return null;
        }

        return array(
            "room_main" => $room_main,
            "room_secondary" => $room_secondary
        );
    }

    public function get_room_pairs(): ?array {
        try {
            $room_pairs = $this->_get_room_pairs();
        } catch ( Exception $ex ) {
            error_log( "Failed to get room pairs: " . $ex->getMessage() );
            return null;
        }

        return $room_pairs;
    }

    public function update( RoomState $updated_room ): bool {
        try {
            $this->_update_room( $updated_room->id, $updated_room->wheel_states );
        } catch ( Exception $ex ) {
            error_log( "Failed to update room: " . $ex->getMessage() );
            return false;
        }

        return true;
    }
}