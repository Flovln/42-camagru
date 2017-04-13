<?php
include('../config/application.php');

function is_valid_login($login) {
  if (strlen($login) >= 5){
    return true;
  } else {
    return false;
  }
}

function is_valid_email($email) {
  return (filter_var($email, FILTER_VALIDATE_EMAIL));
}

function is_valid_passwd($passwd) {
  if(!ctype_alpha($passwd) && strlen($passwd) >= 7){
    return true;
  } else {
    return false;
  }
}

function get_user_id($login)
{
  global $pdo;

  $req = $pdo->prepare('SELECT id FROM users WHERE login = :login');
  $req->bindValue('login', $login);
  if ($req->execute() === false) {
    return (false);
  }
  if (($res = $req->fetch(PDO::FETCH_OBJ)) === false) {
    return (false);
  }
  return ($res->id);
}

function user_sign_in($login, $password)
{
  global $pdo;

  $req = $pdo->prepare('SELECT password FROM users WHERE login = :login');
  $req->bindValue(':login', $login);
  if ($req->execute() === false) {
    return (false);
  }
  if (($result = $req->fetch(PDO::FETCH_OBJ)) === false) {
    return (false);
  }
  return (password_verify($password, $result->password));
}

function login_exists($login) {
  global $pdo;

  $req = $pdo->prepare('SELECT id FROM Users WHERE login = :login');
  $req->bindValue('login', $login);
  if (($res = $req->execute()) === false)
    return (false);
  if ($req->fetch() === false)
    return (false);
  return (true);
}

function email_exists($email) {
  global $pdo;

  $req = $pdo->prepare('SELECT id FROM Users WHERE email = :email');
  $req->bindValue('email', $email);
  if (($res = $req->execute()) === false)
    return (false);
  if ($req->fetch() === false)
    return (false);
  return (true);
}

function register_user($login, $passwd, $email) {
  global $pdo;

  $hashed = password_hash($passwd, PASSWORD_DEFAULT);
  $req = $pdo->prepare('INSERT INTO Users ( login, password, email, email_id ) VALUES ( :login, :passwd, :email, :token )');
  $token = bin2hex(random_bytes(16));
  $req->bindValue('login', $login);
  $req->bindValue('passwd', $hashed);
  $req->bindValue('email', $email);
  $req->bindValue('token', $token);   
  if ($req->execute() === false) {
    foreach ($req->errorInfo() as $error)
      echo $error;
    return (false);
  }
  ask_confirmation($login, $email, $token);
  return (true);
}

function ask_confirmation($login, $email, $token) {
  $subject = 'Camagru: Your new account';
  $link = APPLICATION_ADDR.'/actions/activate_account.php?login=' . $login .'&token=' . $token;
  $content = 'Welcome '.$login.','."\n\n".'In order to use our platform, please verify your account.'."\n\n".'You can confirm your account using the link below: '."\n".$link."\n\n".'The camagru team.';
  mail($email, $subject, $content);
}

function ask_confirmation_newpwd($email, $token, $email_id) {
  $subject = 'Camagru: Forget your password';
  $link = APPLICATION_ADDR.'/includes/update_account.php?token='.$email_id.'';
  $content = 'Hi '.$email.','."\n\n".'Please confirm your new password through the link below: '.$link."\n\n".'The camagru team.';
  mail($email, $subject, $content);
}

function activate_newpwd($token){
  global $pdo;

  $req = $pdo->prepare('UPDATE Users SET email_id = NULL, activated = TRUE WHERE email_id = :token');
  $req->bindValue('token', $token);
  return ($req->execute());
}

function activate_email($login){
  global $pdo;

  $req = $pdo->prepare('UPDATE Users SET activated = TRUE WHERE login = :login');
  $req->bindValue('login', $login);
  return ($req->execute());
}
?>
