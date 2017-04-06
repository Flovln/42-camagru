<?
	session_start();
	if (!isset($_POST['img_data'], $_POST['filter'], $_SESSION['login']) || empty($_POST['img_data']) || empty($_POST['filter'])) {
		header('../index.php');
		exit;
	}
	$img = !empty($_POST['img_data']) ? $_POST['img_data'] : die("No image was taken");
	//here we give a name to the image
	$imgName = 'webcam.png';
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);

//	$id = imagecreatefromstring(fileData);
//	echo 'id content'.$id;
//	$src = imagecreatefrompng($_POST['filter']);
//	echo 'print src '.$src;
	//saving
	if (!file_exists('../user_imgs') && !is_dir('../user_imgs')) {
		mkdir('../user_imgs');
	}
	file_put_contents('../user_imgs/'.$imgName, $fileData);
?>