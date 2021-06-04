<?php
session_start();
extract($_POST);

array_push($_SESSION['carritoPlatos'],$idPlato);

$respuesta['error'] = 0;

echo json_encode($respuesta);
/*echo "<pre>";
print_r($_SESSION);
echo "</pre>";*/


?>
