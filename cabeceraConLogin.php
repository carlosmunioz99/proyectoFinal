<nav class="navbar navbar-dark navbar-expand bg-dark rounded-top" style="margin-top: 0.5%">
  <div class="container-fluid" style="font-family: 'FuentePrincipal'">
    <a class="navbar-brand" style="font-size: 32pt" href="index.php">
      <img src="./imagenes/take-away2.svg" alt="" width="100px" height="100px" class="d-inline-block" />
      CMTakeAway</a>
  </div>
  <li class="nav-item dropdown">
    <p class="text-white bg-dark" style="text-align: center; font-size: 15pt;">Usuario:</p>
    <a id="listaNav2" style="font-size: 15pt; text-align:center" class="nav-link link-light dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <?php echo $_SESSION['usuario']; ?>
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
      <li><a class="dropdown-item" href="perfilUsuario.php">Ver perfil</a></li>
      <li><a class="dropdown-item" href="#">Ver pedidos</a></li>
      <li><a type="button"id="cerrarSesion" name="cerrarSesion" class="dropdown-item" >Cerrar sesión</a></li>
    </ul>
  </li>
</nav>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #db4d4d">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav justify-content-center" id="navbarTogglerDemo03">
          <ul class="nav justify-content-center" style="font-size: 14pt">
            <li class="nav-item">
              <a id="listaNav" class="nav-link link-light" aria-current="page" href="index.php">Inicio</a>
            </li>
            <li class="nav-item dropdown">
              <a id="listaNav" class="nav-link link-light dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Categorías
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                  <a class="dropdown-item" href="#">Something else here</a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a id="listaNav" class="nav-link link-light" href="paginaPlatos.php">Platos</a>
            </li>
            <li class="nav-item">
              <a id="listaNav" class="nav-link link-light" href="paginaMenus.php" tabindex="-1" aria-disabled="true">Menús</a>
            </li>
            <li class="nav-item">
              <a id="listaNav" class="nav-link link-light" href="solicitudDePlaza.php" tabindex="-1" aria-disabled="true">Solicitud de plaza</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>