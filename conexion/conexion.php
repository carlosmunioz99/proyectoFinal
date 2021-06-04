<?php
    function conectar()
    {
        $servidor  = "localhost";
        $basedatos = "proyectofinal";
        $usuario   = "root";
        $password  = "";
    
        $conexion = mysqli_connect($servidor, $usuario, $password, $basedatos) or die(mysqli_error($conexion));
        return $conexion;
    }


?>