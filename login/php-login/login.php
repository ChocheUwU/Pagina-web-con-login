<?php

session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
  }

require 'database.php';

if (!empty($_POST['email']) && !empty($_POST['password'])){
    $records = $conn->prepare('SELECT id, email, password FROM usuarios WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])){
        $_SESSION['user_id'] = $results['id'];
        header("Location: /php-login");

    } else {
        $message = 'Lo siento, las credenciales no coinciden';
    }
}

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

<?php require 'partials/header.php' ?>

<?php if(!empty($message)): ?>
    <p>
        <?= $message ?>
    </p>
    <?php endif; ?>

<h1>Login</h1>
<span>o <a href="Registrarse.php">Registrarse</a></span>

<form action="login.php" method="POST">
<input name="email" type="text" placeholder="Ingrese su Correo">
<input name="password" type="password" placeholder="Ingrese su Contraseña">
<input type="submit" value="Ingresar">
</form>

</body>
</html>