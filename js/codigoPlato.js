function añadirAlCarrito(){

    let idPlato = document.getElementsByName("id_plato")[0].value;

    oJSON = {idPlato}
    $.ajax(
        {
        type: "post",
        url: "usuario/añadirAlCarritoPlato.php",
        data: oJSON,
        dataType: "json",
        success: function (datos) {
            
            if(datos.error == 0){
                document.getElementsByClassName("modal-body")[0].textContent = document.getElementById("nombrePlato").textContent + " añadido al carrito";
            }
            else{
                document.getElementsByClassName("modal-body")[0].textContent = document.getElementById("nombrePlato").textContent + " ya se ha añadido anteriormente";
            }
            }
        });

}

let btnAñadirAlCarrito = document.getElementById("btnAñadirAlCarrito");
btnAñadirAlCarrito.addEventListener("click", añadirAlCarrito);
