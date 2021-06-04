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
            include("cabeceraSinLogin.php")
        ?>
        <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3172.111234587751!2d-5.936467484694839!3d37.33987517984099!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd126f833d887a1f%3A0xb668585f519b4756!2zQ2h1cnJlcsOtYSBQb2xsZXLDrWEgIkNhbGVudGl0b3MiIEx1eiBNYXLDrWE!5e0!3m2!1ses!2ses!4v1619982307920!5m2!1ses!2ses" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="container-fluid bg-dark" style="min-height:80vh;">
            <div class="row">
                <div class="col-6">
                    <div class="row col-12">
                        <div class="row col-3"></div>
                        <div class="row col-9" style="margin-top: 5%;">
                            <h1 style="font-family: FuentePrincipal; color: white;">¿Dónde encontrarnos?</h1>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="row col-3"></div>
                        <div class="row col-9">
                            <p style="color: white; margin-top: 5%; font-size:16pt">
                                Calle Mesina, 4<br>
                                41089 Dos Hermanas<br>
                                Sevilla
                            </p>
                            <p style="color: white; font-size:16pt">
                                De lunes a jueves:<br>
                                <b>8:00 - 12:00</b><br>
                                De viernes a domingo:<br>
                                <b>8:00 - 15:00</b><br>
                                Teléfonos:<br>
                                <b>954 125 094<br>
                                    610 793 087</b>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row col-12">
                        <div class="row col-3"></div>
                        <div class="row col-9" style="margin-top: 5%;">
                            <h1 style="font-family: FuentePrincipal; color: white;">Contacta con nosotros</h1>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="row col-3"></div>
                        <form name="frmContacto" id="frmContacto" method="POST" class="col-7">
                            <div class="row col-12" style="margin-top: 2%;">
                                <label for="exampleInputEmail1" class="form-label" style="color: white;">Asunto</label>
                                <input type="text" class="form-control" id="txtAsunto" name="txtAsunto" required aria-describedby="emailHelp">
                                <small class="form-text text-danger"></small>
                            </div>

                            <div class="row col-12" style="margin-top: 2%;">
                                <label for="exampleFormControlTextarea1" class="form-label" style="color: white;">Contenido</label>
                                <textarea class="form-control" id="txtContenido" name="txtContenido" rows="3"></textarea>
                                <small class="form-text text-danger"></small>
                            </div>

                            <div class="row col-12" style="margin-top: 2%;">
                                <label for="exampleFormControlInput1" class="form-label" style="color: white;">Correo de contacto</label>
                                <input type="email" class="form-control" id="txtEmailContacto" name="txtEmailContacto">
                                <small class="form-text text-danger"></small>
                            </div>



                            <div class="form-check" style="margin-top: 2%;">
                                <label class="form-check-label" for="chkTermCond" style="color: white;">Acepto los términos y condiciones</label>
                                <input class="form-check-input" type="checkbox" name="chkTermCond" id="chkTermCond" value="aceptar"><br>
                                <small class="form-text text-danger"></small>
                            </div>
                            <div style="margin-top: 2%;">
                                <button type="button" name="btnEnviar" id="btnEnviar" class="btn btn-danger" style="background-color: #db4d4d;">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalMensaje" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row col-6">

            </div>


        </div>




    </div>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/codigoSolicitud.js"></script>


</body>

</html>