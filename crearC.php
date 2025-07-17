<?php
session_start();
require_once 'db_wallet_digital.php';

if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header("Location: iniciarS.php");
    exit;
}
?>

<?php
if (isset($_POST["guardar"])) {
    $nombre = trim($_POST['nombre']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $numero = trim($_POST['numero']);
    $password = trim($_POST['pasword']);
    $rol = $_POST['rol'] ?? 'usuario'; // valor por defecto

    // Verificar campos requeridos
    if (!empty($nombre) && !empty($username) && !empty($email) && !empty($numero) && !empty($password)) {
        // Verificar si se subió una imagen
        $imagen = null;
        if (!empty($_FILES['imagen']['tmp_name'])) {
            $imagen = fopen($_FILES['imagen']['tmp_name'], 'rb');
        }

        $sql = $cnnPDO->prepare("INSERT INTO usuarios 
            (nombre, username, email, numero, pasword, imagen, rol) 
            VALUES (:nombre, :username, :email, :numero, :pasword, :imagen, :rol)");

        $sql->bindParam(':nombre', $nombre);
        $sql->bindParam(':username', $username);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':numero', $numero);
        $sql->bindParam(':pasword', $password);
        $sql->bindParam(':rol', $rol);

        if ($imagen !== null) {
            $sql->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
        } else {
            $imagenNull = null;
            $sql->bindParam(':imagen', $imagenNull, PDO::PARAM_NULL);
        }

        $sql->execute();
        unset($sql);

        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Faltan campos obligatorios');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    
    <style>
        body {
            background-size: cover;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        nav {
            background-color: black;
            background-size: cover;
        }
        
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 10px;
            background-color: #000000ff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
        }
        
        .container h2 {
            text-align: center;
            color: #333;
        }
        
        .form-container {
            margin-top: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }
        
        .form-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        
        .form-button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        
        .form-button:hover {
            background-color: #0056b3;
        }

        body {
            background-image: url('images/City.jpg');
            background-size: cover;
        }
    </style>
    
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
  <a class="navbar-brand" href="#">
  <img src="images/logo.png" alt="Logo" class="logo" height="60 px" width="60 px" >
    </a>    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Regresar</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</head>
<body>
<div class="container">
    <h2 style="font-size: 24px; text-align: center;">
    <img src="images/logo.png" alt="Logo" class="logo" height="80 px" width="80 px" >
    </h2>
    <div class="form-container">
     <h2 class="text-center mb-4">Registro de Usuario</h2>
        <form name="form1" method="post" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="nombre">Nombre completo:</label>
                <input type="text" class="form-control" name="nombre" placeholder="Ingresa tu nombre completo" required>
            </div>

            <div class="form-group mb-3">
                <label for="username">Nombre de usuario:</label>
                <input type="text" class="form-control" name="username" placeholder="Ej. jdoe" required>
            </div>

            <div class="form-group mb-3">
                <label for="email">Correo electrónico:</label>
                <input type="email" class="form-control" name="email" placeholder="Ej. ejemplo@correo.com" required>
            </div>

            <div class="form-group mb-3">
                <label for="numero">Número telefónico:</label>
                <input type="text" class="form-control" name="numero" placeholder="Ej. 5551234567" required>
            </div>

            <div class="form-group mb-3">
                <label for="pasword">Contraseña:</label>
                <input type="password" class="form-control" name="pasword" placeholder="Mínimo 6 caracteres" required>
            </div>

            <div class="form-group mb-4">
                <label for="imagen">Foto de perfil (opcional, .jpg):</label>
                <input type="file" accept="image/jpg" name="imagen" class="form-control">
            </div>

            <div class="text-center">
                <button type="submit" name="guardar" class="btn btn-primary">Registrar</button>
            </div>
        </form>
    </div>
</div>

<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

</body>
</html>
