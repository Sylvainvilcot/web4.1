<?php
	$link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');
	$redirect = 'false';
	session_start();
	if(!empty($_SESSION['user']))
	{
		header("Location:menu.php");
		exit();
	}

	if(!(empty($_POST['loginconnect']) || empty($_POST['mdpconnect'])))
	{
		$login = $_POST['loginconnect'];
		$mdp = $_POST['mdpconnect'];
		$resultat = mysqli_query($link,"SELECT * FROM dresseurPokemon");
		if($resultat)
		{
			foreach ($resultat as $enr)
			{
				if($login == $enr['login'] && sha1($mdp) == $enr['motdepasse'])
				{
					$redirect='true';
				}
			}
		}

		if($redirect=='true')
		{
			session_start();
			$_SESSION['user'] = $login;
			header("Location:menu.php");
			exit();
		}
		else
		{
			$erreur = "<script>alert('\Informations incorrectes ! Veuillez réessayer')</script>";
		}
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Pokemon</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


		<link rel="stylesheet" type="text/css" href="login.css" media="all"/>
	</head>
	<body>
		<div align="center">
			<h2> Qui êtes vous dresseur ? </h2>
			<form method="POST" action="login.php" id="form">
				<label for="login" id="labellog"><i class="far fa-user"></i></label>
				<input type="text" name="loginconnect" required placeholder="Votre login" id="login" class="infos"/>
				<br/>
				<label for="mdp" id="labelmdp"><i class="fas fa-key"></i></label>
				<input type="password" name="mdpconnect" required placeholder="Votre mot de passe" id="mdp" class="infos"/>
				<br/>
				<input type="submit" name="formulaire" value="Se connecter" id="submit"/>
				<a href='inscription.php' id='register'> S'inscrire </a>
			</form>
			<?php
				if(isset($erreur))
				{
					echo $erreur;
				}
			?>

		</div>

	</body>
</html>
