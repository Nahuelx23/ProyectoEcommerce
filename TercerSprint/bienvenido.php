<?php 
// Requerimos los archivos necesarios.
require_once 'helpers.php';
$session->mantenerSesion();
if ($_POST) {
    $usuario = $db->modificarDatos();
    if ($usuario instanceof User) {
        session_destroy();
        session_start();
        $_SESSION['usuario'] = $usuario;
    } else {
        dd('ERRORES:', $usuario);
    }
}
// Si no estamos logueados, redirigimos a login.php
if (guest()) {
    redirect('login.php');
}

// Requerimos los archivos necesarios.
require_once '_header.php'; 
?>

<div class="bienvenidoUsuario">
<nav class="bienvenidoRecuadro">

<!-- Mostramos un saludo personalizado hacia el usuario. -->
<h1 class="bienvenido">Bienvenido <?= user()->getUsername() ?></h1> 

<!-- <marquee> 
    <?php //for($i=0; $i < 14; $i++):
    //echo "Hola " . user()->getUsername(). "  ";
    //endfor; ?> 
</marquee> -->

<article class="bienvenidoDatos">
    <h3><?= user()->getUsername();?> </h3>
    <h4>Email: <?= user()->getEmail(); ?></h5>
    <img src="img/<?= user()->getFotoPerfil(); ?>" alt="">
</article>


<!-- MODIFICAR DATOS -->

<div class="mainPage2">
        <div class="mainContainer">
            
            <form class="mainFormLogin" action="" method="post">

                <div class="infoSpaceLogin">
                    <input class="inputMail2" type="text" placeholder="Usuario" name="username">
                </div>

                <div class="infoSpaceLogin">
                    <input class="inputMail2" type="email" placeholder="Direccion de eMail" name="email">
                </div>
                <div class="infoSpaceLogin">
                    <input class="inputContraseña2" type="password" placeholder="Contraseña" name="password">
                </div>
                
                <button class="buttonSendLogin" type="submit">Cambiar Datos</button>                
            </form>
        </div>
    </div>

    </nav>
    </div>

<?php require_once '_footer.php'; ?>

