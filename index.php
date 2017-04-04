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
      <? require_once 'includes/header.php';
        if (!isset($_SESSION['login'])) {
          include 'includes/sign_menu.php';
        } else {
          include 'includes/home.php';
        } ?>
    </div>
    <? require_once 'includes/footer.php'; ?>
  <script type="text/javascript" src="includes/webcam.js"></script>
  <script type="text/javascript" src="includes/application.js"></script>
  </body>
</html>