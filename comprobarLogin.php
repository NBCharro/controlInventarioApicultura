<?php
session_start();
include_once("./formulas.php");
if (isset($_SESSION['usuario'])) {
	header("Location: ./inventarioInvitado.php");
}
if (isset($_REQUEST['login'])) {
	$usuario = $_REQUEST['usuario'];
	$password = $_REQUEST['password'];
	$_SESSION['usuario'] = $usuario;
	$_SESSION['password'] = $password;
	header("Location: ./inventarioLogin.php");
} elseif (isset($_REQUEST['invitado'])) {
	try {
		$usuario = "invitado";
		$_SESSION['usuario'] = $usuario;
		$_SESSION['password'] = $usuario;
		$inventario = obtenerTabla($usuario, $usuario);
		$_SESSION['inventario'] = $inventario;
		header("Location: ./inventarioInvitado.php");
	} catch (mysqli_sql_exception $e) {
		echo "<p>No se puede realizar la operacion. Intentelo de nuevo mas tarde.</p>";
		// echo $e->getMessage();
	}
} elseif (isset($_REQUEST['logOut'])) {
	unset($_SESSION['usuario']);
	unset($_SESSION['password']);
	header("Location: ./index.php");
}
