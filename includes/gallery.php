<?
  include('../config/application.php');
  include('../tools/images.php');
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
    <a href="gallery.php">Gallery</a>
  <? if (isset($_SESSION['auth'])) {
    echo "Welcome " . $_SESSION['login'];?>
    <a href="../index.php">Edit</a>
    <div id="logout">
      <? 
        echo ("<li><a href=\"../actions/logout.php\">Logout</a></li>");?>
    </div>
  <? } ?>
</div>
<div>
  <h2>Gallery</h2>
  <? 
      $images = get_all_images();
      // YOU NEED TO BE LOGGUED IN TO COMMENT OR LIKE A PHOTO
//      $likes = ;
//      $comments = ;
      $imagesNb = count($images);

      if ($images) {
        for ($i=0; $i < $imagesNb; $i++) {
          echo "<div class=img_gallery >
          Posted on ".$images[$i]->captureTime." by ".$images[$i]->user."<img class=image_gallery src='../".$images[$i]->path."'alt='".$images[$i]->id."'></br>
          Likes:
          </div>";
        }
      } else {
        echo '<p>The gallery is empty !</p>';
      }
  ?>
</div>