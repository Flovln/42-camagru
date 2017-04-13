<?php
include ('../tools/users.php');
include('../config/application.php');

if (isset($_POST['submit'], $_POST['email'])) {
  $email = htmlspecialchars($_POST['email']);

  $req = $pdo->prepare('SELECT * FROM Users WHERE email= :email');
  $req->bindValue('email', $email);
  if ($req->execute() === false){
    echo 'error';
  }
  $ret = $req->fetch();

  ask_confirmation_newpwd($email, $token, $ret['email_id']);
  header( "refresh:2;url= ../".ROOT );
  echo "A message with a confirmation link has been sent to your email address. Please follow the link to change your password.";
}
?>
