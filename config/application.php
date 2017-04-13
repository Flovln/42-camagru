<?php

/*
* * Application defines
*/

/* port 8888 for home / port 8080 for school */
define('APPLICATION_ADDR', 'http://localhost:8080/camagru');
define('UPLOADS', 'uploads/');
define('FILTERS', 'filters/');
define('ROOT', 'index.php');

/*
* * Application requirements
*/

session_start();
require_once('database.php');

/*
* * Database connexion
*/

try {
    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
}
catch (PDOException $e) {
    die ('Connexion SQL impossible');
}

?>
