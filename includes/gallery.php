<?
  include('../config/application.php');
  include('../tools/images.php');
  include('../tools/state.php');

  if (!isset($_GET["page"])) {
    $start_from = 0;
  } else {
    $start_from = ($_GET["page"] - 1) * GALLERY_LIMIT;
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
  <body class="gallery">
    <div id="header">
      <a class="logo" href="../index.php">Camagru</a>
      <a class="gallery-link" href="gallery.php">Gallery</a>
      <? 
        if (isset($_SESSION['auth'])) {
          echo "Welcome " . $_SESSION['login']."!";?>
      <a class="home" href="../index.php">Home</a>
      <a class="logout" href="../actions/logout.php">Logout</a>
      <? } ?>
    </div>
    <br/>
    <br/>
    <div class="gallery-container">
      <? 
        $images = get_all_images();
        $imagesCount = count($images);
        $imagesSelection = get_selected_images($_SESSION['user_id'], $start_from);
        foreach ($imagesSelection as $key) {
          echo "<div class=gallery-img-container >";
            echo "<p>Posted on ".$key['captureTime']." by ".$key['user']."</p>";
            echo "<img class=img-props-gallery src='../".$key['path']."'alt='".$key['id']."'>";
            echo "</br>";
            if (!empty($_SESSION['auth'])){
              echo '<form style="display:inline;" action="../actions/manage_comments.php" method="POST">';
              echo '<input type="textarea" name="comment" maxlength="2000" style="width:20vmin;height:2vmin" />';
              echo '<input type="text" name="picId" value="'.$key["id"].'" style="display:none" />';
              echo '<input class=submit-comment type="submit" value="Post" style="display:inline">';
              echo '</form>';            
            }
            echo '<p>&hearts;';
            fetch_likes($key['id']);
            echo '</p>';
            if (!empty($_SESSION['auth'])){
              echo '<form action="../actions/manage_likes.php" style="display:inline;" method="POST">';
              echo '<input class=input-comment type="text" name="picId" value="'.$key["id"].'" style="display:none" />';
              echo '<input class=submit-like type="submit" value="Like"/>';
              echo '</form>';            
            }
            echo '</br>';
            echo '<div class="comments">';
              fetch_comments($key['id']);
            echo '</div>';
          echo "</div>";
        }
        echo "<div class=gallery-pagination>";
        if ($imagesCount > GALLERY_LIMIT) {
          for ($i=0; $i < $imagesCount / GALLERY_LIMIT; $i++) { 
            echo "<a href='gallery.php?page=".($i +1)."'>".($i + 1)."</a>";
          }
        }
        echo "</div>";
      ?>
    </div>
    <? include '../includes/footer.php'; ?>
  </body>
</html>