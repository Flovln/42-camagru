<?php
include ('../tools/users.php');

if (!isset($_GET['login']) || empty($_GET['login'])) {
	echo "No username filled";
	$errors[] = 'error';
}
else if (!is_valid_login($_GET['login'])) {
	echo "Unvalid username";
	$errors[] = 'error';
}
if (!isset($_GET['token']) || empty($_GET['token'])) {
	echo "No activation key filled";
	$errors[] = 'error';
}
if (!isset($errors) || empty($errors))
{
	$handle = $pdo->prepare('SELECT * FROM users WHERE login = :login');
	$handle->bindValue('login', $_GET['login']);
	if ($handle->execute() === false) {
		echo "Database request error";
	}
	else if (($user = $handle->fetch(PDO::FETCH_OBJ)) === false) {
		echo "Account not found";
	}
	else if ($user->activate === '1') {
		echo "Account already validated";
	}
	else
	{
		if ($user->email_id === $_GET['token']) // || $user->pass_token === $_GET['token'])
		{
			if (activate_email($_GET['login']) === false) {
				echo "Unable to activate your account, please retry or reach us if you encounter any difficulties";
			}
			else {
				echo "account activated";
				// rediriger vers home page
			}
		}
		else {
			echo "Invalid token";
		}
	}
}
?>
