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
        var xhttp = get_HttpRequest();

        if (xhttp.readyState == 0 || xhttp.readyState == 4) 
        {
          xhttp.onreadystatechange = updateThumbnailSection;
          xhttp.open("POST", "./index.php?page=create", true);
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          var radio = selectedRadioButton();
          console.log(radio);
          xhttp.send("img_data=" + data + "&filter=" + radio);
        }
        else 
          setTimeout('takepicture()', 500);
        }

      startbutton.addEventListener('click', function(ev){
        takepicture();
        ev.preventDefault();
      }, false);

      xhttp.onreadystatechange = function() {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
          console.log(xhttp.responseText);
        }
      };
    })();

    function selectedRadioButton()
    {
      if (document.getElementById("r1").checked == true)
        return ("test.png");
      else if (document.getElementById("r2").checked == true)
        return ("filter1.png");
      else if (document.getElementById("r3").checked == true)
        return ("filter2.png");
      return (false);
    }
/*
    function selectFilter(x){
      console.log('in selectFilter in home -> ' + x.src);
      try {
        var fil1 = document.getElementById("filter1");
        var fil2 = document.getElementById("filter2");
        var fil3 = document.getElementById("filter3");

        fil1.style.background = "none";
        fil2.style.background = "none";
        fil3.style.background = "none";
        x.style.background="lightgreen";

        document.getElementById('startbutton').disabled = false;
        // set filter value for uploaded file 
        document.getElementById('uploadFilter').value = x.src;
      } catch(e){}
    }*/
    </script>
<!--  <script type="text/javascript" src="js/application.js"></script>
  <script type="text/javascript" src="js/webcam.js"></script>-->
</div>
<div id="side-container">
  Side container / Gallery
</div>