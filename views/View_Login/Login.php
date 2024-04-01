
<!DOCTYPE html>
<html class="h-100" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="SG.png">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link href="../views/Views_Admin/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">


</head>

<body class="h-100">
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    



    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-5">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-1">
                              
                                <form class="mt-5 mb-2 login-input" action="Login.php?action=validar" method="post" onsubmit="return validarlogin();">

                                <div class="form-group text-center">
                                  <img src="../views/View_Login/images/logi.png" alt="Logo" >
                                </div>
                                
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Correo" name="emailuser" id="emailuser" required/>
                                </div>
                                <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Contraseña" name="passwordlog" id="passwordlog" required/>
                                        <button class="btn btn-outline-success col-12 mx-auto" type="button" id="togglePassword" onclick="togglePasswordVisibility()">Visualizar Contraseña</i></button>
                                    </div>
                                    
                                    <button class="btn login-form__btn submit w-100">Iniciar sesion</button>

                                <div class="text-center">
                                <p class="mt-3 login-form__footer" style="padding-top: 20px;">¿No tienes una cuenta? <a href="../controllers/Login.php?action=register" class="text-primary">Click aquí</a> para registrarte.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="../views/Views_Admin/plugins/common/common.min.js"></script>
    <script src="../views/Views_Admin/js/custom.min.js"></script>
    <script src="../views/Views_Admin/js/settings.js"></script>
    <script src="../views/Views_Admin/js/gleek.js"></script>
    <script src="../views/Views_Admin/js/styleSwitcher.js"></script>
    <script src="../Views_Admin/js/validaciones/ValidacionLogin.js"></script>
    <script>
  function togglePasswordVisibility() {
    var passwordInput = document.getElementById("passwordlog");
    var toggleButton = document.getElementById("togglePassword");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      toggleButton.innerHTML = 'Ocultar Contraseña';
    } else {
      passwordInput.type = "password";
      toggleButton.innerHTML = 'Visualizar Contraseña';
    }
  }
</script>
<script>
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

</script>
</body>
</html>





