<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
			<title>Change your password</title>
	</head>
	<body>
	<?php
	if (!isset($_POST['login']) OR $_POST['oldpw'] == NULL OR $_POST['newpw'] == "") {
	?>
		<form action="change_password.php" method="POST">
			Username:
			<br /> 
			<input type="login" name="login"/>
			<br />
			Old password:
			<br /> 
			<input type="oldpassword" name="oldpw"/>
			<br />
			New password:
			<br />
			<input type="newpassword" name="newpw"/>
			<br />
			<input type="submit" name="submit" value="OK"/>
		</form>
	<?php
	}
	else if ($_POST['submit'] === "OK" AND $_POST['oldpw'] !== NULL AND $_POST['newpw'] !== "")
	{
		$_POST['newpw'] = hash("whirlpool", $_POST['newpw']);
		$_POST['oldpw'] = hash("whirlpool", $_POST['oldpw']);
		$content = @file_get_contents("../private/passwd");
  		if (!$content)
        	echo "ERROR\n";
    	$value = unserialize($content);
    	$i = 0;
    	while ($i < count($value))
    	{
       		if ($value[$i]['login'] === $_POST['login'])
       		{
            	if ($value[$i]['passwd'] === $_POST['oldpw'])
            	{
                	$value[$i]['passwd'] = $_POST['newpw'];
               		$content = serialize($value);
               		file_put_contents("../private/passwd", $content);
                	echo "New password edited\n";
                	//require_once("../index.php"); redirige vers la page d'accueil
           		}
            	else
                	echo "ERROR OLD PASSWORD UNVALID\n";
            	return ;
        	}
        	else
            	echo "ERROR WRONG USERNAME\n";
          	$i++;
 		}
	}?>
	</body>
</html>