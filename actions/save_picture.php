<?
	session_start();
	include('../tools/images.php');

	if (!isset($_POST['img_data'], $_POST['filter'], $_SESSION['user_id']) || empty($_POST['img_data']) || empty($_POST['filter'])) {
		header('../index.php');
		exit;
	} else {
		$img_data = $_POST['img_data'];
		$filter = $_POST['filter'];
		$user_id = $_SESSION['user_id'];

		create_picture($img_data, $filter, $user_id);
	}
?>