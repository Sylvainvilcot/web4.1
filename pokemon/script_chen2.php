<?php
  session_start();

  $user = $_SESSION['user'];
  $link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');

  $myarray = &$_POST;
  $choix = $myarray['choix'];

  $resultat = mysqli_query($link, "SELECT ID FROM dresseurPokemon WHERE login = '$user'");

  foreach ($resultat as $enr)
  {
    $id = $enr['ID'];
  }

  if($choix == 1)
  {
    $time = time();
		mysqli_query($link, "INSERT INTO pc (idDresseur, idPokemon, evolution, pvMax, pvNow, niveau, Attaque, AttaqueSpé, Défense, DéfenseSpé, Vitesse, capacites1, capacites2, capacites3, capacites4) VALUES ('$id', '1', '1', '45', '45', '5', '49', '49', '65', '65', '45', 'Charge', 'Fouet Lianes', 'Ecrasement', 'Acide')");
		$resultat = mysqli_query($link, "SELECT ID FROM pc WHERE idPokemon = 1 AND idDresseur = $id");
		foreach ($resultat as $key)
		{
			$id_pc1 = $key['ID'];
		}
		mysqli_query($link, "UPDATE dresseurPokemon SET stade = 1, pokePiece = 50, pokeBall = 5, potion = 5, DernierRecompense = $time, id_pc1 = $id_pc1 WHERE login ='$user'");
  }

  if($choix == 2)
  {
    $time = time();
		mysqli_query($link, "INSERT INTO pc (idDresseur, idPokemon, evolution, pvMax, pvNow, niveau, Attaque, AttaqueSpé, Défense, DéfenseSpé, Vitesse, capacites1, capacites2, capacites3, capacites4) VALUES ('$id', '4', '1', '39', '39', '5', '52', '43', '60', '50', '65', 'Tranche', 'Bec Vrille', 'Lance-Flammes', 'Poing de Feu')");
		$resultat = mysqli_query($link, "SELECT ID FROM pc WHERE idPokemon = 4 AND idDresseur = $id");
		foreach ($resultat as $key)
		{
			$id_pc1 = $key['ID'];
		}
		echo $id_pc1;
		mysqli_query($link, "UPDATE dresseurPokemon SET stade = 1, pokePiece = 50, pokeBall = 5, potion = 5, DernierRecompense = $time, id_pc1 = $id_pc1 WHERE login ='$user'");
  }

  if($choix == 3)
  {
    $time = time();
		mysqli_query($link, "INSERT INTO pc (idDresseur, idPokemon, evolution, pvMax, pvNow, niveau, Attaque, AttaqueSpé, Défense, DéfenseSpé, Vitesse, capacites1, capacites2, capacites3, capacites4) VALUES ('$id', '7', '1','44', '44', '5', '48', '65', '50', '64', '43', 'Laser Glace', 'Hydrocanon', 'Coup d'Boule', 'Séisme')");
		$resultat = mysqli_query($link, "SELECT ID FROM pc WHERE idPokemon = 5 AND idDresseur = $id");
		foreach ($resultat as $key)
		{
			$id_pc1 = $key['ID'];
		}
		mysqli_query($link, "UPDATE dresseurPokemon SET stade = 1, pokePiece = 50, pokeBall = 5, potion = 5, DernierRecompense = $time, id_pc1 = $id_pc1 WHERE login ='$user'");
  }

?>
