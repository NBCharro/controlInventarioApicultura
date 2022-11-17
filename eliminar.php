<?php session_start();
if (!isset($_SESSION['usuario'])) {
	header("Location: ./index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Eliminar</title>
	<link rel="stylesheet" href="./css/style.css">
</head>

<body>
	<header id="navbar">
		<a href="./comprobarLogin.php" id="logo">
			<img src="/dwes/trabajoBloque1/imagen/logo.png" alt="Logo">
		</a>
		<div id="navbar-right">
			<a href="./comprobarLogin.php">Inicio</a>
			<a href="./inventarioLogin.php">Inventario</a>
			<a href="./agregar.php">Agregar</a>
			<a class="active" href="#">Eliminar</a>
			<a href="./modificar.php">Modificar</a>
			<form action="./comprobarLogin.php" method="post">
				<input type="submit" value="Log out" name="logOut">
			</form>
		</div>
	</header>
	<main class="eliminar">
		<h1 class="titulo">Eliminar</h1>
		<?php
		require_once("./formulas.php");
		$articulos = obtenerTabla();
		if (!isset($_REQUEST['eliminar'])) {
		?>
			<form action="#" method="post">
				<?php
				if (count($articulos) > 0) {
					echo "<table id='tablaInventario'>";
					echo "<tr>";
					echo "<th>Imagen</th>";
					echo "<th>Nombre</th>";
					echo "<th>Precio</th>";
					echo "<th>Peso</th>";
					echo "<th>Descripcion</th>";
					echo "<th>Cantidad</th>";
					echo "<th>Marcar</th>";
					echo "</tr>";
					foreach ($articulos as $articulo) {
						echo "<td><img src='./imagen/" . $articulo['Imagen'] . "' style='width: 75px;'></td>";
						echo "<td>" . $articulo['Nombre'] . "</td>";
						echo "<td>" . $articulo['Precio'] . " €</td>";
						if ($articulo['Pesog'] >= 1000) {
							$pesoArticulo = intval($articulo['Pesog'] / 1000);
							echo "<td>$pesoArticulo Kg</td>";
						} else {
							$pesoArticulo = intval($articulo['Pesog']);
							echo "<td>$pesoArticulo g</td>";
						}
						echo "<td>" . $articulo['Descripcion'] . "</td>";
						echo "<td>" . $articulo['Cantidad'] . "</td>";
						echo "<td align='center'><input type='checkbox' name='borrar[]' value=" . $articulo['id_articulo'] . "></td>";
						echo "</tr>";
					}
					echo "</table>";
				} else {
					echo "<h2 class='titulo'>Inventario vacio</h2>";
				}
				?>
				<input type="submit" value="Eliminar" name="eliminar">
			</form>
		<?php
		} else {
			if (!$_REQUEST['borrar']) {
				header("Location: ./eliminar.php");
			}
			$borrar = $_REQUEST['borrar'];
			$eliminados = borrarImagenes($borrar);
			$eliminados = borrarArticulos($borrar);
			if ($eliminados) {
				echo "<h2 class='titulo'>Se han eliminado los datos.</h2>";
			} else {
				echo "<h2 class='titulo'>No se han podido eliminar los datos.</h2>";
			}
			echo "<button class='volver'><a href=''>Volver</a></button>";
		}
		?>
	</main>
	<?php
	include("./footer.html");
	?>
</body>

</html>