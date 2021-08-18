<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Login</title>
</head>
<?php
// Si la sesion esta iniciada no se podra regresar al login otra vez
session_start();
if(!empty($_SESSION['us_tipo'])){
    header('Location: controlador/LoginControler.php');
}else{
    session_destroy();
?>
<body>
    <div class="contenedor">
        <div class="img">
            <div class="contenido-login">
                <form action="controlador/LoginControler.php" method="post">
                    <img src="img/logo.png" alt="">
                    <h2>Zapatería</h2>
                    <div class="input-div dni">
                        <div class="i">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="div">
                            <h5>NIT</h5>
                            <input type="text" name="user" class="input">
                        </div>
                    </div>
                    <div class="input-div pass">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">
                            <h5>Contraseña</h5>
                            <input type="password" name="pass" class="input">
                        </div>
                    </div>
                    <a href="">Creado</a>
                    <input type="submit" class="btn" value="Iniciar Sesión">
                </form>
            </div>
        </div>
    </div>
</body>
<script src="js/login.js"></script>
</html>
<?php
}
?>