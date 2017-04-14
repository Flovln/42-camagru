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
    <div class="signup-style">
      <form action="../actions/create_account.php" method="POST">
        <h2>Create your new Camagru account now.</h2>
        <br/>
        <br/>
        <br/>
        <p>Username:</p>
        <br/>
        <input type="login" name="login" class="input-style" required />
        <br/>
        <p>Password:</p>
        <br/>
        <input type="password" name="passwd" class="input-style" required />
        <br/>
        <p>Email:</p>
        <br/>
        <input type="email" name="email" class="input-style" required></input>
        <br/>
        <input type="submit" name="submit" value="OK" class="submit-style" required />
      </form>
      <?display_error('err_new_password')?>
    </div>
    <? include '../includes/footer.php'; ?>
  </body>
</html>