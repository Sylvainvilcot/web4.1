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
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Boutique / Centre Pokémon</title>
    <link rel="stylesheet" type="text/css" href="boutique.css" media="all" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  </head>
	<header>
		<div id="header">
			<h2>Boutique / Centre Pokémon</h2>
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
  <body>
     <div id="choix" class="inline">
      <button id="centre" onclick="document.getElementById('div_centre').style.visibility='visible'" class="choix">Centre Pokémon</button>
      <button id="shop" onclick="document.getElementById('div_shop').style.visibility='visible'" class="choix">Boutique</button>
     </div>

		 <div id="div_centre">
			<button id="soin" onclick="soin()">Soigner tous les pokémons</button>
			<button id="hide-centre" onclick="document.getElementById('div_centre').style.visibility='hidden';document.getElementById('msg_soin').style.visibility='hidden';"></button>
			<label for="hide-centre" id="hide-centre-btn"><i class="fas fa-times"></i></label>
			<p id="msg_soin">Vos pokémons ont été soignés !</p>
		 </div>

		 <div id="div_shop">
			 <h2>Boutique</h2>
			 <button id="buy-pot" onclick="buy_pot()" class="buy-btn">Acheter</button>
			 <button id="buy-ball" onclick="buy_ball()" class="buy-btn">Acheter</button>
			 <img src="imgs/potion.png" id="img-pot" width="100px"></img>
			 <img src="imgs/pokeball.png" id="img-ball" width="100px"></img>
			 <button id="hide-shop" onclick="document.getElementById('div_shop').style.visibility='hidden'";></button>
			 <label for="hide-shop" id="hide-shop-btn"><i class="fas fa-times"></i></label>
			 <p id="price-pot" class="price">150</p>
			 <p id="price-ball" class="price">200</p>
			 <label for="price-pot" id="label-pot"><img src="imgs/dollar.png" width="15px" height="15px"></img></label>
			 <label for="price-ball" id="label-ball"><img src="imgs/dollar.png" width="15px" height="15px"></img></label>
		 </div>
   <a href="menu.php" id="retour">Menu</a>
  </body>
</html>

<script>

	function buy_pot() {

		let price = document.querySelector('p#pieces');
		price = Number(price.innerHTML);

		if(price < 150)
		{
			alert("Vous n'avez pas assez d'argent !");
		}
		else
		{
			var xhr = new XMLHttpRequest();
			xhr.open('GET', 'buy_pot.php', true);

			xhr.addEventListener('readystatechange', function() {

				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				}
			});

			xhr.send();
			location=location;
		}
	}

	function buy_ball() {

		let price=document.querySelector('p#pieces');
		price = Number(price.innerHTML);

		if(price < 200)
		{
			alert("Vous n'avez pas assez d'argent !");
		}

		else
		{
			var xhr = new XMLHttpRequest();
			xhr.open('GET', 'buy_ball.php', true);

			xhr.addEventListener('readystatechange', function() {

				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				}
			});

			xhr.send();
			location = location;
		}
	}

	function soin() {
		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'soin.php', true);

		xhr.addEventListener('readystatechange', function() {

			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			}
		});

		xhr.send();
		document.getElementById("msg_soin").style.visibility="visible";
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
