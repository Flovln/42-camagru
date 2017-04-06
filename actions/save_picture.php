<?
	session_start();
	if (!isset($_POST['img_data'], $_POST['filter'], $_SESSION['login']) || empty($_POST['img_data']) || empty($_POST['filter'])) {
		header('../index.php');
		exit;
	}
	$img = !empty($_POST['img_data']) ? $_POST['img_data'] : die("No image was posted");
	//here we give a name to the image
	$imgName = 'webcam.png';
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);
	//saving
	file_put_contents($imgName, $fileData);
?>