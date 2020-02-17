<?php
include("header.php");
?>
Choisissez le style graphique du site web :
<form method="post" action="choixDuStyle.php">
    <select name="style">
	<option value ="clair">
		Style Clair
	</option>
	<option value="sombre">
	    Style Sombre
	</option>
    </select>
    <input type="submit" value="Choisir" name="submit"/>
</form>
<a href="index.php">Retour</a> à la page d'accueil.
<?php
include("footer.php");		
?>
