<?php


session_start();
require("conexion/conexion.php");
$conexion = conectar();

extract($_POST);

$cadenaInsertPedido = "INSERT INTO pedido(fechaRecogida, hora, id_cliente, recogida) VALUES ('".$fechaPedido."', '".$horaPedido."', '".$_SESSION['usuario']."', '".$tipoDeEntrega."')";



if($conexion -> query($cadenaInsertPedido))
{
    $ultimoIdPedido = "SELECT MAX(id_pedido) AS id FROM pedido";
    $resultado = $conexion -> query($ultimoIdPedido); 
    $ultimoIdPedidoInsert = $resultado->fetch_assoc();
    //echo $ultimoIdPedidoInsert['id'];
    if(isset($idPlato))
    {
        foreach($idPlato as $clave => $valor)
        {
            $cadenaInsertPlatoPedido = "INSERT INTO pedido_plato (id_plato, id_pedido) VALUES ('".$valor."', ".$ultimoIdPedidoInsert['id'].")";
            $conexion -> query($cadenaInsertPlatoPedido);
        }
    }
    if(isset($idMenu))
    {
        foreach($idMenu as $clave => $valor)
        {
            $cadenaInsertMenuPedido = "INSERT INTO pedido_menu (id_pedido,id_menu) VALUES (".$ultimoIdPedidoInsert['id'].", ".$valor.")";
            $conexion -> query($cadenaInsertMenuPedido);
        }
    }
}
else
{
    echo "Algo no ha ido como debia";
}
//echo $cadenaInsertPedido;

