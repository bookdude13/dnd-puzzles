<?php

require_once 'src/state/RoomPersistence.php';

$response = array(
    "success" => false,
    "data" => array(),
    "errors" => array()
);

$room_pairs = RoomPersistence::instance()->get_room_pairs();
if ( null === $room_pairs ) {
    error_log( "Failed to load initial room pairs" );
    $response["success"] = false;
    $response["errors"][] = "Failed to load initial room pairs.";
} else {
    $response["success"] = true;
    $response["data"] = array(
        "room_pairs" => $room_pairs
    );
}

echo json_encode( $response );