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
    </div>
    <div class="reset-pwd-style">
  		<form class="reset-password-style" action="../actions/reset_password.php" method="POST">
        <h2>We will send you an email to reset your password.</h2>
        <br/>
        <br/>
        <br/>
  		  <p>Please enter your email:</p>
  		  <br/>
  		  <input class="input-style" type="email" name="email" required/>
  		  <br/>
  		  <input class="submit-style" type="submit" name="submit" value="Send"/>
  		</form>
      <?display_error('err_new_password')?>
    </div>
    <? include '../includes/footer.php'; ?>
  </body>
</html>