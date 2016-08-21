<?php
	include('../config/application.php');
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
		<div id="header">
			<img src="../pictures/Camagru_logo.png" title="camagru" id="logo">
				<?php echo "Welcome " . $_SESSION['log_in'];?>
				<form action="logout.php" method="POST">
					<input type="submit" name="submit" value="Logout" id="logout"></input>
				</form>
			</div>
		<div id="main-container">
			<div id="filter-container">
				<form>
					<input type="radio" name="filter" value="test.png">
					<img src="../filters/test.png" width="" id="filter"> <!-- onClick="select_filter(../filters/test.png)"> -->
					<input type="radio" name="filter" value="filter1.png">
					<img src="../filters/filter1.png" width="" id="filter"> <!-- onClick="select_filter(../filters/filter1.png)"> -->
					<input type="radio" name="filter" value="filter2.png">
					<img src="../filters/filter2.png" width="" id="filter"> <!-- onClick="select_filter(../filters/filter2.png)"> -->
				</form>
			</div>
			<div id="webcam-container">
				<div id="webcam">
					<video id="video"></video> 
					<canvas id="canvas"></canvas>
					<button id="startbutton">Prendre une photo</button>
				</div>
			</div>
			<div id="img-upload">
				<form action="upload.php" method="post" enctype="multipart/form-data">
    				Select an image to upload:
    				<input type="file" name="fileToUpload" id="fileToUpload">
    				<input type="submit" name="submit" value="Upload Image">
				</form>
			</div>
		</div>
		<div id="side-container">
		</div>
<!--	<?php
	//		include ('footer.php');
		?> -->
	<script type="text/javascript" src="webcam.js"></script>
	<script type="text/javascript" src="application.js"></script>
	</body>		
</html>