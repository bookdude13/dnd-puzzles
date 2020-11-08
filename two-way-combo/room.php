<?php

require_once 'src/Validation.php';

function get_error_page() {
    return "<!DOCTYPE html>
<html>
<head> <title>Room Not Found</title> </head>
<body> <h2>Room Not Found</h2> </body>
</html>";
}

$room_id = get_validated_room_id( $_REQUEST );
if ( null === $room_id ) {
    echo get_error_page();
    return;
}

require_once 'src/models/Puzzle.php';
require_once 'src/state/RoomState.php';
require_once 'src/state/RoomPersistence.php';

$rooms = RoomPersistence::instance()->get_rooms( $room_id );
if ( null === $rooms || 2 !== count( $rooms ) ) {
    echo get_error_page();
    return;
}

$room_state = RoomState::from_dto_rooms( $rooms["room_a"], $rooms["room_b"] );

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

    <?php
    $puzzle = new Puzzle( $room_state );
    echo $puzzle->get_html();
    ?>

    </div>
</body>
</html>
