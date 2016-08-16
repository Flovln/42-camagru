<?php
include ('../tools/users.php');

if (!isset($_GET['token']) || empty($_GET['token'])) {
	echo "No activation key filled";
	$errors[] = 'error';
}
if (!isset($errors) || empty($errors))
{
	$req = $pdo->prepare('SELECT * FROM users WHERE email_id = :token');
	$req->bindValue('token', $_GET['token']);
	if ($req->execute() === false) {
		echo "Database request error";
	}
	else if (($user = $req->fetch(PDO::FETCH_OBJ)) === false) {
		echo "Account not found";
	}
	else if ($user->activate === '1') {
		echo "Password already validated";
	}
	else
	{
		if ($user->email_id === $_GET['token'])
		{
			if (activate_newpwd($_GET['token']) === false) {
				echo "Unable to activate your new password, please retry or reach us if you encounter any difficulties";
			}
			else {
				echo "New password activated";
			//	header("Location: ../index.php");
			}
		}
		else {
			echo "Invalid token";
		}
	}
}
?>