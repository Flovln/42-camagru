<div id="main-container">
  <div id="filter-container">
    <form>
      <input type="radio" name="filter" value="test.png">
      <img src="filters/test.png" width="" id="filter" onClick=selectFilter('test.png') >
      <input type="radio" name="filter" value="filter1.png">
      <img src="filters/filter1.png" width="" id="filter"> <!-- onClick="select_filter(/filters/filter1.png)"> -->
      <input type="radio" name="filter" value="filter2.png">
      <img src="filters/filter2.png" width="" id="filter"> <!-- onClick="select_filter(/filters/filter2.png)"> -->
    </form>
  </div>
  <div id="webcam-container">
    <div id="webcam">
      <video id="video"></video> 
      <canvas id="canvas"></canvas>
      <button id="startbutton">Prendre une photo</button>
    </div>
  </div>
  <div id="img-upload">
    <form action="../actions/upload.php" method="post" enctype="multipart/form-data">
      Select an image to upload:
      <input type="file" name="fileToUpload" id="fileToUpload">
      <input type="submit" name="submit" value="Upload Image">
    </form>
  </div>
  <script>
    function selectFilter(choose)
    {
      console.log('in selectFilter lalala');
      img_filtre = choose;
      alert(img_filtre);
      var elem = document.getElementById('startbutton');
      elem.style.display = '';
    }
  </script>
  <script type="text/javascript" src="js/webcam.js" async></script>
</div>
<div id="side-container">
  Side container / Gallery
</div>