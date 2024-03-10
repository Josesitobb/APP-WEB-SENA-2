<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('config/db.php');
require('config/config.php');
$db = new db();
$conn = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

print_r($_SESSION);
$lista_Carrito = array();
$total = 0; // Asegúrate de inicializar la variable $total

if ($productos != null) {
    foreach ($productos as $id_producto => $cantidad) {
        $sql = $conn->prepare("SELECT `Id_Productos`, `Nombre_Productos`, `Precio_Productos`, `Imagen_Productos`, `Id_Clientes` FROM `productos` WHERE `Id_Productos` = :id_producto");
        $sql->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $sql->execute();
        $producto = $sql->fetch(PDO::FETCH_ASSOC);

        $id = $producto['Id_Productos'];
        $nombre = $producto['Nombre_Productos'];
        $precio = $producto['Precio_Productos'];
        $imagen = $producto['Imagen_Productos'];
        $id_cliente = $producto['Id_Clientes'];

        $subtotal = $cantidad * $precio;
        $total += $subtotal;

        // Agregar este producto a la lista del carrito
        $lista_Carrito[] = array(
            'Id_Productos' => $id,
            'Nombre_Productos' => $nombre,
            'Precio_Productos' => $precio,
            'Imagen_Productos' => $imagen,
            'Id_Clientes' => $id_cliente,
            'Cantidad' => $cantidad,
            'Subtotal' => $subtotal
        );
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SGCITAS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon1.png" rel="icon">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-primary py-3 d-none d-md-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-white pr-3" href="../admin/theme/page-login.php">Iniciar sesión</a>
                        <span class="text-white">|</span>
                        <a class="text-white px-3" href="../admin/theme/page-register.php">Registrarse</a>
 
                    </div>
                </div>
                <div class="col-md-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-white px-3" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-white pl-3" href="">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-white navbar-light shadow p-lg-0">
                <a href="" class="navbar-brand d-block d-lg-none">
                    <h1 class="m-0 display-4 text-primary"><span class="text-secondary">SG</span>CITAS</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="./index.php" class="nav-item nav-link active">Inicio</a>
                        <!-- <a href="./about.php" class="nav-item nav-link">Nosotros</a> -->
                        <a href="./product.php" class="nav-item nav-link">Productos</a>
                    </div>
                    <a href="index.php" class="navbar-brand mx-5 d-none d-lg-block">
                        <h1 class="m-0 display-4 text-primary"><span class="text-secondary">SG</span>CITAS</h1>
                    </a>
                    <div class="navbar-nav mr-auto py-0">
                        <a href="./service.php" class="nav-item nav-link">Servicios</a>
                        <a href="gallery.php" class="nav-item nav-link">Galeria</a>
                        <!-- <a href="./contact.php" class="nav-item nav-link">Contactenos</a> -->
                        <a href="clases/carrito_Productos.php" class="nav-item nav-link">Carrito
                            <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart ?> </span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->   


    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid page-header" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h1 class="text-white display-3 mt-lg-5">Productos</h1>
        </div>
    </div>
    <!-- Header End -->


    <!-- Products Start -->
    <!-- Products Start -->
    <div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h1 class="section-title position-relative text-center mb-5">Tu mejor versión</h1>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($lista_Carrito == null) {
                        echo '<tr><td colspan="5" class="text-center"><b> Lista vacía </b></td></tr>';
                    } else {
                        foreach ($lista_Carrito as $productos) {
                            $id = $productos['Id_Productos'];
                            $nombre = $productos['Nombre_Productos'];
                            $precio = $productos['Precio_Productos'];
                            $imagen = $productos['Imagen_Productos'];
                            $id_cliente = $productos['Id_Clientes'];
                            $cantidad = $productos['Cantidad'];
                            $subtotal = $cantidad * $precio;
                            $total += $subtotal;
                    ?>
                            <tr>
                                <td><?php echo $nombre; ?></td>
                                <td><?php echo number_format($precio, 2, '.', ','); ?></td>
                                <td>
                                    <input type="number" min="1" max="10" step="1" value="<?php echo $cantidad; ?>" size="5" id="cantidad_<?php echo $id; ?>" onchange="actualizaCantidad(this.value, <?php echo $id; ?>);">

                                </td>
                                <td>
    <div id="subtotal<?php echo $id ?>" name="subtotal[]">
        <?php echo MONEDA . number_format($subtotal, 2, '.', ','); ?>
    </div>
</td>


                               </div>
                                
                               <!-- Enlace para activar la confirmación de eliminación -->
                               <td>
                               <a href="#" class="btn btn-warning btn-sm eliminar-producto" data-bs-id="<?php echo $id; ?>">Eliminar</a>

</td>

<!-- Función JavaScript para mostrar la confirmación de eliminación -->
<script>
  function confirmarEliminar() {
    return confirm("¿Está seguro de que desea eliminar?");
  }
</script>


                            </tr>
                    <?php
                        }
                    }
                    ?>

                    <tr>
                        <td colspan="3" class="text-right"><b>Total:</b></td>
                        <td colspan="2" id=total><?php echo number_format($total, 2, '.', ','); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12 text-center">
            <!-- Agrega el botón "Seleccionar Fecha" -->
            <button class="btn btn-success py-3 px-5" data-bs-toggle="modal" data-bs-target="#seleccionarFechaModal">Seleccionar Fecha</button>
        </div>
    </div>
</div>
>

    <!-- Products End -->



    <!-- Footer Start -->
    <div class="container-fluid footer bg-light py-5" style="margin-top: 90px;">
        <div class="container text-center py-5">
            <div class="row">
                <div class="col-12 mb-4">
                    <a href="index.html" class="navbar-brand m-0">
                        <h1 class="m-0 mt-n2 display-4 text-primary"><span class="text-secondary">SG</span>CITAS</h1>
                    </a>
                </div>
                <div class="col-12 mb-4">
                    
                    <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>

                    <a class="btn btn-outline-secondary btn-social" href="#"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="col-12 mt-2 mb-4">
                    <div class="row">
                        <div class="col-sm-6 text-center text-sm-right border-right mb-3 mb-sm-0">
                            <h5 class="font-weight-bold mb-2">Ubicación</h5>
                            <p class="mb-2">Cra 11 #180a-9, 110141 Bogotá</p>
                            <p class="mb-0">+57 322 4014764</p>
                        </div>
                        <div class="col-sm-6 text-center text-sm-left">
                            <h5 class="font-weight-bold mb-2">Horarios</h5>
                            <p class="mb-2">Lun – Vie, 8AM – 8PM</p>
                            <p class="mb-0">Sab – Dom, 9AM – 4PM</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <p class="m-0">&copy; <a href="#"></a>Estamos aquí para servirte<a href=""></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
    #


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmar eliminación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Está seguro de que desea eliminar?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirmarEliminar" onclick="eliminar()">Eliminar</button>
      </div>
    </div>
  </div>
</div>


<div id="seleccionarFechaModal" class="modal fade" tabindex="-1" aria-labelledby="seleccionarFechaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="seleccionarFechaModalLabel">Seleccionar Fecha y Hora</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para seleccionar fecha y hora -->
                <form id="fechaHoraForm">
                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input type="date" id="fecha" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="hora">Hora:</label>
                        <input type="time" id="hora" class="form-control" required>
                    </div>

                    <!-- Mostrar detalles del carrito aquí -->
                    <div id="detallesCarrito">
                        <!-- Aquí se mostrarán los detalles del carrito -->
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>



    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary px-2 back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>
    <script>
 // Agrega un evento de clic a los enlaces con la clase "eliminar-producto"
document.querySelectorAll('.eliminar-producto').forEach(function(el) {
  el.addEventListener('click', function () {
    // Abre el modal
    $('#exampleModal').modal('show');

    // Puedes obtener el ID específico del producto haciendo referencia al atributo data-bs-id
    var productId = el.getAttribute('data-bs-id');

    // Aquí puedes hacer algo con el ID del producto, como almacenarlo en una variable global o realizar otras acciones
  });
});

// Agrega un evento de clic al botón de confirmar dentro del modal
document.getElementById('confirmarEliminar').addEventListener('click', function () {
  // Aquí puedes agregar la lógica de eliminación si es necesario
  // En este ejemplo, solo se cierra el modal
  $('#exampleModal').modal('hide');
});




</script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>

<!-- Agrega un evento de clic a los enlaces con la clase "eliminar-producto" -->
document.querySelectorAll('.eliminar-producto').forEach(function(el) {
  el.addEventListener('click', function () {
    // Abre el modal
    $('#exampleModal').modal('show');

    // Guarda el ID específico del producto haciendo referencia al atributo data-bs-id
    var productId = el.getAttribute('data-bs-id');

    // Agrega un evento de clic al botón de confirmar dentro del modal
    document.getElementById('confirmarEliminar').addEventListener('click', function () {
      // Realiza la lógica de eliminación aquí
      eliminarProducto(productId);
      // Cierra el modal
      $('#exampleModal').modal('hide');
    });
  });
});

// Función para eliminar un producto del carrito
function eliminarProducto(id) {
  let url = 'clases/eliminar_Productos.php';
  let formData = new FormData();
  formData.append('Id_Productos', id);
  formData.append('action', 'eliminar');

  fetch(url, {
    method: 'POST',
    body: formData,
    mode: 'cors'
  }).then(response => response.json())
    .then(data => {
      if (data.ok) {
        // Actualiza la interfaz u otras acciones necesarias después de la eliminación
        // Puedes recargar la página o actualizar el contenido del carrito de alguna otra manera
        location.reload(); // Recarga la página
      } else {
        console.error('Error al intentar eliminar el producto');
      }
    })
    .catch(error => console.error('Error en la solicitud fetch:', error));
}





 function actualizaCantidad(cantidad, id) {
    let url = 'clases/actualizar_Productos.php';
    let formData = new FormData()
    formData.append('Id_Productos', id);
    formData.append('action', 'agregar')
    formData.append('cantidad', cantidad);

    fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors'
    }).then(response => response.json())
        .then(data => {
            if (data.ok) {
                let divsubtotal = document.getElementById("subtotal" + id);
                divsubtotal.innerHTML = data.sub;

                let total = 0.00
                let list = document.getElementsByName('subtotal[]')
                for (let i = 0; i < list.length; i++) {
                    total += parseFloat(list[i].innerHTML.replace(/[$,]/g,''));

                }
                total = new Intl.NumberFormat('en-US', {
            minimumFractionDigits: 2
            }).format(total);
                document.getElementById('total').innerHTML = '<?php echo MONEDA; ?>' + total
            }
        })
        .catch(error => console.error('Error en la solicitud fetch:', error));

        
}



    </script>

</body>

</html>