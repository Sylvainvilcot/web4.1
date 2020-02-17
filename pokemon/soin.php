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

  $q1 = mysqli_query($link, "SELECT pvMax FROM pc WHERE ID = $pok1_2");
  $q2 = mysqli_query($link, "SELECT pvMax FROM pc WHERE ID = $pok2_2");
  $q3 = mysqli_query($link, "SELECT pvMax FROM pc WHERE ID = $pok3_2");
  $q4 = mysqli_query($link, "SELECT pvMax FROM pc WHERE ID = $pok4_2");
  $q5 = mysqli_query($link, "SELECT pvMax FROM pc WHERE ID = $pok5_2");
  $q6 = mysqli_query($link, "SELECT pvMax FROM pc WHERE ID = $pok6_2");
  foreach($q1 as $key)
  {
    $pvmax1 = $key['pvMax'];
  }
  foreach($q2 as $key)
  {
    $pvmax2 = $key['pvMax'];
  }
  foreach($q3 as $key)
  {
    $pvmax3 = $key['pvMax'];
  }
  foreach($q4 as $key)
  {
    $pvmax4 = $key['pvMax'];
  }
  foreach($q5 as $key)
  {
    $pvmax5 = $key['pvMax'];
  }
  foreach($q6 as $key)
  {
    $pvmax6 = $key['pvMax'];
  }

  mysqli_query($link,"UPDATE pc SET pvNow = $pvmax1 WHERE ID = $pok1_2");
  mysqli_query($link,"UPDATE pc SET pvNow = $pvmax2 WHERE ID = $pok2_2");
  mysqli_query($link,"UPDATE pc SET pvNow = $pvmax3 WHERE ID = $pok3_2");
  mysqli_query($link,"UPDATE pc SET pvNow = $pvmax4 WHERE ID = $pok4_2");
  mysqli_query($link,"UPDATE pc SET pvNow = $pvmax5 WHERE ID = $pok5_2");
  mysqli_query($link,"UPDATE pc SET pvNow = $pvmax6 WHERE ID = $pok6_2");

 ?>
