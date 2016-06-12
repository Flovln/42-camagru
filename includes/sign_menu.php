<!DOCTYPE html>
<html>
    <body>
        <form action="./includes/sign_in.php" method="POST">
	       Username:
            <br />
            <input type="login" name="login" value="<?=$_SESSION['login']?>" class="enter_style"/>
            <br />
            Password:
            <br /> 
            <input type="password" name="passwd" value="<?=$_SESSION['passwd']?>" class="enter_style"/>
            <br />
            <input type="submit" name="submit" value="Sign In" class="submit_style" />
            <br />
        </form>
        <form action="./includes/sign_up.php" method="POST">
            <input type="submit" name="submit" value="Sign Up" id="signup_style"></input>
        </form>
        <br />
        <form action="./includes/change_password.php" method="POST">
            <input type="submit" name="submit" value="Forgot your password?" id="forgot_pwd_style"></input>
        </form>
    </body>
</html>