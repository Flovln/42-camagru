<?
  include('../config/application.php');
  include('../tools/images.php');
  include('../tools/state.php');

  const LIMIT = 6;

  if (!isset($_GET["page"])) {
    $start_from = 0;
  } else {
    $start_from = ($_GET["page"] - 1) * LIMIT;
  }
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Camagru">
    <meta name="author" content="Florent Violin">
    <link rel="stylesheet" type="text/css" href="../style/main.css">
    <title>Camagru</title>
  </head>
  <body>
    <div id="header">
      <a href="../index.php">Camagru</a>
        <a href="gallery.php">Gallery</a>
        <? 
          if (isset($_SESSION['auth'])) {
            echo "Welcome " . $_SESSION['login'];
        ?>
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
        $imagesCount = count($images);
        $imagesSelection = get_selected_images($_SESSION['user_id'], $start_from);
          // YOU NEED TO BE LOGGED IN TO COMMENT OR LIKE A PHOTO
        foreach ($imagesSelection as $key) {
          echo "<div class=img_gallery >";
          echo "Posted on ".$key['captureTime']." by ".$key['user']."";
          echo "<img class=image_gallery src='../".$key['path']."'alt='".$key['id']."'>";
          echo "</br>";
          echo '&hearts;';
          fetch_likes($key['id']);
          if (!empty($_SESSION['auth'])){
            echo '<form action="../actions/manage_likes.php" style="display:inline;" method="POST">';
            echo '<input type="text" name="pic_id" value="'.$key["id"].'" style="display:none" />';
            echo '<input type="submit" value="Like"/>';
            echo '</form>';            
          }
          if (!empty($_SESSION['auth'])){
            
          }
          display_error();
          fetch_comments();
          if ($_SESSION['auth']) {
            //comments + likes DB
          }
          echo "</div>";
        }
        echo "<div>";
        if ($imagesCount > LIMIT) {
          for ($i=0; $i < $imagesCount / LIMIT; $i++) { 
            echo "<a href='gallery.php?page=".($i +1)."'>".($i + 1)."</a>";
          }
        }
        echo "</div>";
      ?>
    </div>
    <? include '../includes/footer.php'; ?>
  </body>
</html>