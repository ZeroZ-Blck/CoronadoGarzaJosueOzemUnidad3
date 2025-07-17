<?php
require_once 'db_wallet_digital.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

?>

<?php
# Inicia Código de REGISTRAR

if (isset($_POST['registrar'])) {
    $cuenta = $_POST['cuenta'];
    $banco = $_POST['banco'];
    $fecha_registro = $_POST['fecha_registro'];
    $saldo = 0;

    if (!empty($cuenta) && !empty($banco) && !empty($fecha_registro) && !empty($_SESSION['username'])) {
        $sql = $cnnPDO->prepare("INSERT INTO tarjetas 
        (cuenta, banco, fecha_registro, saldo, username) 
        VALUES (:cuenta, :banco, :fecha_registro, :saldo, :username)");
        
        $sql->bindParam(':cuenta', $cuenta);
        $sql->bindParam(':banco', $banco);
        $sql->bindParam(':fecha_registro', $fecha_registro);
        $sql->bindParam(':saldo', $saldo);
        $sql->bindParam(':username', $_SESSION['username']);
        
        $sql->execute();
        header("Location: index.php");
        exit();
    }
}
?>

<!-- Rest of the HTML code remains the same -->

<?php
# Código de BUSCAR

$GLOBALS['$cuenta'] = "";
$GLOBALS['$banco'] = "";
$GLOBALS['$fecha_registro'] = "";
$GLOBALS['$saldo'] = "";

if (isset($_POST['buscar'])) {
	
	$cuenta=$_POST['cuenta'];

	$query = $cnnPDO->prepare('SELECT * from tarjetas WHERE cuenta =:cuenta');
	$query->bindParam(':cuenta', $cuenta);
	
	$query->execute(); 
	$count=$query->rowCount();
	$campo = $query->fetch();

	if($count)	{	
        
		$GLOBALS['$cuenta'] = $campo['cuenta'];
        $GLOBALS['$banco'] = $campo['banco'];
		$GLOBALS['$fecha_registro'] = $campo['fecha_registro'];
		$GLOBALS['$saldo'] = $campo['saldo'];		
	} 
	else
		$GLOBALS['$cuenta'] = "";	

}
# Termina Código de BUSCAR
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registrar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
  <a class="navbar-brand" href="#">
    <img src="images/pngwing.com.png" alt="Logo" class="logo" height="30 px" width="30 px" >
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
</head>
<body>
    <style>
    body {
        background-image: url('images/Initial\ D\ \(2\).jpg');
        background-size: cover;
        background-position: center;
    }
    nav{
        background-color: black;
    }
    </style>
<section>
<div class="container">
    <div class="row justify-content mt-4">
        <div class="col-1">
            <div class="card" style="width: 20rem; left: 50rem;">
                <form name="form1" method="post"> 
                    <div class="card-body">
                        <h5 class="card-title" align="center">Wallet Digital</h5>
                        <div class="form-group">
                        
                    <div class="form-group">
                        <label for="cuenta">Cuenta:</label>
                        <input type="text" class="form-control" name="cuenta" placeholder="Ingrese su Cuenta" pattern="[0-9]+" required
                            value="<?php echo $GLOBALS['$cuenta']; ?>">
                            <br>
                    </div>
                    <div class="form-group">
                        <label for="cuenta">Banco:</label>
                        <input type="text" class="form-control" name="banco" placeholder="ingrese su Banco"
                            value="<?php echo $GLOBALS['$banco']; ?>">
                            <br>
                    </div>
                    <div class="form-group">
                        <label for="fecha_registro">Fecha Del Registro:</label>
                        <input type="date" class="form-control" name="fecha_registro" value="<?php echo date('Y-m-d'); ?>" required
                            value="<?php echo $GLOBALS['$fecha_registro']; ?>">
                            <br>
                    </div>
                        <div class="btn-group d-flex justify-content-center" role="group" aria-label="Botones">
                        <button type="submit" name="registrar" class="btn btn-primary" href="index.php" >Registrar</button>
                        <br>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  

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
