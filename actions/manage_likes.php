<?
  include('../config/application.php');
  session_start();

  if(isset($_POST)) {
    global $pdo;
    $error = [];

    if ($_SESSION['user_id']) {
      $req = $pdo->prepare('SELECT * FROM Likes WHERE image_id = :pic_id AND user_id = :user_id');
      $req->bindValue('pic_id', $_POST['pic_id']);
      $req->bindValue('user_id', $_SESSION['user_id']);
      if ($req->execute() === false){
        array_push($error, "DB error 1");        
      }
      $ret = $req->fetch();

      if (empty($ret)) {
        $req = $pdo->prepare('INSERT INTO Likes ( image_id, user_id ) VALUES (:pic_id, :user_id)');
        $req->bindValue('pic_id', $_POST['pic_id']);
        $req->bindValue('user_id', $_SESSION['user_id']);
        if ($req->execute() === false){
          array_push($error, "DB error 3");
        }
        $ret = $req->fetch();
/*        if ($ret = $req->fetch() === false){
          array_push($error, "DB error 4");
        }*/
      }
    } else {
      array_push($error, "Session error");
    }
    if ($error) {
      $_SESSION['error'] = $error[0];
    }
    header('Location: ../includes/gallery.php');
  }
?>