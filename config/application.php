<?php

/*
* * Application defines
*/

//Home
/*define('APPLICATION_ADDR', 'http://localhost:8888/camagru');*/
//School
define('APPLICATION_ADDR', 'http://localhost:8080/camagru');
define('IMAGES_DIR', 'images/');
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
