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
    <div class="signup-style">
      <form action="../actions/create_account.php" method="POST">
        <h2>Create your new Camagru account now.</h2>
        <br/>
        <br/>
        <br/>
        Identifiant:
        <br/>
        <input type="login" name="login" class="input-style" required />
        <br/>
        Mot de passe: 
        <br/>
        <input type="password" name="passwd" class="input-style" required />
        <br/>
        Email:
        <br/>
        <input type="email" name="email" class="input-style" required></input>
        <br/>
        <input type="submit" name="submit" value="OK" class="submit-style" required />
      </form>
      <?display_error('err_signin')?>
    </div>
    <? include '../includes/footer.php'; ?>
  </body>
</html>