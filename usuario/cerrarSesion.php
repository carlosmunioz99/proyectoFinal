<?php
session_start();
session_unset();
$respuesta['error'] = 0;

echo json_encode($respuesta);

?>