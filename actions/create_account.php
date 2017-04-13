<?PHP
include ('../tools/users.php');

$error = array();

if ($_POST['submit'] === "OK" && $_POST['login'] && $_POST['passwd'] && $_POST['email'])
{
	$wrong_login = !is_valid_login($_POST['login']);
	$wrong_email = !is_valid_email($_POST['email']);
  	$wrong_passwd = !is_valid_passwd($_POST['passwd']);
 	$login_exists = login_exists($_POST['login']);
 	$email_exists = email_exists($_POST['email']);
  if ($wrong_login){
    array_push($error, "To secure your account make sure your login is more than 5 characters long");
  }
  if ($wrong_passwd){
    array_push($error, "To secure your account your password has to be at least 7 characters long and must contain at least one digit");
  }
  if ($wrong_email){
    array_push($error, "Please enter a valid email address");
  }
  if (!empty($error)){
    header('Location: ../includes/sign_up.php?error='.$error[0].'');
  }
	if (!$wrong_login && !$wrong_email && !$wrong_passwd && !$login_exists && !$email_exists) {
   	$success = register_user($_POST['login'], $_POST['passwd'], $_POST['email']);
    header("refresh:2;url= ../".ROOT);
    echo "A message with a confirmation link has been sent to your email address. Please follow the link to activate your account";
  }
}
else {
  echo "Error creating account";
}
?>
