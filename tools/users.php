<?php
//require_once ('../config/setup.php');

function is_valid_login($login) {
    return (preg_match('/^[a-zA-Z]{5,12}$/', $login));
}

function is_valid_email($email) {
    return (filter_var($email, FILTER_VALIDATE_EMAIL));
}

function is_valid_passwd($passwd) {
    return (true);
}

function login_exists($login) {
    global $pdo;
    $handle = $pdo->prepare('SELECT id FROM Users WHERE login = :login');
    $handle->bindValue('login', $login);
    if (($res = $handle->execute()) === false)
        return (false);
    if ($handle->fetch() === false)
        return (false);
    return (true);
}

function email_exists($email) {
    global $pdo;
    $handle = $pdo->prepare('SELECT id FROM Users WHERE email = :email');
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
    $handle = $pdo->prepare('INSERT INTO Users ( login, password, email ) VALUES ( :login, :passwd, :email )');
    $handle->bindValue('login', $login);
    $handle->bindValue('password', $hashed);
    $handle->bindValue('email', $email);
    echo "TEST2";
    if ($handle->execute() === false) {
        echo "TEST333";
        foreach ($handle->errorInfo() as $error)
            echo $error;
        echo "TEST3";
        return (false);
    }
    ask_confirmation($login, $email); //, $token);
    echo "TEST5";
    return (true);
}

function ask_confirmation($login, $email) //, $token) 
{
    echo "TEST6";
    $subject = 'Camagru: Please verify your account';
    $content = 'Please verify your account by visiting the link: ' . APPLICATION_ADDR . '/verify/u/' . $name; // . '/token/' . $token;
    mail($email, $subject, $content);
}
/*
function activate_email($user)
{
        global $pdo;
        $handle = $pdo->prepare('UPDATE users SET mail_token = NULL, pass_token = NULL, verified = TRUE WHERE name = :user');
        $handle->bindValue('user', $user);
        return ($handle->execute());
}*/
?>