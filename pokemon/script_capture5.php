<?php
  include('fonctions.php');
  session_start();
  $link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');


  $myarray = &$_POST;
	$num = "capacites".$myarray['capacites'];
  //echo $num;
  $id_pc = $_SESSION['id_pc'];
  $user = $_SESSION['user'];
  $id_enemypokemon = $_SESSION['random'];

  $resultat = mysqli_query($link, "SELECT pokePiece FROM dresseurPokemon WHERE login='$user'");

  foreach ($resultat as $cle)
  {
    $pokePiece = $cle['pokePiece'];
  }

  $resultat = mysqli_query($link, "SELECT * FROM pc WHERE ID ='$id_pc'");

  foreach ($resultat as $enr)
  {
      $id = $enr['idPokemon'];
      $capacites = $enr[$num];
      $idPokemon = $enr['idPokemon'];
      $evolution = $enr['evolution'];
      $niveau = $enr['niveau'];
      $pv_mypokemon = $enr['pvNow'];
      $attaque_mypokemon = $enr['Attaque'];
      $defense_mypokemon = $enr['Défense'];
      $attaqueSpe_mypokemon = $enr['AttaqueSpé'];
      $defenseSpe_mypokemon = $enr['DéfenseSpé'];
      $vitesse_mypokemon = $enr['Vitesse'];
  }
  $resultat = mysqli_query($link, "SELECT * FROM Capacites WHERE Nom = '$capacites'");

  foreach ($resultat as $key)
  {
      $nom = $key['Nom'];
      $type = $key['Types'];
      $categorie = $key['Categories'];
      $puissance = $key['Dommage'];
      $precision = $key['Precision'];
  }

  $resultat = mysqli_query($link, "SELECT Nom,Type1,Type2 FROM Pokemon WHERE ID = $id");

  foreach ($resultat as $enr5)
  {
    $nommypokemon = $enr5['Nom'];
    $type1_mypokemon = $enr5['Type1'];
    $type2_mypokemon = $enr5['Type2'];
  }
  $resultat = mysqli_query($link, "SELECT * FROM Pokemon WHERE ID ='$id_enemypokemon'");

  foreach ($resultat as $enr2)
  {
      $nom_enemypokemon = $enr2['Nom'];
      $type1_enemypokemon = $enr2['Type1'];
      $type2_enemypokemon = $enr2['Type2'];
      $pv_enemypokemon = $enr2['PV'];
      $attaque_enemypokemon = $enr2['Attaque'];
      $defense_enemypokemon = $enr2['Défense'];
      $attaqueSpe_enemypokemon = $enr2['AttaqueSpé'];
      $defenseSpe_enemypokemon = $enr2['DefenseSpé'];
      $vitesse_enemypokemon = $enr2['Vitesse'];
  }

  $capacite_enemy = rand(0,3);
  if($capacite_enemy == 0)
  {
    $capacite_enemy = $_SESSION['capacite1'];
  }
  else if($capacite_enemy == 1)
  {
    $capacite_enemy = $_SESSION['capacite2'];
  }
  else if($capacite_enemy == 2)
  {
    $capacite_enemy = $_SESSION['capacite3'];
  }
  else if($capacite_enemy == 3)
  {
    $capacite_enemy = $_SESSION['capacite4'];
  }
  //echo $capacite_enemy;
  $resultat = mysqli_query($link, "SELECT * FROM Capacites WHERE ID = $capacite_enemy");

  foreach ($resultat as $enr)
  {
    $nom2 = $enr['Nom'];
    $type2 = $enr['Types'];
    $categorie2 = $enr['Categories'];
    $puissance2 = $enr['Dommage'];
    $precision2 = $enr['Precision'];
  }
  if(isset($_SESSION['pvEnemy']))
  {
    $pv_enemypokemon = $_SESSION['pvEnemy'];
  }

  function combat($typeAttaque, $type1, $type2, $categorie, $precision, $attaque, $attaqueSpe, $puissance, $pv, $defense, $defenseSpe)
  {
    $link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');
    $random = rand(0,99);
    if($random < $precision)
    {
      if($categorie == "Physique")
      {
        $degat = (10 * $attaque * $puissance) / (50 * $defense);
      }
      else
      {
        $degat = (10 * $attaqueSpe * $puissance) / (50 * $defenseSpe);
      }
      $resultat = mysqli_query($link, "SELECT $type1 FROM Types WHERE NomType = '$typeAttaque'");
      foreach ($resultat as $var)
      {
        $multiplicateur1 = $var[$type1];
      }
        if($type2 != NULL)
        {
          $resultat = mysqli_query($link, "SELECT $type2 FROM Types WHERE NomType = '$typeAttaque'");
          foreach ($resultat as $var)
          {
            $multiplicateur2 = $var[$type2];
          }
          $efficace = $multiplicateur1 * $multiplicateur2;
        }
        else
        {
          $efficace = $multiplicateur1;
        }
      if($efficace >= 2)
      {
        echo "C'est super efficace !";
        echo "</br>";
      }
      if($efficace == 0)
      {
        echo "Pokemon insensible !";
        echo "</br>";
      }
      else if($efficace <= 0.5)
      {
        echo "Ce n'est pas très efficace ...";
        echo "</br>";
      }
      $pv = $pv - intval($degat * $efficace);
    }
    else
    {
      echo "L'attaque a échoué ! ";
      echo "</br>";
    }
    return $pv;
  }
  //echo "</br>";
  //echo $pv_mypokemon.">".$pv_enemypokemon;

  if($vitesse_mypokemon < $vitesse_enemypokemon)
  {
    echo $nom_enemypokemon." sauvage attaque ".$nom2." !";
    echo "</br>";
    $pv_mypokemon = combat($type,$type1_enemypokemon,$type2_enemypokemon,$categorie2, $precision2, $attaque_enemypokemon, $attaqueSpe_enemypokemon, $puissance2, $pv_mypokemon, $defense_mypokemon, $defenseSpe_mypokemon);
    if($pv_mypokemon < 1)
    {
      $pv_mypokemon = 0;
      //pokjemon my ko
    }
    else
    {
    echo $nommypokemon." attaque ".$nom." !";
    echo "</br>";
      $pv_enemypokemon = combat($type2,$type1_mypokemon,$type2_mypokemon,$categorie, $precision, $attaque_mypokemon, $attaqueSpe_mypokemon, $puissance, $pv_enemypokemon, $defense_enemypokemon, $defenseSpe_enemypokemon);
      if($pv_enemypokemon < 1)
      {
        echo $nom_enemypokemon." sauvage est K.O !";
        echo "</br>";
        $pv_enemypokemon = 0;
        $pokePiece = $pokePiece + 35;
        mysqli_query($link, "UPDATE dresseurPokemon SET pokePiece = $pokePiece WHERE login='$user'");
        if($evolution == 3)
        {
          $niveau++;
          mysqli_query($link, "UPDATE pc SET niveau = $niveau WHERE ID = $id_pc");
        }
        if($evolution == 2)
        {
          if($niveau == 20)
          {
            $idPokemon++;
            $resultat = mysqli_query($link, "SELECT * FROM Pokemon WHERE ID = $idPokemon");

            foreach ($resultat as $key3)
            {
              $evolution = $key3['Evolution'];
              $pvMax = $key3['PV'];
              $attaque= $key3['Attaque'];
              $defense = $key3['Défense'];
              $attaqueSpe = $key3['AttaqueSpé'];
              $defenseSpe = $key3['DefenseSpé'];
              $vitesse = $key3['Vitesse'];
              $mypokemon = $key3['image2'];
            }
            $_SESSION['mypokemon'] = $mypokemon;
            mysqli_query($link, "UPDATE pc SET idPokemon = $idPokemon, pvMax = $pvMax, niveau = 1, evolution = $evolution, Attaque = $attaque, AttaqueSpé = $attaqueSpe, Défense = $defense, Défensespé = $defenseSpe, Vitesse = $vitesse WHERE ID = $id_pc");
          }
          else
          {
            $niveau++;
            mysqli_query($link, "UPDATE pc SET niveau = $niveau WHERE ID = $id_pc");
          }
        }
        if($evolution == 1)
        {
          if($niveau == 10)
          {
            $idPokemon++;
            $resultat = mysqli_query($link, "SELECT * FROM Pokemon WHERE ID = $idPokemon");

            foreach ($resultat as $key3)
            {
              $evolution = $key3['Evolution'];
              $pvMax = $key3['PV'];
              $attaque= $key3['Attaque'];
              $defense = $key3['Défense'];
              $attaqueSpe = $key3['AttaqueSpé'];
              $defenseSpe = $key3['DefenseSpé'];
              $vitesse = $key3['Vitesse'];
              $mypokemon = $key3['image2'];
            }
            //$evolution++;
            $_SESSION['mypokemon'] = $mypokemon;
            mysqli_query($link, "UPDATE pc SET idPokemon = $idPokemon, pvMax = $pvMax, niveau = 1, evolution = $evolution, Attaque = $attaque, AttaqueSpé = $attaqueSpe, Défense = $defense, Défensespé = $defenseSpe, Vitesse = $vitesse WHERE ID = $id_pc");
          }
          else
          {
            $niveau++;
            mysqli_query($link, "UPDATE pc SET niveau = $niveau WHERE ID = $id_pc");
          }
        }
        unset($_SESSION['pvEnemy']);
        unset($_SESSION['pvMaxEnemy']);
        unset($_SESSION['random']);
      }

    }

    //exit();
  }
  else
  {
    echo $nommypokemon." attaque ".$nom." !";
    echo "</br>";
    $pv_enemypokemon = combat($type,$type1_enemypokemon,$type2_enemypokemon,$categorie, $precision, $attaque_mypokemon, $attaqueSpe_mypokemon, $puissance, $pv_enemypokemon, $defense_enemypokemon, $defenseSpe_enemypokemon);
    if($pv_enemypokemon < 1)
    {
      echo $nom_enemypokemon." sauvage est K.O !";
      echo "</br>";
      $pv_enemypokemon = 0;
      $pokePiece = $pokePiece + 35;
      mysqli_query($link, "UPDATE dresseurPokemon SET pokePiece = $pokePiece WHERE login='$user'");
      if($evolution == 3)
      {
        $niveau++;
        mysqli_query($link, "UPDATE pc SET niveau = $niveau WHERE ID = $id_pc");
      }
      if($evolution == 2)
      {
        if($niveau == 20)
        {
          $idPokemon++;
          $resultat = mysqli_query($link, "SELECT * FROM Pokemon WHERE ID = $idPokemon");

          foreach ($resultat as $key3)
          {
            $evolution = $key3['Evolution'];
            $pvMax = $key3['PV'];
            $attaque= $key3['Attaque'];
            $defense = $key3['Défense'];
            $attaqueSpe = $key3['AttaqueSpé'];
            $defenseSpe = $key3['DefenseSpé'];
            $vitesse = $key3['Vitesse'];
            $mypokemon = $key3['image2'];
          }
          $_SESSION['mypokemon'] = $mypokemon;
          mysqli_query($link, "UPDATE pc SET idPokemon = $idPokemon, pvMax = $pvMax, niveau = 1, evolution = $evolution, Attaque = $attaque, AttaqueSpé = $attaqueSpe, Défense = $defense, Défensespé = $defenseSpe, Vitesse = $vitesse WHERE ID = $id_pc");
          echo "Quoi ? ".$nommypokemon." évolue ?!";
        }
        else
        {
          $niveau++;
          mysqli_query($link, "UPDATE pc SET niveau = $niveau WHERE ID = $id_pc");
        }
      }
      if($evolution == 1)
      {
        if($niveau == 10)
        {
          $idPokemon++;
          $resultat = mysqli_query($link, "SELECT * FROM Pokemon WHERE ID = $idPokemon");

          foreach ($resultat as $key3)
          {
            $evolution = $key3['Evolution'];
            $pvMax = $key3['PV'];
            $attaque= $key3['Attaque'];
            $defense = $key3['Défense'];
            $attaqueSpe = $key3['AttaqueSpé'];
            $defenseSpe = $key3['DefenseSpé'];
            $vitesse = $key3['Vitesse'];
            $mypokemon = $key3['image2'];
          }
          $_SESSION['mypokemon'] = $mypokemon;
            mysqli_query($link, "UPDATE pc SET idPokemon = $idPokemon, pvMax = $pvMax, niveau = 1, evolution = $evolution, Attaque = $attaque, AttaqueSpé = $attaqueSpe, Défense = $defense, Défensespé = $defenseSpe, Vitesse = $vitesse WHERE ID = $id_pc");
            echo "Quoi ? ".$nommypokemon." évolue ?!";
            echo "</br>";
        }
        else
        {
          $niveau++;
          mysqli_query($link, "UPDATE pc SET niveau = $niveau WHERE ID = $id_pc");
        }
      }
      unset($_SESSION['pvEnemy']);
      unset($_SESSION['random']);
      unset($_SESSION['pvMaxEnemy']);
      //exit();
      //echo $_SESSION['pvEnemy'];
      }
      else
      {
        echo $nom_enemypokemon." sauvage attaque ".$nom2." !";
        echo "</br>";
        $pv_mypokemon = combat($type2,$type1_mypokemon,$type2_mypokemon,$categorie2, $precision2, $attaque_enemypokemon, $attaqueSpe_enemypokemon, $puissance2, $pv_mypokemon, $defense_mypokemon, $defenseSpe_mypokemon);
        if($pv_mypokemon < 1)
        {
          $pv_mypokemon = 0;
          //pokemon my ko
        }
      }
  }
  $_SESSION['pvMy'] = $pv_mypokemon;
  mysqli_query($link, "UPDATE pc SET pvNow = $pv_mypokemon WHERE ID = $id_pc");
  //$_SESSION['pvNow'] = $pv_mypokemon;
  $_SESSION['pvEnemy'] = $pv_enemypokemon;
  //echo "</br>";
  //echo $pv_mypokemon.">".$pv_enemypokemon;



?>
