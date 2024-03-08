function validarRegister(){
    var usernamereg,lastnamereg,nameuserg,passwordreg,emailreg,nombresexpresiones,usuarioexpresiones,correoexpresiones;
    usernamereg =document.getElementById("usernamereg").value;
    lastnamereg =document.getElementById("lastnamereg").value;
    nameuserg =document.getElementById("nameuserg").value;
    passwordreg =document.getElementById("passwordreg").value;
    emailreg =document.getElementById("emailreg").value;
    // CAMPO DE EXPRESIOM PARA VALIDAR EL NOMBRE Y APELLIDO 
    nombresexpresiones = /^[a-zA-Z\s]*$/;
    // CAMPO DE EXPRESION PARA VALIDAR CONTRASEÑA Y NOMBRE DE USUARIOS
    usuarioexpresiones = /^[a-zA-Z0-9\s]+$/;
    // CAMPO DE EXPRESION PARA VALIDAR CORREO
    correoexpresiones = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;


    // validar si los campos estan vacios
    if(usernamereg =="" || lastnamereg=="" || nameuserg=="" || passwordreg =="" || emailreg =="" ){
        alert("Uno o varios campos están vacíos. Por favor, completa todos los campos");
        return false;
    }
    // CAMPO NOMBRE

    // si el valor es mayor a 20 no lo deja registrar
    else if (usernamereg.length>20){
        alert("Nombre de usuario muy largo")
        return false;
    }
    // si existe simbolos como "#$"# no lo deja registrar
    else if(!nombresexpresiones.test(usernamereg)){
        alert("solo puedes ingresar texto en nombre")
        return false;
    }


// CAMPO APELIIDO
    // si el valor es mayor a 30 no lo deja registrar
    else if (lastnamereg.length>30){
        alert("Nombre de usuario muy largo")
        return false;
    }
     // si existe simbolos como "#$"# no lo deja registrar
    else if(!nombresexpresiones.test(lastnamereg)){
        alert("solo puedes ingresar texto apellido ")
        return false;
    }
    // CAMPO NOMBRE DE USUARIOS
     // si el valor es mayor a 20 no lo deja registrar
    else if (nameuserg.length>20){
        alert("Nombre de usuario muy largo")
        return false;
    }

     // si existe simbolos como "#$"# no lo deja registrar
     else if(!usuarioexpresiones.test(nameuserg)){
        alert("solo puedes ingresar texto y numeros en nombre usuarios")
        return false;
    }
    
// CAMPO CONTRASEÑA
     // si el valor es mayor a 20 no lo deja registrar
     else if (passwordreg.length>30){
        alert("Contraseña muy larga")
        return false;
    }

     // si existe simbolos como "#$"# no lo deja registrar
     else if(!usuarioexpresiones.test(passwordreg)){
        alert("solo puedes ingresar texto y numeros en contraseña")
        return false;
    }
    // CAMPO CORREO
    
    else if (emailreg.length>100){
        alert("correo muy larog")
        return false;
    }

    else if (!correoexpresiones.test(emailreg)){
        alert("Correo invalido")
        return false;
    }
    
}