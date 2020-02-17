<?php

include("fonctions.php");

session_start();
if(isset($_SESSION['user']))
{
	$link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');
	$user = $_SESSION['user'];
	$querySelect = ("SELECT stade FROM dresseurPokemon WHERE login = '$user'");
	$res = mysqli_query($link,$querySelect);

	foreach ($res as $enr)
	{
		$stade = $enr['stade'];
	}
	if($stade == 0)
	{
		header("Location:choix.php");
		exit();
	}
}
else
{
	header("Location:login.php");
	exit();
}

$time = time();

$resultat3 = mysqli_query($link,"SELECT * FROM dresseurPokemon WHERE login = '$user'");

	foreach ($resultat3 as $key)
	{
		$pseudo = $key['pseudo'];
		$pokePiece = $key['pokePiece'];
		$pokeBall = $key['pokeBall'];

		$id_pc1 = $key['id_pc1'];
		$id_pc2 = $key['id_pc2'];
		$id_pc3 = $key['id_pc3'];
		$id_pc4 = $key['id_pc4'];
		$id_pc5 = $key['id_pc5'];
		$id_pc6 = $key['id_pc6'];
	}
	$_SESSION['id_pc'] = $id_pc1;
	$resultat2 = mysqli_query($link, "SELECT * FROM pc WHERE ID = $id_pc1");
	foreach ($resultat2 as $enr)
	{
			$pvNow = $enr['pvNow'];
			$IDmypokemon =  $enr['idPokemon'];
			$niveau = $enr['niveau'];
	}
	$res = mysqli_query($link, "SELECT * FROM Pokemon WHERE ID = $IDmypokemon");
	foreach ($res as $key2)
	{
			$nommypokemon = $key2['Nom'];
			$mypokemon = $key2['image2'];
			$pvMax = $key2['PV'];
	}

  $resultat = mysqli_query($link, "SELECT capacites1, capacites2,
    capacites3, capacites4 FROM pc WHERE ID = $id_pc1");
  foreach ($resultat as $key)
  {
      $capacites1 = $key['capacites1'];
      $capacites2 = $key['capacites2'];
      $capacites3 = $key['capacites3'];
      $capacites4 = $key['capacites4'];
  }
	//$pvNow = $_SESSION['pvNow'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Capture de pokémons</title>
    <link rel="stylesheet" type="text/css" href="capture.css" media="all" />
  </head>
  <header>
    <div id="header">
        <h2>Capture de pokémons</h2>
        <p id="pieces"><?php echo $pokePiece; ?></p>
				<label for="pieces" id="labelpieces"><img src="dollar.png" width="15px" height="15px"></label>
        <div id="ballsTamaman" class="balls aDroite">
				  <img src="ball.png" width="40px" height="40px" id="ball">
					<div id="balls"><?php echo $pokeBall; ?></div>
        </div>
		</div>
  </header>
  <body>
    	<div id="mypkn">
			<?php

			echo"<div class='barre'>
	      <div class='jauge couleurVerte'></div>
	      <div class='pv' id='pv'>$pvNow</div>
	      </div>";

			echo $mypokemon;
			echo "</br>";
			echo $nommypokemon;
			echo "</br>";
			echo "niveau :".$niveau;
			?>
		</div>
		<div id="enemypokemon">
			<?php
			//unset($_SESSION['pvEnemy']);
			nouveauPokemon();
			//$_SESSION['pvNow'] = 1;
			?>
		</div>
		<div id="menu">
			<button class="attaquer" id="capacites1"><?php echo $capacites1 ?></button>
			<button class="attaquer" id="capacites2"><?php echo $capacites2 ?></button>
			<button class="attaquer" id="capacites3"><?php echo $capacites3 ?></button>
			<button class="attaquer" id="capacites4"><?php echo $capacites4 ?></button>
      <form method='post' action='capture.php'>
      <input type='submit' name='refresh' value='Quitter' id='submit'/>
      </form>
			<div id="fenetre"></div>
		</div>
  </body>
	<script src="combat.js">
	</script>
</html>
