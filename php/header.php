<?php
include("model.php");
session_start();
if(isset($_POST['submit']))
{
	if($_POST['style'] == 'clair')
	{
		$_SESSION['style'] = 0;
	}
	else
	{
		$_SESSION['style'] = 1;
	}
}
if(!isset($_SESSION['style']))
{
	$_SESSION['style'] = 0;
	$link = "clair.css";
}
else
{
	if($_SESSION['style'] == 1)
	{
		$link = "sombre.css";
	}
	else
	{
		$link = "clair.css";
	}
}
?>

<!doctype html>
<html>
    <head>
	<title>Mon doodle à moi</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href=<?php echo $link; ?>>
    </head>
    <body>
