<?php
include ('../tools/users.php');

if (isset($_POST['submit'], $_POST['email'], $_POST['newpwd'], $_POST['newpwd_confir'])) {
	$errors = array();
	if (!is_valid_email($_POST['email'])) {
		$errors[] = 'Invalid email';
		echo "Invalid email";
	}
	if (!is_valid_passwd($_POST['newpwd'])) {
		$errors[] = 'Invalid password';
		echo "Please secure your password";
	}
	else if ($_POST['newpwd'] !== $_POST['newpwd_confir']) {
		$errors[] = 'Please enter the same password';
		echo "Please enter the same password";
	}
	if (!empty($errors)) {
		return ;
	}
	$new_pwd = password_hash($_POST['newpwd'], PASSWORD_DEFAULT);
	$token = bin2hex(random_bytes(16));
	$req = $pdo->prepare('UPDATE users SET password = :new_pwd, email_id = :token, activated = 0 WHERE email = :email');
	$req->bindValue('new_pwd', $new_pwd);
	$req->bindValue('token', $token);
	$req->bindValue('email', $_POST['email']);
	if ($req->execute() === false) {
		echo "Database error";
	}
	ask_confirmation_newpwd($_POST['email'], $token);
	echo "A message with a confirmation link has been sent to your email address. Please follow the link to activate your new password.";
}
?>
