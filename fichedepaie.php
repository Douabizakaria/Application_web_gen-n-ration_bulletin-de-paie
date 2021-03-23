<?php

session_start();

require 'database.php';

if (isset($_SESSION['user_id'])) {

	$records = $conn->prepare('SELECT id,name,Fonction, CIN, CNSS, datenaissance, lieunaissance, adresse, Ntelephone, embouche, situationfamilial, paie, salaire, Nenfant, Nheuresup, prixheuresup FROM users WHERE id = :id');
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
	<title>FICHE DE PAIE</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

	<style>
		table,
		th,
		td {
			border: 1px solid black;
			padding: 10px 40px 10px 40px;
			border-collapse: collapse;
			text-align: center;
		}

		.tdd {
			width: 60px;
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
	<p style="visibility:collapse;"><?= $date1 = $user['embouche'];
									$date2 = date("Y-m-d ");

									$diff = abs(strtotime($date2) - strtotime($date1));

									$years = floor($diff / (365 * 60 * 60 * 24));
									if ($years < 5) {
										$valancinete = $user['salaire'] * 5 / 100;
										echo $valancinete;
									}
									if (5 <= $years and $years < 12) {
										$valancinete = $user['salaire'] * 10 / 100;
										echo $valancinete;
									}
									if (12 <= $years and $years < 0) {
										$valancinete = $user['salaire'] * 15 / 100;
										echo $valancinete;
									}
									if (20 <= $years and $years < 25) {
										$valancinete = $user['salaire'] * 20 / 100;
										echo $valancinete;
									}
									if (25 <= $years) {
										$valancinete = $user['salaire'] * 25 / 100;
										echo $valancinete;
									}

									?></p>
	<table class="table">
		<tr>
			<th scope="row" colspan="6" style="background-color:grey;">BULLETIN DE PAIE</th>
		</tr>
		<tr style="background-color:#FFFAF0;">
			<td> nom et prénom</td>
			<td colspan="2"> Fonction</td>
		</tr>
		<tr>
			<td> <?= $user['name']; ?> </td>
			<td colspan="2"><?= $user['Fonction']; ?> </td>
		</tr>
		<tr style="background-color:#FFFAF0;">
			<td colspan="1" style="text-align:left;"> Adresse: </td>
			<td colspan="2"> <?= $user['adresse'] ?> </td>
		</tr>
		<tr style="background-color:#FFFAF0;">
			<td colspan="3"> Dates</td>
		</tr>
		<tr style="background-color:#FFFAF0;">
			<td> Naissance</td>
			<td> Embouche</td>
			<td> Paie</td>
			<td> Sit.familial</td>
			<td>N°C.I.N</td>
			<td>N°C.N.S.S</td>
		</tr>
		<tr>
			<td> <?= $user['datenaissance']; ?> </td>
			<td> <?= $user['embouche']; ?> </td>
			<td> <?= $user['paie']; ?> </td>
			<td> <?= $user['situationfamilial']; ?> </td>
			<td> <?= $user['CIN']; ?> </td>
			<td> <?= $user['CNSS']; ?> </td>
		</tr>
		<tr style="background-color:#FFFAF0;">
			<td> code </td>
			<td> libellé </td>
			<td> nbre ou base </td>
			<td>taux </td>
			<td> gains </td>
			<td> Retenus </td>
		</tr>
		<tr>
			<td> 1 </td>
			<td> APPOINTEMENTS </td>
			<td> </td>
			<td> </td>
			<td> <?= $user['salaire']; ?> </td>
			<td> </td>
		</tr>
		<tr>
			<td> 2 </td>
			<td> HEURES SUPPLEMENT AIRES A 100% </td>
			<td> <?= $user['Nheuresup']; ?> </td>
			<td> <?= $user['prixheuresup']; ?> </td>
			<td> <?= $valsup = ($user['Nheuresup'] * $user['prixheuresup']) ?> </td>
			<td> </td>
		</tr>
		<tr>
			<td> 3 </td>
			<td> ANCIENNETE </td>
			<td> <?= $user['salaire']; ?> </td>
			<td> </td>
			<td> <?= $valancinete ?>

			</td>
			<td> </td>
		</tr>
		<tr>
			<td> 4 </td>
			<td> C.I.M.R </td>
			<td> <?= $user['salaire']; ?> </td>
			<td> 2.000% </td>
			<td> </td>
			<td> <?= $cimr = ($user['salaire'] * 2 / 100); ?> </td>
		</tr>
		<tr>
			<td> 5 </td>
			<td> C.N.S.S </td>
			<td> </td>
			<td> 4.290% </td>
			<td> </td>
			<td> <?= $cimr = ($user['salaire'] * 4.290 / 100); ?> </td>
		</tr>
		<tr style="background-color:#FFFAF0;">
			<td colspan="3"> Mode de règlement </td>
			<td> total </td>
			<td> <?= $totalgain = ($user['salaire'] + $user['Nheuresup'] * $user['prixheuresup'] + $valancinete); ?> </td>
			<td> <?= $cimr = ($user['salaire'] * 4.290 / 100 + $user['salaire'] * 2 / 100); ?> </td>
		</tr>
		<tr style="background-color:#FFFAF0;">
			<td colspan="3"> </td>
			<td> Net a Payer </td>
			<td colspan="2"> <?= $totalgain = (($user['salaire'] + $user['Nheuresup'] * $user['prixheuresup'] + $valancinete) - ($user['salaire'] * 4.290 / 100 + $user['salaire'] * 2 / 100)); ?> </td>
		</tr>
	</table>
	<a class="cc" href="logout.php" >Logout?</a>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>