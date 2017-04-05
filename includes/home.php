<div id="main-container">
  <form>
    <div id="filter-container">
      <label>
        <input id="r1" type="radio" name="filter" value="test.png" required>
        <img id="filter" width="" onClick=selectFilter('filters/test.png') src="filters/test.png">
      </label>
      <label>
        <input type="radio" name="filter" value="filter1.png" required>
        <img id="filter" width="" onClick=selectFilter('filter1.png') src="filters/filter1.png">
      </label>
      <label>
        <input type="radio" name="filter" value="filter2.png" required>
        <img id="filter" width="" onClick=selectFilter('filter2.png') src="filters/filter2.png">        
      </label>
    </div>
    <div id="webcam-container">
      <div id="webcam">
        <video id="video"></video> 
        <canvas id="canvas"></canvas>
        <button id="startbutton">Prendre une photo</button>
      </div>
    </div>
  </form>
  <div id="img-upload">
    <form action="actions/upload.php" method="post" enctype="multipart/form-data">
      Select an image to upload:
      <input type="file" name="fileToUpload" id="fileToUpload">
      <input type="submit" name="submit" value="Upload Image">
    </form>
  </div>
  <script>
  (function() {
    var xhttp = new XMLHttpRequest ();

    var streaming    = false,
        video        = document.querySelector('#video'),
        cover        = document.querySelector('#cover'),
        canvas       = document.querySelector('#canvas'),
        photo        = document.querySelector('#photo'),
        startbutton  = document.querySelector('#startbutton'),
        width        = 450,
        height       = 0,
        x            = 0;

    navigator.getMedia = ( navigator.getUserMedia ||
                           navigator.webkitGetUserMedia ||
                           navigator.mozGetUserMedia ||
                           navigator.msGetUserMedia);

    navigator.getMedia(
      {
        video: true,
        audio: false
      },
      function(stream) {
        if (navigator.mozGetUserMedia) {
          video.mozSrcObject = stream;
        }
        else {
          var vendorURL = window.URL || window.webkitURL;
          video.src = vendorURL.createObjectURL(stream);
        }
        video.play();
      },
      function(err) {
        console.log("An error occured! " + err);
      }
    );

    video.addEventListener('canplay', function(ev){
      if (!streaming) {
        height = video.videoHeight / (video.videoWidth/width);
        video.setAttribute('width', width);
        video.setAttribute('height', height);
        canvas.setAttribute('width', width);
        canvas.setAttribute('height', height);
        streaming = true;
      }
    }, false);

    function takepicture() {
      canvas.width = width;
      canvas.height = height;
      canvas.getContext('2d').drawImage(video, 0, 0, width, height);
      var data = canvas.toDataURL('image/png');
      photo.setAttribute('src', data);
      xhttp.open("POST", "./stock.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("ajaximg=" + data);
    }

    startbutton.addEventListener('click', function(ev){
      console.log("Hello");
      takepicture();
      ev.preventDefault();
    }, false);

    xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
        console.log(xhttp.responseText);
      }
    };
  })();
  function selectFilter(choose)
  {
    console.log('in selectFilter : ' + choose);
    img_filtre = choose;
//      alert(img_filtre);
    var elem = document.getElementById('startbutton');
    elem.style.display = '';
  }
  </script>
  <!--<script type="text/javascript" src="js/webcam.js"></script>
  <script type="text/javascript" src="js/application.js"></script>-->
</div>
<div id="side-container">
  Side container / Gallery
</div>