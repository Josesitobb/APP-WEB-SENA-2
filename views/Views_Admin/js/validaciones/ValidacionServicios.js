function ValidacioServicios(){

    var Servicio_Nombre,Servicio_Precio,Servicio_cantidad,servicio_Imagen,expresion;


    Servicio_Nombre = document.getElementById("Servicio_Nombre").value;
    Servicio_Precio = document.getElementById("Servicio_Precio").value;
    Servicio_cantidad = document.getElementById("Servicio_cantidad").value;
    servicio_Imagen = document.getElementById("servicio_Imagen").value;
    expresion = /^[a-zA-Z]+$/;
    // validacion si los campos estan vacios

    if(Servicio_Nombre =="" || Servicio_Precio=="" || Servicio_cantidad=="" || servicio_Imagen ==""){
        alert("El campo algun campo esta vacio");
        return false;
    }

    // Validacion si el campo NOMBRE SERVICIOS tiene mas de 100 letras

    else if (Servicio_Nombre.length>45){
        alert("Nombre de servicio muy largo")
        return false;
    }

    //Validacion si el capo NOMBRE SERVICIOS contiene cosa "#"#"#"$
    else if (!expresion.test(Servicio_Nombre)){
        alert("solo letras")
        return false;
    }
// validar si es campo es llenado por numeros
    else if (isNaN(Servicio_Precio)){
        alert("El precio no es una numero")
        return false;
    }
    // validar si es campo es llenado por numeros
    else if (isNaN(Servicio_cantidad)){
        alert("Cantidad ingresada no es un numero")
        return false;
    }
}