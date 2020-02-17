<?php
  session_start();
  if(isset($_SESSION['user']))
  {
    $link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');
    $user = $_SESSION['user'];
  }

  $pok1 = mysqli_query($link,"SELECT id_pc1 FROM dresseurPokemon WHERE login='$user'");
	foreach($pok1 as $key)
	{
		$pok1_2 = $key['id_pc1'];
	}

	$pok2 = mysqli_query($link,"SELECT id_pc2 FROM dresseurPokemon WHERE login='$user'");
	foreach($pok2 as $key)
	{
		$pok2_2 = $key['id_pc2'];
	}
	$pok3 = mysqli_query($link,"SELECT id_pc3 FROM dresseurPokemon WHERE login='$user'");
	foreach($pok3 as $key)
	{
		$pok3_2 = $key['id_pc3'];
	}
	$pok4 = mysqli_query($link,"SELECT id_pc4 FROM dresseurPokemon WHERE login='$user'");
	foreach($pok4 as $key)
	{
		$pok4_2 = $key['id_pc4'];
	}
	$pok5 = mysqli_query($link,"SELECT id_pc5 FROM dresseurPokemon WHERE login='$user'");
	foreach($pok5 as $key)
	{
		$pok5_2 = $key['id_pc5'];
	}
	$pok6 = mysqli_query($link,"SELECT id_pc6 FROM dresseurPokemon WHERE login='$user'");
	foreach($pok6 as $key)
	{
		$pok6_2 = $key['id_pc6'];
	}
  $pok1 = mysqli_query($link, "SELECT idPokemon FROM pc WHERE ID = $pok1_2");
	foreach($pok1 as $key)
	{
		$pok1_3 = $key['idPokemon'];
	}
	$pok2 = mysqli_query($link, "SELECT idPokemon FROM pc WHERE ID = $pok2_2");
	foreach($pok2 as $key)
	{
		$pok2_3 = $key['idPokemon'];
	}
	$pok3 = mysqli_query($link, "SELECT idPokemon FROM pc WHERE ID = $pok3_2");
	foreach($pok3 as $key)
	{
		$pok3_3 = $key['idPokemon'];
	}
	$pok4 = mysqli_query($link, "SELECT idPokemon FROM pc WHERE ID = $pok4_2");
	foreach($pok4 as $key)
	{
		$pok4_3 = $key['idPokemon'];
	}
	$pok5 = mysqli_query($link, "SELECT idPokemon FROM pc WHERE ID = $pok5_2");
	foreach($pok5 as $key)
	{
		$pok5_3 = $key['idPokemon'];
	}
	$pok6 = mysqli_query($link, "SELECT idPokemon FROM pc WHERE ID = $pok6_2");
	foreach($pok6 as $key)
	{
		$pok6_3 = $key['idPokemon'];
	}

  mysqli_query($link,"UPDATE dresseurPokemon SET id_pc3 = $pok4_2 WHERE login = '$user'");
  mysqli_query($link,"UPDATE dresseurPokemon SET id_pc4 = $pok5_2 WHERE login = '$user'");
  mysqli_query($link,"UPDATE dresseurPokemon SET id_pc5 = $pok6_2 WHERE login = '$user'");
  mysqli_query($link,"UPDATE dresseurPokemon SET id_pc6 = 0 WHERE login = '$user'");
 ?>
