<?php
//Function call in home.php
function display_error() {
  if (isset($_SESSION['error'])) {
    $err = $_SESSION["error"];
    $_SESSION["error"] = "";
    unset($_SESSION["error"]);
    echo $err;
  }
}

function fetch_comments($imgId) {
	global $pdo;

	$req = $pdo->prepare('SELECT * FROM Comments WHERE image_id = :pic_id');
	$req->bindValue('pic_id', $imgId);
  if ($req->execute() === false){
  	echo 'DB error comments';
  }
  $ret = $req->fetchAll();
  foreach ($ret as $comment) {
    $req = $pdo->prepare('SELECT login FROM Users WHERE id = :user_id');
		$req->bindValue('user_id', $comment['user_id']);
	  if ($req->execute() === false){
	  	echo 'DB error comments';  	
		}
    $user = $req->fetch();
		echo '-'.$user['login'] . ': ';
  	echo $comment['content'].'</br>';
  }
}

function fetch_likes($imgId) {
  global $pdo;

  $req = $pdo->prepare('SELECT COUNT(user_id) FROM Likes WHERE image_id = :pic_id');
  $req->bindValue('pic_id', $imgId);
  if ($req->execute() === false){
  	echo 'DB error likes';
  }
  $ret = $req->fetch();
	echo ' '.$ret[0].' ';
}
?>