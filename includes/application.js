function selectFilter(choose)
{
  console.log('in selectFilter');
  img_filtre = choose;
  alert(img_filtre);
  var elem = document.getElementById('startbutton');
  elem.style.display = '';
}