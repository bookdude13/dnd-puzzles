<?php
    require_once 'src/Validation.php';

    $room_id = get_validated_room_id( $_REQUEST );
    if ( null === $room_id ) {
?>

<!DOCTYPE html>
<html>
<head> <title>Room A</title> </head>
<body> <h2>Room Not Found</h2> </body>
</html>

<?php
        return;
    }

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

    <?php
    $room_state = RoomState::create_new();
    $puzzle = new Puzzle( $room_state );
    echo $puzzle->get_html();
    ?>

    </div>
</body>
</html>
