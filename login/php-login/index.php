<?php
session_start();

require 'database.php';

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM usuarios WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;
   
    if (count($results) > 0) {
        $user = $results;
    }
}
?>


<!DOCTYPE html>
<html> 
<head>
<meta charset="utf-8">
<title>Guias Valorant</title>
<link rel="stylesheet" type="text/css" href="assets/css/estilos.css">
</head>
<body>


<?php require 'partials/header.php' ?>

<?php if(!empty($user)): ?>
    <br>Welcome. <?=$user['email'] ?>
    <br>Estas logeado
    <a href="logout.php">
        Logout
        </a>
<?php else: ?>


<h1>Bienvenido a Guias Valorant!</h1> 

<a href="login.php">Login</a> o
<a href="registrarse.php">Registrarse</a>
<?php endif; ?>
</body>
</html>      