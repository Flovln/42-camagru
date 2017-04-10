<?
  include('../config/application.php');
?>
<head>
  <meta charset="utf-8">
  <meta name="description" content="Camagru">
  <meta name="author" content="Florent Violin">
  <link rel="stylesheet" type="text/css" href="../style/main.css">
  <title>Camagru</title>
</head>
<div id="header">
  <a href="../index.php">Camagru</a>
  <? if (isset($_SESSION['auth'])) {
    echo "Welcome " . $_SESSION['login'];?>
    <a href="gallery.php">Gallery</a>
    <a href="../index.php">Edit</a>
    <div id="logout">
      <? 
        echo ("<li><a href=\"../actions/logout.php\">Logout</a></li>");?>
    </div>
  <? } ?>
</div>
<div>
  <h2>Gallery</h2>
  <? if (isset($_SESSION['auth'])) {

    if (isset($_GET['id'])) {
      //CHECK the user can only delete his photos
      global  $pdo;

      $imgId = $_GET['id'];
      $req = $pdo->prepare('DELETE FROM Images WHERE id = :imgId');
      $req->bindValue('imgId', $imgId);

      if($req->execute() === false) {
        echo "Error deleting image";
      }
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
    $images = get_all_images();
    $imagesNb = count($images);

    if ($images) {
      for ($i=0; $i < $imagesNb; $i++) {
        echo "<div class=img_gallery >Posted on ".$images[$i]->captureTime."<img class=image_gallery src='../".$images[$i]->path."'alt='".$images[$i]->id."'></br>
        <a href='gallery.php?id=".$images[$i]->id."' ><button class=delbutton name=delete_snap>Delete</button></a></div>";
      }
    } else {
      echo '<p>No pictures available</p>';
    }
  } else {
    echo "You need to be logged in to access this page";
  }?>
</div>