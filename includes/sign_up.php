<?
	include('../tools/state.php');
?>
<div id="header">
  <a href="../index.php">Camagru</a>
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