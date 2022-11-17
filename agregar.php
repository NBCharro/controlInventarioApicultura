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
	<title>Agregar</title>
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
			<a class="active" href="#">Agregar</a>
			<a href="./eliminar.php">Eliminar</a>
			<a href="./modificar.php">Modificar</a>
			<form action="./comprobarLogin.php" method="post">
				<input type="submit" value="Log out" name="logOut">
			</form>
		</div>
	</header>
	<main class="agregar">
		<h1 class="titulo">Agregar</h1>
		<form action="#" method="post" enctype="multipart/form-data">
			<table>
				<tr>
					<td>
						<label for="nombre">Nombre: </label>
					</td>
					<td>
						<input type="text" name="nombre" id="nombre" placeholder="Nombre del articulo" required>
					</td>
				</tr>
				<tr>
					<td>
						<label for="cantidad">Cantidad: </label>
					</td>
					<td>
						<input type="number" name="cantidad" id="cantidad" min="0">
					</td>
				</tr>
				<tr>
					<td>
						<label for="precio">Precio: </label>
					</td>
					<td>
						<input type="number" name="precio" id="precio" step="0.01" min="0">
					</td>
				</tr>
				<tr>
					<td>
						<label for="peso">Peso: </label>
					</td>
					<td>
						<input type="number" name="peso" id="peso" step="0.001" min="0">
					</td>
				</tr>
				<tr>
					<td>
						<label for="descripcion">Descripcion: </label>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea name="descripcion" id="descripion" cols="10" rows="10" maxlength="200"></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<label for="tipo">Tipo</label>
					</td>
					<td>
						<select name="tipo" id="tipo">
							<option value="" selected disabled hidden></option>
							<option value="miel">Miel</option>
							<option value="jalea real">Jalea Real</option>
							<option value="propoleo">Propoleo</option>
							<option value="polen">Polen</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label for="imagen">Imagen</label>
					</td>
					<td>
						<input type="file" name="imagen" id="imagen">
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" value="Agregar" name="agregar" class="boton">
					</td>
					<td></td>
				</tr>
		</form>
		</table>
		<?php
		if (isset($_REQUEST['agregar'])) {
			$nombre = $_REQUEST['nombre'];
			$nombreImagen = $_FILES['imagen']['name'];
			$tipoImagen = $_FILES['imagen']['type'];
			$pathImagen = $_FILES['imagen']['tmp_name'];
			$tipo = isset($_REQUEST["tipo"]) ? $_REQUEST["tipo"] : "";
			$cantidad = intval($_REQUEST['cantidad']);
			$precio = floatval($_REQUEST['precio']);
			$peso = floatval($_REQUEST['peso']);
			$descripcion = $_REQUEST['descripcion'];
			require_once("./formulas.php");
			$agregado = agregarArticulo(
				$nombre,
				$precio,
				$peso,
				$descripcion,
				$cantidad,
				$tipo,
				$nombreImagen,
				$tipoImagen,
				$pathImagen
			);
			if ($agregado) {
				echo "<h2 class='titulo'>Se ha agregado el articulo.</h2>";
			} else {
				echo "<h2 class='titulo'>No se ha podido agregar el articulo.</h2>";
			}
		}
		?>
	</main>
	<?php
	include("./footer.html");
	?>
</body>

</html>