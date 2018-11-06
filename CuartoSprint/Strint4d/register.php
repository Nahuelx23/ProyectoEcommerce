<?php 

require_once 'helpers.php';

if (check()) {
    redirect('bienvenido.php');
}

if ($_POST && $_FILES) {
    
    $usuarioViejo = $db->traerUsuario($_POST['email']);

    if ($usuarioViejo === null) {
       
        $usuario = new User($_POST['username'], $_POST['email'], $_POST['password']);
        $usuario->setFotoPerfil($db->guardarFoto($_FILES['fotoPerfil']));
        
       
        $errores = Validator::validarRegister($usuario);
        

        if (count($errores) === 0) {
            $usuario->setPassword(password_hash($usuario->getPassword(), PASSWORD_DEFAULT));
            $db->guardarUsuario($usuario);
            $_SESSION['usuario'] = $usuario;
            redirect('bienvenido.php');
        }
    } else {

        $errores['email'] = 'El email ya está usado.';
    }
}
?>

<?php require_once '_header.php'; ?>

<?php 

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
                    
                </div>
                <div class="infoSpaceSignUp">
                    <input class="inputMail" type="email" placeholder="Direccion de eMail" name="email" value="<?= (isset($errores['email'])) ? '' : old('email') ?>" required>
                </div>
                
                <div class="infoSpaceSignUp">
                    <input class="inputContraseña" type="password" placeholder="Elija una contraseña" name="password" required>
                
                </div>

                <label for="file">Foto de Perfil</label>
                <input type="file" name="fotoPerfil">

                <button class="buttonSendSignIn" type="submit">Registrarme</button>
            </form>
        </div>
    </div>
    <!-- FIN REGISTRO --> 

<?php require_once '_footer.php'; ?>

