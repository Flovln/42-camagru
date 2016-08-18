<?php
//	session_start();
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
		<!--		<?php echo "Welcome " . $_SESSION['login'];?> -->
				<form action="logout.php" method="POST">
					<input type="submit" name="submit" value="Logout" id="logout"></input>
				</form>
			</div>
			<div id="home_main">
				<div id="filter-container">
					<img src="../filters/test.png" width="360px" id="filter" onClick="selectfilter(this)">
					<img src="../filters/filter1.png" width="360px" id="filter" onClick="selectfilter(this)">
					<img src="../filters/filter2.png" width="360px" id="filter" onClick="selectfilter(this)">
				</div>
				<div id="webcam">
					<div id="webcam-container">
						<video id="video"></video> 
						</br>
						<button id="startbutton">Prendre une photo</button>
						</br>
						<canvas id="canvas"></canvas>
						<script type="text/javascript" src="webcam.js"></script>
					</div>
					<div id="webcam-button">
				<!--	<button id="startbutton">Prendre une photo</button> -->
					</div>
				</div>
			</div>
			<div id="home_side">
			</div>
<!--			<?php
		//		include ('footer.php');
			?> -->
  		</div>
	</body>		
</html>