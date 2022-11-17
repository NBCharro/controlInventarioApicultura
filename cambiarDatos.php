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
	<title>Modificar</title>
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
			<a href="./eliminar.php">Eliminar</a>
			<a class="active" href="#">Modificar</a>
			<form action="./comprobarLogin.php" method="post">
				<input type="submit" value="Log out" name="logOut">
			</form>
		</div>
	</header>
	<main class="cambiarDatos">
		<h1 class="titulo">Modificar</h1>
		<?php
		if (!isset($_REQUEST['modificarValores'])) {
			if (!$_REQUEST['articuloModificar']) {
				header("Location: ./modificar.php");
			}
			require_once("./formulas.php");
			$articulo = articuloParaModificar($_REQUEST['articuloModificar']);
		?>
			<form action="#" method="post" enctype="multipart/form-data">
				<table id='tablaInventario'>
					<tr>
						<th>Imagen</th>
						<th>Nombre</th>
						<th>Precio</th>
						<th>Peso</th>
						<th>Descripcion</th>
						<th>Cantidad</th>
						<th><label for="tipoNuevo">Tipo</label></th>
					</tr>
					<input type="hidden" name="">
					<tr>
						<?php
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
						echo "<td>" . $articulo['Tipo'] . "</td>";
						echo "</tr>";
						?>
					</tr>
					<tr>
						<td><input type="file" name="imagenNueva" id="imagenNueva"></td>
						<td><input type="text" name="nombreNuevo" id="nombreNuevo"></td>
						<td><input type="number" name="precioNuevo" id="precioNuevo" step="0.01" min="0"></td>
						<td><input type="number" name="pesoNuevo" id="pesoNuevo" min="0"></td>
						<td><input type="text" name="descripcionNueva" id="descripcionNueva"></td>
						<td><input type="number" name="cantidadNueva" id="pesoNuevo" min="0"></td>
						<td><select name="tipoNuevo" id="tipoNuevo">
								<option value="" selected disabled hidden></option>
								<option value="miel">Miel</option>
								<option value="jalea real">Jalea Real</option>
								<option value="propoleo">Propoleo</option>
								<option value="polen">Polen</option>
							</select>
						</td>
					</tr>
				</table>
				<input type="hidden" name="articuloModificar" value="<?php echo $articulo['id_articulo'] ?>">
				<input type="submit" value="Modificar" name="modificarValores">
			</form>
		<?php
		} else {
			$nombreNuevo = $_REQUEST["nombreNuevo"];
			$precioNuevo = floatval($_REQUEST["precioNuevo"]);
			$pesoNuevo = floatval($_REQUEST["pesoNuevo"]);
			$descripcionNueva = $_REQUEST["descripcionNueva"];
			$cantidadNueva = intval($_REQUEST["cantidadNueva"]);
			$tipoNuevo = isset($_REQUEST["tipoNuevo"]) ? $_REQUEST["tipoNuevo"] : "";
			$articuloModificar = intval($_REQUEST["articuloModificar"]);
			$nombreImagen = $_FILES['imagenNueva']['name'];
			$tipoImagen = $_FILES['imagenNueva']['type'];
			$pathImagen = $_FILES['imagenNueva']['tmp_name'];
			require_once("./formulas.php");
			$modificado = modificarArticulo(
				$nombreNuevo,
				$precioNuevo,
				$pesoNuevo,
				$descripcionNueva,
				$cantidadNueva,
				$tipoNuevo,
				$articuloModificar,
				$nombreImagen,
				$tipoImagen,
				$pathImagen
			);
			if ($modificado) {
				echo "<h2 class='titulo'>Se ha modificado el articulo.</h2>";
			} else {
				echo "<h2 class='titulo'>No se ha podido modificar el articulo.</h2>";
			}
		}
		echo "<button class='volver'><a href=''>Volver</a></button>";
		?>
	</main>
	<?php
	include("./footer.html");
	?>
</body>

</html>