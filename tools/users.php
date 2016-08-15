<?php
include('../config/database.php');

// ----------------------------- ---------------------------------- //
//to be move in application.php
try {
    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
}
catch (PDOException $e) {
    die ('Connexion SQL impossible');
}

// ----------------------------- --------------------------------- //

function is_valid_login($login) {
    return (preg_match('/^[a-zA-Z]{5,12}$/', $login));
}

function is_valid_email($email) {
    return (filter_var($email, FILTER_VALIDATE_EMAIL));
}

function is_valid_passwd($passwd) {
   // return (preg_match('/^[a-zA-Z]{5,12}$/', $login)); creates error when signing up
    return (true);
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
    $handle = $pdo->prepare('INSERT INTO Users ( login, password, email, email_id ) VALUES ( :login, :passwd, :email, :token )');
    $token = bin2hex(random_bytes(16)); //email_id
    $handle->bindValue('login', $login);
    $handle->bindValue('passwd', $hashed);
    $handle->bindValue('email', $email);
    $handle->bindValue('token', $token);   
    if ($handle->execute() === false) {
        foreach ($handle->errorInfo() as $error)
            echo $error;
        return (false);
    }
    ask_confirmation($login, $email, $token);
    return (true);
}

function ask_confirmation($login, $email, $token) {
    $subject = 'Camagru: Please verify your account';
    /* port 8888 for home / port 8080 for school */
    $link = 'http://localhost:8888/camagru/includes/activate_account.php?login=' . $login .'&token=' . $token;
    $content = 'Please verify your account by visiting the following link ' . $link;
    //<html></html> email form including vars like content + link
    mail($email, $subject, $content);
}

function activate_email($login){
        global $pdo;

        $handle = $pdo->prepare('UPDATE Users SET email_id = NULL, activate = TRUE WHERE login = :login');
        $handle->bindValue('login', $login);
        return ($handle->execute());
}
?>