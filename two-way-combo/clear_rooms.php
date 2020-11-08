<?php

require_once 'src/state/RoomPersistence.php';

$response = array(
    "success" => false,
    "data" => array(),
    "errors" => array()
);

$result = RoomPersistence::instance()->clear_rooms();
if ( true === $result ) {
    $response["success"] = true;
} else {
    $response["success"] = false;
    $response["errors"][] = "Failed to clear generated rooms on server.";
}

echo json_encode($response);
