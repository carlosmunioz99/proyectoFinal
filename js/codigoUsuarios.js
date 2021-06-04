
function procesoInsertarUsuario(datos)
{
    if(!datos.error)
    {


    }
    else
    {
        /*let btnRegistrar = document.getElementById("btnRegistro");
        btnRegistrar.setAttribute("data-toggle", "modal");  


        let modal = document.createElement("div");
        modal.className = 'modal' 
        modal.setAttribute('tabindex','1');
        let div2 = document.createElement("div");
        div2.className = 'modal-dialog'
        let div3 = document.createElement('div');
        div3.className = 'modal-content';

        let div4 = document.createElement('div');
        div4.className = 'modal-header';
        let h5 = document.createElement('h5');
        h5.className = "modal-title";
        h5.textContent = "Error";

        let div5 = document.createElement('div');
        div5.className = 'modal-body';

        let contenidoDiv5 = document.createElement("p");
        contenidoDiv5.textContent = datos.mensaje;

        div5.appendChild(contenidoDiv5);

        let footer = document.createElement("div");
        footer.className = "modal-footer";

        let boton = document.createElement("button");
        boton.className = "btn btn-secondary";
        boton.setAttribute('type','button');
        boton.setAttribute('data-bs-dismiss','modal');
        boton.textContent="Cerrar";
        footer.appendChild(boton);


        modal.appendChild(div2);
        div2.appendChild(div3);
        div3.appendChild(div4);
        div4.appendChild(h5);
        div3.appendChild(div5);
        div3.appendChild(footer);
        footer.appendChild(boton);


        let body = document.querySelector("body");
        body.appendChild(modal);*/

    }
}


function validarInicioSesion()
{
    let bValido = true;
    let txtNombreUsuario = frmInicioSesion.nombreUsuario;
    let txtContraseña = frmInicioSesion.contraseña;

    if(txtNombreUsuario.value == "")
    {
        bValido = false;
        txtNombreUsuario.nextElementSibling.textContent = "Debe introducir un nombre de usuario";
        txtNombreUsuario.focus();
    }
    else
    {
        txtNombreUsuario.nextElementSibling.textContent = "";
    }

    if(txtContraseña.value == "")
    {
        if(bValido)
        {
            bValido = false;
            txtContraseña.focus();
        }
        txtContraseña.nextElementSibling.textContent = "Debe introducir una contraseña";
    }
    else
    {
        txtContraseña.nextElementSibling.textContent = "";
    }

    if(bValido)
    {
        comprobarUsuarioIntroducido(txtNombreUsuario.value, txtContraseña.value);
    }
}

function comprobarUsuarioIntroducido(nombreUsuario, contraseña)
{
    txtMensajeError = document.getElementById("mensajeErrorInicioSesion");
    let oJSON = {
        nombreUsuario: nombreUsuario,
        contraseña: contraseña
    }

    $.ajax({
        type: "get",
        url: "usuario/comprobarUsuario.php",
        data: oJSON,
        dataType: "json",
        success: function (respuesta) {
            if(respuesta.error == 1)
            {
                txtMensajeError.textContent = "El nombre de usuario o la contraseña son incorrectos, inténtelo de nuevo";
            }
            else
            {
                iniciarSesion(nombreUsuario);
            }
        }
    });
}


function iniciarSesion(nombreUsuario)
{
    let oJSON = {nombreUsuario: nombreUsuario}
    $.ajax({
        type: "GET",
        url: "usuario/iniciarSesion.php",
        data: oJSON,
        dataType: "json",
        success: function (respuesta) {
            if(respuesta.error == 0)
            {
                window.location.href = "index.php";
            }
        }
    });
}







/*EVENTOS*/

let btnIniciarSesion = document.getElementById("iniciarSesionEnviar");
btnIniciarSesion.addEventListener("click", validarInicioSesion);

