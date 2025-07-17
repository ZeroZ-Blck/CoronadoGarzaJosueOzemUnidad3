<?php
session_start();
require_once 'db_wallet_digital.php';

if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header("Location: iniciarS.php");
    exit;
}

if (isset($_POST['recuperar'])) {
    $email = trim($_POST['email']);

    $stmt = $cnnPDO->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user) {
        $token = bin2hex(random_bytes(16));
        $fecha = date("Y-m-d H:i:s");

        $update = $cnnPDO->prepare("UPDATE usuarios SET token_recuperacion = :token, fecha_token = :fecha WHERE email = :email");
        $update->bindParam(':token', $token);
        $update->bindParam(':fecha', $fecha);
        $update->bindParam(':email', $email);
        $update->execute();

        // Solo para pruebas: mostrar el token (normalmente se envía por correo)
        $_SESSION['recuperacion_email'] = $email;
        $_SESSION['codigo'] = $token;
        $mail->Host = 'smtp.ionos.mx';
        $mail->Username = 'no-reply@tudominio.mx';
        $mail->Password = 'contraseña';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('El correo no está registrado');</script>";
    }
}
?>

<!-- HTML simple -->
<!DOCTYPE html>
<html>
<head>
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
<div class="card p-4 shadow" style="width: 25rem;">
    <h4 class="mb-3 text-center">Recuperar contraseña</h4>
    <form method="post">
        <div class="form-group mb-3">
            <label>Correo electrónico</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button type="submit" name="recuperar" class="btn btn-primary w-100">Enviar código</button>
    </form>
</div>
</body>
</html>
