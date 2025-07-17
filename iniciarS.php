<?php
require_once 'db_wallet_digital.php';

session_start();

if (isset($_POST['buscar'])) {
    $email = $_POST['email'];

    $query = $cnnPDO->prepare('SELECT * FROM usuarios WHERE email = :email');
    $query->bindParam(':email', $email);
    $query->execute();

    $count = $query->rowCount();
    $campo = $query->fetch();

    if ($count && $_POST['pasword'] == $campo['pasword']) {
        $_SESSION['email'] = $campo['email'];
        $_SESSION['pasword'] = $campo['pasword'];
        $_SESSION['username'] = $campo['username'];

        header("Location: index.php");
        exit();
    } else {
        echo "<strong><font color='red'>El Usuario o la Contraseña son Incorrectos</font></strong>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Buscar</title>
    <body>
    <style>
         body {
            background-image: url('images/City.jpg');
            background-size: cover;
            margin: 0;
        }
        nav{
            background-color: black;
        }
    </style>
</body>
</head>
<body>
    <div>
       <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
  <a class="navbar-brand" href="#">
    <img src="images/logo.png" alt="Logo" class="logo" height="30 px" width="30 px" >
        Wallet Digital
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

        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page"></a>
            </li>
            <li class="nav-item">
                <a class="nav-link">  </a>
            </li>
        </ul>
    </div>
   
    <!-- Contenedor centrado -->
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 26rem; border-radius: 1rem; background-color: black;">
        <div class="text-center mb-4">
            <img src="images/logo.png" alt="Logo" height="60">
            <h2 class="mt-3">Wallet Digital</h2>
            <h5 class="text-muted">Iniciar Sesión</h5>
        </div>
        <form method="post" name="Form">
            <div class="form-group mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" name="email" placeholder="ejemplo@correo.com" required>
            </div>
            <div class="form-group mb-4">
                <label for="pasword" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="pasword" placeholder="Contraseña" required>
            </div>
            <div class="d-grid">
                <button type="submit" name="buscar" class="btn btn-primary">Iniciar Sesión</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
<!-- CDN  MDB 4.19.1 -->

<!-- CSS -->

<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">

<!-- JavaScript -->

<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>