<?php

require_once __DIR__ . "/RoomState.php";
require_once __DIR__ . "/../../../config.php";

class RoomPersistence
{
    private static function _get_connection(): PDO {
        $config = new DndPuzzlesConfiguration();
        $db_host = $config->db_host;
        $db_username = $config->db_username;
        $db_password = $config->db_password;
        $connection = new PDO( "mysql:host=$db_host;dbname=dndpuzzles", $db_username, $db_password );
        $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        return $connection;
    }

    private static function _add_room( PDO $conn, RoomState $room ) {
        $stmt = $conn->prepare(
            "INSERT INTO twowaycombo_room (room_id, wheel_0, wheel_1, wheel_2, wheel_3)
            VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $room->id, $room->wheel_states[0], $room->wheel_states[1], $room->wheel_states[2], $room->wheel_states[3]
        ]);
    }

    private static function _add_room_pair( PDO $conn, string $room_id_a, string $room_id_b ) {
        $stmt = $conn->prepare(
            "INSERT INTO twowaycombo_room_pair (room_id_a, room_id_b)
            VALUES (?, ?)"
        );
        $stmt->execute([
            $room_id_a, $room_id_b
        ]);
    }

    public static function add_rooms( RoomState $room_a, RoomState $room_b ): bool {
        try {
            $conn = self::_get_connection();
            self::_add_room( $conn, $room_a );
            self::_add_room( $conn, $room_b );
            self::_add_room_pair( $conn, $room_a->id, $room_b->id );
        } catch ( PDOException $ex ) {
            error_log( "Failed to add rooms: " . $ex->getMessage() );
            return false;
        }
        
        return true;
    }
}