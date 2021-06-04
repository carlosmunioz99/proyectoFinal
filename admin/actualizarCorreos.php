<?php
include("../conexion/conexion.php");
$conexion = conectar();
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/
extract($_POST);

$cadenaUpdate = "UPDATE cuentascorreo SET correoGmail = '".$correoCalendario."', correoSolicitudes = '".$correoSolicitudes."'";

//echo $cadenaUpdate;
$resultado = $conexion ->query($cadenaUpdate);

if($resultado)
{
    $respuesta["error"] = 0;
    $respuesta["mensaje"] = "Correos actualizados";
}
else
{
    $respuesta["error"] = 1;
    $respuesta["mensaje"] = "No se han podido actualizar los correos, intentelo de nuevo más tarde.";
}

echo json_encode($respuesta);

?>