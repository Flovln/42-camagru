<?
  include('config/application.php');
  include('includes/header.php');

  if (isset($_GET['id'])) {
    global  $pdo;

    $imgId = $_GET['id'];
    $req = $pdo->prepare('DELETE FROM Images WHERE id = :imgId');
    $req->bindValue('imgId', $imgId);

    if($req->execute() === false) {
      echo "Error deleting image";
    }
  }

  function display_error() {
    if (isset($_SESSION['error'])) {
      $err = $_SESSION["error"];
      $_SESSION["error"] = "";
      unset($_SESSION["error"]);
      echo $err;
    }
  }
  
?>
    <div id="wrapper">
      <?
        if (!isset($_SESSION['login'])) {
          include 'includes/sign_menu.php';
        } else {
          include 'includes/home.php';
        } ?>
    </div>
    <? require_once 'includes/footer.php'; ?>
  </body>
</html>