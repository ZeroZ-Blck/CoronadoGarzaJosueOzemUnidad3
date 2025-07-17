<?php
require_once 'db_wallet_digital.php';

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

# Inicia Código de EDITAR o MODIFICAR

if (isset($_POST['editar'])) 
{  
    $nombre = $_POST['nombre'];
    $username = $_POST['username'];
    $password = $_POST['pasword'];
    
    if(!empty($nombre) && !empty($username) && !empty($password))
    {  
        $sql = $cnnPDO->prepare(
            'UPDATE usuarios SET nombre = :nombre, username = :username, pasword = :pasword WHERE email = :email'
        );
        
        $sql->bindParam(':nombre', $nombre);
        $sql->bindParam(':username', $username);
        $sql->bindParam(':pasword', $password);
        $sql->bindParam(':email', $_SESSION['email']);

        $sql->execute();
        unset($sql);
        unset($cnnPDO);
        
        $_SESSION['username'] = $username;

        header("Location: verP.php");
        exit();
        
    }
}

# Termina Código de EDITAR o MODIFICAR
?>
<?php
# Código de BUSCAR

$GLOBALS['$nombre'] = "";
$GLOBALS['$username'] = "";
$GLOBALS['$email'] = "";
$GLOBALS['$pasword'] = "";

if (isset($_POST['buscar'])) {
	
	$email=$_POST['email'];

	$query = $cnnPDO->prepare('SELECT * from usuarios WHERE email =:email');
	$query->bindParam(':email', $email);
	
	$query->execute(); 
	$count=$query->rowCount();
	$campo = $query->fetch();

	if($count)	{	
        
		$GLOBALS['$nombre'] = $campo['nombre'];
        $GLOBALS['$username'] = $campo['username'];
		$GLOBALS['$email'] = $campo['email'];
		$GLOBALS['$pasword'] = $campo['pasword'];		
	} 
	else
		$GLOBALS['$email'] = "";	

}
# Termina Código de BUSCAR
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
      }
      .card {
        width: 300px;
        border: 1px solid #ccc;
        padding: 10px;
      }
      .card-image {
        text-align: center;
        margin-bottom: 10px;
      }
      .card-image img {
        width: 100px;
        height: 100px;
        object-fit: contain;
      }
      body{
        background-image: url(images/Wallpaper\ Anime.jpg);
      }
      nav{
        background-color: black;
      }
    </style>
</head>
<body>
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

<!-- Section Para publicar Imagenes -->
<section>
  <div class="container" style="width:80%;margin-top:90px;">
  <?php
    $sql = $cnnPDO->prepare("SELECT * FROM usuarios where email = :email");
    $sql->bindParam(':email', $_SESSION['email']);
    $sql->execute();
    ?>

    <div class="card-container">
      <?php
      while ($campo = $sql->fetch(PDO::FETCH_ASSOC)) {
      ?>
        <div class="card">
        <div class="card-head">
            <p class="card-head" align="center"><b>Foto de perfil:</b></p>
          </div><br>
          <div class="card-image">
            <p class="card-text"> <?php echo'<img class="rounded-circle" src="data:image/png;base64,' . base64_encode($campo['imagen']) . '" width="150px" height="150px"/>'; ?></p>
          </div><br>
          <div class="card-body">
            <form method="post" action="">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" placeholder="Ingrese su Nuevo Nombre" value="<?php echo $campo['nombre']; ?>">
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" placeholder="Ingrese su Nuevo Username" value="<?php echo $campo['username']; ?>">
            </div>                
            <p class="card-text"><b>Email:</b> <?php echo $campo['email']; ?></p>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" class="form-control" name="pasword" placeholder="Ingrese su Nueva Password" value="<?php echo $campo['pasword']; ?>">
            </div>               
            <div class="btn-group d-flex justify-content-center" role="group" aria-label="Botones">
            <button class="btn btn-secondary" name="editar" type="submit">
              <i class="fas fa-save"></i>
            </button>          
            </div>
            </form>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  

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