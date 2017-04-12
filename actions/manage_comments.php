<?
  include('../config/application.php');
  session_start();

  if(isset($_POST)) {
  	global $pdo;
  	$error = [];

  	if ($_SESSION['user_id']) {
  		$req->prepare('INSERT INTO Comments ( image_id, user_id, content, textTime ) VALUES (:pic_id, :userId) ');
  		$req->bindValue();
  		$req->bindValue();
  		$req->bindValue();
  		$req->bindValue();
  	}
  }
  header('Location: ../includes/gallery.php')
?>