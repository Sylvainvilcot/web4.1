<?php

  function connection()
  {
    if(isset($_SESSION['user']))
    {
    	$link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');
    	$user = $_SESSION['user'];
    	$querySelect = ("SELECT stade FROM dresseurPokemon WHERE login = "."'".$user."'");
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
  }

  function nouveauPokemon()
  {
    $link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');

    if(!isset($_SESSION['random']))
  	{
  			$temp = rand(0,100);
  			if($temp < 65)
  			{
  				$rare = 1;
  			}
  			if($temp >= 65 && $temp < 85)
  			{
  				$rare = 3;
  			}
  			if($temp >= 85 && $temp < 96)
  			{
  				$rare = 5;
  			}
  			if($temp >= 96 && $temp < 100)
  			{
  				$rare = 7;
  			}
  			if($temp == 100)
  			{
  				$rare = 9;
  			}
  			$_SESSION['rare'] = $rare;
  	}
    $rare = $_SESSION['rare'];
  	do {
  		if(!isset($_SESSION['random']))
  		{
  			$random = rand(1,62);
  		}
  		else
  		{
  			$random = $_SESSION['random'];
  		}

  		$resultat = mysqli_query($link, ("SELECT * FROM Pokemon WHERE ID = $random AND rare = $rare"));
  	} while (!mysqli_num_rows($resultat));
  	$_SESSION['random'] = $random;
    foreach ($resultat as $enr)
  	{
  		$id_pokemon = $enr['ID'];
      $nom = $enr['Nom'];
      $stade = $enr['Evolution'];
      $pvEnemy = $enr['PV'];
      $attaque = $enr['Attaque'];
      $defense = $enr['Défense'];
      $attaqueSpe = $enr['AttaqueSpé'];
      $defenseSpe = $enr['DefenseSpé'];
      $vitesse = $enr['Vitesse'];

      $enemypokemon = $enr['image1'];
  	}
    $_SESSION['capacite1'] = rand(1,37);
    $_SESSION['capacite2'] = rand(1,37);
    $_SESSION['capacite3'] = rand(1,37);
    $_SESSION['capacite4'] = rand(1,37);

    $_SESSION['pvMaxEnemy'] = $pvEnemy;
    $_SESSION['pvEnemy'] = $pvEnemy;
    $_SESSION['enemypokemon'] = $enemypokemon;
    $_SESSION['nom_enemypokemon'] = $nom;
    echo $nom;
    echo "</br>";
    echo"<div class='barre'>
      <div id='jaugeEnemy' class='couleurGrise'></div>
      <div class='pv' id ='pvEnemy'>$pvEnemy</div>
      </div>";
    echo $enemypokemon;
    echo "</br>";

    //echo $stade;

    //echo "</br>";
    /*echo $attaque;
    echo "</br>";
    echo $defense;
    echo "</br>";
    echo $attaqueSpe;
    echo "</br>";
    echo $defenseSpe;
    echo "</br>";
    echo $vitesse;*/

  }


?>
