<?php
  session_start();
  $user = $_SESSION['user'];
  $link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');
  $resultat = mysqli_query($link, "SELECT pokeBall,ID FROM dresseurPokemon WHERE login = "."'".$user."'");
  foreach ($resultat as $enr)
  {
    $pokeBall = $enr['pokeBall'];
  }

  echo $pokeBall;
?>
