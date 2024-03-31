function validarlogin () {
    var passwordlog = document.getElementById("passwordlog").value;
    var emailuser = document.getElementById("emailuser").value;
    if (passwordlog === "" || emailuser === "") {
        alert ("Los campos estan vacios");
        return false;
    }
    // Contraseña  
    if (passwordlog.length<=5) {
        alert ("La contraseña debe tener más de 8 caracteres.");
        return false;
    }
    if (passwordlog.length >= 30) {
        alert("La contraseña debe tener menos de 30 caracteres.");
        return false;
    }
    if (passwordlog.length < 8 || passwordlog.length > 15) {
        alert("La contraseña debe tener entre 8 y 15 caracteres.");
        return false;
    }
    
    if (!/^[a-zA-Z0-9!@#$%^&()_+-]+$/.test(passwordlog)) {
        alert("La contraseña debe contener letras, números y/o caracteres especiales.");
        return false;
    }
    
    if (!/[a-z]/.test(passwordlog) || !/[A-Z]/.test(passwordlog) || !/\d/.test(passwordlog)) {
        alert("La contraseña debe contener al menos una letra mayúscula, una minúscula y un número.");
        return false;
    }  
    // Correo
    if (emailuser.length < 5 || emailuser.length > 50) {
        alert("El correo electrónico debe tener entre 5 y 50 caracteres.");
        return false;
    }
    
    var correo_regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!correo_regex.test(emailuser)) {
        alert("El correo electrónico no tiene un formato válido.");
        return false;
    }
    
    if (emailuser.indexOf('.') === -1 || emailuser.indexOf('@') === -1) {
        alert("El correo electrónico debe contener al menos un punto en el dominio y un símbolo '@'.");
        return false;
    }
    
    if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(emailuser)) {
        alert("El correo electrónico solo debe contener letras, números, puntos, guiones bajos (_) o guiones en la parte local.");
        return false;
    }
}
