<div id="main-container">
  <form ><!--action="./index.php?page=create" method="post" name="snapshot"-->
    <div id="filter-container">
      <label>
        <input id="r1" type="radio" name="filter" value="test.png" required>
        <img id="fil1" class="filters" width="" onClick="try {selectFilter(this)} catch(e){}" src="filters/test.png">
      </label>
      <label>
        <input id="r2" type="radio" name="filter" value="filter1.png" required>
        <img id="fil2" class="filters" width="" onClick="try {selectFilter(this)} catch(e){}" src="filters/filter1.png">
      </label>
      <label>
        <input id="r3" type="radio" name="filter" value="filter2.png" required>
        <img id="fil3" class="filters" width="" onClick="try {selectFilter(this)} catch(e){}" src="filters/filter2.png">        
      </label>
    </div>
    <div id="webcam-container">
      <div id="webcam">
        <video id="video"></video> 
        <canvas id="canvas"></canvas>
        <button id="startbutton">Take a picture</button>
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
  Side container / Gallery
</div>