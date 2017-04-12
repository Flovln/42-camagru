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

function fetch_comments() {
	echo '';
}

function fetch_likes($picId) {
  global $pdo;

  $req = $pdo->prepare('SELECT COUNT(user_id) FROM Likes WHERE image_id = :pic_id');
  $req->bindValue('pic_id', $picId);
  if ($req->execute() === false){
  	echo 'error yo';
  }
  $ret = $req->fetch();
/*  if ($ret = $req->fetch() === false){
  	echo 'error 2 yo';
  }*/
	echo $ret[0].' ';
}
?>