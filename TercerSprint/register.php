<?php 
// Requerimos los archivos necesarios.
require_once 'helpers.php';


// Redirigimos en el caso de que estemos logueados para evitar el acceso a esta página.
if (check()) {
    redirect('bienvenido.php');
}

// En el caso de que recibamos datos por POST y un archivo, registramos al usuario.
if ($_POST && $_FILES) {
    // Primero nos fijamos que el usuario no exista en la base de datos, de no existir, nos devuelve null.
    $usuarioViejo = $db->traerUsuario($_POST['email']);

    // Si el usuario efectivamente no se encontró, se procede a crear el usuario.
    if ($usuarioViejo === null) {
        // Creamos el usuario con los datos de $_POST
        $usuario = new User($_POST['username'], $_POST['email'], $_POST['password']);
        $usuario->setFotoPerfil($db->guardarFoto($_FILES['fotoPerfil']));
        
        // Validamos los datos del usuario que creamos anteriormente
        $errores = Validator::validarRegister($usuario);
        
        // Si en la validación no hubo errores, hasheamos la contraseña del usuario, lo guardamos en base de datos (json), iniciamos la sesión del mismo y redirigimos hacia la páginas de bienvenido.
        if (count($errores) === 0) {
            $usuario->setPassword(password_hash($usuario->getPassword(), PASSWORD_DEFAULT));
            $db->guardarUsuario($usuario);
            $_SESSION['usuario'] = $usuario;
            redirect('bienvenido.php');
        }
    } else {

        // De haberse encontrado el usuario, devolvemos un error.
        $errores['email'] = 'El email ya está usado.';
    }
}
?>

<?php require_once '_header.php'; ?>

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


<!-- REGISTRO --> 
<div class="mainPage">
        <div class="mainContainer">
            <div class="mainSignUp">
                <h1 class="tituloSignUp">Registro</h1>
            </div>

            <form class="mainFormSignUp" action="" method="post" enctype="multipart/form-data">

                <div class="infoSpaceSignUp">
                    <input class="inputNombre" type="text" placeholder="Nombre completo" name="username"  value="<?= (isset($errores['username'])) ? '' : old('username') ?>" required>
                    <!-- <input class="inputApellido" type="text" placeholder="Apellido" name="apellido" required> -->
                </div>
                <div class="infoSpaceSignUp">
                    <input class="inputMail" type="email" placeholder="Direccion de eMail" name="email" value="<?= (isset($errores['email'])) ? '' : old('email') ?>" required>
                </div>
                <!-- <div class="infoSpaceSignUp">
                    <input class="inputNacimiento" type="text" placeholder="Fecha de nacimiento (dd/mm/yyyy)" name="nombre" required>
                </div> -->
                <div class="infoSpaceSignUp">
                    <input class="inputContraseña" type="password" placeholder="Elija una contraseña" name="password" required>
                    <!-- <input class="inputReContraseña" type="password" placeholder="Repita su contraseña" name="reContraseña" required> -->
                </div>

                <label for="file">Foto de Perfil</label>
                <input type="file" name="fotoPerfil">

                <!-- <div class="infoSpaceSignUp">
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

                <!-- <div class="infoTerminosCondiciones">
                    <label class="terminosCondiciones" for="terminos">Acepto los terminos y condiciones</label>
                    <input class="checkTerminos" type="checkbox" name="terminos" required>
                </div> -->

                <button class="buttonSendSignIn" type="submit">Registrarme</button>
            </form>
        </div>
    </div>
    <!-- FIN REGISTRO --> 

<?php require_once '_footer.php'; ?>

