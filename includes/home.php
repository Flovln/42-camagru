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
      <input id="uploadButton" type="submit" name="upload_submit" value="Upload Image">
    </form>
  </div>
  <script type="text/javascript" src="js/application.js"></script>
  <script type="text/javascript" src="js/webcam.js"></script>
</div>
<div id="side-container">
</br>
  <?
    function get_user_images($userId)
    {
        global  $pdo;
      
        if (!isset($_SESSION['auth']))
            return (false);
        //use AJAX to automatically update user gallery content
        $req = $pdo->prepare('SELECT * FROM Images WHERE user_id = :userId ORDER BY captureTime DESC');
        $req->bindValue('userId', $userId);

        if ($req->execute() === false) {
          return (false);
        }
        $images = $req->fetchAll(PDO::FETCH_OBJ);
        return ($images);
    }
    $images = get_user_images($_SESSION['user_id']);
    $imagesNb = count($images);
    //Use AJAX to handle pagination
    $pageNb = ceil($imagesNb/5);

    if ($images) {
      for ($i=0; $i < $imagesNb; $i++) {
        echo "<div class=img_snap_container ><img class=image_snap src='".$images[$i]->path."'alt='".$images[$i]->id."'></br>
        <a href='index.php?id=".$images[$i]->id."' ><button class=delbutton name=delete_snap>Delete</button></a></div>";
      }
    } else {
      echo '<p>No pictures on this profile</p>';
    }
  ?>
</div>