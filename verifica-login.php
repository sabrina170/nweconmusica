<?php
require_once('controlador/conexion.php');
$usuario = $_POST['user'];
$contrasena = $_POST['password'];

$login = $cn->query("SELECT * FROM adminuser WHERE usuario='$usuario'")->fetch_assoc();
if ($usuario == $login['usuario']) {
	if ($contrasena == $login['clave']) {
		if ($login['estado'] == 1) {
			session_start();
			$_SESSION['user_id'] = $login['id'];
			$_SESSION['user_name'] = utf8_encode($login['nombres'] . " " . $login['apellidos']);
			$_SESSION['user_tipo'] = $login['tipo'];
			$_SESSION['usuario'] = $login['usuario'];
			$_SESSION['contraseña'] = $login['clave'];
			$_SESSION['user_foto'] = $login['foto'];
			$_SESSION['user_espe'] = $login['especialidad'];
			$_SESSION['user_dni'] = $login['dni'];

			if ($login['tipo'] == 1) {
				header("location:admin.php?nt=0");
			} else if ($login['tipo'] == "3") {
				header("location:profesores.php?nt=0");
			} else {
				header("location:mis-cursos.php");
			}
			die();
		} else {
			header("location:index.php?nt=11");
			die();
		}
	} else {
		header("location:index.php?nt=12");
		die();
	}
} else {
	header("location:index.php?nt=13");
	die();
}
