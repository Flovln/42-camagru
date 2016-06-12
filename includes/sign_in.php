<?php
if (($_POST["submit"] === "Sign In") AND isset($_POST["login"]) AND isset($_POST["passwd"])) {
    $_SESSION["login"] = $_POST["login"];
    $_SESSION["passwd"] = $_POST["passwd"];
    $content = @file_get_contents("../private/passwd");
  	if (!$content)
        echo "ERROR\n";
    $value = unserialize($content);
    $i = 0;
    while ($i < count($value))
    {
       	if ($value[$i]['login'] === $_SESSION['login']) {
        	 require_once("home.php");
       	}
        else
            echo "Error\n";
        $i++;
 	}
}
else
	echo "Please enter your login or password";
?>