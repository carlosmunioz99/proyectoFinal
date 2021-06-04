<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Document</title>
</head>

<body>
  <div class="container-fluid">
    <?php
    session_start();
    require('cabeceraConLogin.php');
    /*echo "<pre>";
    print_r($_SESSION["carrito"]);
    echo "</pre>";*/
    ?>
    <div>
      <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
          <span class="navbar-brand mb-0 h1">Tu carrito</span>
        </div>
        <?php
        require("conexion/conexion.php");
        $conexion = conectar();
        mysqli_query($conexion, "utf8");
        $carritoPlatoActual = array();
        $carritoMenuActual = array();
        foreach ($_SESSION["carritoPlatos"] as $clave => $valor) {
          $cadenaSql = "SELECT id_plato, nombre, categoria, descripcion, precio FROM plato where id_plato = '" . $valor . "'";
          $resultado = mysqli_query($conexion, $cadenaSql);
          while ($plato = $resultado->fetch_assoc()) {
            $carritoPlatoActual[] = $plato;
          }
        }

        foreach ($_SESSION['carritoMenus'] as $clave => $valor) {
          $cadenaSql = "SELECT id_menu, nombre, descripcion, precio FROM menu where id_menu = $valor";
          //echo $cadenaSql;
          $resultado = mysqli_query($conexion, $cadenaSql);
          while ($menu = $resultado->fetch_assoc()) {
            $carritoMenuActual[] = $menu;
          }
        }
        /*echo "<pre>";
        print_r($carritoMenuActual);
        echo "</pre>";*/

        ?>
      </nav>
    </div>

    <table class="table table-striped">
      <tr>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th style="width: 10%;">Precio</th>
      </tr>
      <?php
      $total = 0;
      foreach ($carritoPlatoActual as $clave => $valor) {
        echo "<tr><td>" . $valor['nombre'] . "</td><td>" . $valor['descripcion'] . "</td><td>" . $valor['precio'] . "</td></tr>";
        $total += $valor['precio'];
      }

      foreach ($carritoMenuActual as $clave => $valor) {
        echo "<tr><td>" . $valor['nombre'] . "</td><td>" . $valor['descripcion'] . "</td><td>" . $valor['precio'] . "</td></tr>";
        $total += $valor['precio'];
      }
      echo "<tr><td></td><td></td><td>Total: " . $total . "€</td></tr>";
      ?>
    </table>

    <div>
      <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
          <span class="navbar-brand mb-0 h1">Seleccione una fecha, una hora y el tipo de entrega</span>
        </div>
      </nav>
    </div>
    <div>
      <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=2&amp;bgcolor=%23db4d4d&amp;ctz=Europe%2FMadrid&amp;src=Y183ZGhkdXBlMXA2a2xuNGttZGx2MWM4bTdxY0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&amp;color=%23AD1457&amp;mode=WEEK&amp;showTabs=0&amp;showPrint=0&amp;showNav=1&amp;showDate=1&amp;showCalendars=0&amp;showTz=1" style="border:solid 1px #777" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
    </div>

    <div>
    <?php $fecha = date("Y-m-d");?>
      <form method="POST" action="hacerPedido.php">
        <label for="fechaPedido"> Seleccione una fecha: </label>
        <input type="date" class="form-control" id="fechaPedido" name="fechaPedido" min="">
        <label for="horaPedido"> Seleccione una hora: </label>
        <select class="form-control" id="horaPedido" name="horaPedido">
          <option value="8:00">8:00</option>
          <option value="8:30">8:30</option>
          <option value="9:00">9:00</option>
          <option value="9:30">9:30</option>
          <option value="10:00">10:00</option>
          <option value="10:30">10:30</option>
          <option value="11:00">11:00</option>
          <option value="11:30">11:30</option>
          <option value="12:00">12:00</option>
          <option value="12:30">12:30</option>
          <option value="13:00">13:00</option>
          <option value="13:30">13:30</option>
          <option value="14:00">14:00</option>
          <option value="14:30">14:30</option>
          <option value="15:00">15:00</option>



          <div class="form-check">
            <input class="form-check-input" type="radio" name="tipoDeEntrega" id="tipoDeEntrega" value="A domicilio">
            <label class="form-check-label" for="tipoDeEntrega">
              A domicilio
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="tipoDeEntrega" id="tipoDeEntrega" value="En tienda">
            <label class="form-check-label" for="flexRadioDefault2">
              En tienda
            </label>
          </div>
          <?php

          foreach ($carritoPlatoActual as $clave => $valor) {
            echo "<input type='hidden' name='idPlato[]' value='" . $valor['id_plato'] . "'>";
          }

          foreach ($carritoMenuActual as $clave => $valor) {
            echo "<input type='hidden' name='idMenu[]' value='" . $valor['id_menu'] . "'>";
          }

          ?>
          <input type="submit" class="button" id="enviar" value="Hacer pedido">
      </form>
    </div>
  </div>



  <script src="js/bootstrap.bundle.js"></script>
  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/codigoIndex.js"></script>
</body>

</html>