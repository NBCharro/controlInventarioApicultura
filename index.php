<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bienvenido</title>
	<link rel="stylesheet" href="./css/style.css">
</head>

<body>
	<header id="navbar">
		<a href="#" id="logo">
			<img src="./imagen/logo.png	" alt="Logo">
		</a>
	</header>
	<main class="index">
		<div class="login">
			<h1>Bienvenido</h1>
			<form action="./comprobarLogin.php" method="post">
				<input type="text" name="usuario" id="usuario" placeholder="Usuario">
				<input type="password" name="password" id="password" placeholder="Contraseña">
				<input type="submit" value="Login" name="login" class="btn btn-block btn-large btn-primary">
				<input type="submit" value="Entrar como invitado" name="invitado" class="btn btn-block btn-large btn-secondary">
			</form>
		</div>
	</main>
	<?php
	include("./footer.html");
	?>
</body>

</html>