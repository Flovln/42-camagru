<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Camagru">
    <meta name="author" content="Florent Violin">
    <link rel="stylesheet" type="text/css" href="style/main.css">
    <title>Camagru</title>
  </head>
  <body class="home">
    <div id="header">
      <a class="logo" href="index.php">Camagru</a>
      <a class="gallery-link" href="includes/gallery.php">Gallery</a>
      <? if (isset($_SESSION['auth'])) {
        echo "Welcome " . $_SESSION['login']."!";?>
        <a class="home" href="index.php">Home</a>
        <a class="logout" href="actions/logout.php">Logout</a>
      <? } ?>
    </div>