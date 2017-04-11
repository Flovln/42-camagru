function selectedRadioButton()
{
  if (document.getElementById("r1").checked == true)
    return ("filter1.png");
  else if (document.getElementById("r2").checked == true)
    return ("filter2.png");
  else if (document.getElementById("r3").checked == true)
    return ("filter3.png");
  else if (document.getElementById("r4").checked == true)
    return ("filter4.png");
  else if (document.getElementById("r5").checked == true)
    return ("filter5.png");
  return ("");
}

function selectFilter(x) {
  try {
    fil1 = document.getElementById("fil1");
    fil2 = document.getElementById("fil2");
    fil3 = document.getElementById("fil3");
    fil4 = document.getElementById("fil4");
    fil5 = document.getElementById("fil5");

    fil1.style.background = "none";
    fil2.style.background = "none";
    fil3.style.background = "none";
    fil4.style.background = "none";
    fil5.style.background = "none";
    x.style.background="lightgreen";
    //  enable snap button :
    document.getElementById("startbutton").disabled = false;
    //  set filter value for upload form :
    document.getElementById("uploadFilter").value = x.src;
    // enable upload button
    document.getElementById("uploadButton").disabled = false;
  } catch(e){};
}