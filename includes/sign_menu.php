<div align="center">
  <img src="./pictures/Sf_bay.jpg" id="main_img">
  <form action="./includes/sign_in.php" method="POST">
    Username:
    <br />
    <input type="login" name="login" class="enter_style"/>
    <br />
    Password:
    <br /> 
    <input type="password" name="passwd" class="enter_style"/>
    <br />
    <input type="submit" name="submit" value="Sign In" class="submit_style" />
    <br />
  </form>
  <form action="./includes/sign_up.php" method="POST">
    <input type="submit" name="submit" value="Sign Up" id="signup_style"></input>
  </form>
  <br />
  <form action="./includes/forgot_pwd.php" method="POST">
    <input type="submit" name="submit" value="Forgot your password?" id="forgot_pwd_style"></input>
  </form>
</div>