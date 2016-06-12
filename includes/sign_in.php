<?php
function auth($login, $passwd) {
     $pswd_content = "";
     $content = "";
     $tab = array();
     $file = "../private/passwd";
     $pswd_content = hash("whirlpool", $passwd);
    $content = file_get_contents($file);
     $value = unserialize($content);
     foreach ($value as $elem) {
         if ($elem["login"] === $login && $elem["passwd"] === $pswd_content)
            return TRUE;
      }
    return FALSE;
}

if (($_POST["submit"] === "Sign In") AND isset($_POST["login"]) AND isset($_POST["passwd"])) {
    $_SESSION["login"] = $_POST["login"];
    $_SESSION["passwd"] = $_POST["passwd"];
    if (auth($_SESSION['login'], $_SESSION['passwd']) === TRUE) {
    	require_once("home.php");
	}
    else
    	require_once("../index.php");
}
else
	echo "Please enter your login or password";
?>