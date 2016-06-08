<?php
if ($_GET["submit"] === "OK") {
     $_SESSION["login"] = $_GET["login"];
     $_SESSION["passwd"] = $_GET["passwd"];
}
?>
<!-- <form action="./includes/sign_up.php" method="get"> -->
	Username:
	<br />
	<input type="text" name="login" value="<?=$_SESSION['login']?>" class="enter_style"/>
    <br />
    Password:
    <br /> 
    <input type="password" name="passwd" value="<?=$_SESSION['passwd']?>" class="enter_style"/>
    <br />
    <input type="submit" name="submit" value="Sign In" class="submit_style" />
    <br />
<form action="./includes/sign_up.php" method="get">
    <input type="submit" name="submit" value="Sign Up" id="signup_style"></input>
</form>
    <br />
    <input type="submit" name="submit" value="Forgot your password?" id="forgot_pwd_style"></input>
<!-- </form> -->