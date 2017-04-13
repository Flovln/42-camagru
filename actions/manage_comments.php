<?
  include('../config/application.php');

  if(isset($_POST) && !empty($_POST['comment']) && strlen($_POST['comment']) < 2000) {
  	global $pdo;
  	$error = [];

  	if ($_SESSION['user_id']){
  		$req = $pdo->prepare('INSERT INTO comments ( image_id, user_id, content, textTime ) VALUES (:picId, :userId, :comment, :timeText)');
  		$req->bindValue('picId', $_POST['picId']);
  		$req->bindValue('userId', $_SESSION['user_id']);
  		$req->bindValue('comment', htmlspecialchars($_POST['comment']));
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

      $req = $pdo->prepare('SELECT * FROM Users WHERE id=:userId');
      $req->bindValue('userId', $userId[0]);
      if ($req->execute() === false){
        array_push($error, "DB error");    	
      }
      $ret = $req->fetch();
      mail($ret['email'], 'Camagru: new comment','Hi '.$ret['login'].','."\n\n".'Someone commented one of your post!'."\n\n".'Have a nice day,'."\n\n".'The Camagru team.');
  	}
  	if ($error) {
      $_SESSION['error'] = $error[0];
    }
  }
  header('Location: ../includes/gallery.php')
?>