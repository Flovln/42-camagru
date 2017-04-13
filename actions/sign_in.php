<?php
  include('../config/application.php');
  include ('../tools/users.php');
  session_start();

  if (isset($_POST) && isset($_POST['login']) && isset($_POST['passwd']))
  {
    if (user_sign_in($_POST['login'], $_POST['passwd']) === true)
    {
      $login = $_POST['login'];
      $req = $pdo->prepare('SELECT * FROM users WHERE login = :login');
      $req->bindValue(':login', $login);
      $req->execute();
      /* Second syntax for req->execute */
//    $req->execute([":login" => $_POST['login']]);
      /* Third syntax for req->execute */
//    $req = $pdo->prepare('SELECT * FROM users WHERE login = ?');
//    $req->execute([$_POST['login']]);

      $user = $req->fetch(PDO::FETCH_OBJ);
      if ($user->activated === '0') {
        echo "Please make sure your account is activated before signing in";
        return ;
      }
      $_SESSION['auth'] = $user;
      $_SESSION['login'] = $login;
      $_SESSION['user_id'] = $user->id;
      header("Location: ../".ROOT);
    }
    else {
      echo "Wrong username or password, please try again";
    }
  }
?>
