function ValidacioProductos(){

    var Name_product,Price_Name,Product_amount,Product_Image,expresion;


    Name_product = document.getElementById("Name_product").value;
    Price_Name = document.getElementById("Price_Name").value;
    Product_amount = document.getElementById("Product_amount").value;
    Product_Image = document.getElementById("Product_Image").value;
    expresion = /^[a-zA-Z]+$/;
    // validacion si los campos estan vacios

    if(Name_product =="" || Price_Name=="" || Product_amount=="" || Product_Image ==""){
        alert("El campo algun campo esta vacio");
        return false;
    }

    // Validacion si el campo NOMBRE PRODUCTOS tiene mas de 100 letras

    else if (Name_product.length>100){
        alert("Nombre de producto muy largo")
        return false;
    }

    //Validacion si el capo NOMBRE PRODUCTOS contiene cosa "#"#"#"$
    else if (!expresion.test(Name_product)){
        alert("solo letras  ")
        return false;
    }
// validar si es campo es llenado por numeros
    else if (isNaN(Price_Name)){
        alert("El precio no es una numero")
        return false;
    }
    // validar si es campo es llenado por numeros
    else if (isNaN(Product_amount)){
        alert("Cantidad ingresada no es un numero")
        return false;
    }
}