<?php 
 
    session_start();
    
 
    require_once 'helpers.php';
    require_once 'controllers/loginController.php';

    // Redirigimos en el caso de que estemos logueados para evitar el acceso a esta página.
    if (check()) {
        redirect('bienvenido.php');
    }

    
    if ($_POST) {
        // Verificamos si el usuario ya existe en nuestra base de datos, y de ser así, que la contraseña sea la correcta.
        $verifica = verificaUsuario($_POST['email'], $_POST['password']);
        // Si efectivamente verificamos, guardamos en $_SESSION el usuario que se logueó y redirigimos a la página de bienvenidos.
        if ($verifica) {
            $_SESSION['usuario'] = traerUsuario($_POST['email']);
            redirect('bienvenido.php');

        if ($_POST['remember'] === true) {
            $cookie_name='username';
            $cookie_value= '';

            $expira =  time() + 3600;
            setcookie('username',$cookie_value,$expira); }    
        
        } else {
            // De no ser así, guardamos un error en el array de errores
            $errores['email'] = "Usuario o contraseña incorrecto";
        }
    }
    
?>




<!-- Inicia formulario OJO VER COMO COMPARTIR EL HEAD -->

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c:300,400,500,700" rel="stylesheet">
        <link rel="stylesheet" href="css/styles.css">
        <title>Eccomerce</title>
    </head>

    <body>
        <!-- HEADER -->
        <?php require_once "parts/_header.php"; ?>

        <!-- LOGIN -->
        <div class="mainPage">
            <div class="mainContainer">
                <div class="mainLogin">

                    <h1 class="tituloLogin">Login</h1>

                </div>

                <form class="mainFormLogin" action="" method="post">

                    <div class="infoSpaceLogin">
                        <label for="email"></label>
                        <input class="inputMail2" type="email" placeholder="Direccion de email" name="email" required>
                    </div>
                    <div class="infoSpaceLogin">
                        <label for="password"></label>
                        <input class="inputContraseña2" type="password" placeholder="Contraseña" name="password" required>
                    </div>
                    <?php
                    // Si hay errores, los mostramos.
                    if(isset($errores) && count($errores) > 0): ?>
                    
                    <div>
                    <ul>
                        <?php foreach ($errores as $value): ?>
                        <li><?= $value ?></li>
                        <?php endforeach; ?>
                    </ul>
                    </div>

                    <?php endif; ?>

                    <div class="infoRememberMe">
                        <label class="rememberMe" for="remember">Recordar mis datos</label>
                        <input class="checkRemember" type="checkbox" name="remember">
                    </div>
                    <button class="buttonSendLogin" type="submit">Ingresar</button>
                    <div class="olvidoUsuarioContraseña">
                        <a href="" class="olvidoUsuario">¿Olvidaste tu usuario o contraseña?</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- FIN LOGIN -->
        
        <!-- FOOTER -->
        <?php require_once "parts/_footer.php"; ?>

    </body>
</html>