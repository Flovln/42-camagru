<?php
  include ('../tools/users.php');
  include('../config/application.php');

  $error = array();

  if (isset($_POST['submit'], $_POST['email'])) {
    $email = htmlspecialchars($_POST['email']);

    if (is_valid_email($email) === false){
      array_push($error, "Please enter a valid email");
    }
    $req = $pdo->prepare('SELECT * FROM Users WHERE email= :email');
    $req->bindValue('email', $email);
    if ($req->execute() === false){
      echo 'DB error';
    }
    $ret = $req->fetch();

    if (!empty($error)){
      header('Location: ../includes/reset_my_password.php?error='.$error[0].'');
    }
    ask_confirmation_newpwd($email, $token, $ret['email_id']);
    header( "refresh:2;url= ../".ROOT );
    echo "A message with a confirmation link has been sent to your email address. Please follow the link to change your password.";
  } else {
    echo 'There was an error submitting this form';
  }
?>
