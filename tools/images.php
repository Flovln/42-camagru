<?php
include('../config/application.php');

function create_picture($img_data, $filter, $user_id) {
    //Get the img and decode it
    echo 'img_data : '.$img_data.'  ';
    echo 'filter : '.$filter.'  ';
    echo 'user_id : '.$user_id.'  ';
    $img = !empty($img_data) ? $img_data : die("No image was taken");
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $fileData = base64_decode($img);

    //filter to be applied 
    $src = imagecreatefrompng($filter);
    //webcam picture
    $dest = imagecreatefromstring($fileData);

    //Get width and height of bottom layer
    $dest_width = imagesx($dest);
    $dest_height = imagesy($dest);

    //apply filter on bottom picture
    imagecopy($dest, $src, 0, 0, 0, 0, $dest_width, $dest_height);

    //saving in directory
    if (!file_exists('../user_imgs') && !is_dir('../user_imgs')) {
        mkdir('../user_imgs');
    }
    $imgPath = '../user_imgs/'.$user_id.'_'.uniqid().'.png';
    imagepng($dest, $imgPath);
    imagedestroy($dest);

    //save img in DB
    save_picture($user_id, $imgPath);
}

function save_picture($user_id, $image)
{
	global $pdo;

	if ($user_id === false)
	{
		return (false);
	}
	$handle = $pdo->prepare('INSERT INTO images ( `user_id`, `path`, `timestamp` ) VALUES ( :user_id, :image, '.time().' );');
    $handle->bindValue('path', $image);
    $handle->bindValue('user_id', $user_id);
    if ($handle->execute() === false)
    {
      return (false);
    }
    return (true);
}

function get_user_images($login)
{
    global  $pdo;

    if (!isset($_SESSION['auth'])) //auth is an object pointing to the DB table, we can access all elements in the table through it
        return (false);
    $req = $pdo->prepare('SELECT * FROM Images WHERE login = ? ORDER BY date DESC');
    $req->execute([get_user_id($login)]);
    $images = $req->fetchAll(PDO::FETCH_OBJ);
    if (empty($images))
        return (false);
    return ($images);
}
?>