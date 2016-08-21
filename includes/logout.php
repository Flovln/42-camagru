<?php
session_start();

if (isset($_SESSION['log_in'])) {
	unset($_SESSION['log_in']);
}

session_destroy();
header('Location: ../index.php');
?>
