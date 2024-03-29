
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

    <link rel="stylesheet" href="css/login.css">
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
                <div class="col-xl-4">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-1">
                              
                                <form class="mt-5 mb-2 login-input" action="Login.php?action=validar" method="post" onsubmit="return validarlogin();">

                                <div class="form-group text-center">
                                  <img src="../views/View_Login/images/logi.png" alt="Logo" class="mb-3"> 
                                </div>
                                
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Correo" name="emailuser" id="emailuser" required/>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Contraseña" name="passwordlog" id="passwordlog" required/>
                                    <button class="btn btn-outline-link col-12 mx-auto margin-btn" type="button" id="togglePassword" onclick="togglePasswordVisibility()" style="margin: 10px; background-color: #ff69b4; color: #fff;">Visualizar Contraseña</button>
                                </div>
                                    
                                <button class="btn btn-info w-100" >Iniciar sesión</button>

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
    <script src="../views/Views_Admin/js/validaciones/ValidacionLogin.js"></script>
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
</body>
</html>





