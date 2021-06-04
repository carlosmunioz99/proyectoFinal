function validarSolicitud()
{
    bValido = true;
    let sAsunto= document.querySelector("#txtAsunto");
    let txtMensajeError = frmContacto.txtAsunto.nextElementSibling;

    let regExp = /[A-Za-z0-9_.-]{3,50}/;
    if(!regExp.test(sAsunto.value))
    {
        bValido=false;
        sAsunto.focus();

        txtMensajeError.textContent = "- El asunto debe tener entre 3 y 50 caracteres  "
    }
    else
    {
        txtMensajeError.textContent="";
    }

    let sContenido = document.querySelector("#txtContenido");
    txtMensajeError = frmContacto.txtContenido.nextElementSibling;

    if(sContenido.value == "")
    {
        if (bValido) {
            bValido = false
            sContenido.focus();
        }   
        txtMensajeError.textContent = "Debe rellenar este campo";
    }
    else
    {
        txtMensajeError.textContent = "";
    }

    regExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
    let sCorreo = document.querySelector("#txtEmailContacto");
    txtMensajeError = frmContacto.txtEmailContacto.nextElementSibling;

    if(!regExp.test(sCorreo.value))
    {
        if(bValido)
        {
            bValido = false;
            sCorreo.focus
        }
        txtMensajeError.textContent = "Formato de e-mail incorrecto";
    }
    else
    {
        txtMensajeError.textContent = "";
    }

    let chkTerminosYCondiciones = document.querySelector("#chkTermCond");
    txtMensajeError = frmContacto.chkTermCond.nextElementSibling.nextElementSibling;

    if(!chkTerminosYCondiciones.checked)
    {
        if(bValido)
        {
            bValido = false;
        }
        txtMensajeError.textContent = "Debe aceptar los terminos y condiciones";
    }
    else
    {
        txtMensajeError.textContent="";
    }

    if(bValido)
    {
        procesarSolicitud(sAsunto.value, sContenido.value, sCorreo.value);
        document.getElementById("frmContacto").reset();
    }
}

function procesarSolicitud(asunto, contenido, correo)
{
    oJSON = {asunto, contenido, correo};
    $.ajax({
        type: "post",
        url: "./solicitud/guardarSolicitud.php",
        data: oJSON,
        dataType: "json",
        success: function (datos) 
        {
            var myModal = new bootstrap.Modal(document.getElementById('modalMensaje'), {
                keyboard: false
              })
            if(datos.error == 0)
            {                
                
                modalTitulo = document.getElementsByClassName("modal-header")
                modalTitulo[0].textContent = "EN PROCESO"
                modalContenido = document.getElementsByClassName("modal-body")
                modalContenido[0].textContent = datos.mensaje;
                myModal.show();

            }
            else
            {
                modalTitulo = document.getElementsByClassName("modal-header")
                modalTitulo[0].textContent = "ERROR"
                modalContenido = document.getElementsByClassName("modal-body")
                modalContenido[0].textContent = datos.mensaje;
                myModal.show();
            }
        }
    });
}

//EVENTOS
let btnEnviarSolicitud = document.getElementById("btnEnviar");
btnEnviarSolicitud.addEventListener("click", validarSolicitud);