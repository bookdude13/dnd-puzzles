<?php require 'src/Puzzle.php' ?>

<!DOCTYPE html>
<html>
<head>
    <title>Room A</title>
    <link rel="stylesheet" href="styles/main.css">

    <!-- Skeleton styling -->
    <link rel="stylesheet" href="styles/normalize.css">
    <link rel="stylesheet" href="styles/skeleton.css">
</head>
<body>
    <div class="container">

    <?php
    $puzzle = new Puzzle();
    echo $puzzle->get_html();
    ?>

    </div>
</body>
</html>
