<?php

require_once __DIR__ . "/Persistence.php";
require_once __DIR__ . "/RoomState.php";

class RoomPersistence
{
    private static ?RoomPersistence $_instance = null;

    private PDOStatement $stmt_insert_room;
    private PDOStatement $stmt_insert_room_pair;
    private PDOStatement $stmt_clear_rooms;
    private PDOStatement $stmt_clear_room_pairs;

    public static function instance(): RoomPersistence {
        if ( null === self::$_instance ) {
            self::$_instance = new RoomPersistence();
        }

        return self::$_instance;
    }

    public function __construct() {
        $pdo = Persistence::get_pdo();

        $this->stmt_insert_room = $pdo->prepare(
            "INSERT INTO twowaycombo_room (room_id, wheel_0, wheel_1, wheel_2, wheel_3)
            VALUES (?, ?, ?, ?, ?)"
        );
        $this->stmt_insert_room_pair = $pdo->prepare(
            "INSERT INTO twowaycombo_room_pair (room_id_a, room_id_b)
            VALUES (?, ?)"
        );
        $this->stmt_clear_rooms = $pdo->prepare(
            "DELETE FROM twowaycombo_room"
        );
        $this->stmt_clear_room_pairs = $pdo->prepare(
            "DELETE FROM twowaycombo_room_pair"
        );
    }

    private function _add_room( RoomState $room ): void {
        $this->stmt_insert_room->execute([
            $room->id,
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
}