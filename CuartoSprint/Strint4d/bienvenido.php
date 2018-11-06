<?php 

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

if (guest()) {
    redirect('login.php');
}


require_once '_header.php'; 
?>

<div class="bienvenidoUsuario">
<nav class="bienvenidoRecuadro">


<h1 class="bienvenido">Bienvenido <?= user()->getUsername() ?></h1> 


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

