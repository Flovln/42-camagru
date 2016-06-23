<?PHP
include('../tools/users.php');

if ($_POST['submit'] === "OK" && $_POST['login'] && $_POST['passwd'] && $_POST['email'])
{
	$wrong_login = !is_valid_login($_POST['login']);
	$wrong_email = !is_valid_email($_POST['email']);
  	$wrong_passwd = !is_valid_passwd($_POST['passwd']);
 	$login_exists = login_exists($_POST['login']);
 	$email_exists = email_exists($_POST['email']);
	if (!$wrong_login && !$wrong_email && !$wrong_passwd && !$login_exists && !$email_exists) {
   		$success = register_user($_POST['login'], $_POST['passwd'], $_POST['email']);
   		// print message saying an email has been sent before redirecting to index page
  		header('Location: ../index.php');
  	}
}
else
	echo "Error create_account\n";
?>
