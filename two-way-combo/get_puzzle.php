<?php

require_once 'src/Validation.php';
require_once 'src/models/Puzzle.php';
require_once 'src/state/RoomPersistence.php';
require_once 'src/state/RoomState.php';

$response = array(
    "success" => false,
    "data" => array(),
    "errors" => array()
);

$room_id = get_validated_room_id( $_REQUEST );
if ( null === $room_id ) {
    $response["success"] = false;
    $response["errors"][] = "Invalid room id.";
} else {
    $rooms = RoomPersistence::instance()->get_rooms( $room_id );
    if ( null === $rooms || 2 !== count( $rooms ) ) {
        $response["success"] = false;
        $response["errors"][] = "Unable to retrieve rooms.";
    } else {
        $room_state = RoomState::from_dto_rooms( $rooms["room_a"], $rooms["room_b"] );
        $puzzle = new Puzzle( $room_state );
        $response["success"] = true;
        $response["data"] = array(
            "html" => $puzzle->get_html()
        );
    }
}

echo json_encode( $response );
