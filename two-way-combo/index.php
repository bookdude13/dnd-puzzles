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
    <script src="./src/js/utility.js"></script>
    <script src="./src/js/main.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <h1 class="u-full-width text-center">Two Way Combo</h1>
        </div>
        <div class="row text-center">
            <button class="button-primary" id="btn-generate-rooms">Generate Rooms</button>
            <button class="button-primary" id="btn-clear-rooms">Clear All Rooms</button>
        </div>
        <div class="row text-center">
            <span id="message" class="u-full-width text-center"></span>
        </div>
        <hr />
        <div class="row">
            <h2 class="u-full-width text-center">Rooms</h2>
        </div>
        <div id="room-container"></div>
    </div>
</body>
</html>
