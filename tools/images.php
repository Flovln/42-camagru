<?php
include('../config/application.php');

function save_picture($user_id, $image)
{
	global $pdo;

	if ($user_id === false)
	{
		return (false);
	}
	$handle = $pdo->prepare('INSERT INTO images ( `path`, `user_id` ) VALUES ( :path, :user_id );');
    $handle->bindValue('path', $image);
    $handle->bindValue('user_id', $user_id);
    if ($handle->execute() === false)
    {
      return (false);
    }
    return (true);
}

function get_user_images($user)
{
    global  $pdo;

    if (!isset($_SESSION['auth']))
        return (false);
    $req = $pdo->prepare('SELECT * FROM Images WHERE user_id = ? ORDER BY date DESC');
    $req->execute([get_uid($user)]);
    $images = $req->fetchAll(PDO::FETCH_OBJ);
    if (empty($images))
        return (false);
    return ($images);
}
?>