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

    var radio = selectedRadioButton();
    console.log("radio ->" + radio);

    photo.setAttribute('src', data);
    xhttp.open("POST", "./stock.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("ajaximg=" + data);
/*    var xhttp = get_HttpRequest();

    if (xhttp.readyState == 0 || xhttp.readyState == 4) 
    {
      xhttp.onreadystatechange = updateThumbnailSection;
      xhttp.open("POST", "./index.php?page=create", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      var radio = selectedRadioButton();
      console.log("radio ->" + radio);
      xhttp.send("img_data=" + data + "&filter=" + radio);
    }
    else 
      setTimeout('takepicture()', 500);
    }*/
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