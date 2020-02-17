<?php
	session_start();
	if(isset($_POST['quit']))
	{
		session_destroy();
		header("Location:login.php");
		exit();
	}
	if(isset($_SESSION['user']))
	{
		$link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');
		$user = $_SESSION['user'];
		$querySelect = ("SELECT stade FROM dresseurPokemon WHERE login = "."'".$user."'");
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

	$querySelect2 = ("SELECT pseudo,pokePiece,pokeBall,DernierRecompense
		FROM dresseurPokemon WHERE login = '$user'");
	$resultat = mysqli_query($link,$querySelect2);

	//$querySelect3 = ("SELECT pv FROM Pokemon");

	foreach ($resultat as $key)
	{
		$pseudo = $key['pseudo'];
		$pokePiece = $key['pokePiece'];
		$pokeBall = $key['pokeBall'];
		$DernierRecompense = $key['DernierRecompense'];
	}

	// echo date('d/m/y', $DernierRecompense)." : ".date('H:i:s', $DernierRecompense);
	// echo "</br>";
	// echo date('d/m/y', $time)." : ".date('H:i:s', $time);
	// echo "</br>";
	// echo $pokePiece;
	if($DernierRecompense + 60 * 60 * 24 < $time)
	{
		do{
		$DernierRecompense = $DernierRecompense + 60 * 60 * 24;
		$pokePiece = $pokePiece + 50;
		} while($DernierRecompense + 60 * 60 * 24 < $time);


		mysqli_query($link, "UPDATE dresseurPokemon SET DernierRecompense='$DernierRecompense' WHERE login ='$user'");
		mysqli_query($link, "UPDATE dresseurPokemon SET pokePiece='$pokePiece' WHERE login ='$user'");
	}

	$pok1 = mysqli_query($link,"SELECT id_pc1 FROM dresseurPokemon WHERE login='$user'");
	foreach($pok1 as $key)
	{
		$pok1_2 = $key['id_pc1'];
	}

	$pok2 = mysqli_query($link,"SELECT id_pc2 FROM dresseurPokemon WHERE login='$user'");
	foreach($pok2 as $key)
	{
		$pok2_2 = $key['id_pc2'];
	}
	$pok3 = mysqli_query($link,"SELECT id_pc3 FROM dresseurPokemon WHERE login='$user'");
	foreach($pok3 as $key)
	{
		$pok3_2 = $key['id_pc3'];
	}
	$pok4 = mysqli_query($link,"SELECT id_pc4 FROM dresseurPokemon WHERE login='$user'");
	foreach($pok4 as $key)
	{
		$pok4_2 = $key['id_pc4'];
	}
	$pok5 = mysqli_query($link,"SELECT id_pc5 FROM dresseurPokemon WHERE login='$user'");
	foreach($pok5 as $key)
	{
		$pok5_2 = $key['id_pc5'];
	}
	$pok6 = mysqli_query($link,"SELECT id_pc6 FROM dresseurPokemon WHERE login='$user'");
	foreach($pok6 as $key)
	{
		$pok6_2 = $key['id_pc6'];
	}

	$pok1 = mysqli_query($link, "SELECT idPokemon FROM pc WHERE ID = $pok1_2");
	foreach($pok1 as $key)
	{
		$pok1_3 = $key['idPokemon'];
	}
	$pok2 = mysqli_query($link, "SELECT idPokemon FROM pc WHERE ID = $pok2_2");
	foreach($pok2 as $key)
	{
		$pok2_3 = $key['idPokemon'];
	}
	$pok3 = mysqli_query($link, "SELECT idPokemon FROM pc WHERE ID = $pok3_2");
	foreach($pok3 as $key)
	{
		$pok3_3 = $key['idPokemon'];
	}
	$pok4 = mysqli_query($link, "SELECT idPokemon FROM pc WHERE ID = $pok4_2");
	foreach($pok4 as $key)
	{
		$pok4_3 = $key['idPokemon'];
	}
	$pok5 = mysqli_query($link, "SELECT idPokemon FROM pc WHERE ID = $pok5_2");
	foreach($pok5 as $key)
	{
		$pok5_3 = $key['idPokemon'];
	}
	$pok6 = mysqli_query($link, "SELECT idPokemon FROM pc WHERE ID = $pok6_2");
	foreach($pok6 as $key)
	{
		$pok6_3 = $key['idPokemon'];
	}

	function getPoke($pok)
	{
		if(isset($_SESSION['user']))
		{
			$link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');
			$user = $_SESSION['user'];
		}
		$id = mysqli_query($link, "SELECT $pok FROM dresseurPokemon WHERE login='$user'");
		foreach($id as $key)
		{
			$id2 = $key[$pok];
		}
		return $id2;
	}


	if(isset($_GET['sub1']))
	{
		$intr = $pok1_2;
		$intr2 = $_GET['pok1'];
		$test = getPoke($intr2);

		mysqli_query($link, "UPDATE dresseurPokemon SET id_pc1 = $test WHERE login = '$user'");
		mysqli_query($link, "UPDATE dresseurPokemon SET $intr2 = $intr WHERE login = '$user'");
		header("Location:ordinateurordinateur.php");
	}
	else if(isset($_GET['sub2']))
	{
		$intr = $pok2_2;
		$intr2 = $_GET['pok2'];
		$test = getPoke($intr2);
		mysqli_query($link, "UPDATE dresseurPokemon SET id_pc2 = $test WHERE login = '$user'");
		mysqli_query($link, "UPDATE dresseurPokemon SET $intr2 = $intr WHERE login = '$user'");
		header("Location:ordinateur.php");
	}
	else if(isset($_GET['sub3']))
	{
		$intr = $pok3_2;
		$intr2 = $_GET['pok3'];
		$test = getPoke($intr2);

		mysqli_query($link, "UPDATE dresseurPokemon SET id_pc3 = $test WHERE login = '$user'");
		mysqli_query($link, "UPDATE dresseurPokemon SET $intr2 = $intr WHERE login = '$user'");
		header("Location:ordinateur.php");
	}
	else if(isset($_GET['sub4']))
	{
		$intr = $pok4_2;
		$intr2 = $_GET['pok4'];
		$test = getPoke($intr2);

		mysqli_query($link, "UPDATE dresseurPokemon SET id_pc4 = $test WHERE login = '$user'");
		mysqli_query($link, "UPDATE dresseurPokemon SET $intr2 = $intr WHERE login = '$user'");
		header("Location:ordinateur.php");
	}
	else if(isset($_GET['sub5']))
	{
		$intr = $pok5_2;
		$intr2 = $_GET['pok5'];
		$test = getPoke($intr2);

		mysqli_query($link, "UPDATE dresseurPokemon SET id_pc5 = $test WHERE login = '$user'");
		mysqli_query($link, "UPDATE dresseurPokemon SET $intr2 = $intr WHERE login = '$user'");
		header("Location:ordinateur.php");
	}
	else if(isset($_GET['sub6']))
	{
		$intr = $pok6_2;
		$intr2 = $_GET['pok6'];
		$test = getPoke($intr2);

		mysqli_query($link, "UPDATE dresseurPokemon SET id_pc6 = $test WHERE login = '$user'");
		mysqli_query($link, "UPDATE dresseurPokemon SET $intr2 = $intr WHERE login = '$user'");
		header("Location:ordinateur.php");
	}

	if(isset($_GET['retir']))
	{
		$idpc = $_GET['retir1'];
		$q = mysqli_query($link,"SELECT * FROM dresseurPokemon WHERE id_pc1 = $idpc OR id_pc2 = $idpc OR id_pc3 = $idpc OR id_pc4 = $idpc OR id_pc5 = $idpc OR id_pc6 = $idpc");
		$num2 = mysqli_num_rows($q);
		if($num2 == 0)
		{
	    $num = $_GET['retir2'];
	  	mysqli_query($link, "UPDATE dresseurPokemon SET $num = $idpc WHERE login = '$user'");
			header("Location:ordinateur.php");
		}
		else
		{
			echo "<p id='err-cp'>Ce pokémon est déjà dans votre équipe !</p>";
		}
	}

	if(isset($_GET['sub_abandon']))
	{
		$pcida = $_GET['abandon'];
		mysqli_query($link,"DELETE FROM pc WHERE ID = $pcida");
		header("Location:ordinateur.php");
	}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ordinateur</title>
    <link rel="stylesheet" type="text/css" href="ordinateur.css" media="all" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  </head>
	<header>
		<div id="header">
			<h2>Ordinateur</h2>
			<form method="post">
				  <input type="submit" name="quit" id="disc" value="Déconnexion"></input>
					<label for="disc" id="disc2"><i class="fas fa-sign-out-alt"></i></label>
			</form>
			<p id="pieces"><?php echo $pokePiece; ?></p>
			<p id="balls"><?php echo $pokeBall; ?></p>

			<label for="pieces" id="labelpieces">
				<img src="imgs/dollar.png" width="15px" height="15px">
			</label>
			<label for="balls" id="labelballs">
				<img src="imgs/ball.png" width="20px" height="20px">
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
		<?php

		$n_pok1 = mysqli_query($link, "SELECT nom FROM Pokemon WHERE ID='$pok1_3'");
		foreach($n_pok1 as $key)
		{
			$n_pok1_2 = $key['nom'];
		}
		$n_pok2 = mysqli_query($link, "SELECT nom FROM Pokemon WHERE ID='$pok2_3'");
		foreach($n_pok2 as $key)
		{
			$n_pok2_2 = $key['nom'];
		}
		$n_pok3 = mysqli_query($link, "SELECT nom FROM Pokemon WHERE ID='$pok3_3'");
		foreach($n_pok3 as $key)
		{
			$n_pok3_2 = $key['nom'];
		}
		$n_pok4 = mysqli_query($link, "SELECT nom FROM Pokemon WHERE ID='$pok4_3'");
		foreach($n_pok4 as $key)
		{
			$n_pok4_2 = $key['nom'];
		}
		$n_pok5 = mysqli_query($link, "SELECT nom FROM Pokemon WHERE ID='$pok5_3'");
		foreach($n_pok5 as $key)
		{
			$n_pok5_2 = $key['nom'];
		}
		$n_pok6 = mysqli_query($link, "SELECT nom FROM Pokemon WHERE ID='$pok6_3'");
		foreach($n_pok6 as $key)
		{
			$n_pok6_2 = $key['nom'];
		}

		$i_pok1 = mysqli_query($link, "SELECT image1 FROM Pokemon WHERE ID='$pok1_3'");
		foreach($i_pok1 as $key)
		{
			$i_pok1_2 = $key['image1'];
		}
		$i_pok2 = mysqli_query($link, "SELECT image1 FROM Pokemon WHERE ID='$pok2_3'");
		foreach($i_pok2 as $key)
		{
			$i_pok2_2 = $key['image1'];
		}
		$i_pok3 = mysqli_query($link, "SELECT image1 FROM Pokemon WHERE ID='$pok3_3'");
		foreach($i_pok3 as $key)
		{
			$i_pok3_2 = $key['image1'];
		}
		$i_pok4 = mysqli_query($link, "SELECT image1 FROM Pokemon WHERE ID='$pok4_3'");
		foreach($i_pok4 as $key)
		{
			$i_pok4_2 = $key['image1'];
		}
		$i_pok5 = mysqli_query($link, "SELECT image1 FROM Pokemon WHERE ID='$pok5_3'");
		foreach($i_pok5 as $key)
		{
			$i_pok5_2 = $key['image1'];
		}
		$i_pok6 = mysqli_query($link, "SELECT image1 FROM Pokemon WHERE ID='$pok6_3'");
		foreach($i_pok6 as $key)
		{
			$i_pok6_2 = $key['image1'];
		}

			$q = mysqli_query($link, "SELECT ID FROM dresseurPokemon WHERE login='$user'");
			foreach($q as $key)
			{
				$idd = $key['ID'];
			}
	?>
  <body>
    <div id="ordi">
        <table id="table">
          <?php

						$q = mysqli_query($link, "SELECT idPokemon FROM pc WHERE idDresseur = $idd");

						$i = 0;
						foreach($q as $key)
						{

							$i++;
							$echo = $key['idPokemon'];
							$i_pok = mysqli_query($link, "SELECT image1 FROM Pokemon WHERE ID='$echo'");
							foreach($i_pok as $key)
							{
								$echo2 = $key['image1'];
							}
							if($i%6 == 0)
							{
								echo "<tr>";
							}
							if($i%6 != 0)
							{
								echo "<td>$echo2</td>";
							}
							if($i%6 == 0)
							{
								echo "</tr>";
							}
							if($i == 23)
							{
								break;
							}
						}
					 ?>
        </table>
        <a href="menu.php" id="retour">Menu</a>
				<button id="deposer" class="but" onclick="document.getElementById('div_deposer').style.visibility='visible'">Déposer un pokémon</button>
				<button id="retirer" class="but" onclick="document.getElementById('div_retirer').style.visibility='visible'">Retirer un pokémon</button>
				<button id="abandon" class="but" onclick="document.getElementById('div_abandon').style.visibility='visible'">Abandonner un pokémon</button>
				<div id="div_deposer">
					  <button id="poke1" class="poke-btn" onclick="dep_pok1()"><?php echo $n_pok1_2; ?></button>
						<button id="poke2" class="poke-btn" onclick="dep_pok2()"><?php echo $n_pok2_2; ?></button>
						<button id="poke3" class="poke-btn" onclick="dep_pok3()"><?php echo $n_pok3_2; ?></button>
						<button id="poke4" class="poke-btn" onclick="dep_pok4()"><?php echo $n_pok4_2; ?></button>
						<button id="poke5" class="poke-btn" onclick="dep_pok5()"><?php echo $n_pok5_2; ?></button>
						<button id="poke6" class="poke-btn" onclick="dep_pok6()"><?php echo $n_pok6_2; ?></button>
						<button id="deposer-hide" onclick="document.getElementById('div_deposer').style.visibility='hidden'"></button>
						<label for="deposer-hide" id="dep-hide-btn"><i class="fas fa-times"></i></label>
				</div>
				<div id="div_retirer">
					<h4 id="retir-1">Pokémon à retirer : </h4>
					<h4 id="retir-2">Place dans l'équipe : </h4>
					<button id="retirer-hide" onclick="document.getElementById('div_retirer').style.visibility='hidden'"></button>
					<label for="retirer-hide" id="ret-hide-btn"><i class="fas fa-times"></i></label>
					  <form method="get" id="f_retirer">
							<select name="retir1" size="6" id="retir1">
								<?php
									$q = mysqli_query($link, "SELECT idPokemon, ID FROM pc WHERE idDresseur = $idd");
									foreach($q as $key)
									{
										$echo = $key['idPokemon'];
										$IDf = $key['ID'];
										$n_pok = mysqli_query($link, "SELECT nom FROM Pokemon WHERE ID='$echo'");
										foreach($n_pok as $key)
										{
											$echo2 = $key['nom'];
											echo "<option value=$IDf>$echo2</option>";
										}
									}
								 ?>
							 </select>
							 <select name="retir2" size="6" id="retir2">
								 <?php
									 echo "<option value='id_pc1'>Pokémon 1</option>";
									 echo "<option value='id_pc2'>Pokémon 2</option>";
									 echo "<option value='id_pc3'>Pokémon 3</option>";
									 echo "<option value='id_pc4'>Pokémon 4</option>";
									 echo "<option value='id_pc5'>Pokémon 5</option>";
									 echo "<option value='id_pc6'>Pokémon 6</option>";
									?>
							 </select>
							 <input type="submit" value="Retirer" id="sub-retir" name="retir"></input>
						</form>
				</div>
				<div id="div_abandon">
					<button id="abandon-hide" onclick="document.getElementById('div_abandon').style.visibility='hidden'"></button>
					<label for="abandon-hide" id="abandon-btn"><i class="fas fa-times"></i></label>
					<form id="f_abandon">
						<select name="abandon" size=6 id="s_abandon">
							<?php
								$q = mysqli_query($link, "SELECT idPokemon, ID FROM pc WHERE idDresseur = $idd");
								foreach($q as $key)
								{
									$echo = $key['idPokemon'];
									$IDf = $key['ID'];
									$n_pok = mysqli_query($link, "SELECT nom FROM Pokemon WHERE ID='$echo'");
									foreach($n_pok as $key)
									{
										$echo2 = $key['nom'];
										echo "<option value=$IDf>$echo2</option>";
									}
								}
							 ?>
						 </select>
						 <input type="submit" name="sub_abandon" id="sub_abandon" value="Abandonner ce pokémon"></input>
					 </form>
				</div>
				<div id="pokemons">
					<h3>Mes Pokémons</h3>
					<hr class="barre">
					<div id="pokemon1" class="pokemon">
						<form method="get">
							  <select class="select" id="sel1" name="pok1">
							  	<option value="id_pc1" selected>Pokémon 1</option>
									<option value="id_pc2">Pokémon 2</option>
									<option value="id_pc3">Pokémon 3</option>
									<option value="id_pc4">Pokémon 4</option>
									<option value="id_pc5">Pokémon 5</option>
									<option value="id_pc6">Pokémon 6</option>
							  </select>
								<input class="sub" type="submit" name="sub1" value="valider">
						</form>
						<?php
							echo "<div id='n_pok1' class='n_pok'>$n_pok1_2</div>";
							echo "<div id='i_pok1' class='i_pok'>$i_pok1_2</div>";
						?>
					</div>
					<hr>
					<div id="pokemon2" class="pokemon">
						<form method="get">
							  <select class="select" id="sel2" name="pok2">
							  	<option value="id_pc1">Pokémon 1</option>
									<option value="id_pc2" selected>Pokémon 2</option>
									<option value="id_pc3">Pokémon 3</option>
									<option value="id_pc4">Pokémon 4</option>
									<option value="id_pc5">Pokémon 5</option>
									<option value="id_pc6">Pokémon 6</option>
							  </select>
								<input class="sub" type="submit" name="sub2" value="valider">
						</form>
						<?php
							echo "<div id='n_pok2' class='n_pok'>$n_pok2_2</div>";
							echo "<div id='i_pok2' class='i_pok'>$i_pok2_2</div>";
						?>
					</div>
					<hr>
					<div id="pokemon3" class="pokemon">
						<form method="get">
							  <select class="select" id="sel3" name="pok3">
							  	<option value="id_pc1">Pokémon 1</option>
									<option value="id_pc2">Pokémon 2</option>
									<option value="id_pc3" selected>Pokémon 3</option>
									<option value="id_pc4">Pokémon 4</option>
									<option value="id_pc5">Pokémon 5</option>
									<option value="id_pc6">Pokémon 6</option>
							  </select>
								<input class="sub" type="submit" name="sub3" value="valider">
						</form>
						<?php
							echo "<div id='n_pok3' class='n_pok'>$n_pok3_2</div>";
							echo "<div id='i_pok3' class='i_pok'>$i_pok3_2</div>";
						?>
					</div>
					<hr>
					<div id="pokemon4" class="pokemon">
						<form method="get">
							  <select class="select" id="sel4" name="pok4">
							  	<option value="id_pc1">Pokémon 1</option>
									<option value="id_pc2">Pokémon 2</option>
									<option value="id_pc3">Pokémon 3</option>
									<option value="id_pc4" selected>Pokémon 4</option>
									<option value="id_pc5">Pokémon 5</option>
									<option value="id_pc6">Pokémon 6</option>
							  </select>
								<input class="sub" type="submit" name="sub4" value="valider">
						</form>
						<?php

							echo "<div id='n_pok4' class='n_pok'>$n_pok4_2</div>";
							echo "<div id='i_pok4' class='i_pok'>$i_pok4_2</div>";
						?>
					</div>
					<hr>
					<div id="pokemon5" class="pokemon">
						<form method="get">
							  <select class="select" id="sel5" name="pok5">
							  	<option value="id_pc1">Pokémon 1</option>
									<option value="id_pc2">Pokémon 2</option>
									<option value="id_pc3">Pokémon 3</option>
									<option value="id_pc4">Pokémon 4</option>
									<option value="id_pc5" selected>Pokémon 5</option>
									<option value="id_pc6">Pokémon 6</option>
							  </select>
								<input class="sub" type="submit" name="sub5" value="valider">
						</form>
						<?php
							echo "<div id='n_pok5' class='n_pok'>$n_pok5_2</div>";
							echo "<div id='i_pok5' class='i_pok'>$i_pok5_2</div>";
						?>
					</div>
					<hr>
					<div id="pokemon6" class="pokemon">
						<form  method="get">
							  <select class="select" id="sel6" name="pok6">
							  	<option value="id_pc1">Pokémon 1</option>
									<option value="id_pc2">Pokémon 2</option>
									<option value="id_pc3">Pokémon 3</option>
									<option value="id_pc4">Pokémon 4</option>
									<option value="id_pc5">Pokémon 5</option>
									<option value="id_pc6" selected>Pokémon 6</option>
							  </select>
								<input class="sub" type="submit" name="sub6" value="valider">
						</form>
						<?php
							echo "<div id='n_pok6' class='n_pok'>$n_pok6_2</div>";
							echo "<div id='i_pok6' class='i_pok'>$i_pok6_2</div>";
						?>
					</div>
				</div>
    </div>
  </body>
</html>
<script>

	function dep_pok1() {

		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'dep_pok1.php', true);

		xhr.addEventListener('readystatechange', function() {

			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			}
		});

		xhr.send();
		location = location;
	}
	function dep_pok2() {

		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'dep_pok2.php', true);

		xhr.addEventListener('readystatechange', function() {

			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			}
		});

		xhr.send();
		location = location;
	}
	function dep_pok3() {

		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'dep_pok3.php', true);

		xhr.addEventListener('readystatechange', function() {

			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			}
		});

		xhr.send();
		location = location;
	}
	function dep_pok4() {

		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'dep_pok4.php', true);

		xhr.addEventListener('readystatechange', function() {

			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			}
		});

		xhr.send();
		location = location;
	}
	function dep_pok5() {

		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'dep_pok5.php', true);

		xhr.addEventListener('readystatechange', function() {

			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			}
		});

		xhr.send();
		location = location;
	}
	function dep_pok6() {

		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'dep_pok6.php', true);

		xhr.addEventListener('readystatechange', function() {

			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			}
		});

		xhr.send();
		location = location;
	}
	function accept_friend() {

		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'accept_friend.php', true);

		xhr.addEventListener('readystatechange', function() {

			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			}
		});

		xhr.send();
		location = location;
	}

	function deny_friend() {
		var xhr = new XMLHttpRequest();

		xhr.open('GET', 'deny_friend.php', true);

		xhr.addEventListener('readystatechange', function() {

			if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			}
		});

		xhr.send();
		location = location;
	}

</script>
