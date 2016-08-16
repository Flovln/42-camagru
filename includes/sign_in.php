<?php
include ('../tools/users.php');

if (isset($_POST) && isset($_POST['login']) && isset($_POST['passwd']))
{
   if (user_sign_in($_POST['login'], $_POST['passwd']) === true)
    {
        $login = $_POST['login'];
        $req = $pdo->prepare('SELECT * FROM users WHERE login = :login');
        $req->execute([":login" => $_POST['login']]);
    //  $req = $pdo->prepare('SELECT * FROM users WHERE login = ?');
    //  $req->execute([$_POST['login']]);
        $user = $req->fetch(PDO::FETCH_OBJ);
        if ($user->activate === '0') {
            echo "Please make sure your account is activated before signing in";
            return ;
        }
        $_SESSION['login'] = $login; //$_POST['login'];
        header("Location: home.php");
        return ;
    }
    else {
        echo "Wrong username or password used, please try again";
    //  header("Location: ../index.php");
    }
}
?>