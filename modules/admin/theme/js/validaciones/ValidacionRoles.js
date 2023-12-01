function ValidarRoles() {

    var NombreRol,expresion;

    NombreRol=document.getElementById("NombreRol").value;
    expresion = /^[a-zA-Z]+$/;

    if(NombreRol =="" ){
        alert("El campo algun campo esta vacio");
        return false;
    }

    else if (!expresion.test(NombreRol)){
        alert("El campo solo se puede llenar con letras ")
        return false;
    }


}


