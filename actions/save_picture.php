<?
	session_start();
	if (!isset($_POST['img_data'], $_POST['filter'], $_SESSION['login']) || empty($_POST['img_data']) || empty($_POST['filter'])) {
		header('../index.php');
		exit;
	}
	$img = !empty($_POST['img_data']) ? $_POST['img_data'] : die("No image was taken");
	//here we give a name to the image
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);

	//src = filter to be applied 
	$src = imagecreatefrompng('../filters/'.$_POST['filter']);
	//dest = webcam picture
	$dest = imagecreatefromstring($fileData);

	// Get width and height of bottom layer
	$dest_width = imagesx($dest);
	$dest_height = imagesy($dest);

	//apply filter on webcam picture
	imagecopy($dest, $src, 0, 0, 0, 0, $dest_width, $dest_height);

	//saving in directory
	if (!file_exists('../user_imgs') && !is_dir('../user_imgs')) {
		mkdir('../user_imgs');
	}
	$imgPath = '../user_imgs/'.$_SESSION['user_id'].'_'.uniqid().'.png';
	imagepng($dest, $imgPath);
	imagedestroy($dest);

	//save img in DB
?>