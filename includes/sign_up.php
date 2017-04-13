<?
	include('../tools/state.php');
?>
<html>
	<head>
	  <meta charset="utf-8">
	  <meta name="description" content="Camagru">
	  <meta name="author" content="Florent Violin">
	  <link rel="stylesheet" type="text/css" href="../style/main.css">
	  <title>Camagru</title>
	</head>
	<body class="signup">
		<div id="header">
		  <a class="logo" href="../index.php">Camagru</a>
		  <a class="gallery-link" href="gallery.php">Gallery</a>
		  <? if (isset($_SESSION['auth'])) {
		    echo "Welcome " . $_SESSION['login'];?>
		    <div id="logout">
		      <? echo ("<li><a href=\"logout.php\">Logout</a></li>");?>
		    </div>
		  <? } ?>
		</div>
		<div align="center">
			<form action="../actions/create_account.php" method="POST">
			    Identifiant: <input type="login" name="login" required />
			    <br/>
			    Mot de passe: <input type="password" name="passwd" required />
			    <br/>
			    Email: <input type="email" name="email" required></input>
			    <br/>
			    <input type="submit" name="submit" value="OK" required />
			</form>
			<?display_error('err_signin')?>
		</div>
	</body>
</html>