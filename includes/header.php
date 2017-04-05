<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Camagru">
    <meta name="author" content="Florent Violin">
    <script type="text/javascript" src="js/application.js"></script>
    <link rel="stylesheet" type="text/css" href="style/main.css">
    <title>Camagru</title>
  </head>
  <body>
    <div id="header">
      <a href="index.php">Camagru</a>
      <? if (isset($_SESSION['auth'])) {
        echo "Welcome " . $_SESSION['login'];?>
        <a href="includes/gallery.php">Gallery</a>
        <a href="index.php">Edit</a>
        <div id="logout">
          <? 
            echo ("<li><a href=\"actions/logout.php\">Logout</a></li>");?>
        </div>
      <? } ?>
    </div>