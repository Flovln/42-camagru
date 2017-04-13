<?
  include('../config/application.php');
  include('../tools/users.php');
  include('../tools/state.php');

  if (isset($_POST['submit'], $_POST['newpwd'], $_POST['newpwd_confir'])) {
    $error = array();

    if (!is_valid_passwd($_POST['newpwd'])) {
      array_push($error, "Please secure your password");
    }
    else if ($_POST['newpwd'] !== $_POST['newpwd_confir']) {
      array_push($error, "Please make sure to enter the same password");
    }
    if (!empty($error)) {
      header('Location: ../includes/update_account.php?error='.$error[0].'');
    }
    $new_pwd = password_hash($_POST['newpwd'], PASSWORD_DEFAULT);
    $token = bin2hex(random_bytes(16));
    $req = $pdo->prepare('UPDATE users SET password = :new_pwd WHERE email_id = :token');
    $req->bindValue('new_pwd', $new_pwd);
    $req->bindValue('token', $_GET['token']);
    if ($req->execute() === false) {
      echo "Database error";
    } else {
      header( "refresh:2;url= ../index.php" );
      echo 'You can now start using your new password';
    }
  }

echo '<form action="../includes/update_account.php?token='.$_GET['token'].'" method="POST">'?>
  New password:
  <br /> 
  <input type="password" name="newpwd"/>
  <br />
  New password confirmation:
  <br />
  <input type="password" name="newpwd_confir"/>
  <br />
  <input type="submit" name="submit" value="OK"/>
</form>
<? display_error('err_new_password')?>