<?
  include('../config/application.php');
?>
<head>
  <meta charset="utf-8">
  <meta name="description" content="Camagru">
  <meta name="author" content="Florent Violin">
  <link rel="stylesheet" type="text/css" href="../style/main.css">
  <title>Camagru</title>
</head>
<div id="header">
  <a href="../index.php">Camagru</a>
  <? if (isset($_SESSION['auth'])) {
    echo "Welcome " . $_SESSION['login'];?>
    <a href="gallery.php">Gallery</a>
    <a href="../index.php">Edit</a>
    <div id="logout">
      <? 
        echo ("<li><a href=\"../actions/logout.php\">Logout</a></li>");?>
    </div>
  <? } ?>
</div>
<div>
  <? if (isset($_SESSION['auth'])) {
    echo '  Welcome to the gallery';
  } else {
    echo "You need to be logged in to access this page";
  }?>
</div>