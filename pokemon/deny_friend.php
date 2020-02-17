<?php
  session_start();
  if(isset($_POST['quit']))
	{
		session_destroy();
		header("Location:login.php");
		exit();
	}
  if(isset($_SESSION['user']))
	{
		$link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');
		$user = $_SESSION['user'];
  }
  mysqli_query($link,"UPDATE dresseurPokemon SET id_req = NULL WHERE login='$user'");

 ?>
