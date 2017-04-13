<?PHP
include ('../tools/users.php');

$error = array();

if ($_POST['submit'] === "OK" && $_POST['login'] && $_POST['passwd'] && $_POST['email']) {
  $login = htmlspecialchars($_POST['login']);
  $passwd = htmlspecialchars($_POST['passwd']);
  $email = htmlspecialchars($_POST['email']);

	$wrong_login = !is_valid_login($login);
	$wrong_email = !is_valid_email($email);
  $wrong_passwd = !is_valid_passwd($passwd);
 	$login_exists = login_exists($login);
 	$email_exists = email_exists($email);
  if ($wrong_login){
    array_push($error, "To secure your account make sure your login is more than 5 characters long");
  }
  if ($wrong_passwd){
    array_push($error, "To secure your account your password has to be at least 7 characters long and must contain at least one digit");
  }
  if ($wrong_email){
    array_push($error, "Please enter a valid email address");
  }
  if ($login_exists){
    array_push($error, "This login is already taken");    
  }
  if ($email_exists){
    array_push($error, "This email is already taken");    
  }
  if (!empty($error)){
    header('Location: ../includes/sign_up.php?error='.$error[0].'');
  }
	if (!$wrong_login && !$wrong_email && !$wrong_passwd && !$login_exists && !$email_exists) {
   	$success = register_user($login, $passwd, $email);
    header("refresh:2;url= ../".ROOT);
    echo "A message with a confirmation link has been sent to your email address. Please follow the link to activate your account";
  }
}
else {
  echo "Error creating account";
}
?>
