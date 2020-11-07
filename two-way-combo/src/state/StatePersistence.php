<?php

require_once __DIR__ . "/RoomState.php";

class StatePersistence
{
    public static function add_rooms( RoomState $room_a, RoomState $room_b ): bool {
        return true;
    }
}