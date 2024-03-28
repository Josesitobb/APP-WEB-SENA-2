function ValidarEditarUsuario() {
    var Nombre,Apellido,Username,Correo,Contraseña,IdRol,nombresexpresiones,usuarioexpresiones,correoexpresiones;
    
    Nombre =document.getElementById("Nombre").value;
    Apellido =document.getElementById("Apellido").value;
    Username =document.getElementById("Username").value;
    Correo =document.getElementById("Correo").value;
    Contraseña =document.getElementById("Contraseña").value;
    IdRol =document.getElementById("Rolesid").value;
     // CAMPO DE EXPRESIOM PARA VALIDAR EL NOMBRE Y APELLIDO 
     nombresexpresiones = /^[a-zA-Z\s]*$/;
     // CAMPO DE EXPRESION PARA VALIDAR CONTRASEÑA Y NOMBRE DE USUARIOS
     usuarioexpresiones = /^[a-zA-Z0-9\s]+$/;
     // CAMPO DE EXPRESION PARA VALIDAR CORREO
     correoexpresiones = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    
    
    
    if(Nombre =="" || Apellido=="" || Username=="" || Correo =="" || Contraseña =="" || IdRol==""){
        alert("El campo algun campo esta vacio");
        return false;
    }
        // CAMPO NOMBRE
    
        // si el valor es mayor a 20 no lo deja registrar
        else if (Nombre.length>20){
            alert("Nombre de usuario muy largo")
            return false;
        }
        // si existe simbolos como "#$"# no lo deja registrar
        else if(!nombresexpresiones.test(Nombre)){
            alert("solo puedes ingresar texto en nombre")
            return false;
        }
    
    
    // CAMPO APELIIDO
        // si el valor es mayor a 30 no lo deja registrar
        else if (Apellido.length>30){
            alert("Nombre de usuario muy largo")
            return false;
        }
         // si existe simbolos como "#$"# no lo deja registrar
        else if(!nombresexpresiones.test(Apellido)){
            alert("solo puedes ingresar texto apellido ")
            return false;
        }
        // CAMPO NOMBRE DE USUARIOS
         // si el valor es mayor a 20 no lo deja registrar
        else if (Username.length>20){
            alert("Nombre de usuario muy largo")
            return false;
        }
    
         // si existe simbolos como "#$"# no lo deja registrar
         else if(!usuarioexpresiones.test(Username)){
            alert("solo puedes ingresar texto y numeros en nombre usuarios")
            return false;
        }
        
    // CAMPO CONTRASEÑA
         // si el valor es mayor a 20 no lo deja registrar
         else if (Contraseña.length>30){
            alert("Contraseña muy larga")
            return false;
        }
    
         // si existe simbolos como "#$"# no lo deja registrar
         else if(!usuarioexpresiones.test(Contraseña)){
            alert("solo puedes ingresar texto y numeros en contraseña")
            return false;
        }
        // CAMPO CORREO
        else if (Correo.length>100){
            alert("correo muy larog")
            return false;
        }
    
        else if (!correoexpresiones.test(Correo)){
            alert("Correo invalido")
            return false;
        }
        
    
    }