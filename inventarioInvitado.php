<?php
session_start();
$inventario = $_SESSION['inventario'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inventario</title>
	<link rel="stylesheet" href="./css/style.css">
</head>

<body>
	<header id="navbar">
		<a href="/dwes/trabajoBloque1/index.php" id="logo">
			<img src="/dwes/trabajoBloque1/imagen/logo.png" alt="Logo">
		</a>
		<div id="navbar-right">
			<a href="/dwes/trabajoBloque1/index.php">Inicio</a>
			<a class="active" href="#">Inventario</a>
		</div>
	</header>
	<main class="inventario">
		<h1 class="titulo">Inventario</h1>
		<form action="#" method="post">
			<label for="orden">Orden</label>
			<select name="orden" id="orden">
				<option value="asc">Ascendente</option>
				<option value="desc">Descendente</option>
			</select>
			<label for="filtrar">Filtrar por</label>
			<select name="filtrarCampo" id="filtrarCampo">
				<option value="Nombre">Nombre</option>
				<option value="Precio">Precio</option>
				<option value="Pesog">Peso</option>
				<option value="Descripcion">Descripcion</option>
				<option value="Cantidad">Cantidad</option>
				<option value="Tipo">Tipo</option>
			</select>
			<input type="text" name="valorFiltrar" id="valorFiltrar">
			<input type="submit" value="Filtrar" name="filtrar" class="filtrar">
		</form>
		<?php
		if (!isset($_REQUEST['filtrar'])) {
			if (count($inventario) > 0) {
				echo "<table id='tablaInventario'>";
				echo "<tr>";
				echo "<th>Imagen</th>";
				echo "<th>Nombre</th>";
				echo "<th>Precio</th>";
				echo "<th>Peso</th>";
				echo "<th>Descripcion</th>";
				echo "<th>Cantidad</th>";
				echo "</tr>";
				foreach ($inventario as $articulo) {
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
					echo "</tr>";
				}
				echo "</table>";
			} else {
				echo "<h2 class='titulo'>Inventario vacio</h2>";
			}
		} else {
			$orden = $_REQUEST['orden'];
			$filtrarCampo = $_REQUEST['filtrarCampo'];
			$valorFiltrar = strtolower($_REQUEST['valorFiltrar']);
			$valores = array();
			foreach ($inventario as $articulo) {
				if (stristr($articulo[$filtrarCampo], $valorFiltrar)) {
					$valores[] = $articulo;
				}
			}
			if (count($valores) > 0) {
				$ordenColumna  = array_column($valores, $filtrarCampo);
				array_multisort($ordenColumna, $orden == "asc" ? SORT_ASC : SORT_DESC, SORT_NATURAL, $valores);
				echo "<table id='tablaInventario'>";
				echo "<tr>";
				echo "<th>Imagen</th>";
				echo "<th>Nombre</th>";
				echo "<th>Precio</th>";
				echo "<th>Peso</th>";
				echo "<th>Descripcion</th>";
				echo "<th>Cantidad</th>";
				echo "</tr>";
				foreach ($valores as $articulo) {
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
					echo "</tr>";
				}
				echo "</table>";
			} else {
				echo "<h2 class='titulo'>No existen datos</h2>";
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