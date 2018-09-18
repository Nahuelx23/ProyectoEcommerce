<?php require_once 'helpers.php'; ?>

<div class="container">
    <header class="main-header">
        <nav class="nav-logo-icon">
            <div class="cajalogo">
                <img src="images/logo.png" alt="logotipo" class="logo">
            </div>

            <div class="nav-iconos">
                <ul>
                    <?php if(guest()): ?>
                    <li><a href="registro.php">Registrate</a></li>  
                    <li><a href="login.php"><i class="fas fa-user"></i></a></li>
                    <li><i class="fas fa-cart-arrow-down"></i></li>

                    <?php else: ?>
                    <li><a href="bienvenido.php"><?= user()['username']; ?></a></li>
                    <li><a href="logout.php">LOGOUT</a></li>
                    <li><i class="fas fa-cart-arrow-down"></i></li>

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