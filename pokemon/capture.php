
<?php
session_start();
if(isset($_POST['quit']))
{
	session_destroy();
	header("Location:login.php");
	exit();
}
include("fonctions.php");

if(isset($_SESSION['user']))
{
	$link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');
	$user = $_SESSION['user'];
	$querySelect = ("SELECT stade FROM dresseurPokemon WHERE login = '$user'");
	$res = mysqli_query($link,$querySelect);

	foreach ($res as $enr)
	{
		$stade = $enr['stade'];
	}
	if($stade == 0)
	{
		header("Location:choix.php");
		exit();
	}
}
else
{
	header("Location:login.php");
	exit();
}

$time = time();

/*$querySelect2 = ("SELECT *
	FROM dresseurPokemon WHERE login = '$user'");*/
$resultat3 = mysqli_query($link,"SELECT * FROM dresseurPokemon WHERE login = '$user'");

	foreach ($resultat3 as $key)
	{
		$pseudo = $key['pseudo'];
		$pokePiece = $key['pokePiece'];
		$pokeBall = $key['pokeBall'];
		$DernierRecompense = $key['DernierRecompense'];
		$id_pc1 = $key['id_pc1'];
		$id_pc2 = $key['id_pc2'];
		$id_pc3 = $key['id_pc3'];
		$id_pc4 = $key['id_pc4'];
		$id_pc5 = $key['id_pc5'];
		$id_pc6 = $key['id_pc6'];
		$potion = $key['potion'];
	}
	$_SESSION['id_pc'] = $id_pc1;
	$resultat2 = mysqli_query($link, "SELECT * FROM pc WHERE ID = $id_pc1");
	foreach ($resultat2 as $enr)
	{
			$pvMy = $enr['pvNow'];
			$niveau = $enr['niveau'];
			$IDmypokemon =  $enr['idPokemon'];
			$capacites1 = $enr['capacites1'];
			$capacites2 = $enr['capacites2'];
			$capacites3 = $enr['capacites3'];
			$capacites4 = $enr['capacites4'];
	}
	$res = mysqli_query($link, "SELECT * FROM Pokemon WHERE ID = $IDmypokemon");
	foreach ($res as $key2)
	{
			$nommypokemon = $key2['Nom'];
			$mypokemon = $key2['image2'];
	}
	//$pvMy = $_SESSION['pvMy'];
	$_SESSION['pvMy'] = $pvMy;
	$_SESSION['mypokemon'] = $mypokemon;
	$_SESSION['$nommypokemon'] = $nommypokemon;
	//$_SESSION['pokeBall'] = $pokeBall;
//$pvNow = $_SESSION['pvNow'];
//$pvNow = 0;
$q = mysqli_query($link, "SELECT ID FROM dresseurPokemon WHERE login='$user'");
foreach($q as $key)
{
	$idd = $key['ID'];
}

$q = mysqli_query($link, "SELECT * FROM pc WHERE idDresseur = $idd");
$places = mysqli_num_rows($q);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Capture de pokémons</title>
    <link rel="stylesheet" type="text/css" href="capture.css" media="all" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  </head>
	<header>
		<div id="header">
			<h2>Capture de Pokémon</h2>
			<form method="post">
				  <input type="submit" name="quit" id="disc" value="Déconnexion"></input>
					<label for="disc" id="disc2"><i class="fas fa-sign-out-alt"></i></label>
			</form>
			<p id="pieces"><?php echo $pokePiece; ?></p>
			<p id="balls"><?php echo $pokeBall; ?></p>
			<p id="potions"><?php echo $potion; ?></p>
			<p id="places"><?php echo $places?></p>

			<label for="pieces" id="labelpieces">
				<img src="imgs/dollar.png" width="15px" height="15px">
			</label>
			<label for="balls" id="labelballs">
				<img src="imgs/ball.png" width="20px" height="20px">
			</label>
			<label for="potions" id="labelpots">
				  <img src="imgs/potion_logo.png" width="30px" height="30px"></img>
			</label>
			<label for="places" id="labelplaces">
				  <i class="fas fa-desktop"></i>
			</label>


			<input type="checkbox" id="chk">
			<label for="chk" class="show-menu-btn">
				<i class="fas fa-user-friends"></i>
			</label>

			<ul class="friends">
				<h3> amis </h3>
				<h4>liste d'amis</h4>
				<div id="friendlist">
					<?php
						$query_fr = mysqli_query($link,"SELECT login_2 FROM Amis WHERE login_1 = '$user'");
						$query_fr2 = mysqli_query($link,"SELECT login_1 FROM Amis WHERE login_2 = '$user'");
						while($data = mysqli_fetch_array($query_fr))
						{
							echo $data['login_2']."<br />";
						}
						while($date = mysqli_fetch_array($query_fr2))
						{
							echo $date['login_1']."<br />";
						}
					?>
				</div>
				<form method="get">
					<input name="form" id="form" type="text" placeholder="Ajouter un ami"></input>
					<input id="submit" type="submit"></input>
				</form>
				<?php
					if(isset($_GET['form']))
					{
						$form = $_GET['form'];
						$check = mysqli_query($link,"SELECT id_req FROM dresseurPokemon WHERE login = '$form'");
						foreach($check as $key)
						{
							$id_req = $key['id_req'];
						}
						if($id_req != NULL && $user != $form)
						{
							echo "<p class ='err' id='err_amis'>Cet utilisateur a déjà une demande d'amis en attente !</p>";
						}
						elseif($user == $form)
						{
							mysqli_query($link, "UPDATE dresseurPokemon SET id_req = NULL WHERE login = '$user'");
						}
						else
						{
							$query = "UPDATE dresseurPokemon SET id_req = '$user' WHERE login = '$form'";
							mysqli_query($link,$query);
							//header("Location:menu.php");
						}
					}
					$req = mysqli_query($link,"SELECT id_req FROM dresseurPokemon WHERE login = '$user'");
					foreach($req as $key)
					{
						$id_req2 = $key['id_req'];
					}
					if($id_req2 != NULL)
					{
						echo "<p id='fr_req'>Nouvelle requête de : $id_req2</p>
									<input type='button' id='accept' onclick='accept_friend()'></input>
									<input type='button' id='deny' onclick='deny_friend()'></input>
									<label for='accept'><i class='fas fa-check' id='accept-btn'></i></label>
									<label for='deny'><i class='fas fa-times' id='deny-btn'></i></label>";
					}
					elseif($id_req2 == NULL)
					{
						echo "<p id='fr_req'>Pas de nouvelle demande d'amis</p>";
					}
				?>
				<label for="submit" class="sub-btn">
					  <i class="fas fa-user-plus"></i>
				</label>
				<label for="chk" class="hide-menu-btn">
					<i class="fas fa-times"></i>
				</label>
				<?php
					$form = $_GET['form'];
					if($user == $form)
					{
						echo "<p class='err' id='own'>Vous ne pouvez pas vous demander en amis vous-même !</p>";
					}
					$check2_1 = mysqli_query($link,"SELECT * FROM Amis WHERE login_1 = '$user' AND login_2 = '$form'");
					$check2_2 = mysqli_query($link,"SELECT * FROM Amis WHERE login_2 = '$user' AND login_1= '$form'");
					$row_cnt1 = mysqli_num_rows($check2_1);
					$row_cnt2 = mysqli_num_rows($check2_2);

					if($row_cnt1 == 1 || $row_cnt2 == 1)
					{
						echo "<p id='alrdy'>Cet utilisateur est déjà dans votre liste d'amis !</p>";
					}
				?>
			</ul>
		</div>
	</header>
  <body>
		<a href="menu.php" id="retour">Menu</a>
		<div id="mypkn">

			<div class='barre'>
	      <div id='jaugeMy' class='couleurGrise'></div>
	      <div class='pv' id='pvMy'><?php echo $pvMy;?></div>
	      </div>
				<?php
			echo $mypokemon;
			echo "</br>";
			echo $nommypokemon;
			echo "</br>";
			echo "Niveau : ".$niveau; ?>
		</div>
		<div id="enemypokemon">
			<?php
				if(isset($_SESSION['random']))
				{
					$pvEnemy = $_SESSION['pvEnemy'];
					echo $_SESSION['nom_enemypokemon'];
					echo "</br>";
					echo"<div class='barre'>
					<div id='jaugeEnemy' class='couleurVerte'></div>
			      <div class='pv' id='pvEnemy'>$pvEnemy</div>
			      </div>";
						//echo "<script src='capture.js'> jaugePvMy(); </script>";
					echo $_SESSION['enemypokemon'];
				}
				else
				{
					nouveauPokemon();
				}
			?>
		</div>
		<div id="menu">
			<div id="fenetre"></div>
			<button class="attaquer" id="attaquer">ATTAQUER</button>
			<button id="sac">SOIN</button>
			<button id="capturer">CAPTURER</button>
			<button id="fuir">NOUVEAU POKEMON</button>
			<button class="capacites" id="capacites1"><?php echo $capacites1 ?></button>
			<button class="capacites" id="capacites2"><?php echo $capacites2 ?></button>
			<button class="capacites" id="capacites3"><?php echo $capacites3 ?></button>
			<button class="capacites" id="capacites4"><?php echo $capacites4 ?></button>
			<input type="button" value="Quitter" id="refresh"></input>
		</div>
  </body>
	<script>
		let xhr = new XMLHttpRequest();
		let pvmaxmy;
		xhr.open("POST", "pv_max_my_pokemon.php", false);
		xhr.addEventListener('readystatechange', function()
		{
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
			{
				 pvmaxmy = Number(xhr.responseText);
			}
		});
		xhr.send();
		let div6 = document.querySelector('div#pvMy');
		let pourcentage = Number(div6.innerHTML) * 100 / pvmaxmy;
		if(pourcentage <= 15)
		{
			document.querySelector('div#jaugeMy').className = "couleurRouge";
		}
		else if(pourcentage <= 50)
		{
			document.querySelector('div#jaugeMy').className = "couleurJaune";
		}
		else
	  {
	    document.querySelector('div#jaugeMy').className = "couleurVerte";
	  }
		document.querySelector('div#jaugeMy').style.width = pourcentage+"%";

		let xhr2 = new XMLHttpRequest();
		let pvmaxenemy;
		xhr2.open("POST", "pv_max_enemy_pokemon.php", false);
		xhr2.addEventListener('readystatechange', function()
		{
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
			{
				 pvmaxenemy = Number(xhr2.responseText);
			}
		});
		xhr2.send();
		//console.log(pvmaxenemy);
		let div7 = document.querySelector('div#pvEnemy');
		let pourcentage2 = Number(div7.innerHTML) * 100 / pvmaxenemy;
		if(pourcentage2 <= 15)
		{
			document.querySelector('div#jaugeEnemy').className = "couleurRouge";
		}
		else if(pourcentage2 <= 50)
		{
			document.querySelector('div#jaugeEnemy').className = "couleurJaune";
		}
		else
	  {
	    document.querySelector('div#jaugeEnemy').className = "couleurVerte";
	  }
		document.querySelector('div#jaugeEnemy').style.width = pourcentage2+"%";
</script>
	<script src="capture.js">
	</script>
</html>
