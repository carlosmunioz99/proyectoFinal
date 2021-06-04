function obtenerListados()
{
    let fechaListado = document.getElementById('fecha').value;

    oJSON ={fechaListado}
    $.ajax({
        type: "get",
        url: "./admin/listadoProductos.php",
        data: oJSON,
        dataType: "json",
        success: procesarListado 
    });    
}

function procesarListado(datos)
{
    let listadoMenusDiario= [];
    let listadoPlatos = [];
    listadoMenusDiario.push(datos.listadoMenuDiario);
    listadoPlatos.push(datos.listadoPlatos)


    let contenedorTabla = document.getElementById("contenedorMenusDiarios");
    /*console.log(listadoMenusDiario.length);
    console.log(datos.listadoMenuDiario);*/
    if(datos.listadoMenuDiario.length == 0)
    {
        contenedorTabla.textContent = "No existen pedidos de menus diarios para este día";   
    }
    else
    {
        if(contenedorTabla.textContent != "")
        {
            contenedorTabla.textContent = "";
        }
        generarTablaMenusDiarios(listadoMenusDiario);
    }

    contenedorTabla = document.getElementById("contenedorTablaPlatos");
    if(datos.listadoMenuDiario.length == 0)
    {
        contenedorTabla.textContent = "No existen pedidos de platos para este día";   
    }
    else
    {
        if(contenedorTabla.textContent != "")
        {
            contenedorTabla.textContent = "";
        }
        generarTablaPlatos(listadoPlatos);
    }
    /*if(listadoPlatos.length > 0)
    {

    }*/
    //console.log(listadoMenusDiario[0][0]);
}

function generarTablaMenusDiarios(listadoMenusDiario)
{
    let oH2 = document.createElement("h2");
    oH2.textContent = "Pedidos de menús diarios";
    
    let contenedorTabla = document.getElementById("contenedorMenusDiarios");

    if(contenedorTabla.childElementCount != 0)
    {
        contenedorTabla.textContent = "";
    }
    let oTabla = document.createElement("table");
    oTabla.setAttribute("id", "tablaMenusDiarios");
    oTabla.setAttribute("class", "table");
    let oTHeader = document.createElement("thead")
    let oTr = document.createElement("tr");
    let oTh = document.createElement("th");
    oTh.setAttribute("scope", "col");
    oTh.textContent = "Id Pedido";
    let oTh1 = document.createElement("th");
    oTh1.setAttribute("scope", "col")
    oTh1.textContent = "Id Cliente"
    let oTh2 = document.createElement("th");
    oTh2.setAttribute("scope", "col")
    oTh2.textContent = "Nombre"
    let oTh3 = document.createElement("th");
    oTh3.setAttribute("scope", "col")
    oTh3.textContent = "Descripcion"
    let oTh4 = document.createElement("th");
    oTh4.setAttribute("scope", "col")
    oTh4.textContent = "Fecha";
    oTabla.createTBody

    oTr.appendChild(oTh);
    oTr.appendChild(oTh1);
    oTr.appendChild(oTh2);
    oTr.appendChild(oTh3);
    oTr.appendChild(oTh4);
   

    let oTbody = document.createElement("tBody");
    let oFila;
    for(let i = 0;i<listadoMenusDiario.length;i++)
    {
        for (let j=0;j<listadoMenusDiario[i].length;j++)
        {
            oFila = oTbody.insertRow(-1);
            let oCelda = oFila.insertCell(-1);
            oCelda.textContent = listadoMenusDiario[i][j].id_pedido;
            oFila.appendChild(oCelda);

            oCelda = oFila.insertCell(-1);
            oCelda.textContent = listadoMenusDiario[i][j].id_cliente;
            oFila.appendChild(oCelda);

            oCelda = oFila.insertCell(-1);
            oCelda.textContent = listadoMenusDiario[i][j].nombre;
            oFila.appendChild(oCelda);

            oCelda = oFila.insertCell(-1);
            oCelda.textContent = listadoMenusDiario[i][j].descripcion;
            oFila.appendChild(oCelda);

            oCelda = oFila.insertCell(-1);
            oCelda.textContent = listadoMenusDiario[i][j].fecha;
            oFila.appendChild(oCelda);
        }
    }
    
    contenedorTabla.appendChild(oH2);
    contenedorTabla.appendChild(oTabla);
    oTabla.appendChild(oTHeader);
    oTHeader.appendChild(oTr);
    oTabla.appendChild(oTbody);
    oTbody.appendChild(oFila);


}

function generarTablaPlatos(listadoPlatos)
{
    let oH2 = document.createElement("h2");
    oH2.textContent = "Pedidos de platos";

    let contenedorTabla = document.getElementById("contenedorTablaPlatos");

    if(contenedorTabla.childElementCount != 0)
    {
        contenedorTabla.textContent = "";
    }
    let oTabla = document.createElement("table");
    oTabla.setAttribute("id", "tablaPlatos");
    oTabla.setAttribute("class", "table");
    let oTHeader = document.createElement("thead")
    let oTr = document.createElement("tr");
    let oTh = document.createElement("th");
    oTh.setAttribute("scope", "col");
    oTh.textContent = "Id Pedido";
    let oTh1 = document.createElement("th");
    oTh1.setAttribute("scope", "col")
    oTh1.textContent = "Id Cliente"
    let oTh2 = document.createElement("th");
    oTh2.setAttribute("scope", "col")
    oTh2.textContent = "Nombre"
    let oTh3 = document.createElement("th");
    oTh3.setAttribute("scope", "col")
    oTh3.textContent = "Descripcion"
    let oTh4 = document.createElement("th");
    oTh4.setAttribute("scope", "col")
    oTh4.textContent = "Fecha";
    oTabla.createTBody

    oTr.appendChild(oTh);
    oTr.appendChild(oTh1);
    oTr.appendChild(oTh2);
    oTr.appendChild(oTh3);
    oTr.appendChild(oTh4);

    let oTbody = document.createElement("tBody");
    let oFila;
    for(let i = 0;i<listadoPlatos.length;i++)
    {
        for (let j=0;j<listadoPlatos[i].length;j++)
        {
            oFila = oTbody.insertRow(-1);
            let oCelda = oFila.insertCell(-1);
            oCelda.textContent = listadoPlatos[i][j].id_pedido;
            oFila.appendChild(oCelda);

            oCelda = oFila.insertCell(-1);
            oCelda.textContent = listadoPlatos[i][j].id_cliente;
            oFila.appendChild(oCelda);

            oCelda = oFila.insertCell(-1);
            oCelda.textContent = listadoPlatos[i][j].nombre;
            oFila.appendChild(oCelda);

            oCelda = oFila.insertCell(-1);
            oCelda.textContent = listadoPlatos[i][j].descripcion;
            oFila.appendChild(oCelda);

            oCelda = oFila.insertCell(-1);
            oCelda.textContent = listadoPlatos[i][j].fecha;
            oFila.appendChild(oCelda);
        }
    }
    
    contenedorTabla.appendChild(oH2);
    contenedorTabla.appendChild(oTabla);
    oTabla.appendChild(oTHeader);
    oTHeader.appendChild(oTr);
    oTabla.appendChild(oTbody);
    oTbody.appendChild(oFila);
}

function vaciarListados()
{
    let contenedorTabla = document.getElementById("contenedorTablaPlatos");

    if(contenedorTabla.childElementCount != 0)
    {
        contenedorTabla.textContent = "";
    }

    contenedorTabla = document.getElementById("contenedorMenusDiarios");

    if(contenedorTabla.childElementCount != 0)
    {
        contenedorTabla.textContent = "";
    }
}



function registrarUsuario()
{
    bValido = true;
    let sNombreUsuario= document.querySelector("#nombreUsuario");
    let txtMensajeError = frmRegistro.nombreUsuario.nextElementSibling;

    let regExp = /\S[A-Za-z0-9_.-]{3,15}\S/;
    if(!regExp.test(sNombreUsuario.value))
    {
        bValido=false;

        txtMensajeError.textContent = "- El nombre de usuario debe tener entre 3 y 15 caracteres";
        sNombreUsuario.focus();
    }
    else
    {
        txtMensajeError.textContent="";
    }

    let sEmail = document.querySelector("#txtCorreo");
    regExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
    txtMensajeError = frmRegistro.txtCorreo.nextElementSibling;

    if(!regExp.test(sEmail.value))
    {
        if(bValido)
        {
            bValido = false;
            sEmail.focus();
        }
        txtMensajeError.textContent = "- Formato del e-mail incorrecto";
    }
    else
    {
        txtMensajeError.textContent="";
    }

    let sContraseña = document.querySelector("#txtContraseña");
    //regExp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/;
    txtMensajeError = frmRegistro.txtContraseña.nextElementSibling;

    if(sContraseña.value == "")
    {
        if(bValido)
        {
            bValido = false;
            sContraseña.focus();
        }
        txtMensajeError.textContent = "- Debe rellenar este campo";
    }
    else
    {
        txtMensajeError.textContent="";
    }

    if(bValido)
    {
        introducirUsuario();
    }
}


function introducirUsuario()
{
    let txtNombreUsuario = document.querySelector("#nombreUsuario").value;
    let txtEmail = document.querySelector("#txtCorreo").value;
    let txtContraseña =  document.querySelector("#txtContraseña").value;

    let oJSON={
        nombreUsuario:txtNombreUsuario,
        email:txtEmail,
        contraseña:txtContraseña
    }

    $.ajax({
        type: "POST",
        url: "./admin/registrarUsuario.php",
        data: oJSON,
        dataType: "json",
        success: function (datos)
        {
            console.log(datos);
            if(datos.error == 0)
            {
                document.getElementById("contenidoModal").textContent = "Usuario creado correctamente";
                frmRegistro.reset();
            }
            else
            {
                document.getElementById("contenidoModal").textContent = datos.mensaje;
                frmRegistro.reset();
            }
        }
    });
}


function cambiarCorreo()
{
    let txtCorreoCalendario = document.getElementById("correoGmail");
    let txtCorreoSolicitudes = document.getElementById("correoSolicitudes");
    let bValido = true;

    let regExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@\gmail.com$/;

    let txtMensajeError = frmCorreos.correoGmail.nextElementSibling;

    if(!regExp.test(txtCorreoCalendario.value))
    {
        bValido = false;
        txtCorreoCalendario.focus;
        txtMensajeError.textContent = "Formato de correo para calendarios incorrecto, debe ser una cuenta de gmail.com";
    }
    else
    {
        txtMensajeError.textContent = "";
    }

    txtMensajeError = frmCorreos.correoSolicitudes.nextElementSibling;
    regExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;

    if(!regExp.test(txtCorreoSolicitudes.value))
    {
        if(bValido)
        {
            bValido = false;
            txtCorreoSolicitudes.focus;
        }
        txtMensajeError.textContent = "Formato de correo para calendarios incorrecto, debe tener formato '<usuario>@<servidor>.<dominio>'";
    }
    else
    {
        txtMensajeError.textContent = "";
    }

    if(bValido)
    {
        //console.log (txtCorreoCalendario.value);
        //console.log (txtCorreoSolicitudes.value);
        actualizarCorreos(txtCorreoCalendario.value, txtCorreoSolicitudes.value);
    }
}

function actualizarCorreos(correoCalendario, correoSolicitudes)
{
    let oJSON = {correoCalendario, correoSolicitudes}
    console.log(oJSON);
    $.ajax({
        type: "POST",
        url: "admin/actualizarCorreos.php",
        data: oJSON,
        dataType: "json",
        success: function (datos) 
        {
            if(datos.error == 0)
            {
                document.getElementById("contenidoModal").textContent = datos.mensaje;
            }
            else
            {
                document.getElementById("contenidoModal").textContent = datos.mensaje;
            }
            
        }
    });
}



//BOTONES EVENTOS
let btnEnviarProductoPorFecha = document.getElementById("consultarProductos");
btnEnviarProductoPorFecha.addEventListener("click", obtenerListados);

let btnPlegar = document.getElementById("botonPlegar");
btnPlegar.addEventListener("click", vaciarListados);

let btnRegistrar = document.getElementById("btnRegistro");
btnRegistrar.addEventListener("click", registrarUsuario);

let btnConfigurarEmail = document.getElementById("btnCambiarCorreo")
btnConfigurarEmail.addEventListener("click", cambiarCorreo)
