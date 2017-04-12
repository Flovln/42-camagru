<?
  global  $pdo;
      
  //select all images given a user id
  $req = $pdo->prepare('SELECT * FROM Images WHERE user_id = :userId ORDER BY captureTime DESC');
  $req->bindValue('userId', $_SESSION['user_id']);

  if ($req->execute() === false) {
    return (false);
  }
  $imgs = $req->fetchAll(PDO::FETCH_OBJ);
  $imagesCount = count($imgs);

  //does a selection to limit the number of images to be displayed on each page
  $req = $pdo->prepare('SELECT * FROM Images WHERE user_id = :userId ORDER BY captureTime DESC LIMIT :start_from, :limit;');
  $req->bindValue('userId', $_SESSION['user_id']);
  $req->bindValue('start_from', (int)$start_from, PDO::PARAM_INT);
  $req->bindValue('limit', LIMIT, PDO::PARAM_INT);

  if ($req->execute() === false) {
    echo 'error DB';
  }
  $images = $req->fetchAll();

  foreach ($images as $key) {
    echo "<div class=img_snap_container ><img class=image_snap src='".$key['path']."'alt='".$key['id']."'>";
    echo "</br>";
    echo "<a href='index.php?id=".$key['id']."' ><button class=delbutton name=delete_snap>Delete</button></a>";
    echo "</div>";
  }
?>