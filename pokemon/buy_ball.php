<?php
  session_start();
  if(isset($_SESSION['user']))
	{
		$link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');
		$user = $_SESSION['user'];
  }

  $q = mysqli_query($link,"SELECT pokeBall FROM dresseurPokemon WHERE login='$user'");
  foreach($q as $key)
  {
    $nbballs = $key['pokeBall'];
  }
  $q = mysqli_query($link,"SELECT pokePiece FROM dresseurPokemon WHERE login='$user'");
  foreach($q as $key)
  {
    $nbpieces = $key['pokePiece'];
  }

  $nbballs = $nbballs + 1;
  $nbpieces = $nbpieces - 200;

  mysqli_query($link, "UPDATE dresseurPokemon SET pokeBall = $nbballs WHERE login='$user'");
  mysqli_query($link, "UPDATE dresseurPokemon SET pokePiece = $nbpieces WHERE login='$user'");
 ?>
