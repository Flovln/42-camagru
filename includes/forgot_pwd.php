<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
      <title>Change your password</title>
  </head>
  <body>
    <form action="change_password.php" method="POST">
      Please enter your email:
      <br /> 
      <input type="email" name="email"/>
      <br />
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
  </body>
</html>