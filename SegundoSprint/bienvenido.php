<?php 

session_start();


require_once 'helpers.php';

// Si no estamos logueados, redirigimos a login.php
if (guest()) {
    redirect('login.php');
}

// Requerimos los archivos necesarios.
require_once 'parts/_header.php';  					

?>


<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c:300,400,500,700" rel="stylesheet">
        <link rel="stylesheet" href="css/styles.css">
        <title>Eccomerce</title>
</head>

<main class="container">

    <div class="bienvenidoUsuario">
        <nav class="bienvenidoRecuadro">
            <h1 class="bienvenido">Bienvenido <?= user()['username'] . "" . "!" ?></h1>

            <article>
                <h3><?= user()['username'];?> </h3>
                <img src="img/<?= user()['fotoPerfil'] ?>" alt="">
                <h5>Email: <?= user()['email'] ?></h5>
            </article>
            <form method='get'>
            <button type='submit' name='editar' value=""><a href='editar.php'> Editar </a></button>
            </form>
        </nav>
    </div>

</main>	

<?php require_once 'parts/_footer.php'; ?>			

