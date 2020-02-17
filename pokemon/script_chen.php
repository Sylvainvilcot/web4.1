<?php
	session_start();

	$user = $_SESSION['user'];
	$link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');
	$res = mysqli_query($link,"SELECT pseudo FROM dresseurPokemon WHERE login = '$user'");
	foreach ($res as $enr)
	{
		$pseudo = $enr['pseudo'];
	}
	$myarray = &$_POST;
	$text = $myarray['text'];
	if($text == 0)
	{
		$msg = "Bien le bonjour <B>".$pseudo."</B> ! </br>
		Bienvenue dans le monde magique des Pokémon !</br>
		Mon nom est <B>Chen</B> ! Les gens souvent m'appellent le Prof Pokémon!</br>
		Ce monde est peuplé de créatures du nom de Pokémon! Pour certains, </br>
		les Pokémon sont des animaux domestiques, pour d'autres, ils sont un moyen de combattre.</br>
		 Pour ma part... L'étude des Pokémon est ma profession. !</br>
		 Ta quête des Pokémon est sur le point de commencer ! </br>
		 Un tout nouveau monde de rêves, d'aventures et de Pokémon t'attend ! Dingue !</br> </br>
		 Eh <B>".$pseudo."</B> ! </br>
 	 Ne pars pas ! De justesse !</br>
 	 Des Pokémon sauvages vivent dans les hautes herbes !</br>
 	 Pfou ! Des Pokémon sauvages peuvent surgir à tout instant !</br>
 	 Tu as besoin d'un Pokémon pour te protéger ! </br>
 	 Choisi l'un d'entre eux !";
	}
	else if($text == 2)
	{
		$msg = "<B>Bulbizarre</B> ?</br>
		Ce Pokémon se montrera très efficace ! </br>
	 Il est de type <B>Plante</B> et <B>Poison</B> et t'offrira le début le plus facile !</br>";
	}
	else if($text == 3)
	{
		$msg = "<B>Salamèche</B> ?</br>
		Ce Pokémon est difficile à maîtriser, mais il s'avère être très puissant !</br>
	 Il est de type <B>Feu</B>, mais il t'offrira le début le plus difficile </br>";
	}
	else if($text == 4)
	{
	 $msg = "<B>Carapuce</B> ?</br> Ce Pokémon est très affectif, mais quand il est en bande il devient dangereux ! Une vrai racaille ! </br>
	 Il est de type <B>Eau</B> et t'offrira un début sans grande difficulté !</br>";
	}
	echo $msg;

?>
