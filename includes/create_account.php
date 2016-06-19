<?PHP
//require_once ('./tools/users.php')

function is_valid_login($login) {
    return (preg_match('/^[a-zA-Z]{3,8}$/', $login));
}

function is_valid_email($email) {
    return (filter_var($email, FILTER_VALIDATE_EMAIL));
}

function is_valid_passwd($passwd) {
    return (true);
}

function login_exists($login) {
    global $pdo;
    $handle = $pdo->prepare('SELECT id FROM users WHERE login = :login');
    $handle->bindValue('login', $login);
    if (($res = $handle->execute()) === false)
        return (false);
    if ($handle->fetch() === false)
        return (false);
    return (true);
}

function email_exists($email) {
    global $pdo;
    $handle = $pdo->prepare('SELECT id FROM users WHERE email = :email');
    $handle->bindValue('email', $email);
    if (($res = $handle->execute()) === false)
        return (false);
    if ($handle->fetch() === false)
        return (false);
    return (true);
}

function register_user($login, $passwd, $email) {
  	global $pdo;
  
    $hashed = password_hash($passwd, PASSWORD_DEFAULT);
    $handle = $pdo->prepare('INSERT INTO Users (login, password, email) VALUES (:login, :passwd, :email)');
//    $token = hash('sha256', 'foo' . time());
    $handle->bindValue('login', $login);
    $handle->bindValue('passwd', $hashed);
    $handle->bindValue('email', $email);
//    $handle->bindValue('token', $token);
    if ($handle->execute() === false) {
        foreach ($handle->errorInfo() as $error)
            echo $error;
        return (false);
    }
 //   ask_confirmation($login, $email); //, $token);
    return (true);
}

function ask_confirmation($login, $email) //, $token) 
{
    $subject = 'Camagru: Please verify your account';
    $content = 'Please verify your account by visiting the link: ' . APPLICATION_ADDR . '/verify/u/' . $name; // . '/token/' . $token;
    mail($email, $subject, $content);
}

if ($_POST['submit'] === "OK" && $_POST['login'] && $_POST['passwd'] && $_POST['email']) {
//	$wrong = true;
//  	$success = false;
/*
  	echo "test";
	$wrong_login = !is_valid_login($_POST['login']);
	echo "test1";
  	$wrong_email = !is_valid_email($_POST['email']);
  	echo "test2";
  	$wrong_passwd = !is_valid_passwd($_POST['passwd']);
  	echo "test3";
  	$login_exists = login_exists($_POST['login']);
  	echo "test4";
  	$email_exists = email_exists($_POST['email']);
  	echo "test5";
  	if (!$wrong_login && !$wrong_email && !$wrong_passwd !$login_exists && !$email_exists) {*/
    	$success = register_user($_POST['login'], $_POST['passwd'], $_POST['email']);
/*    	$wrong = false;
  }*/
}
else
	echo "Error2\n";
?>
