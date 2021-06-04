function añadirAlCarritoMenu(){

    let idMenu = document.getElementsByName("id_menu")[0].value;

    oJSON = {idMenu}
    $.ajax(
        {
        type: "post",
        url: "usuario/añadirAlCarritoMenu.php",
        data: oJSON,
        dataType: "json",
        success: function (datos) {
            
            if(datos.error == 0){
                document.getElementsByClassName("modal-body")[0].textContent = document.getElementById("nombreMenu").textContent + " añadido al carrito";
            }
            else{
                document.getElementsByClassName("modal-body")[0].textContent = document.getElementById("nombreMenu").textContent + " ya se ha añadido anteriormente";
            }
            }
        });

}

let btnAñadirAlCarritoMenu = document.getElementById("btnAñadirAlCarritoMenu");
btnAñadirAlCarritoMenu.addEventListener("click", añadirAlCarritoMenu)