<?php
include("header.php");
?>

<?php
	$doodleCode = $_GET['doodleCode'];
	$doodle = recupererDoodle($bdd,$doodleCode);
	$doodleID = $doodle['ID'];

	//afficherDoodle.php?doodleCode= $doodleCode
?>
<h1>Bienvenue sur le doodle "<?php echo $doodle['nomSondage'];?>" créé par "<?php echo $doodle['nomCreateur'];?>" !</h1>
<div>Description : <?php echo $doodle['commentaire'];?></div>
<table>
    <tr><th> Pseudo </th><th></th><th></th><th></th></tr>
    <?php
    	if(isset($_POST['submit3']))
    	{
    		$pseudo = $_POST['pseudo'];
    		$reponse1 = $_POST['reponse1'];
    		$reponse2 = $_POST['reponse2'];
    		$reponse3 = $_POST['reponse3'];

    		creerReponse($bdd, $reponse1, $reponse2, $reponse3, $pseudo, $doodleID);
    		echo "$pseudo  $reponse1  $reponse2   $reponse3";
    		$reponses = recupererReponses($bdd, $doodleID);
    		//print_r($reponses);
    		//echo $reponses['reponse1'];
    		foreach ($reponses as $key => $value)
    		{
    			echo "$value </br>";
    		}
    	}
    ?>
    <tr class="newAnswer">
	<form method="post" action="afficherDoodle.php?doodleCode=<?php echo $doodleCode; ?>"">  
	<td><input name="pseudo" type="text"/></td>
	<td><select name="reponse1"><option>Oui</option><option>Oui Mais</option><option>Non</option></select></td>
	<td><select name="reponse2"><option>Oui</option><option>Oui Mais</option><option>Non</option></select></td>
	<td><select name="reponse3"><option>Oui</option><option>Oui Mais</option><option>Non</option></select></td>
	<td><input type="submit" name="submit3"></td>
	</form>
    </tr>
</table>

<a href="index.php">Retour</a> à la page d'accueil.
<?php
include("footer.php");		
?>
