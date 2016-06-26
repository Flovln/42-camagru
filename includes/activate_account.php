<?php
include ('../tools/users.php');

	activate_emai($user);
	echo "account activated";
	//activate() function filling users table with activation row (!= NULL)
	//header to index.php
?>
