function validarlogin() {
var usernamelog,passwordlog;
// SE TRAE LOS DATOS DEL FORMULARIO
usernamelog= document.getElementById("usernamelog").value;
passwordlog= document.getElementById("passwordlog").value;
// SE CREA LA EXPRESION PARA COMPARAR
NombreExpresion =/^[a-zA-Z0-9\s]+$/;

// SE MIRA SI LOS CAMPOS ESTAN VACIO
if(usernamelog =="" ||passwordlog=="" ){
    alert("algun campo esta vacio");
    return false;
}
// SE MIRA SI EL NOMBRE TIENE "#$%&&"#
else if (!NombreExpresion.test(usernamelog)){
    alert("solo letras y numeros")
    return false;
}
// SE MIRA SI LA CONTRASEÑA TIENE "#$%&&"#
else if (!NombreExpresion.test(passwordlog)){
    alert("solo letras y numeros")
    return false;
}
}