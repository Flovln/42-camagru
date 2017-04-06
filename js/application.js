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