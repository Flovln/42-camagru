<?php
include ('../tools/users.php');

if (isset($_POST['submit']))
{
  echo'yoooolo';
  $file = rand(1000,100000)."-".$_FILES['fileToUpload']['name'];
  $file_loc = $_FILES['fileToUpload']['tmp_name'];
  $file_size = $_FILES['fileToUpload']['size'];
  $file_type = $_FILES['fileToUpload']['type'];
  $folder="uploads/";
     
  move_uploaded_file($file_loc,$folder.$file);
  $req = $pdo->prepare('INSERT INTO Images ( file) VALUES ( :file)');
  $req->bindValue(':file', $file);
  echo $file_type . " ";
  echo $file_size . " ";
  /*$req->bindValue(':type', $file_type);*/
  /*$req->bindValue(':size', $file_size);*/
  if ($req->execute() === false) {
    echo "req error";
  } 
}

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//ERROR ARRAY INSTEAD
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
// else if everything is ok, try to upload file
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      //CREATE PICTURE ../tools/images.php
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
header('Location: ../index.php');
?>