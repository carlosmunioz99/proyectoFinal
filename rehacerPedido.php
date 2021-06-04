<?php

//$url=$_SERVER['REFERER'];
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/
session_start();
include('conexion/conexion.php');
$conexion = conectar();
$selectPedido = "SELECT * FROM pedido WHERE id_pedido = ".$_POST['idPedido'];

$resultado = $conexion -> query($selectPedido);

$pedido = $resultado -> fetch_assoc();

$cadenaInsertPedido = "INSERT INTO pedido(fechaRecogida, hora, id_cliente, recogida) VALUES ('".$pedido['fechaRecogida']."', '".$pedido['hora']."', '".$pedido['id_cliente']."', '".$pedido['recogida']."')";

if($conexion -> query($cadenaInsertPedido))
{
    $ultimoIdPedido = "SELECT MAX(id_pedido) AS id FROM pedido";
    $resultado = $conexion -> query($ultimoIdPedido); 
    $ultimoIdPedidoInsert = $resultado->fetch_assoc();
    //echo $ultimoIdPedidoInsert['id'];
    $selectPedidoPlato = "SELECT * FROM pedido_plato WHERE id_pedido = ".$_POST['idPedido'];

    $resultado = $conexion -> query($selectPedidoPlato);
    if($resultado->field_count > 0)
    {
        while($pedido_plato = $resultado->fetch_assoc())
        {
            
        }
    }
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
    }*/
}
else
{
    echo "Algo no ha ido como debia";
}

//echo $selectPedido;


?>