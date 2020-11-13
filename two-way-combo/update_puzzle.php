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
$update = get_validated_state_update( $_REQUEST );
if ( null === $room_id || null === $update ) {
    $response["success"] = false;
    $response["errors"][] = "Invalid request.";
} else {
    $rooms = RoomPersistence::instance()->get_rooms_for_id( $room_id );
    if ( null === $rooms || 2 !== count( $rooms ) ) {
        $response["success"] = false;
        $response["errors"][] = "Unable to retrieve rooms.";
    } else {
        $room_state = RoomState::from_dto_rooms( $rooms["room_main"], $rooms["room_secondary"] );
        $update_success = $room_state->update( $update );
        if ( false === $update_success ) {
            $response["success"] = false;
            $response["errors"][] = "Unable to update room state.";
        } else {
            $response["success"] = true;
        }
    }
}

echo json_encode( $response );
