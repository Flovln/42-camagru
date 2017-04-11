<?
  const LIMIT = 4;

  if (isset($_GET['id'])) {
    global  $pdo;

    $imgId = $_GET['id'];
    $req = $pdo->prepare('DELETE FROM Images WHERE id = :imgId');
    $req->bindValue('imgId', $imgId);

    if($req->execute() === false) {
      echo "Error deleting image";
    }
  }

  if (!isset($_GET["page"])) {
    $start_from = 0;
  } else {
    $start_from = ($_GET["page"] - 1) * LIMIT;
  }

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
      global  $pdo;
      
      //select all images given a user id
      $req = $pdo->prepare('SELECT * FROM Images WHERE user_id = :userId ORDER BY captureTime DESC');
      $req->bindValue('userId', $_SESSION['user_id']);

      if ($req->execute() === false) {
        return (false);
      }
      $imgs = $req->fetchAll(PDO::FETCH_OBJ);
      $imagesCount = count($imgs);

      //does a selection to limit the number of images to be displayed on each page
      $req = $pdo->prepare('SELECT * FROM Images WHERE user_id = :userId ORDER BY captureTime DESC LIMIT :start_from, :limit;');
      $req->bindValue('userId', $_SESSION['user_id']);
      $req->bindValue('start_from', (int)$start_from, PDO::PARAM_INT);
      $req->bindValue('limit', LIMIT, PDO::PARAM_INT);

      if ($req->execute() === false) {
        echo 'error DB';
      }
      $images = $req->fetchAll();

      foreach ($images as $key) {
        echo "<div class=img_snap_container ><img class=image_snap src='".$key['path']."'alt='".$key['id']."'>";
        echo "</br>";
        echo "<a href='index.php?id=".$key['id']."' ><button class=delbutton name=delete_snap>Delete</button></a>";
        echo "</div>";
      }
      if ($imagesCount > LIMIT) {
        for ($i=0; $i < $imagesCount / LIMIT; $i++) { 
          echo "<a href='index.php?page=".($i + 1)."'>".($i + 1)."</a>";
        }
      }
  ?>
</div>