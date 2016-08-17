<?php
?>
<!DOCTYPE html>
<html>
	<head>
  		<meta charset="utf-8">
  		<meta name="author" content="Florent Violin">
		<link rel="stylesheet" type="text/css" href="../style/main.css">
  		<title>Home</title>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<img src="../pictures/Camagru_logo.png" title="camagru" id="logo">
				<input type="submit" name="submit" value="Logout" id="logout"></input>
			</div>
			<div id="home_main">
				<img src="../filters/test.png" width="360px" id="filter1" onClick="selectfilter(this)">
				<div id="webcam">
					<video id="video"></video>
					<button id="startbutton">Prendre une photo</button>
					<canvas id="canvas"></canvas>
					<script type="text/javascript" src="webcam.js"></script>
				</div>
			</div>
			<div id="home_side">
			</div>
			<div id="home_footer"></div>
  		</div>
	</body>		
</html>