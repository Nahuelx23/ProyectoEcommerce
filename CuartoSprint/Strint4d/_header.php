<?php require_once 'helpers.php'?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c:300,400,500,700" rel="stylesheet">
        <link rel="stylesheet" href="css/estilos.css">

        <title>Eccomerce</title>
    </head>
<body>

    <!-- HEADER -->
    <div class="container">
        <header class="main-header">
            <nav class="nav-logo-icon">
                <div class="cajalogo">
                        <img src="imagenes/logo.png" alt="logotipo" class="logo">
                </div>

                <div class="nav-iconos">
                    <ul>
                        <?php if(guest()): ?>
                            <li><a href="register.php">Registrate</a></li>
                            <li><a href="login.php"><i class="fas fa-user"></i></a></li>
                            <li><i class="fas fa-cart-arrow-down"></i></li>
                        <?php else: ?>
                            <li><a href="bienvenido.php"><?= user()->getUsername(); ?></a></li>
                            <li><a href="logout.php">Logout</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <ul class="nav-menu">
                    <li class="active-menu"><a href="index.php">home</a></li>
                    <li><a href="shop.php">shop</a></li>
                    <li><a href="contacto.php">contacto</a></li>
                    <li><a href="faq.php">faq</a></li>
                </ul>

                <form class="buscador-completo" action="" method="post">
                    <input type="text" placeholder=" producto" name="producto">
                    <button type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </nav>
        </header>
    </div>
    <!-- FIN HEADER -->
