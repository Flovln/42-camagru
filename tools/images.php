<?php

//Function call in save_picture.php
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
  if (!file_exists('../'.UPLOADS) && !is_dir('../'.UPLOADS)) {
    mkdir('../'.UPLOADS);
  }
  $imgPath = UPLOADS.$user_id.'_'.uniqid().'.png';
  imagepng($dest, '../'.$imgPath);
  imagedestroy($dest);

  //save img in DB
  if (!save_picture($user_id, $imgPath)) {
    return true;
  }
}

//Function call in upload.php
function create_fly_picture($img_data, $filter, $user_id, $img_type){
  
  // Filter to be applied
  $src = imagecreatefrompng($filter);
  
  // Image uploaded  
  if ($img_type == 'image/png') {
    $dest = imagecreatefrompng($img_data);
  } else {
    $dest = imagecreatefromjpeg($img_data);    
  }
  // Get width and height of bottom layer
  $dest_width = imagesx($dest);
  $dest_height = imagesy($dest);
  // Copy stamp on bottom layer
  imagecopy($dest, $src, 0, 0, 0, 0, $dest_width, $dest_height);
  // Store in disk and database
  $imgPath = UPLOADS.$user_id.'_'.uniqid().'.png';
  imagepng($dest, '../'.$imgPath);
  imagedestroy($dest);

  //save img in DB
  if (!save_picture($user_id, $imgPath)) {
    return true;
  }
}

function save_picture($user_id, $image)
{
  global $pdo;
  date_default_timezone_set("Europe/Paris");

  if ($user_id === false) {
    return false;
  }
  $handle = $pdo->prepare('INSERT INTO images ( `user`, `user_id`, `path`, `captureTime` ) VALUES ( :user, :user_id, :image, :captureTime )');
  $handle->bindValue('user', $_SESSION['login']);
  $handle->bindValue('user_id', $user_id);
  $handle->bindValue('image', $image);
  $handle->bindValue('captureTime', date("Y-m-d H:i:s", time()));
  if ($handle->execute() === false) {
    return false;
  }
  return true;
}

//Function call in gallery.php
function get_all_images() {
  global  $pdo;
  
  $req = $pdo->prepare('SELECT * FROM Images WHERE id>=1 ORDER BY captureTime DESC');
  if ($req->execute() === false) {
    return false;
  }
  $images = $req->fetchAll(PDO::FETCH_OBJ);
  return $images;
}

//Function call for pagination in gallery.php
function get_selected_images($userId, $start_from)
{
  global  $pdo;
      
  $req = $pdo->prepare('SELECT * FROM Images WHERE id>=1 ORDER BY captureTime DESC LIMIT :start_from, :limit;');
  $req->bindValue('start_from', (int)$start_from, PDO::PARAM_INT);
  $req->bindValue('limit', GALLERY_LIMIT, PDO::PARAM_INT);

  if ($req->execute() === false) {
    return false;
  }
  $images = $req->fetchAll();
  return $images;
}

//Function call in home.php, use to delete likes + comments of a deleted image
function delete_cascade($img_id)
{
  global  $pdo;

  $req = $pdo->prepare('DELETE FROM Images WHERE id = :imgId');
  $req->bindValue('imgId', $img_id);
  if($req->execute() === false) {
    return false;
  }

  $req = $pdo->prepare('DELETE FROM Likes WHERE image_id = :imgId');
  $req->bindValue('imgId', $img_id);
  if($req->execute() === false) {
    return false;
  }

  $req = $pdo->prepare('DELETE FROM Comments WHERE image_id = :imgId');
  $req->bindValue('imgId', $img_id);
  if($req->execute() === false) {
    return false;
  }
}
?>