<?php session_start();
if (!isset($_SESSION['usuario'])) {
	header("Location: ./index.php");
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Error</title>
	<link rel="stylesheet" href="./css/style.css">
</head>

<body>
	<header id="navbar">
		<a href="./index.php" id="logo">
			<img src="./imagen/logo.png	" alt="Logo">
		</a>
	</header>
	<main class="error">
		<h2 class='titulo'>No existe el usuario.</h2>
		<button class='volver'><a href='./index.php'>Volver</a></button>
	</main>
	<?php
	include("./footer.html");
	?>
</body>

</html>