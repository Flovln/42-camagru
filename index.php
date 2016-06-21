<?php 
session_start(); 
//require_once("./config/database.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="Camagru">
	<meta name="author" content="Florent Violin">
	<link rel="stylesheet" type="text/css" href="style/main.css">
	<title>Camagru</title>
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<img src="./pictures/camagru_logo.png" title="camagru" id="logo">
		</div>
		<div id="main_content">
			<img src="./pictures/sf_bay.jpg" id="main_img">
			<div id="sign_menu">
				<?php require_once("./includes/sign_menu.php"); ?>
			</div>
		</div>
		<div id="bottom_line"></div>
		<div id="footer">
			fviolin&copy; 2016
		</div>
	</div>
</body>
</html>