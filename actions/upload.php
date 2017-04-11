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
    echo 'error 1';
    array_push($error, "File is not an image");
  }/* else if ($checkType != 'image/png' || $checkType != 'image/jpeg') {
    echo 'error 11';
    array_push($error, "File is not in the right format");
  }*/
}

// Check if file already exists
if (file_exists($target_file)) {
    echo 'error 2';
  array_push($error, "Sorry, file already exists.");
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo 'error 3';
  array_push($error, "Sorry, your file is too large");
}

// Allow certain file formats
if($imageFileType != "png" && $imageFileType != "jpeg") {
    echo 'error 4';
  array_push($error, "Sorry, only JPEG & PNG files are allowed.");
}

if ($error) {
//  array_push($error, "Sorry, your file was not uploaded");
  echo "Sorry, your file was not uploaded\n";
} else {
  $imgData = $_FILES["fileToUpload"]["tmp_name"];
  $userId = $_SESSION['user_id'];

  if (move_uploaded_file($imgData, $target_file)){
    if (create_fly_picture($target_file, $_POST["uploadFilter"], $userId)) {
      echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  } else {
    echo 'Hacking !';
  }
}

header('Location: ../index.php');
?>