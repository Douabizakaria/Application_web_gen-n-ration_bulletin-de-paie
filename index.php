<?php

session_start();

require 'database.php';

if (isset($_SESSION['user_id'])) {

	$records = $conn->prepare('SELECT id,email,password,name,Fonction, CIN, CNSS, datenaissance, lieunaissance, adresse, Ntelephone, embouche, situationfamilial, paie, salaire, Nenfant, Nheuresup, prixheuresup FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if (count($results) > 0) {
		$user = $results;
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Welcome to you WebApp</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
	<style>
		.center {
			margin: auto;


			padding-top: 20%;

		}

		button {
			width: 100%;
			margin: 10px;
			height: 200px;
			opacity: 0.95;
			border: 2px;
		}

		body {
			font-size: 14px;
			line-height: 1.8;
			color: #222;
			font-weight: 400;
			font-family: 'Montserrat';
			background-color:#F0F8FF;
			background-repeat: no-repeat;
			background-size: cover;
			-moz-background-size: cover;
			-webkit-background-size: cover;
			-o-background-size: cover;
			-ms-background-size: cover;
			background-position: center center;
			padding: 115px 0;

		}

		table,
		th,
		td {
			border: 3px solid black;
			padding: 9px;
		}

		body {
			height: 100%;
			width: 100%;
		}

		div.static {
			position: relative;
			left: 30px;
			border: 1px solid none;
			width: 400px;
			height: 200px;
		}

		div.relative {
			position: relative;
			left: 600px;
			border: 1px solid none;
			width: 400px;
			height: 200px;
		}

		a,
		a:hover,
		a:visited,
		a:active {
			color: inherit;
			text-decoration: none;
		}
		.cc:link, .cc:visited {
  background-color: #00FFFF;
  color: black;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

.cc:hover, .cc:active {
  background-color: #7FFFD4;
}
		
	</style>
</head>

<body>


	<?php if (!empty($user)) : ?>

		<p style=" text-align: center;">Welcome <?= $user['name']; ?> You are successfully logged in!</p>
		<br>
		<br>
		
		<div class="static">
			<table>
				<tr>
					<td> nom </td>
					<td> <?= $user['name']; ?> </td>
				</tr>
				<tr>
					<td> Fonction </td>
					<td> <?= $user['Fonction']; ?> </td>
				</tr>
				<tr>
					<td> CIN </td>
					<td> <?= $user['CIN']; ?> </td>
				</tr>
				<tr>
					<td> CNSS </td>
					<td> <?= $user['CNSS']; ?> </td>
				</tr>
				<tr>
					<td> date de naissance </td>
					<td> <?= $user['datenaissance']; ?> </td>
				</tr>
				<tr>
					<td> lieu de naissance </td>
					<td> <?= $user['lieunaissance']; ?> </td>
				</tr>
				<tr>
					<td> adresse </td>
					<td> <?= $user['adresse']; ?> </td>
				</tr>
				<tr>
					<td> N°telephone </td>
					<td> <?= $user['Ntelephone']; ?> </td>
				</tr>
				<tr>
					<td> date d'embouche</td>
					<td> <?= $user['embouche']; ?> </td>
				</tr>
				<tr>
					<td> situation familial</td>
					<td> <?= $user['situationfamilial']; ?> </td>
				</tr>
				<tr>
					<td> date de paie </td>
					<td> <?= $user['paie']; ?> </td>
				</tr>
				<tr>
					<td> salaire brute </td>
					<td> <?= $user['salaire']; ?> </td>
				</tr>
				<tr>
					<td> le nombre d'heures sup </td>
					<td> <?= $user['Nheuresup']; ?> </td>
				</tr>
				<tr>
					<td> rémunération pour une heure supplumentaire </td>
					<td> <?= $user['prixheuresup']; ?> </td>
				</tr>
				<tr>
					<td> Nenfant</td>
					<td> <?= $user['Nenfant']; ?> </td>
				</tr>


			</table>
		</div>

		<div class="relative">
			<a class="cc" href='fichedepaie.php' class="a">fiche de paie</a>
			<br>
			<br>
			<br>
			<a class="cc" href="logout.php" >Logout?</a>
		</div>
		

	<?php else : ?>



		<div class="container-fluid ">


			<div class="container col-md-4">
				<div class="center">
					<div>
						<button type="button" class="btn btn-info shadow-lg   ">
							<a href="login.php">
								<h4> Loging</h4>
							</a>
						</button>
					</div>
					<div>
						<button type="button" class="btn btn-outline-info shadow-lg  ">
							<a href="register.php">
								<h4> Register</h4>
							</a>
						</button>
					</div>
				</div>

			</div>
		</div>

	<?php endif; ?>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>