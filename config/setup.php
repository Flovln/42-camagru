<?php
//include "./config/database.php";
//	require_once("config/database.php");
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "db_camagru";

try {
  //  $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // sql to create table
    $sql = "CREATE TABLE `Users` (
	`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`user` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL
	)";
	$conn->exec($sql);

	$sql = "CREATE TABLE `Images` (
	`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`user` varchar(255) NOT NULL,
	`filepath` varchar(255) NOT NULL
	)";
	$conn->exec($sql);

	$sql = "CREATE TABLE `Likes` (
	`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`user` varchar(255) NOT NULL,
	`filepathimage` varchar(255) NOT NULL
	)";
	$conn->exec($sql);

	$sql = "CREATE TABLE Comments (
	`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`user` varchar(255) NOT NULL,
	`filepathimage` varchar(255) NOT NULL
	)";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Tables created successfully";
}

catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>