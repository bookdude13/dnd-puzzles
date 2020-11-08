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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Room</title>
    <link rel="stylesheet" href="styles/main.css">

    <!-- Skeleton styling -->
    <link rel="stylesheet" href="styles/normalize.css">
    <link rel="stylesheet" href="styles/skeleton.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./src/js/utility.js"></script>
    <script src="./src/js/room.js"></script>
</head>
<body>
    <div class="container" id="puzzle-container"></div>
</body>
</html>
