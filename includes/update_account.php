<?
  include('../config/application.php');
  include('../tools/users.php');
  include('../tools/state.php');

  if (isset($_POST['submit'], $_POST['newpwd'], $_POST['newpwd_confir'])) {
    $error = array();
    $pwd = htmlspecialchars($_POST['newpwd']);
    $pwdConf = htmlspecialchars($_POST['newpwd_confir']);

    if (!is_valid_passwd($pwd)) {
      array_push($error, "Please secure your password");
    }
    else if ($pwd !== $pwdConf) {
      array_push($error, "Please make sure to enter the same password");
    }
    if (!empty($error)) {
      header('Location: ../includes/update_account.php?error='.$error[0].'');
    }
    $new_pwd = password_hash($pwd, PASSWORD_DEFAULT);
    $token = bin2hex(random_bytes(16));
    $req = $pdo->prepare('UPDATE users SET password = :new_pwd WHERE email_id = :token');
    $req->bindValue('new_pwd', $new_pwd);
    $req->bindValue('token', $_GET['token']);
    if ($req->execute() === false) {
      echo "Database error";
    } else {
      header( "refresh:2;url= ../".ROOT );
      echo 'You can now start using your new password';
    }
  }
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Camagru">
    <meta name="author" content="Florent Violin">
    <link rel="stylesheet" type="text/css" href="../style/main.css">
    <title>Camagru</title>
  </head>
  <body class="signup">
    <div id="header">
      <a class="logo" href="../index.php">Camagru</a>
      <a class="gallery-link" href="gallery.php">Gallery</a>
    </div>
    <div class="reset-pwd-style">
    <?  echo '<form action="../includes/update_account.php?token='.$_GET['token'].'" method="POST">'?>
        New password:
        <br /> 
        <input class="input-style" type="password" name="newpwd" required />
        <br />
        New password confirmation:
        <br />
        <input class="input-style" type="password" name="newpwd_confir" required />
        <br />
        <input class="submit-style" type="submit" name="submit" value="OK"/>
      </form>
    <? display_error('err_new_password')?>
    </div>
    <? include '../includes/footer.php'; ?>
  </body>
</html>