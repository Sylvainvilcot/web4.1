<?php
global $bdd;
// Remplissez vos identifiants pour vous connecter à votre propre base de donnée.
$bdd = mysqli_connect("dwarves.iut-fbleau.fr", "vilcot", "vilcot123", "vilcot");

////////////////////////////////////////////////////////////////////////
/*      Créer un doodle                                               */
////////////////////////////////////////////////////////////////////////

/* Cette fonction crée un code généré aléatoirement
   Vous pouvez l'utiliser sans modification
   pour générer un code pour un doodle.
   Pour simplifier, ne vous embêtez pas à vérifier qu'il est unique */
function randomCode() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

/* Cette fonction crée un nouveau doodle dans la table des doodles.
   Elle prend en entrée les informations du doodle.
   Elle retourne la manière "cryptée" d'accéder au doodle. */
function creerDoodle($bdd, $nomCreateur, $nomSondage, $commentaire, $valeur1, $valeur2, $valeur3)
{
  $doodleCode = randomCode();
  mysqli_query($bdd, "INSERT INTO sondage (nomCreateur, nomSondage, commentaire, valeur1, valeur2, valeur3, doodleCode) VALUES ('$nomCreateur','$nomSondage', '$commentaire', '$valeur1', '$valeur2', '$valeur3','$doodleCode')");
    global $bdd;
    return $doodleCode;
}

////////////////////////////////////////////////////////////////////////
/*      Créer une réponses pour un doodle                             */
////////////////////////////////////////////////////////////////////////

/* Cette fonction crée une entrée dans la table des réponses
   Elle prend en entrée un pseudo, et un tableau contenant les réponses dans l'ordre
   Elle retourne true si tout a marché, false sinon. */
function creerReponse($bdd, $reponse1, $reponse2, $reponse3, $pseudo, $idSondage)
{
  mysqli_query($bdd, "INSERT INTO reponseSondage (reponse1, reponse2, reponse3, pseudo, idSondage) VALUES ('$reponse1', '$reponse2', '$reponse3', '$pseudo', '$idSondage') ");
    global $bdd;
//    return true;
}

////////////////////////////////////////////////////////////////////////
/*      Récupérer les infos d'un doodle                               */
////////////////////////////////////////////////////////////////////////

/* Cette fonction récupère les informations sur un doodle
   Elle prend en entrée une manière "cryptée" d'identifier le doodle.
   Elle retourne les infos du doodle. */
function recupererDoodle($bdd,$doodleCode)
{

    $resultat = mysqli_query($bdd, "SELECT * FROM sondage WHERE doodleCode = '$doodleCode'");
    //echo $doodleCode;
    foreach ($resultat as $key)
    {
      $doodle['ID'] = $key['ID'];
      $doodle['nomCreateur'] = $key['nomCreateur'];
      $doodle['nomSondage'] = $key['nomSondage'];
      $doodle['commentaire'] = $key['commentaire'];
      $doodle['valeur1'] = $key['valeur1'];
      $doodle['valeur2'] = $key['valeur2'];
      $doodle['valeur3'] = $key['valeur3'];
    }

    global $bdd;
    return $doodle;
}

////////////////////////////////////////////////////////////////////////
/*      Récupérer les réponses d'un doodle                            */
////////////////////////////////////////////////////////////////////////

/* Cette fonction récupère toutes les réponses à un doodle.
   Elle prend en entrée une manière d'identifier le doodle.
   Elle retourne un tableau contenant les réponses à ce doodle. */
function recupererReponses($bdd, $idSondage)
{
  $resultat = mysqli_query($bdd, "SELECT * FROM reponseSondage WHERE idSondage = '$idSondage'");

  while($key = mysqli_fetch_array($resultat))
  {
    $reponses['pseudo'] = $key['pseudo'];
    $reponses['reponse1'] = $key['reponse1'];
    $reponses['reponse2'] = $key['reponse2'];    
    $reponses['reponse3'] = $key['reponse3'];
  }

    global $bdd;
    return $reponses;
}


?>
