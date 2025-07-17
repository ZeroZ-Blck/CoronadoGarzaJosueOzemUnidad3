<?php
    require_once 'db_wallet_digital.php';
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
        border-radius: 5px;
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

    <!-- Section Para publicar Imagenes -->
    <section>
  <div class="container" style="width:80%;margin-top:90px;">
  <?php
    $sql = $cnnPDO->prepare("SELECT * FROM usuarios");

    $sql->execute();
    ?>

    <div class="card-container">
      <?php
      while ($campo = $sql->fetch(PDO::FETCH_ASSOC)) {
      ?>
        <div class="card">
          <div class="card-image">
            <img src="images/usuario.png" alt="Card Image">
          </div>
          <div class="card-body">
            <p class="card-text"><b>Nombre:</b> <?php echo $campo['nombre']; ?></p>
            <p class="card-text"><b>Nombre Usuario:</b> <?php echo $campo['username']; ?></p>
            <p class="card-text"><b>Email:</b> <?php echo $campo['email']; ?></p>
            <p class="card-text"><b>Password:</b> <?php echo $campo['pasword']; ?></p>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>
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