<?php
include('../config/application.php');

function create_picture($img_data, $filter, $user_id) {
    //Get the img and decode it
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
    $imgPath = 'user_imgs/'.$user_id.'_'.uniqid().'.png';
    imagepng($dest, '../'.$imgPath);
    imagedestroy($dest);

    //save img in DB
    save_picture($user_id, $imgPath);
}


function create_fly_picture($img_data, $filter, $user_id){
  
  // Filter to be applied
  $src = imagecreatefrompng($filter);
  // Image uploaded
  $dest = imagecreatefrompng($img_data);
  // Get width and height of bottom layer
  $dest_width = imagesx($dest);
  $dest_height = imagesy($dest);
  // Copy stamp on bottom layer
  imagecopy($dest, $src, 0, 0, 0, 0, $dest_width, $dest_height);
  // Store in disk and database
  $imgPath = 'user_imgs/'.$user_id.'_'.uniqid().'.png';
  imagepng($dest, '../'.$imgPath);
  imagedestroy($dest);

  //save img in DB
  save_picture($user_id, $imgPath);
}

function save_picture($user_id, $image)
{
  global $pdo;

  if ($user_id === false) {
    return (false);
  }
  $handle = $pdo->prepare('INSERT INTO images ( `user`, `user_id`, `path`, `captureTime` ) VALUES ( :user, :user_id, :image, :captureTime )');
  $handle->bindValue('user', $_SESSION['login']);
  $handle->bindValue('user_id', $user_id);
  $handle->bindValue('image', $image);
  $handle->bindValue('captureTime', date("Y-m-d H:i:s", time()));
  if ($handle->execute() === false) {
    return (false);
  }
  return (true);
}

function get_all_images() {
  global  $pdo;
  
  $req = $pdo->prepare('SELECT * FROM Images WHERE id>=1 ORDER BY captureTime DESC');
  if ($req->execute() === false) {
    return (false);
  }
  $images = $req->fetchAll(PDO::FETCH_OBJ);
  return $images;
}

/* 
function get_user_images($userId)
{
    global  $pdo;

    if (!isset($_SESSION['auth'])) //auth is an object pointing to the DB table, we can access all elements in the table through it
        return (false);
    $req = $pdo->prepare('SELECT * FROM Images WHERE user_id = ? ORDER BY captureTime DESC');
    if ($req->execute() === false) {
      return (false);
    }
    $images = $req->fetchAll(PDO::FETCH_OBJ);
//    if (empty($images))
//        return (false);
    return ($images);
}*/
?>