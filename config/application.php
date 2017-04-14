<?php

/*
* * Application defines
*/

/* port 8888 for home / port 8080 for school */
define('APPLICATION_ADDR', 'http://localhost:8080/camagru');
define('UPLOADS', 'uploads/');
define('FILTERS', 'filters/');
define('ROOT', 'index.php');
//use for user snap pagination
define('SNAP_LIMIT', 3);
//use for gallery pagination
define('GALLERY_LIMIT', 6);

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
