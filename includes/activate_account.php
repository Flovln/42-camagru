<?php
include ('../tools/users.php');
/*
try
{
    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
}
catch (PDOException $e)
{
    die ('Connexion SQL impossible');
}*/
//	echo "account activated";//test
	if (!isset($_GET['login'])) {
		echo "No username filled";
		$errors[] = 'error';
	}
/*	else if (!is_valid_login($_GET['login'])) {
		echo "Unvalid username";
		$errors[] = 'error';
	}*/
	if (!isset($_GET['token'])) {
		echo "No activation key filled";
		$errors[] = 'error';
	}
	if (!isset($errors) || empty($errors))
	{
//		$handle = $pdo->prepare('SELECT * FROM users WHERE token = :email_id');
		$handle = $pdo->prepare('SELECT * FROM users WHERE login = :login');
		$handle->bindValue('login', $_GET['login']);
		$handle->bindValue('email_id', $_GET['token']);
		if ($handle->execute() === false)
		{
			$errors[] = 'Database request error';
		}
		else if (($user = $handle->fetch(PDO::FETCH_OBJ)) === false)
		{
			$errors[] = 'Account not found';
		}
		else if ($user->activate === '1')
		{
			$errors[] = 'Account already validated';
		}
	}
	else
	{
		if ($user->mail_id === $_GET['token'])// || $user->pass_token === $_GET['token'])
		{
			if (activate_email($_GET['login']) === false/* || !isset($_GET['token'])*/) {
				$errors[] = 'Unable to activate your email, please retry or reach us';
			}
			else {
				echo "account activated";
			}
		}
		else {
			$errors[] = 'Invalid token';
		}
	}
?>
