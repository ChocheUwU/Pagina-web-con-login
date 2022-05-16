<?php
require 'database.php';

$message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])){
  $sql = "INSERT INTO usuarios (email, password) VALUES (:email, :password)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':email', $_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $stmt->bindParam(':password', $password);

  if($stmt->execute()){
      $message = 'Usuario Creado Correctamente';
  } else {
    $message = 'Lo siento a ocurrido un error creando su contraseña';
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
  </head>
<body>
    <?php require 'partials/header.php' ?>
    
    <?php if(!empty($message)): ?>
    <p><?= $message ?></p>
    <?php endif; ?>

    <h1>Registrarse</h1>
    <span>o <a href="login.php">Login</a></span>

    <form action="registrarse.php" method="POST">
      <input name="email" type="text" placeholder="Ingrese su correo">
      <input name="password" type="password" placeholder="Ingrese su contraseña">
      <input name="confirm_password" type="password" placeholder="Confirme su contraseña ">
      <input type="submit" value="Registrarse">
    </form>
   </form>
  </body>
</html>