<?php
    require_once 'db_wallet_digital.php';
    session_start();

    if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header("Location: iniciarS.php");
    exit;
}

    if (isset($_POST['cerrar_sesion'])) {
        session_destroy();
        header("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-image: url('images/Initial D (2).jpg');
            background-size: cover;
        }
        nav{
            background-color: black;
        }
        
    </style>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/logo.png" alt="Logo" class="logo" height="30 px" width="30 px" >
                Wallet Digital
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <?php
                if (isset($_SESSION['email'])) {
                    $username = $_SESSION['username'];
                    $email = $_SESSION['email'];
                    $es_administrador = false;
                    if ($username === 'admin' && $email === 'aministrador@wallet.com') {
                        $es_administrador = true;
                    }
                    if ($es_administrador) {
                        //Mostrar admin
                        echo '
                            <li class="nav-item">
                                <a class="nav-link" href="verU.php">Mostrar Usuarios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="verTU.php">Mostrar Tarjetas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="document.querySelector(\'form[name=\\\'logout-form\\\']\').submit(); return false;">Cerrar Sesión</a>
                                <form name="logout-form" action="" method="post" style="display: none;">
                                    <input type="hidden" name="cerrar_sesion">
                                </form>
                            </li>
                            <li>.....................................................................................................................................</li>
                            <li class="nav-item">
                                <span class="nav-link">Bienvenido, ' . $username . '</span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link">' . $email . '</span>
                            </li>
                        ';
                    } else {
                        // Mostrar usuarios
                        echo '
                            <li class="nav-item">
                                <a class="nav-link" href="anadirT.php">Añadir Tarjeta</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="verT.php">Ver Tarjeta</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="verP.php">Ver Perfil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="document.querySelector(\'form[name=\\\'logout-form\\\']\').submit(); return false;">Cerrar Sesión</a>
                                <form name="logout-form" action="" method="post" style="display: none;">
                                    <input type="hidden" name="cerrar_sesion">
                                </form>
                            </li> 
                            <li>..........................................................................................................................................................</li>
                            <li class="nav-item">
                                <span class="nav-link">Bienvenido, ' . $username . '</span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link">' . $email . '</span>
                            </li>
                        ';
                    }
                    } else {
                    // Usuario no ha iniciado sesión
                    echo '
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="crearC.php">Crear Cuenta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="iniciarS.php">Iniciar Sesión</a>
                        </li>
                    ';
                }
                ?>
                </ul>
            </div>
        </div>
    </nav>
</head>
<body>
    <?php
        if (isset($_SESSION['email'])) {
            $username = $_SESSION['username'];
            $email = $_SESSION['email'];
            $es_administrador = false;
            if ($username === 'admin' && $email === 'aministrador@wallet.com') {
                $es_administrador = true;
            }
            if ($es_administrador) {
                //muestra admin
                echo '
                <style>
                .card {
                    width: 300px;
                    border: 1px solid #ccc;
                    border-radius: 10px;
                    padding: 20px;
                    margin-bottom: 20px;
                }
                
                .card-title {
                    text-align: center;
                    margin-bottom: 10px;
                }
                
                .card-image {
                    text-align: center;
                }
                
                .card-image img {
                    max-width: 100%;
                    height: auto;
                }
            </style>
            <div class="container">
            <div class="row justify-content-start mt-4">
                <div class="col-1">
                <div class="card" style="width: 20rem;left: 24rem;">
                    <h2 class="card-title">Wallet Digital</h2>
                    <div class="card-image">
                        <img src="images/logo.png" height="50 px" width="50 px";"Wallet Digital">
                    </div>
                </div>
                
                <div class="card" style="width: 20rem;left: 24rem;">
                    <h2 class="card-title">BIENVENIDO<br>ADMINISTRADOR</h2>
                    <div class="card-image">
                        <img src="images/admin.png" alt="Card Image">
                        </div>
                </div>
                </div>
                </div>
                </div>
                ';
            } else {
                // Muestra usuarios
                echo '
                <style>
                .card {
                    width: 300px;
                    border: 1px solid #ccc;
                    border-radius: 10px;
                    padding: 20px;
                    margin-bottom: 20px;
                }
                
                .card-title {
                    text-align: center;
                    margin-bottom: 10px;
                }
                
                .card-image {
                    text-align: center;
                }
                
                .card-image img {
                    max-width: 100%;
                    height: auto;
                }
            </style>
            <div class="container">
            <div class="row justify-content-start mt-4">
                <div class="col-1">
                <div class="card" style="width: 20rem;left: 24rem;">
                    <h2 class="card-title">Wallet Digital</h2>
                    <div class="card-image">
                        <img src="images/logo.png" height="50 px" width="50 px";"Wallet Digital">
                    </div>
                </div>
                
                <div class="card" style="width: 20rem;left: 24rem;">
                    <h2 class="card-title">BIENVENIDO<br>USUARIO</h2>
                    <div class="card-image">
                        <img src="images/usuario.png" alt="Card Image">
                        </div>
                </div>
                </div>
                </div>
                </div>
                ';
            }
            } else {
            // Usuario no ha iniciado sesión
            echo '
            ';
        }
    ?>

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
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
