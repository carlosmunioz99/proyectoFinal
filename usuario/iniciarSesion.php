<?php
require("../conexion/conexion.php");

extract($_GET);

$conexion = conectar();

session_start();
$_SESSION["usuario"] = $nombreUsuario;
$_SESSION['carritoPlatos'] = array();
$_SESSION['carritoMenus'] = array();
$respuesta["error"] = 0;

echo json_encode($respuesta);

?>