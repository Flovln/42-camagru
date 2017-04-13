<?
  include('../config/application.php');
  include('../tools/images.php');
  session_start();

  if (!isset($_POST['img_data'], $_POST['filter'], $_SESSION['user_id']) || empty($_POST['img_data']) || empty($_POST['filter'])) {
    header('../'.ROOT);
    exit;
  } else {
    $img_data = $_POST['img_data'];
    $filterPath = '../'.FILTERS.$_POST['filter'];
    $user_id = $_SESSION['user_id'];

    create_picture($img_data, $filterPath, $user_id);
  }
?>