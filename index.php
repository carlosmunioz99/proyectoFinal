<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <?php
  require('conexion/conexion.php');

    $conexion = conectar();
    mysqli_query($conexion, "utf8");
  ?>

  <title>Document</title>
</head>

<body>
  <div class="container-fluid">

  <?php
    session_start();
    if(!isset($_SESSION['usuario']))
    {

      require 'cabeceraSinLogin.php';

    }
    else
    {
      
      $cadenaSql = "SELECT tipo from cliente where id_cliente ='".$_SESSION['usuario']."'";
      $resultado = mysqli_query($conexion, $cadenaSql);
      $tipoDeCliente = mysqli_fetch_assoc($resultado);
      if($tipoDeCliente['tipo'] != 'Administrador')
      {
          require 'cabeceraConLogin.php';
      }
      else
      {
          require 'cabeceraAdministrador.php';
      }
      
    }


  ?>

    <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
      <div class="carousel-inner">
        <div class="carousel-item active" style="width: 100%" data-bs-interval="1000">
          <img src="imagenes/Menu1.jpg" class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item" data-bs-interval="2000">
          <img src="imagenes/Menu2.jpg" class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="imagenes/Menu3.jpg" class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="imagenes/Plato1.jpg" class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="imagenes/Plato2.jpg" class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="imagenes/Plato3.jpg" class="d-block w-100" alt="..." />
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #db4d4d;">
      <div class="container-fluid">
        <a style="font-family: 'FuentePrincipal'; font-size:20pt; color:white" class="navbar-brand" href="#">Algunos de nuestros productos</a>
      </div>
    </nav>
    <div class="row row-cols-xl-4 row-cols-lg-2 row-cols-md-2 row-cols-md-1" style="margin-left:2%">

      <?php

      $cadenaSql = "SELECT * FROM plato WHERE categoria = 'Entrantes'";
      $imagen = array();
      $resultado = $conexion->query($cadenaSql);
      $listadoComidas = array();
      while ($comidas = $resultado->fetch_assoc()) {
        $listadoComidas[] = $comidas;
      }
      for ($i = 0; $i < count($listadoComidas); $i++) {
        $imagen[] = $listadoComidas[$i]['imagen'];
      ?>
      <div class="col">
        <div class="card text-center" style="width: 18rem; border:none">
          <?php
          echo "<img class='card-img-top' style='width:350px; display:block; margin:auto; border-radius:5px' src= 'data:image/png; base64," . base64_encode($imagen[$i]) . "'> ";
          ?>
          <div class="card-body">
            <h5 class="card-title"><?php echo $listadoComidas[$i]['nombre'] ?></h5>
            <p class="card-text"><?php echo $listadoComidas[$i]['precio'] ?>€</p>
            <a href="detallesPlato.php?idPlato=<?php echo $listadoComidas[$i]['id_plato'] ?>" class="btn btn-dark" style="width: 50%;">Detalles</a>
          </div>
        </div>
      </div>

      <?php
      }
      /*echo "<pre>";
        print_r($listadoComidas);
        echo "</pre>";*/
      ?>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #db4d4d;">
      <div class="container-fluid">
        <a style="font-family: 'FuentePrincipal'; font-size:20pt; color:white" class="navbar-brand" href="#">¿Dónde estamos?</a>
      </div>
    </nav>
    <div>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3172.111234587751!2d-5.936467484694839!3d37.33987517984099!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd126f833d887a1f%3A0xb668585f519b4756!2zQ2h1cnJlcsOtYSBQb2xsZXLDrWEgIkNhbGVudGl0b3MiIEx1eiBNYXLDrWE!5e0!3m2!1ses!2ses!4v1619982307920!5m2!1ses!2ses" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    
    <div style="bottom: 0px;" class="container-fuid bg-dark text-center p-3">
      <img src="imagenes/instagram.png" style="filter:invert(100%);">
      <img src="imagenes/twitter.png" style="filter:invert(100%);">
      <img src="imagenes/facebook.png" style="filter:invert(100%);">
      <p style="color: white;"><img src="imagenes/gmail.png" style="filter:invert(100%);"> cmtakeaway@contacto.es</p>
    </div>
  


  </div>

  <script src="js/bootstrap.bundle.js"></script>
  <script src="js/codigoIndex.js"></script>
  <script src="js/jquery-3.5.1.min.js"></script>
  <script>
  var myCarousel = document.querySelector('#carouselExampleControlsNoTouching')
var carousel = new bootstrap.Carousel(myCarousel, {
  interval: 3000,
  wrap: false
})

  </script>

</body>

</html>