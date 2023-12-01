
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
crossorigin="anonymous">
<!-- FONS -->
    <title>Maryuri</title>
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:#c6e5d9">
        PHP CRUD 
</nav>
<div class="container">
    <?php
      $i = 1;
    ?>
    <a href="add_new.php" class="btn btn-dark mb-3"> AÑADIR NUEVO USUARIO</a>

    <table class="table table-holver text-center">
  <thead class="table-danger">
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Username</th>
      <th scope="col">Id_Rol</th>
      <th scope="col">Correo</th>
      <th scope="col">Contraseña</th>
      <th scope="col">Enviar</th>
    </tr>
  </thead>
  <tbody>
  <?php
  include "db.php";
$sql="SELECT * FROM `usuarios`";
$result=mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
?>
<tr>


<td><?php echo $i++ ?></td>
<td><?php echo $row['usuarios_nombres'] ?> </td>
<td> <?php echo $row['usuario_apellido'] ?> </td>
<td><?php echo $row['usuario_username'] ?></td>
<td><?php echo $row['ROLES_IdROLES'] ?></td>  
<td> <?php echo $row['usuario_correo'] ?> </td>
<td><?php echo $row['usuario_contraseña'] ?></td>
<td>
<a href="edit.php?id=<?php echo $row['idUSUARIOS']?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i>Editar</a>    
<a href="delete.php?id=<?php echo $row['idUSUARIOS']?>" class="link-dark"><i class="fa-solid fa-trash fs-5 "></i>Eliminar</a>    

</td>
</tr>

<?php

}
  ?>



  
  </tbody>
</table>
</div>


<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <h1>Fino<h1>
</body>
</html>