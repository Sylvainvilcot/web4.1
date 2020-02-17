<?php
	$link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');
	if(!empty($_SESSION['user']))
	{
		header("Location:menu.php");
		exit();
	}

	if(isset($_POST['inscription']))
	{
			$pseudo = htmlspecialchars($_POST['pseudo']);
			$login1 = htmlspecialchars($_POST['login1']);
			$login2 = htmlspecialchars($_POST['login2']);
			$mdp1 = sha1($_POST['mdp1']);
			$mdp2 = sha1($_POST['mdp2']);
			$tmp = 0;

			$pseudolength = strlen($pseudo);
			if($pseudolength <= 255)
			{
				if($login1 == $login2)
				{
					if($mdp1 == $mdp2)
					{
						$resultat = mysqli_query($link,"SELECT * FROM dresseurPokemon");
						if($resultat)
						{
							foreach ($resultat as $enr)
							{
								if($login1 == $enr['login'])
								{
									$tmp = 1;
								}
							}
						}
						if($tmp == 0)
						{
	  						$queryInsert = ("INSERT INTO dresseurPokemon(Pseudo,login,motdepasse,stade) VALUES ('$pseudo','$login1','$mdp1','$stade')");
	  						$resultatInsert = mysqli_query($link,$queryInsert);
								session_start();
								$_SESSION['user'] = $login1;
								header("Location:choix.php");
								exit();
  						}
  						else
  						{
  							$erreur = "Compte déjà éxistant";
  						}
					}
					else
					{
						$erreur = "Vos mots de passes ne correspondent pas";
					}
				}
				else
				{
					$erreur = "Vos logins ne correspondent pas";
				}
			}
			else
			{
				$erreur = "Votre pseudo est trop long";
			}
		}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Pokemon</title>
    	<link rel="stylesheet" type="text/css" href="inscription.css" media="all" />
		<meta charset="utf-8">
	</head>
	<body>
		<div align="center" id="registration">
			<h2> Rejoignez l'aventure dresseur ! </h2>
			<form method="POST" action="inscription.php">
				<table id="tab">
					<tr>
						<td align="right">
							<label for="pseudo"> Pseudo : </label>
						</td>
						<td>
							<input type="text" placeholder="Votre pseudo" required name="pseudo" id="infos">
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="login1"> Login : </label>
						</td>
						<td>
							<input type="text" placeholder="Votre login" required name="login1" id="infos">
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="login2"> Confirmation du login : </label>
						</td>
						<td>
							<input type="text" placeholder="Votre login" required name="login2" id="infos">
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="mdp1"> Mot de passe : </label>
						</td>
						<td>
							<input type="password" placeholder="Votre mot de passe" required name="mdp1" id="infos">
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="mdp2"> Confirmation du mot de passe : </label>
						</td>
						<td>
							<input type="password" placeholder="Votre mot de passe" required name="mdp2" id="infos">
						</td>
					</tr>
					<tr>
			            <td>
			              <input type="submit" name="inscription" value="S'inscrire" id="submit">
			              <a href='login.php' id='login'> Se connecter </a>
			            </td>
			        </tr>

				</table>
					</br>
					</br>
					</br>


			</form>

			<?php
				if(isset($erreur))
				{
					echo '<div id="erreurdiv"><font color="red" id="erreur">'.$erreur.'</font></div>';
				}
			?>
		</div>
	</body>
</html>
