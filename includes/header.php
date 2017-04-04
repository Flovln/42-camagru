<div id="header">
<!--  <img src="pictures/Camagru_logo.png" title="camagru" id="logo"> -->
  Camagru
  <? if (isset($_SESSION['auth'])) {
    echo "Welcome " . $_SESSION['login'];?>
    <div id="logout">
      <? echo ("<li><a href=\"/camagru/includes/logout.php\">Logout</a></li>");?>
    </div>
  <? } ?>
</div>