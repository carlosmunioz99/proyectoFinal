<?php
require('../conexion/conexion.php');

$conexion = conectar();
extract($_GET);
mysqli_query($conexion, 'utf8');

$cadenaSql ="SELECT COUNT(*) as contador FROM cliente WHERE id_cliente = '".$nombreUsuario."' AND contraseña = '".$contraseña."'";

$resultado = mysqli_query($conexion,$cadenaSql);

$numeroUsuarios = mysqli_fetch_assoc($resultado);

if($numeroUsuarios['contador'] > 0){
    $respuesta['error'] = 0;
}
else{
    $respuesta['error'] = 1;
}

echo json_encode($respuesta);
?>