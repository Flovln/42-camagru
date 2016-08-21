<?php
include('../config/application.php');

function save_picture($user_id, $image)
{
	global $pdo;

	if ($user_id === false)
	{
		return (false);
	}
	$handle = $pdo->prepare('INSERT INTO images ( `path`, `user_id` ) VALUES ( :image, :user_id );');
    $handle->bindValue('path', $image);
    $handle->bindValue('user_id', $user_id);
    if ($handle->execute() === false)
    {
      return (false);
    }
    return (true);
}

function get_user_images($login)
{
    global  $pdo;

    if (!isset($_SESSION['auth'])) //auth is an object pointing to the DB table, we can access all elements in the table through it
        return (false);
    $req = $pdo->prepare('SELECT * FROM Images WHERE login = ? ORDER BY date DESC');
    $req->execute([get_user_id($login)]);
    $images = $req->fetchAll(PDO::FETCH_OBJ);
    if (empty($images))
        return (false);
    return ($images);
}
?>