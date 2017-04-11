<?
  const LIMIT = 4;

  function display_error() {
    if (isset($_SESSION['error'])) {
      $err = $_SESSION["error"];
      $_SESSION["error"] = "";
      unset($_SESSION["error"]);
      echo $err;
    }
  }

  if (isset($_GET['id'])) {
    global  $pdo;

    $imgId = $_GET['id'];
    $req = $pdo->prepare('DELETE FROM Images WHERE id = :imgId');
    $req->bindValue('imgId', $imgId);

    if($req->execute() === false) {
      echo "Error deleting image";
    }
  }

//TEST
  if (!isset($_GET["page"])) {
    $start_from = 0;
  } else {
    $start_from = $_GET["page"] * LIMIT;
  }

  $req = $pdo->prepare('SELECT * FROM Images WHERE user_id = :userId ORDER BY captureTime DESC');
  $req->bindValue('userId', $_SESSION['user_id']);

  if ($req->execute() === false) {
    return (false);
  }
  $imgs = $req->fetchAll(PDO::FETCH_OBJ);
  $imagesCount = count($imgs);
?>
<div id="main-container">
  <form >
    <div id="filter-container">
      <label>
        <input id="r1" type="radio" name="filter" value="filter1.png" required>
        <img id="fil1" class="filters" width="" onClick="try {selectFilter(this)} catch(e){}" src="filters/filter1.png">
      </label>
      <label>
        <input id="r2" type="radio" name="filter" value="filter2.png" required>
        <img id="fil2" class="filters" width="" onClick="try {selectFilter(this)} catch(e){}" src="filters/filter2.png">        
      </label>
      <label>
        <input id="r3" type="radio" name="filter" value="filter3.png" required>
        <img id="fil3" class="filters" width="" onClick="try {selectFilter(this)} catch(e){}" src="filters/filter3.png">
      </label>
      <label>
        <input id="r4" type="radio" name="filter" value="filter4.png" required>
        <img id="fil4" class="filters" width="" onClick="try {selectFilter(this)} catch(e){}" src="filters/filter4.png">
      </label>
      <label>
        <input id="r5" type="radio" name="filter" value="filter4.png" required>
        <img id="fil5" class="filters" width="" onClick="try {selectFilter(this)} catch(e){}" src="filters/filter5.png">
      </label>
    </div>
    <div id="webcam-container">
      <div id="webcam">
        <video id="video"></video> 
        <canvas id="canvas"></canvas>
        <button id="startbutton" disabled>Take a picture</button>
      </div>
    </div>
  </form>
  <div id="img-upload">
    <form action="actions/upload.php" method="post" enctype="multipart/form-data">
      Select an image to upload:
      <input id="uploadFilter" type="hidden" name="uploadFilter" >
      <input id="fileToUpload" type="file" name="fileToUpload">
      <input id="uploadButton" type="submit" name="upload_submit" value="Upload Image" disabled>
      <div><? display_error(); ?></div>
    </form>
  </div>
  <script type="text/javascript" src="js/application.js"></script>
  <script type="text/javascript" src="js/webcam.js"></script>
</div>
<div id="side-container">
</br>
  <?
    function get_user_images($userId, $start_from)
    {
      global  $pdo;
      
      if (!isset($_SESSION['auth']))
        return (false);
      //use AJAX to automatically update user gallery content
      $req = $pdo->prepare('SELECT * FROM Images WHERE user_id = :userId ORDER BY captureTime DESC LIMIT :start_from, :limit;');
      $req->bindValue('userId', $userId);
      $req->bindValue('start_from', (int)$start_from, PDO::PARAM_INT);
      $req->bindValue('limit', LIMIT, PDO::PARAM_INT);

      if ($req->execute() === false) {
        return (false);
      }
      $images = $req->fetchAll(PDO::FETCH_OBJ);
      return ($images);
    }

    $images = get_user_images($_SESSION['user_id'], $start_from);

    if ($images) {
      for ($i=0; $i < LIMIT; $i++) {
        echo "<div class=img_snap_container ><img class=image_snap src='".$images[$i]->path."'alt='".$images[$i]->id."'>";
        echo "</br>";
        echo "<a href='index.php?id=".$images[$i]->id."' ><button class=delbutton name=delete_snap>Delete</button></a>";
        echo "</div>";
      }
      if ($imagesCount > 4) {
        for ($i=0; $i < $imagesCount / LIMIT; $i++) { 
          echo "<a href='index.php?page=".$i."'>".($i + 1)."</a>";
        }
      }
    } else {
      echo '<p>No pictures on this profile</p>';
    }
  ?>
</div>