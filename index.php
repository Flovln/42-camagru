<?
	include('config/application.php');
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
			<img src="pictures/Camagru_logo.png" title="camagru" id="logo">
		</div>
		<div id="main_content">
			<img src="./pictures/Sf_bay.jpg" id="main_img">
			<div id="sign_menu">
				<?php require_once("./includes/sign_menu.php"); ?>
			</div>
		</div>
		<?php include ('includes/footer.php'); ?>
	</div>
</body>
</html>
