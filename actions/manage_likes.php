<?
  include('../config/application.php');

  if(isset($_POST)) {
    global $pdo;
    $error = [];

    if ($_SESSION['user_id']) {
      $req = $pdo->prepare('SELECT * FROM Likes WHERE image_id = :picId AND user_id = :userId');
      $req->bindValue('picId', $_POST['picId']);
      $req->bindValue('userId', $_SESSION['user_id']);
      if ($req->execute() === false){
        array_push($error, "DB error");        
      }
      $ret = $req->fetch();

      if (empty($ret)) {
        $req = $pdo->prepare('INSERT INTO Likes ( image_id, user_id ) VALUES (:picId, :userId)');
        $req->bindValue('picId', $_POST['picId']);
        $req->bindValue('userId', $_SESSION['user_id']);
        if ($req->execute() === false){
          array_push($error, "DB error");
        }
        $ret = $req->fetch();
      }
    } else {
      array_push($error, "Session error");
    }
    if ($error) {
      $_SESSION['error'] = $error[0];
    }
  }
  header('Location: ../includes/gallery.php');
?>