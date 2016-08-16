"use strict";
var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var videoStream = null;
var preLog = document.getElementById('preLog');
var img_filtre;

function image_choose(choose)
{
    img_filtre = choose;
    alert(img_filtre);
    var elem = document.getElementById('snapshot');
    var hidden = document.getElementById('filtre_img');
    hidden.value = img_filtre;
    elem.style.display = '';
}

function img_load() {
    console.log('in');
    var img = document.getElementById('files');
    var hidden = document.getElementById('filtre');
    hidden.style.display = 'block';
}

function log(text)
{
    if (preLog) preLog.textContent += ('\n' + text);
    else alert(text);
}

function snapshot()
{
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);
    var canvas2 = document.getElementById("canvas");
    var img = canvas2.toDataURL("image/png");
    save_img(img,img_filtre);
}

function save_img(img,img_filtre){
    var xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
        afficher_img();
    };
    xhr.open("POST", "add_img.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("img=" + img + "&img_filtre=" + img_filtre);
}

function afficher_img(){
    var xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function()
    {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
            put_result(xhr.responseText);
    };
    xhr.open("POST", "select_img.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send();
}

function put_result(Data){
    var json = JSON.parse(Data);
    var i = 0;
    var html = '';
    while (json[i]){
        html += '<div class="img" onclick="supprimer('+json[i].id+')"><img width="320" height="240" id="'+json[i].id+'" src="'+json[i].nom+'"><div class="hover"></div></div>';
        i++;
    }
    html += '';
    document.getElementById('ladiv').innerHTML = html;
}

function getXMLHttpRequest() {
    var xhr = null;

    if(window.XMLHttpRequest || window.ActiveXObject){
        if(window.ActiveXObject){
            try{
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            }catch(e){
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        }else{
            xhr = new XMLHttpRequest();
        }
    }else{
        alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
        return;
    }
    return xhr;
}

function noStream()
{
    log('Access to camera was denied!');
}

function stop()
{
    var elem = document.getElementById('snapshot');
    var elem2 = document.getElementById('filtre');
    elem.style.display = 'none';
    elem2.style.display = 'none';
    var myButton = document.getElementById('buttonStop');
    if (myButton) myButton.disabled = true;
    myButton = document.getElementById('buttonSnap');
    if (myButton) myButton.disabled = true;
    if (videoStream)
    {
        if (videoStream.stop) videoStream.stop();
        else if (videoStream.msStop) videoStream.msStop();
        videoStream.onended = null;
        videoStream = null;
    }
    if (video)
    {
        video.onerror = null;
        video.pause();
        if (video.mozSrcObject)
            video.mozSrcObject = null;
        video.src = "";
    }
    myButton = document.getElementById('buttonStart');
    if (myButton) myButton.disabled = false;
}

function gotStream(stream)
{
    var myButton = document.getElementById('buttonStart');
    if (myButton) myButton.disabled = true;
    videoStream = stream;
    video.onerror = function ()
    {
        log('video.onerror');
        if (video) stop();
    };
    stream.onended = noStream;
    if (window.webkitURL) video.src = window.webkitURL.createObjectURL(stream);
    else if (video.mozSrcObject !== undefined)
    {//FF18a
        video.mozSrcObject = stream;
        video.play();
    }
    else if (navigator.mozGetUserMedia)
    {//FF16a, 17a
        video.src = stream;
        video.play();
    }
    else if (window.URL) video.src = window.URL.createObjectURL(stream);
    else video.src = stream;
    myButton = document.getElementById('buttonSnap');
    if (myButton) myButton.disabled = false;
    myButton = document.getElementById('buttonStop');
    if (myButton) myButton.disabled = false;
}

function start()
{
    var elem = document.getElementById('filtre');
    elem.style.display = 'block';
    if ((typeof window === 'undefined') || (typeof navigator === 'undefined')) log('This page needs a Web browser with the objects window.* and navigator.*!');
    else if (!(video && canvas)) log('HTML context error!');
    else
    {
        if (navigator.getUserMedia) navigator.getUserMedia({video:true}, gotStream, noStream);
        else if (navigator.oGetUserMedia) navigator.oGetUserMedia({video:true}, gotStream, noStream);
        else if (navigator.mozGetUserMedia) navigator.mozGetUserMedia({video:true}, gotStream, noStream);
        else if (navigator.webkitGetUserMedia) navigator.webkitGetUserMedia({video:true}, gotStream, noStream);
        else if (navigator.msGetUserMedia) navigator.msGetUserMedia({video:true, audio:false}, gotStream, noStream);
        else log('getUserMedia() not available from your Web browser!');
    }
}