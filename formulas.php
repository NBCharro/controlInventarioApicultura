<?php
define("HOST", "localhost");
define("USER", "admin");
define("PASSWORD", "admin");
define("BD", "abejas");

function obtenerTabla()
{
	$articulos = false;
	try {
		$usuario = $_SESSION['usuario'];
		$password = $_SESSION['password'];
		$conection = new mysqli(HOST, $usuario, $password, BD);
		$ConsultaInventario = "SELECT * FROM apicultura";
		$inventarioSQL = mysqli_query($conection, $ConsultaInventario);
		mysqli_close($conection);
		if (mysqli_num_rows($inventarioSQL) > 0) {
			$articulos = array();
			while ($articulo = mysqli_fetch_assoc($inventarioSQL)) {
				$articulos[] = $articulo;
			}
		}
	} catch (mysqli_sql_exception $e) {
		header("Location: ./errorLogin.php");
	}
	return $articulos;
}

function obtenerTablaInvitado($usuario, $password)
{
	$articulos = false;
	try {
		$conection = new mysqli(HOST, $usuario, $password, BD);
		$ConsultaInventario = "SELECT Nombre,Cantidad,Precio,Pesog,Descripcion,Tipo,Imagen FROM apicultura";
		$datosBD = mysqli_query($conection, $ConsultaInventario);
		mysqli_close($conection);
		$articulos = array();
		while ($articulo = mysqli_fetch_assoc($datosBD)) {
			$articulos[] = $articulo;
		}
	} catch (mysqli_sql_exception $e) {
	}
	return $articulos;
}

function borrarArticulos($borrar)
{
	$borrado = false;
	try {
		$usuario = $_SESSION['usuario'];
		$password = $_SESSION['password'];
		$conection = new mysqli(HOST, $usuario, $password, BD);
		foreach ($borrar as $value) {
			$ConsultaEliminar = "DELETE FROM apicultura WHERE id_articulo = {intval($value)}";
			if ($conection->query($ConsultaEliminar) !== TRUE) {
				echo "Error: " . $ConsultaEliminar . "<br>" . $conection->error;
			}
		}
		mysqli_close($conection);
		$borrado = true;
	} catch (mysqli_sql_exception $e) {
	}
	return $borrado;
}

function borrarImagenes($borrar)
{
	try {
		$usuario = $_SESSION['usuario'];
		$password = $_SESSION['password'];
		$conection = new mysqli(HOST, $usuario, $password, BD);
		$ConsultaSQL = "SELECT id_articulo, Imagen FROM apicultura";
		$datosBD = mysqli_query($conection, $ConsultaSQL);
		mysqli_close($conection);
		while ($articulo = mysqli_fetch_assoc($datosBD)) {
			if (is_array($borrar) && in_array($articulo['id_articulo'], $borrar)) {
				unlink("./imagen/{$articulo['Imagen']}");
			}
			if (!is_array($borrar) && $articulo['id_articulo'] == $borrar) {
				unlink("./imagen/{$articulo['Imagen']}");
			}
		}
	} catch (mysqli_sql_exception $e) {
	}
}

function articuloParaModificar($articuloModificar)
{
	$articulo = false;
	try {
		$usuario = $_SESSION['usuario'];
		$password = $_SESSION['password'];
		$conection = new mysqli(HOST, $usuario, $password, BD);
		$ConsultaModificar = "SELECT * FROM apicultura WHERE id_articulo = {intval($articuloModificar)}";
		$articulos = mysqli_query($conection, $ConsultaModificar);
		$articulo = mysqli_fetch_assoc($articulos);
		mysqli_close($conection);
	} catch (mysqli_sql_exception $e) {
		// echo $e->getMessage();
	}
	return $articulo;
}

function modificarArticulo(
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
) {
	$modificado = false;
	try {
		$usuario = $_SESSION['usuario'];
		$password = $_SESSION['password'];
		$conection = new mysqli(HOST, $usuario, $password, BD);
		if ($nombreNuevo != "") {
			$consultaModificar = "UPDATE apicultura SET Nombre = '$nombreNuevo' WHERE id_articulo = $articuloModificar";
			$conection->query($consultaModificar);
		}
		if ($precioNuevo != 0) {
			$consultaModificar = "UPDATE apicultura SET Precio = $precioNuevo WHERE id_articulo = $articuloModificar";
			$conection->query($consultaModificar);
		}
		if ($pesoNuevo != 0) {
			$consultaModificar = "UPDATE apicultura SET Pesog = $pesoNuevo WHERE id_articulo = $articuloModificar";
			$conection->query($consultaModificar);
		}
		if ($descripcionNueva != "") {
			$consultaModificar = "UPDATE apicultura SET Descripcion = '$descripcionNueva' WHERE id_articulo = $articuloModificar";
			$conection->query($consultaModificar);
		}
		if ($cantidadNueva != 0) {
			$consultaModificar = "UPDATE apicultura SET Cantidad = $cantidadNueva WHERE id_articulo = $articuloModificar";
			$conection->query($consultaModificar);
		}
		if ($tipoNuevo != "") {
			$consultaModificar = "UPDATE apicultura SET Tipo = '$tipoNuevo' WHERE id_articulo = $articuloModificar";
			$conection->query($consultaModificar);
		}
		if ($nombreImagen != "") {
			$imagenSubida = subirImagen($nombreImagen, $tipoImagen, $pathImagen);
			borrarImagenes($articuloModificar);
			$consultaModificar = "UPDATE apicultura SET Imagen = '$nombreImagen' WHERE id_articulo = $articuloModificar";
			$conection->query($consultaModificar);
		}
		$modificado = true;
		mysqli_close($conection);
	} catch (mysqli_sql_exception $e) {
		echo $e->getMessage();
	}
	return $modificado;
}

function agregarArticulo(
	$nombreNuevo,
	$precioNuevo,
	$pesoNuevo,
	$descripcionNueva,
	$cantidadNueva,
	$tipoNuevo,
	$nombreImagen,
	$tipoImagen,
	$pathImagen
) {
	$agregado = false;
	try {
		$usuario = $_SESSION['usuario'];
		$password = $_SESSION['password'];
		$imagenSubida = subirImagen($nombreImagen, $tipoImagen, $pathImagen);
		$conection = new mysqli(HOST, $usuario, $password, BD);
		$ConsultaAgregar = "INSERT INTO `apicultura` (`Nombre`, `Cantidad`, `Precio`, `Pesog`, `Descripcion`, `Tipo`, `Imagen`) VALUES ('$nombreNuevo', $cantidadNueva, $precioNuevo, $pesoNuevo, '$descripcionNueva', '$tipoNuevo', '$nombreImagen');";
		if ($conection->query($ConsultaAgregar) !== TRUE) {
			echo "Error: " . $ConsultaAgregar . "<br>" . $conection->error;
		}
		$agregado = true;
		mysqli_close($conection);
	} catch (mysqli_sql_exception $e) {
	}
	return $agregado;
}

function subirImagen($nombreImagen, $tipoImagen, $pathImagen)
{
	$imagenSubida = false;
	if ($nombreImagen != "") {
		if (((strpos($tipoImagen, "jpeg") || strpos($tipoImagen, "jpg") || strpos($tipoImagen, "png")))) {
			if (move_uploaded_file($pathImagen, 'imagen/' . $nombreImagen)) {
				chmod('imagen/' . $nombreImagen, 0777);
				$imagenSubida = true;
			}
		}
	}
	return $imagenSubida;
}
