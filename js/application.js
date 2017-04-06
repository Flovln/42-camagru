function selectFilter(choose)
{
  console.log('in selectFilter : ' + choose.src);
  img_filtre = choose;
//  alert(img_filtre);
  var elem = document.getElementById('startbutton');
  elem.style.display = '';
/*  try {
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
  } catch(e){}*/
}


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