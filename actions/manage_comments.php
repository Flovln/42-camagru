<?
  include('../config/application.php');
  session_start();

  if(isset($_POST)) {
  	global $pdo;
  	$error = [];

  	if ($_SESSION['user_id'] && isset($_POST['comment'])) {
  		$req = $pdo->prepare('INSERT INTO comments ( image_id, user_id, content, textTime ) VALUES (:picId, :userId, :comment, :timeText)');
  		$req->bindValue('picId', $_POST['picId']);
  		$req->bindValue('userId', $_SESSION['user_id']);
  		$req->bindValue('comment', $_POST['comment']);
  		$req->bindValue('timeText', date("Y-m-d H:i:s", time()));
      if ($req->execute() === false){
        array_push($error, "DB error");
      }

      $req = $pdo->prepare('SELECT user_id FROM Images WHERE id=:picId');
      $req->bindValue('picId', $_POST['picId']);
      if ($req->execute() === false){
        array_push($error, "DB error");    	
      }
      $userId = $req->fetch();

      $req = $pdo->prepare('SELECT email FROM Users WHERE id=:userId');
      $req->bindValue('userId', $userId);
      if ($req->execute() === false){
        array_push($error, "DB error");    	
      }
      $ret = $req->fetch();
      mail($ret[0], 'Camagru: New comment','You received a new comment');
  	}
  }
  header('Location: ../includes/gallery.php')
?>