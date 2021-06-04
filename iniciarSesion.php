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
<?php

?>

<body>
  <div class="container-fluid">
    <?php
    require('cabeceraSinLogin.php');
    ?>
    <div class="container-fluid bg-dark" style="min-height:80vh;">
      <div class="row">
        <div class="col-6">
          <div class="row col-12">
            <div class="row col-3"></div>
            <div class="row col-9" style="margin-top: 5%;">
              <h1 style="font-family: FuentePrincipal; color: white;">Iniciar sesión</h1>
            </div>
          </div>
          <div class="row col-12">
            <div class="row col-3"></div>
            <form name="frmInicioSesion" id="frmInicioSesion" method="GET" class="col-8">
              <div class="row col-12" style="margin-top: 4%;">
                <label for="exampleInputEmail1" class="form-label" style="color: white;">Usuario</label>
                <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" aria-describedby="emailHelp">
                <small class="form-text text-danger"></small>
              </div>
              <div class=" row col-12" style="margin-top: 5%;">
                <label for="exampleInputPassword1" class="form-label" style="color: white;">Contraseña</label>
                <input type="password" class="form-control" id="contraseña" name="contraseña">
                <small class="form-text text-danger"></small>
              </div>
              <div style="margin-top: 2%;">
                <button type="button" name="iniciarSesionEnviar" id="iniciarSesionEnviar" class="btn btn-danger" style="background-color: #db4d4d;">Iniciar Sesión</button>
              </div>
              <small id="mensajeErrorInicioSesion" name="mensajeErrorInicioSesion" class="form-text text-danger"></small>
            </form>
          </div>
        </div>
      </div>

      <div class="row col-6">
      </div>
    </div>
  </div>

  <script src="js/bootstrap.bundle.js"></script>
  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/codigoUsuarios.js"></script>


</body>

</html>