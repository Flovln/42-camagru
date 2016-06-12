<?PHP
if ($_POST['submit'] === "OK" && $_POST['login'] && $_POST['passwd'])
{
	if (!file_exists("../private"))
		mkdir("../private");
	if (!file_exists("../private/passwd"))
		file_put_contents("../private/passwd", "");
	$_POST['passwd'] = hash("whirlpool", $_POST['passwd']);
	$content = file_get_contents("../private/passwd");
	$value = unserialize($content);
	if ($value){
		foreach ($value as $tab){
			if ($tab['login'] == $_POST['login'])
			{
				echo "Error sign_up 1\n";
				return ;
			}
		}
	}
	$new['login'] = $_POST['login'];
	$new['passwd'] = $_POST['passwd'];
	$value[] = $new;
	$content = serialize($value);
	file_put_contents("../private/passwd", $content);
//	echo "OK\n";
	require_once("home.php");
}
else
	echo "Error2\n";
?>
