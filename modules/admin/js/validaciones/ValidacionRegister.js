function register () {
    var Nombre_usuario = document.getElementById("Nombre_usuario").value; 
    var Apellido_Usuario = document.getElementById("Apellido_Usuario").value;
    var Contraseña_Usuario = document.getElementById("Contraseña_Usuario").value;
    var Correo_Usuario = document.getElementById("Correo_Usuario").value;
    var Telefono_usuario = document.getElementById("Telefono_usuario").value;
    if (Nombre_usuario === "" || Apellido_Usuario === "" || Contraseña_Usuario === "" || Correo_Usuario === "" || Telefono_usuario === "") {
        alert ("Los campos estan vacios");
        return false;
    }
    // Nombre
    if (Nombre_usuario.length<=2) {
        alert ("El nombre debe tener más de 2 letras.");
        return false;
    }
    if (Nombre_usuario.length >= 25) {
        alert("El nombre debe tener menos de 25 letras.");
        return false;
    }
    if (!/^[a-zA-Z]+$/.test(Nombre_usuario)) {
        alert("El nombre solo debe contener letras.");
        return false;
    }
    // Apellido
    if (Apellido_Usuario.length<=2) {
        alert ("El apellido debe tener más de 2 letras.");
        return false;
    }
    if (Apellido_Usuario.length >= 25) {
        alert("El apellido debe tener menos de 25 letras.");
        return false;
    }
    if (!/^[a-zA-Z]+(\s[a-zA-Z]+){0,2}$/.test(Apellido_Usuario)) {
        alert("El apellido puede contener hasta dos espacios y solo letras. (si colocaste un espacio al inicio o al final a eso se debe la alerta");
        return false;
    }
    // Contraseña  
    if (Contraseña_Usuario.length<=5) {
        alert ("La contraseña debe tener más de 8 caracteres.");
        return false;
    }
    if (Contraseña_Usuario.length >= 30) {
        alert("La contraseña debe tener menos de 30 caracteres.");
        return false;
    }
    if (Contraseña_Usuario.length < 8 || Contraseña_Usuario.length > 15) {
        alert("La contraseña debe tener entre 8 y 15 caracteres.");
        return false;
    }
    
    if (!/^[a-zA-Z0-9!@#$%^&()_+-]+$/.test(Contraseña_Usuario)) {
        alert("La contraseña debe contener letras, números y/o caracteres especiales.");
        return false;
    }
    
    if (!/[a-z]/.test(Contraseña_Usuario) || !/[A-Z]/.test(Contraseña_Usuario) || !/\d/.test(Contraseña_Usuario)) {
        alert("La contraseña debe contener al menos una letra mayúscula, una minúscula y un número.");
        return false;
    }  
    // Correo
    if (correo_usuario.length < 5 || correo_usuario.length > 50) {
        alert("El correo electrónico debe tener entre 5 y 50 caracteres.");
        return false;
    }

    var correo_regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!correo_regex.test(correo_usuario)) {
        alert("El correo electrónico no tiene un formato válido.");
        return false;
    }

    if (correo_usuario.indexOf('.') === -1) {
        alert("El correo electrónico debe contener al menos un punto en el dominio.");
        return false;
    }

    if (!/^[a-zA-Z0-9._-]+$/.test(correo_usuario)) {
        alert("El correo electrónico solo debe contener letras, números, puntos, guiones bajos (_) o guiones.");
        return false;
    }
    // Teléfono
    if (telefono_usuario.length < 7 || telefono_usuario.length > 15) {
        alert("El número de teléfono debe tener entre 7 y 15 caracteres.");
        return false;
    }

    var telefono_regex = /^\d+$/;
    if (!telefono_regex.test(telefono_usuario)) {
        alert("El número de teléfono solo puede contener dígitos numéricos.");
        return false;
    }
}

