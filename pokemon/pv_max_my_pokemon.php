<?php
  $link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');
  session_start();
  $id_pc = $_SESSION['id_pc'];
  $resultat = mysqli_query($link, "SELECT * FROM pc WHERE ID ='$id_pc'");

  foreach ($resultat as $enr)
  {
      $pv = $enr['pvMax'];
  }
  echo $pv;
?>
