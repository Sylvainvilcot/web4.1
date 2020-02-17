<?php
  session_start();
  $id_pc = $_SESSION['id_pc'];
  $user = $_SESSION['user'];
  $link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');
  $resultat = mysqli_query($link, "SELECT pvMax,pvNow FROM pc WHERE ID = $id_pc");
  foreach ($resultat as $key)
  {
    $pvMax = $key['pvMax'];
    $pvNow = $key['pvNow'];
  }
  $resultat = mysqli_query($link, "SELECT potion FROM dresseurPokemon WHERE login = '$user'");
  foreach($resultat as $enr)
  {
    $potion = $enr['potion'];
  }
  if($pvNow == $pvMax)
  {
    echo $potion;
  }
  else
  {
    $pvNow = $pvNow + 50;
    if($pvNow > $pvMax)
    {
      $pvNow = $pvMax;
    }
    $potion--;
    $_SESSION['pvMy'] = $pvNow;
    mysqli_query($link, "UPDATE pc SET pvNow = $pvNow WHERE ID = $id_pc");
    mysqli_query($link, "UPDATE dresseurPokemon SET potion = $potion WHERE login = '$user'");

    echo $potion;
  }

?>
