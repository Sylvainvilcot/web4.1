<?php
  session_start();
  if(isset($_SESSION['user']))
	{
		$link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');
		$user = $_SESSION['user'];
  }
  echo $user;
  $q = mysqli_query($link,"SELECT potion FROM dresseurPokemon WHERE login='$user'");
  foreach($q as $key)
  {
    $nbpots = $key['potion'];
  }
  $q = mysqli_query($link,"SELECT pokePiece FROM dresseurPokemon WHERE login='$user'");
  foreach($q as $key)
  {
    $nbpieces = $key['pokePiece'];
  }

  $nbpots = $nbpots + 1;
  $nbpieces = $nbpieces - 150;

  mysqli_query($link, "UPDATE dresseurPokemon SET potion = $nbpots WHERE login='$user'");
  mysqli_query($link, "UPDATE dresseurPokemon SET pokePiece = $nbpieces WHERE login='$user'");



 ?>
