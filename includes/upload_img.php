<?php
if(isset($_POST['upload']) ) // si formulaire soumis
{
	$content_dir = 'upload/'; // dossier où sera déplacé le fichier

    $tmp_file = $_FILES['file']['tmp_name'];

    if( !is_uploaded_file($tmp_file) )
    {
        exit("Le fichier est introuvable");
    }

    // on vérifie maintenant l'extension
    $type_file = $_FILES['file']['type'];

    if( !strstr($type_file, 'jpg') && !strstr($type_file, 'png') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') )
    {
        exit("Le fichier n'est pas une image");
    }

    // on copie le fichier dans le dossier de destination
    $name_file = $_FILES['file']['name'];

    if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
    {
        exit("Impossible de copier le fichier dans $content_dir");
    }

    echo "Le fichier a bien été uploadé";
//    echo $_FILES['file']['name'];
}
?>