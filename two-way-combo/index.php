<?php

require_once 'src/models/Puzzle.php';
require_once 'src/state/RoomState.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Room A</title>
    <link rel="stylesheet" href="styles/main.css">

    <!-- Skeleton styling -->
    <link rel="stylesheet" href="styles/normalize.css">
    <link rel="stylesheet" href="styles/skeleton.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./src/js/main.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <h1 class="u-full-width text-center">Two Way Combo</h1>
        </div>
        <div class="row">
            <button class="button-primary center" id="btn-generate-rooms">Generate Rooms</button>
        </div>
        <div class="row">
            <div class="u-full-width">
                <span>Room A: </span><a href="" id="room-a-link"></a>
            </div>
        </div>
        <div class="row">
            <div class="u-full-width">
                <span>Room B: </span><a href="" id="room-b-link"></a>
            </div>
        </div>
        <hr />
        <div class="row">
            <h2 class="u-full-width text-center">Admin</h2>
        </div>
        <div class="row">
            <div class="three columns">
                <button class="button-primary" id="btn-clear-rooms">Clear All Rooms</button>
            </div>
            <div class="nine columns">
                <span id="message"></span>
            </div>
        </div>
    </div>
</body>
</html>
