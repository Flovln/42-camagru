<?php
session_start();
include ('../tools/images.php');

if (!file_exists('../user_imgs') && !is_dir('../user_imgs')) {
  mkdir('../user_imgs');
}
$target_dir = "../user_imgs/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$error = array();

// Check if image file is a actual image or fake image
if(isset($_POST["upload_submit"])
  && isset($_FILES["fileToUpload"]["tmp_name"])
  && !empty($_FILES["fileToUpload"]["tmp_name"])
  && isset($_POST["uploadFilter"])
  && !empty($_POST["uploadFilter"])) {

  $checkImg = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  $checkFilter = getimagesize($_POST["uploadFilter"]);
  $checkType = mime_content_type($_FILES["fileToUpload"]["tmp_name"]);

  if ($checkImg === false || $checkFilter === false) {
    array_push($error, "File is not an image");
  }
  if ($checkType != "image/png" && $checkType != "image/jpeg") {
    array_push($error, "File is not in the right format");
  }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  array_push($error, "Sorry, your file is too large");
}

// Allow certain file formats
if($imageFileType != "png" && $imageFileType != "jpeg") {
  array_push($error, "Sorry, only JPEG & PNG files are allowed.");
}

if (!$error[0] && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
  if (create_fly_picture($target_file, $_POST["uploadFilter"], $_SESSION['user_id'], $checkType)) {
    array_push($error, "Sorry, there was an error uploading your file.");
  }
} else {
  array_push($error, "Sorry, there was an error uploading your file.");  
}

if ($error) {
  $_SESSION['error'] = $error[0];
}

header('Location: ../index.php');
?>