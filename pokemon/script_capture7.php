<?php
  session_start();
  $link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');

  $id_pc = $_SESSION['id_pc'];

  $resultat = mysqli_query($link, "SELECT idPokemon, niveau FROM pc WHERE ID = $id_pc");
  foreach ($resultat as $key)
  {
    $niveau = $key['niveau'];
  }

  $pvMy = $_SESSION['pvMy'];
  $mypokemon = $_SESSION['mypokemon'];
  $nommypokemon = $_SESSION['$nommypokemon'];
  echo"<div class='barre'>
    <div id='jaugeMy' class='couleurGrise'></div>
    <div class='pv' id='pvMy'>$pvMy</div>
    </div>";
  echo $mypokemon;
  echo "</br>";
  echo $nommypokemon;
  echo "</br>";
  echo "Niveau : ".$niveau;
?>
