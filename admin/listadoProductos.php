<?php
include('../conexion/conexion.php');

$conexion = conectar();

extract($_GET);
 

$cadenaSqlMenusSemanales = "SELECT pedido.id_pedido, cliente.id_cliente , menu.nombre , menu.descripcion, pedido.fecha 
FROM menu
INNER JOIN pedido_menu ON menu.id_menu = pedido_menu.id_menu
INNER JOIN pedido ON pedido_menu.id_pedido = pedido.id_pedido
INNER JOIN cliente on pedido.id_cliente = cliente.id_cliente
WHERE pedido.fecha = '".$fechaListado."'";

$resultado = $conexion->query($cadenaSqlMenusSemanales);
$listadoMenuDiario = array();
if($resultado->field_count > 0)
{
    while($menus = $resultado->fetch_assoc())
    {
        $listadoMenuDiario[] = $menus;
    }
    $respuesta['listadoMenuDiario'] = $listadoMenuDiario;
}

$cadenaSqlPlatos = "SELECT pedido.id_pedido, cliente.id_cliente , plato.nombre , plato.descripcion, pedido.fecha 
FROM plato
INNER JOIN pedido_plato ON plato.id_plato = pedido_plato.id_plato
INNER JOIN pedido ON pedido.id_pedido =  pedido_plato.id_pedido
INNER JOIN cliente on pedido.id_cliente = cliente.id_cliente
WHERE pedido.fecha = '".$fechaListado."'";

$resultado = $conexion->query($cadenaSqlPlatos);
$listadoPlatos = array();
if($resultado->field_count > 0)
{
    while($platos = $resultado ->fetch_assoc())
    {
        $listadoPlatos[] = $platos;
    }
    $respuesta['listadoPlatos'] = $listadoPlatos;
}




/*$cadenaSqlMenusSemanales = "SELECT cliente.id_cliente , menu.nombre , menu.descripcion, pedido.fecha 
FROM menu
INNER JOIN pedido_menu ON menu.id_menu = pedido_menu.id_menu
INNER JOIN pedido ON pedido_menu.id_pedido = pedido.id_pedido
INNER JOIN cliente on pedido.id_cliente = cliente.id_cliente
WHERE pedido.fecha = '".$fechaListado."'";

/*echo "<pre>";
print_r($listadoMenuDiario);
echo "</pre>";*/

echo json_encode($respuesta);
?>