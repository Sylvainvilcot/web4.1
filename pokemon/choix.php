<?php
	session_start();
	if(isset($_POST['quit']))
	{
		session_destroy();
		header("Location:login.php");
		exit();
	}

	if(!empty($_SESSION['user']))
	{
		$link = mysqli_connect('dwarves.iut-fbleau.fr','vilcot','vilcot123','vilcot');
		$user = $_SESSION['user'];
		$querySelect = ("SELECT pseudo,stade,ID FROM dresseurPokemon WHERE login = "."'".$user."'");
		$resultat = mysqli_query($link,$querySelect);

		foreach ($resultat as $enr)
		{
			$stade = $enr['stade'];
			$pseudo = $enr['pseudo'];
			$id = $enr['ID'];
		}
		if($stade == 1)
		{
			header("Location:menu.php");
		}
	}
	else
	{
		header("Location:inscription.php");
	}

	/*if(isset($_POST['bulbi']))
	{
		$time = time();
		mysqli_query($link, "INSERT INTO pc (idDresseur, idPokemon, evolution, pvMax, pvNow, niveau, Attaque, AttaqueSpé, Défense, DéfenseSpé, Vitesse, capacites1, capacites2, capacites3, capacites4) VALUES ('$id', '1', '1', '45', '45', '5', '49', '49', '65', '65', '45', 'Charge', 'Fouet Lianes', 'Ecrasement', 'Acide')");
		$resultat = mysqli_query($link, "SELECT ID FROM pc WHERE idPokemon = 1 AND idDresseur = $id");
		foreach ($resultat as $key)
		{
			$id_pc1 = $key['id_pc'];
		}
		mysqli_query($link, "UPDATE dresseurPokemon SET stade = 1, pokePiece = 50, pokeBall = 5, potion = 5, DernierRecompense = $time, id_pc1 = $id_pc1 WHERE login ='$user'");

		header("Location:menu.php");
		exit();
	}

	if(isset($_POST['sala']))
	{
		$time = time();
		mysqli_query($link, "INSERT INTO pc (idDresseur, idPokemon, evolution, pvMax, pvNow, niveau, Attaque, AttaqueSpé, Défense, DéfenseSpé, Vitesse, capacites1, capacites2, capacites3, capacites4) VALUES ('$id', '4', '1', '39', '39', '5', '52', '43', '60', '50', '65', 'Tranche', 'Bec Vrille', 'Lance-Flammes', 'Poing de Feu')");
		$resultat = mysqli_query($link, "SELECT ID FROM pc WHERE idPokemon = 4 AND idDresseur = $id");
		foreach ($resultat as $key)
		{
			$id_pc1 = $key['ID'];
		}
		echo $id_pc1;
		mysqli_query($link, "UPDATE dresseurPokemon SET stade = 1, pokePiece = 50, pokeBall = 5, potion = 5, DernierRecompense = $time, id_pc1 = $id_pc1 WHERE login ='$user'");

		header("Location:menu.php");
		exit();
	}

	if(isset($_POST['cara']))
	{
		$time = time();
		mysqli_query($link, "INSERT INTO pc (idDresseur, idPokemon, evolution, pvMax, pvNow, niveau, Attaque, AttaqueSpé, Défense, DéfenseSpé, Vitesse, capacites1, capacites2, capacites3, capacites4) VALUES ('$id', '7', '1','44', '44', '5', '48', '65', '50', '64', '43', 'Laser Glace', 'Hydrocanon', 'Coup d'Boule', 'Séisme')");
		$resultat = mysqli_query($link, "SELECT ID FROM pc WHERE idPokemon = 5 AND idDresseur = $id");
		foreach ($resultat as $key)
		{
			$id_pc1 = $key['id_pc'];
		}
		mysqli_query($link, "UPDATE dresseurPokemon SET stade = 1, pokePiece = 50, pokeBall = 5, potion = 5, DernierRecompense = $time, id_pc1 = $id_pc1 WHERE login ='$user'");

		header("Location:menu.php");
		exit();
	}*/


?>
<!DOCTYPE html>
<html>
	<head>
		<title>Choix du Starter</title>
		<link rel="stylesheet" type="text/css" href="choix.css" media="all" />
		<meta charset="utf-8">
	</head>
	<body>
		<form method="post" action="choix.php">
		<h2>Choisissez votre starter !</h2>
		<div id="defileParent">
		</div>
		<div id="texte-chen">

		</div>
		<div id="chen">
			<img src="imgs/chen.png" height="300px">
		</div>
		<div id="starter">
			<img src="imgs/bulb3.png" height="200px" width="200px" class="starter" id ="plante">
			<img src="imgs/salarabe3.png" height="200px" width="200px" class="starter" id ="feu">
			<img src="imgs/cara3.png" height="200px" width="200px" class="starter" id ="eau">
			<input type="submit" name="quit" value="Se déconnecter" id="submit"/>
		</div>
		<div id="pokeballs">
			<img src="imgs/ball.png" height="150px" width="150px" class="ball" id="ball1">
			<img src="imgs/ball.png" height="150px" width="150px" class="ball" id="ball2">
			<img src="imgs/ball.png" height="150px" width="150px" class="ball" id="ball3">
		</div>

	</form>
	<script>
	var div = document.querySelector('div#texte-chen');
	var data = "text=" + 0;
	let xhr = new XMLHttpRequest();
	xhr.open("POST", "script_chen.php", true);
	xhr.addEventListener('readystatechange', function()
	{
		if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
		{
			div.innerHTML = xhr.responseText;
		}
		 });
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(data);
	document.getElementById("ball1").addEventListener("mouseenter",
		function mouseEnter1()
	{
		data = "text=" + 2;
		let xhr = new XMLHttpRequest();
		xhr.open("POST", "script_chen.php", true);
		xhr.addEventListener('readystatechange', function()
		{
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
			{
				div.innerHTML = xhr.responseText;
			}
	     });
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send(data);

		document.getElementById("plante").style.visibility = "visible";
	});

	document.getElementById("ball1").addEventListener("mouseout",
		function mouseLeave1()
	{

		document.getElementById("plante").style.visibility = "hidden";
	});

	document.getElementById("ball2").addEventListener("mouseenter",
		function mouseEnter2()
	{
		data = "text=" + 3;
		let xhr = new XMLHttpRequest();
		xhr.open("POST", "script_chen.php", true);
		xhr.addEventListener('readystatechange', function()
		{
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
			{
				div.innerHTML = xhr.responseText;
			}
	     });

		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send(data);
		document.getElementById("feu").style.visibility = "visible";
	});

	document.getElementById("ball2").addEventListener("mouseout",
		function mouseLeave2()
	{
		document.getElementById("feu").style.visibility = "hidden";
	});

	document.getElementById("ball3").addEventListener("mouseenter",
		function mouseEnter3()
	{
		data = "text=" + 4;
		let xhr = new XMLHttpRequest();
		xhr.open("POST", "script_chen.php", true);
		xhr.addEventListener('readystatechange', function()
		{
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
			{
				div.innerHTML = xhr.responseText;
			}
	     });
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send(data);
		document.getElementById("eau").style.visibility = "visible";
	});

	document.getElementById("ball1").addEventListener("click",
	function mouseClick1()
	{
		donnee = "choix=" + 1;
		let xhr = new XMLHttpRequest();
		xhr.open("POST", "script_chen2.php", false);
		xhr.addEventListener('readystatechange', function()
		{
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
			{
			}
	  });
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send(donnee);
		redirection();
	});

	document.getElementById("ball2").addEventListener("click",
	function mouseClick2()
	{
		donnee = "choix=" + 2;
		let xhr = new XMLHttpRequest();
		xhr.open("POST", "script_chen2.php", false);
		xhr.addEventListener('readystatechange', function()
		{
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
			{
			}
		});
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send(donnee);
		redirection();
	});

	document.getElementById("ball3").addEventListener("click",
	function mouseClick3()
	{
		donnee = "choix=" + 3;
		let xhr = new XMLHttpRequest();
		xhr.open("POST", "script_chen2.php", false);
		xhr.addEventListener('readystatechange', function()
		{
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
			{
			}
	  });
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send(donnee);
		redirection();
	});

	document.getElementById("ball3").addEventListener("mouseout",
		function mouseLeave3()
	{
		document.getElementById("eau").style.visibility = "hidden";
	});

	var redirection = function()
	{
	  document.location.href="menu.php";
	};

	</script>

	</body>
</html>
