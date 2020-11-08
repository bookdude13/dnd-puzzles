<?php

require_once __DIR__ . "/../../../config.php";

class Persistence
{
    public static function get_pdo(): PDO {
        $config = new DndPuzzlesConfiguration();
        $db_host = $config->db_host;
        $db_username = $config->db_username;
        $db_password = $config->db_password;
        $pdo = new PDO( "mysql:host=$db_host;dbname=dndpuzzles", $db_username, $db_password );
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        return $pdo;
    }
}
