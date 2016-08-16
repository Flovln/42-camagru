<?php
require_once('database.php');
$sql = file_get_contents('camagru.sql');

try {
	$pdo = new PDO($DB_HOST, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$dbname = "camagru";
	$pdo->query("CREATE DATABASE IF NOT EXISTS $dbname");
	$pdo->query("use $dbname");
	if ($pdo !== false && $pdo->exec($sql) === false)
    	$messages[] = 'Error while installing database';
    else
    	$messages[] = "Database and tables successfully installed";
}

catch(PDOException $e) {
	$messages[] = $e->getMessage();
}
?>

<!doctype html>
<html>
    <head>
        <meta charset=utf-8>
        <title> Application installer </title>
    </head>
    <body>
        <?php if (isset($messages)): ?>
            <?php foreach ($messages as $message): ?>
                <p><?= $message; ?></p>
            <?php
            	endforeach;
        	endif;?>
    </body>
</html>