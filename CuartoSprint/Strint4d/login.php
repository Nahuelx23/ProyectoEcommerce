<?php 
   
    require_once 'helpers.php';
    
    if (check()) {
        redirect('bienvenido.php');
    }
    
    if ($_POST) {
       
        $verifica = Validator::validarLogin($db, $_POST['email'], $_POST['password']);
        
        if ($verifica) {
            $usuario = $db->traerUsuario($_POST['email']);
            
            $session->crearSesion($usuario);

            redirect('bienvenido.php');
        } else {        
            $errores['email'] = "Usuario o contraseña incorrecto";
        }
    }    
    require_once '_header.php'; 
?>

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


<!-- LOGIN -->
<div class="mainPage">
        <div class="mainContainer">
            <div class="mainLogin">
                <h1 class="tituloLogin">Login</h1>
            </div>

            <form class="mainFormLogin" action="" method="post">

                <div class="infoSpaceLogin">
                    <input class="inputMail2" type="email" placeholder="Direccion de eMail" name="email" required value="<?= isset($_COOKIE['email']) ? $_COOKIE['email'] : ''; ?>"> <!-- De estar seteda la posición email, mostramos el email. -->
                </div>
                <div class="infoSpaceLogin">
                    <input class="inputContraseña2" type="password" placeholder="Contraseña" name="password" required>
                </div>
                <div class="infoRememberMe">
                    <label class="rememberMe" for="remember">Recordar mis datos</label>
                    <input class="checkRemember" type="checkbox" name="recordar" id="recordar">
                </div>

                <button class="buttonSendLogin" type="submit">Ingresar</button>

                <div class="olvidoUsuarioContraseña">
                    <a href="" class="olvidoUsuario">¿Olvidaste tu usuario o contraseña?</a>
                </div>
            </form>
        </div>
    </div>
    <!-- FIN LOGIN -->    

<?php require_once '_footer.php'; ?>

