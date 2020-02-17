<?php

  include('fonctions.php');
  session_start();
  $user = $_SESSION['user'];
  $link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');
  $resultat = mysqli_query($link, "SELECT pokeBall,ID FROM dresseurPokemon WHERE login = "."'".$user."'");

  foreach ($resultat as $enr)
  {
    $pokeBall = $enr['pokeBall'];
    $id = $enr['ID'];
  }
  $pokeBall--;
  $random = $_SESSION['random'];
  //unset($_SESSION['random']);
  $resultat = mysqli_query($link, "SELECT * FROM Pokemon WHERE ID = $random");
  foreach ($resultat as $enr)
  {
    $id_pokemon = $enr['ID'];
    $nom = $enr['Nom'];
    $stade = $enr['Evolution'];
    $pv = $enr['PV'];
    $attaque = $enr['Attaque'];
    $defense = $enr['Défense'];
    $attaqueSpe = $enr['AttaqueSpé'];
    $defenseSpe = $enr['DefenseSpé'];
    $vitesse = $enr['Vitesse'];
  }
  $proba = 35 - 7 * $_SESSION['rare'] + ($pv - $_SESSION['pvEnemy']) * 100/$pv;
  if($proba < 1){$proba = 1;}
  $capture = rand(0,99);
  //echo $capture."<".$proba;
  if($capture < $proba)
  {
    $capa1 = $_SESSION['capacite1'];
    $capa2 = $_SESSION['capacite2'];
    $capa3 = $_SESSION['capacite3'];
    $capa4 = $_SESSION['capacite4'];
    $resultat = mysqli_query($link, "SELECT Nom FROM Capacites WHERE ID = $capa1");
    foreach ($resultat as $key)
    {
      $nom1 = $key['Nom'];
    }
    $resultat = mysqli_query($link, "SELECT Nom FROM Capacites WHERE ID = $capa2");
    foreach ($resultat as $key2)
    {
      $nom2 = $key2['Nom'];
    }
    $resultat = mysqli_query($link, "SELECT Nom FROM Capacites WHERE ID = $capa3");
    foreach ($resultat as $key3)
    {
      $nom3 = $key3['Nom'];
    }
    $resultat = mysqli_query($link, "SELECT Nom FROM Capacites WHERE ID = $capa4");
    foreach ($resultat as $key4)
    {
      $nom4 = $key4['Nom'];
    }
    mysqli_query($link, "INSERT INTO pc (idDresseur, idPokemon, evolution, pvMax, pvNow, niveau, Attaque, AttaqueSpé, Défense, DéfenseSpé, Vitesse, capacites1, capacites2, capacites3, capacites4) VALUES ('$id', '$id_pokemon', '$stade', '$pv', '$pv', '1', '$attaque', '$defense', '$attaqueSpe', '$defenseSpe', '$vitesse', '$nom1', '$nom2', '$nom3', '$nom4')");
    unset($_SESSION['random']);
    nouveauPokemon();
  }
  else
  {
    $pvEnemy = $_SESSION['pvEnemy'];
    echo $_SESSION['nom_enemypokemon'];
    echo "</br>";
    echo"<div class='barre'>
    <div id='jaugeEnemy' class='couleurVerte'></div>
      <div class='pv' id='pvEnemy'>$pvEnemy</div>
      </div>";

    echo $_SESSION['enemypokemon'];
  }
  mysqli_query($link, "UPDATE dresseurPokemon SET pokeBall = $pokeBall WHERE ID = $id");


?>
