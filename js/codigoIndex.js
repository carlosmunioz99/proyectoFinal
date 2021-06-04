function cerrarSesion()
{
    $.ajax({
        url: "usuario/cerrarSesion.php",
        dataType:"json",
        success: function (respuesta) 
        {
            if(respuesta.error == 0){
                window.location.href = "index.php";
            }
        }
    });
}

let enlaceCerrarSesion = document.getElementById("cerrarSesion");
enlaceCerrarSesion.addEventListener("click",cerrarSesion);              