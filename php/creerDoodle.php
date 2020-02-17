<?php
include("header.php");
?>

<?php
    if(isset($_POST['submit2']))
    {
        $nomCreateur = $_POST['createurName'];
        $nomSondage = $_POST['sondageName'];
        $commentaire = $_POST['commentaire'];
        $valeur1 = $_POST['val-0'];
        $valeur2 = $_POST['val-1'];
        $valeur3 = $_POST['val-2'];

        $doodleCode = creerDoodle($bdd, $nomCreateur, $nomSondage, $commentaire, $valeur1, $valeur2, $valeur3);
    echo "<div class='newDoodle'>
Votre doodle a bien été créé, il peut être rempli à l'adresse : <a href='afficherDoodle.php?doodleCode=".$doodleCode."'>afficherDoodle.php?doodleCode=".$doodleCode."</a>. Envoyez ce lien à vos amis.
</div>";
    }
//?doodleCode=".$doodleCode."
?>
Créer un nouveau doodle :
</br>
<form method="post" action="creerDoodle.php">
    <fieldset>
	<legend>Informations du sondage</legend>
	Nom du créateur : <input type="text" name="createurName"><br>
	Nom du sondage : <input type="text" name="sondageName"><br>
	<textarea placeholder="Commentaires sur le sondage" name="commentaire"></textarea>
    </fieldset>
    <fieldset id="contenu">
	<legend>Contenu du sondage</legend>
	<div class="valeurWrapper">
	</div>
	<a onclick="addValue()" href=#>Ajouter une valeur</a>
    </fieldset>
    <input type="submit" name="submit2">
</form>
<a href="index.php">Retour</a> à la page d'accueil.
<script>
 let valeurWrapper = document.querySelector("#contenu .valeurWrapper");
 
 function addValue() {
     let nValeur = valeurWrapper.querySelectorAll(".valeur").length;
     let newValeur = document.createElement("div");
     newValeur.innerHTML = "Valeur "+nValeur+" : <input name=\"val-"+nValeur+"\" type=\"text\"/><a onclick=\"removeValeur("+nValeur+")\" href=\"#\">❌</a></div>";
     newValeur.classList.add("valeur");
     valeurWrapper.appendChild(newValeur);
 }
 function removeValeur(i) {
     console.log("test", i);
     let valeurListe = valeurWrapper.querySelectorAll(".valeur");
     valeurListe.forEach((elem, index) => {
	 if(index>i){
	     elem.firstChild.data = "Valeur "+(index-1)+" : ";
	     elem.querySelector("input").name="val-"+(index-1);
	     elem.querySelector("a").onclick = () => {removeValeur(index-1);};
	     console.log(elem);
	 }
     })
     valeurWrapper.removeChild(valeurListe[i]);
 }
 addValue();
 addValue();
 addValue();
</script>

<?php
include("footer.php");
?>
