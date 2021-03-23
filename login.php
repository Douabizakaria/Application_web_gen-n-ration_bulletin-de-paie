<?php

session_start();

if (isset($_SESSION['user_id'])) {
}

require 'database.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) :

	$records = $conn->prepare('SELECT id,email,password FROM users WHERE email = :email');
	$records->bindParam(':email', $_POST['email']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message = '';

	if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {

		$_SESSION['user_id'] = $results['id'];
		header("Location: http://localhost/login/index.php");
	} else {
		$message = 'Sorry, those credentials do not match';
	}

endif;

?>

<!DOCTYPE html>
<html>

<head>
	<title>Login Below</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-light  bg-white" id="home">
		<div class="container-fluid  ">
			<a class="text-dark navbar-brand" href="#">Login</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
					<a class="nav-link active text-black" aria-current="page" href="index.php">Home</a>
					<a class="nav-link text-black" href="register.php">Register here</a>

					<a class="nav-link text-black " href="logout.php">Logout</a>
				</div>
			</div>
		</div>
	</nav>


	<?php if (!empty($message)) : ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	<div class="container-fluid log" style="padding-left: 35%; padding-right:0% ">
		<div class="row vertical-center">
			<form class="col-md-6" action="login.php" method="POST">
				<h1 class="text-center text-info">Login</h1>
				<hr>
				<div class="control-group">
					<div class="form-group floating-label-form-group controls">
						<input class="form-control" type="text" placeholder="Enter your email" name="email">
					</div>
				</div>

				<div class="control-group">
					<div class="form-group floating-label-form-group controls">
						<input class="form-control" type="password" placeholder="and password" name="password">
					</div>
				</div>

				<button type="submit" class="btn btn-info btn-lg col-md-12">Submit</button>

			</form>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>