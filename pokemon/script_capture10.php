<?php
  session_start();
  $link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');
  $user = $_SESSION['user'];

  $resultat = mysqli_query($link, "SELECT ID FROM dresseurPokemon WHERE login = '$user'");
  foreach ($resultat as $key)
  {
    $idd = $key['ID'];
  }
  $q = mysqli_query($link, "SELECT * FROM pc WHERE idDresseur = $idd");
  $places = mysqli_num_rows($q);

  echo $places;

?>
