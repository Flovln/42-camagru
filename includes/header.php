<div id="header">
  <a href="index.php">Camagru</a>
  <? if (isset($_SESSION['auth'])) {
    echo "Welcome " . $_SESSION['login'];?>
    <div id="logout">
      <? echo ("<li><a href=\"actions/logout.php\">Logout</a></li>");?>
    </div>
  <? } ?>
</div>