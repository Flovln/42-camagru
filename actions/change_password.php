<?php
include ('../tools/users.php');
include('../config/application.php');

if (isset($_POST['submit'], $_POST['email'])) {
  $req = $pdo->prepare('SELECT * FROM Users WHERE email= :email');
  $req->bindValue('email', $_POST['email']);
  if ($req->execute() === false){
    echo 'error';
  }
  $ret = $req->fetch();

  ask_confirmation_newpwd($_POST['email'], $token, $ret['email_id']);
  header( "refresh:2;url= ../index.php" );
  echo "A message with a confirmation link has been sent to your email address. Please follow the link to change your password.";
}
?>
