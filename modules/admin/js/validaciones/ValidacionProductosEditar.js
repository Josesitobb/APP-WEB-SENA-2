function ValidacioProductosEditar() {

    var Name_producto,Price_producto,Amount_producto,Producto_Imagen;

    Name_producto = document.getElementById("Name_producto").value;
    Price_producto = document.getElementById("Price_producto").value;
    Amount_producto = document.getElementById("Amount_producto").value;
    Producto_Imagen = document.getElementById("Producto_Imagen").value;
    expresion = /^[a-zA-Z]+$/;


    if(Name_producto =="" || Price_producto=="" || Amount_producto=="" || Producto_Imagen =="" ){
        alert("El campo algun campo esta vacio");
        return false;
    }

    // Validacion si el campo NOMBRE PRODUCTOS tiene mas de 100 letras

    else if (Name_producto.length>100){
        alert("Nombre de producto muy largo")
        return false;
    }

    //Validacion si el capo NOMBRE PRODUCTOS contiene cosa "#"#"#"$
    else if (!expresion.test(Name_producto)){
        alert("solo letras en el campo nombre del producto ")
        return false;
    }
// validar si es campo es llenado por numeros
    else if (isNaN(Price_producto)){
        alert("El precio no es una numero")
        return false;
    }
    // validar si es campo es llenado por numeros
    else if (isNaN(Amount_producto)){
        alert("Cantidad ingresada no es un numero")
        return false;
    }



}