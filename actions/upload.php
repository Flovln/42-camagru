<?php
session_start();
include ('../tools/images.php');

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
echo 'filter : '.$_POST['uploadFilter'];
$error = array();
/*
if (isset($_POST['upload_submit'])) {
  echo 'in condition';
  $file = rand(1000,100000)."-".$_FILES['fileToUpload']['name'];
  $file_loc = $_FILES['fileToUpload']['tmp_name'];
  $file_size = $_FILES['fileToUpload']['size'];
  $file_type = $_FILES['fileToUpload']['type'];
  $folder="uploads/";
     
  move_uploaded_file($file_loc,$folder.$file);
  $req = $pdo->prepare('INSERT INTO Images ( file) VALUES ( :file)');
  $req->bindValue(':file', $file);
  $req->bindValue(':type', $file_type);
  $req->bindValue(':size', $file_size);
  if ($req->execute() === false) {
    echo "req error";
  } 
}*/

// Check if image file is a actual image or fake image
if(isset($_POST["upload_submit"])
  && isset($_FILES["fileToUpload"]["tmp_name"])
  && !empty($_FILES["fileToUpload"]["tmp_name"])
  && isset($_POST["uploadFilter"])
  && !empty($_POST["uploadFilter"])) {

  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
  } else {
    array_push($error, "File is not an image");
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  array_push($error, "Sorry, file already exists.");
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  array_push($error, "Sorry, your file is too large");
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
  array_push($error, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
}

if ($error) {
  array_push($error, "Sorry, your file was not uploaded");
} else {
  $imgData = $_FILES["fileToUpload"]["tmp_name"];
  $userId = $_SESSION['user_id'];

  if (create_picture($imgData, $_POST["uploadFilter"], $userId)) {//move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

header('Location: ../index.php');
?>