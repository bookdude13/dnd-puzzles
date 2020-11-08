<?php

require_once 'src/state/RoomState.php';
require_once 'src/state/RoomPersistence.php';

$room_state_a = RoomState::create_new();
$room_state_b = RoomState::create_new();

$response = array(
    "success" => false,
    "data" => array(),
    "errors" => array()
);

$persist_result = RoomPersistence::instance()->add_rooms( $room_state_a, $room_state_b );
if ( true === $persist_result ) {
    $response["success"] = true;
    $response["data"] = array(
        "rooms" => array(
            "A" => $room_state_a->id,
            "B" => $room_state_b->id
        )
        );
} else {
    $response["success"] = false;
    $response["errors"][] = "Failed to store generated rooms on server";
}

echo json_encode($response);
