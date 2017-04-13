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
    <div id="header">
      <a href="index.php">Camagru</a>
      <a href="includes/gallery.php">Gallery</a>
      <? if (isset($_SESSION['auth'])) {
        echo "Welcome " . $_SESSION['login'];?>
        <a href="index.php">Home</a>
        <div id="logout">
          <a href="actions/logout.php">Logout</a>
        </div>
      <? } ?>
    </div>