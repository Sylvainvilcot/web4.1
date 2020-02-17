<?php

	$time = time();
	setcookie("cookie", $time + 3600 * 3);
	header("Location:index.php");
	exit();
?>