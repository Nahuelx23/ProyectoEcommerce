<?php 
// Iniciamos la sesión
session_start();

// Requerimos los archivos necesarios.
require_once 'controllers/registerController.php'; 
require_once 'controllers/validationController.php'; 
require_once 'helpers.php';


// Redirigimos en el caso de que estemos logueados para evitar el acceso a esta página.
if (check()) {
    redirect('bienvenido.php');
}

// En el caso de que recibamos datos por POST y un archivo, registramos al usuario.
if ($_POST && $_FILES) {
    // Primero nos fijamos que el usuario no exista en la base de datos, de no existir, nos devuelve null.
    $usuarioViejo = traerUsuario($_POST['email']);

    // Si el usuario efectivamente no se encontró, se procede a crear el usuario.
    if ($usuarioViejo === null) {

        // Creamos el usuario con los datos de $_POST
        $usuario = crearUsuario($_POST['username'], $_POST['email'], $_POST['fecha'], $_POST['password'], $_FILES['fotoPerfil']);

        // Validamos los datos del usuario que creamos anteriormente
        $errores = validarRegister($usuario);
        
        // Si en la validación no hubo errores, hasheamos la contraseña del usuario, lo guardamos en base de datos (json), iniciamos la sesión del mismo y redirigimos hacia la páginas de bienvenido.
        if (count($errores) === 0) {
            $usuario['password'] = password_hash($usuario['password'], PASSWORD_DEFAULT);
            guardarUsuario($usuario);
            $_SESSION['usuario'] = $usuario;
            redirect('bienvenido.php');
        }
    } else {

        // De haberse encontrado el usuario, devolvemos un error.
        $errores['email'] = 'El email ya está usado.';
    }
}
?>

<!-- BOORE EL REQUIRE ONCE -->



<!-- Inicio de formulario OJO QUE EL HEAD DEBERIA SER CON INCLUDE-->
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

        <!-- REGISTRO --> 
        <div class="mainPage">
            <div class="mainContainer">
                <div class="mainSignUp">
                    <h1 class="tituloSignUp">Registro</h1>
                </div>

                <form class="mainFormSignUp" action="" method="post" enctype="multipart/form-data">
                    <label for="file">Foto de Perfil</label>
                    <input type="file" name="fotoPerfil">
                    
                    
                    <label for="username" class="infoSpaceSignUp"></label>
                    <input class="inputNombre" type="text" placeholder="Nombre de usuario" name="username" required value="<?= (isset($errores['username'])) ? '' : old('username');
                    ?>">
                    
                            
                    <label for="email" class="infoSpaceSignUp"></label>
                    <input class="inputMail" type="email" placeholder="Direccion de eMail" name="email" required value="<?= (isset($errores['email'])) ? '' : old('email') ?>">
                    
                    <label for="fecha" class="infoSpaceSignUp"></label>
                    <input class="inputNacimiento" type="date" placeholder="Fecha de nacimiento (dd/mm/yyyy)" name="fecha" required value="<?=old('fecha');
                    ?>">
                    
            
                    <label for="password" class="infoSpaceSignUp"></label>
                    <input class="inputContraseña" type="password" placeholder="Elija una contraseña" name="password" required>
                   
                    <label for="rePassword" class="infoSpaceSignUp"></label>
                    <input class="inputReContraseña" type="password" placeholder="Repita su contraseña" name="rePassword" required>
                    

                  <!--  <div class="infoSpaceSignUp">
                        <div class="infoSpaceGenero">
                            <legend class="textGenero">Género:</legend>
                        </div>
                        <div class="infoSpaceGenero">
                            <div class="generoButtons">
                                <label for="masculino">Masculino</label>
                                <input type="radio" name="genero" value="masculino">
                                <br>
                                <label for="femenino">Femenino</label>
                                <input type="radio" name="genero" value="femenino">
                                <br>
                                <label for="otro">Otro</label>
                                <input type="radio" name="genero" value="otro">
                            </div>
                        </div>
                    </div> -->

                    <div class="infoTerminosCondiciones">
                        <label class="terminosCondiciones" for="terminos">Acepto los terminos y condiciones</label>
                        <input class="checkTerminos" type="checkbox" name="terminos" required>
                    </div>

                    
                    <?php 
                    // Mostramos los errores
                    if(isset($errores) && count($errores) > 0): ?>
                    <div>
                    <ul>
                    <?php foreach ($errores as $value): ?>
                    <li><?= $value ?></li>
                    <?php endforeach; ?>
                    </ul>
                    </div>
                    <?php endif; ?>
                

                    <button class="buttonSendSignIn" type="submit">Registrarse</button>
                
                </form>
            </div>
        </div>
        <!-- FIN REGISTRO --> 

        <!-- FOOTER -->
        <?php require_once "parts/_footer.php"; ?>

    </body>
</html>