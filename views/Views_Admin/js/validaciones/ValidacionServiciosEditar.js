function ValidacioServiciosEditar() {

    var servicio_nombre,servicio_valor,Amount_producto,servicio_cantidad;

    servicio_nombre = document.getElementById("servicio_nombre").value;
    servicio_valor = document.getElementById("servicio_valor").value;
    Amount_producto = document.getElementById("servicio_cantidad").value;
    servicio_cantidad = document.getElementById("servicio_Imagen").value;
    expresion = /^[a-zA-Z]+$/;


    if(servicio_nombre =="" || servicio_valor=="" || Amount_producto=="" || servicio_cantidad =="" ){
        alert("El campo algun campo esta vacio");
        return false;
    }

    // Validacion si el campo NOMBRE SERVICIOS tiene mas de 100 letras

    else if (servicio_nombre.length>45){
        alert("Nombre del servicio muy largo")
        return false;
    }

    //Validacion si el capo NOMBRE SERVICIOS contiene cosa "#"#"#"$
    else if (!expresion.test(servicio_nombre)){
        alert("solo letras en el campo nombre del servicio ")
        return false;
    }
// validar si es campo es llenado por numeros
    else if (isNaN(servicio_valor)){
        alert("El precio no es una numero")
        return false;
    }
    // validar si es campo es llenado por numeros
    else if (isNaN(Amount_producto)){
        alert("Cantidad ingresada no es un numero")
        return false;
    }



}