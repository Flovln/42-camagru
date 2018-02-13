<?
  include('config/application.php');
  include('tools/state.php');
  include('tools/images.php');
  include('includes/header.php');
?>
  <div id="wrapper">
    <?
      if (!isset($_SESSION['login'])) {
        include 'includes/sign_menu.php';
      } else {
        include 'includes/home.php';
      }
    ?>
  </div>
  <? include 'includes/footer.php'; ?>
  </body>
</html>