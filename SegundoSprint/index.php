<?php 

session_start();

require_once 'helpers.php';


 ?>


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
        <!-- BANNER -->
        <?php require_once "parts/_banner.php"; ?>

         <!-- PRODUCTOS -->
        <main class="Contenedor">
            <h2>Sale Last Minutes</h2>
            <section class="NewAccesories">

                <article class="Productos">
                    <img src="images/productos/img1.jpg" alt="">
                    <i></i>
                    <i></i>
                    <h3>Mochila</h3>
                    <p>$900</p>
                    <a href="">Comprar</a>
                </article>
                <article class="Productos">
                    <img src="images/productos/img2.jpg" alt="">
                    <i></i>
                    <i></i>
                    <h3>Valija</h3>
                    <p>$2000</p>
                    <a href="">Comprar</a>
                </article>
                <article class="Productos">
                    <img src="images/productos/img3.jpg" alt="">
                    <i></i>
                    <i></i>
                    <h3>Reloj deportivo</h3>
                    <p>$1500</p>
                    <a href="">Comprar</a>
                </article>
                <article class="Productos ProdExt">
                <img src="images/productos/img10.jpg" alt="">
                <i></i>
                <i></i>
                <h3>Bolso</h3>
                <p>$1700</p>
                <a href="">Comprar</a>
            </article>
            <article class="Productos ProdExt">
                <img src="images/productos/img11.jpg" alt="">
                <i></i>
                <i></i>
                <h3>Anotador</h3>
                <p>$300</p>
                <a href="">Comprar</a>
            </article>
            </section>
            
            <section class="Btn-Ext">
            <a href="">More Products</a>
            </section>

            <h2>New Accesories</h2>
            <section class="NewAccesories">

                <article class="Productos">
                    <img src="images/productos/img4.jpg" alt="">
                    <i></i>
                    <i></i>
                    <h3>Guantes de Cuero</h3>
                    <p>$700</p>
                    <a href="">Comprar</a>
                </article>
                <article class="Productos">
                    <img src="images/productos/img5.jpg" alt="">
                    <i></i>
                    <i></i>
                    <h3>Zapatillas</h3>
                    <p>$1300</p>
                    <a href="">Comprar</a>
                </article>
                <article class="Productos">
                    <img src="images/productos/img6.jpg" alt="">
                    <i></i>
                    <i></i>
                    <h3>Billetera</h3>
                    <p>$600</p>
                    <a href="">Comprar</a>
                </article>
                <article class="Productos ProdExt">
                <img src="images/productos/img14.jpg" alt="">
                <h3>Riñonera</h3>
                <p>$600</p>
                <a href="">Comprar</a>
            </article>
            <article class="Productos ProdExt">
                <img src="images/productos/img13.jpg" alt="">
                <h3>Porta</h3>
                <p>$400</p>
                <a href="">Comprar</a>
            </article>
            </section>

            <section class="Btn-Ext">
            <a href="">More Products</a>
            </section>

            <section class="Best Sellers">
                <h2>Best Sellers</h2>
                <section class="NewAccesories">

                    <article class="Productos">
                        <img src="images/productos/img7.jpg" alt="">
                        <i></i>
                        <i></i>
                        <h3>Gorro</h3>
                        <p>$250</p>
                        <a href="">Comprar</a>
                    </article>
                    <article class="Productos">
                        <img src="images/productos/img8.jpg" alt="">
                        <i></i>
                        <i></i>
                        <h3>Go Pro</h3>
                        <p>$3500</p>
                        <a href="">Comprar</a>
                    </article>
                    <article class="Productos">
                        <img src="images/productos/img9.jpg" alt="">
                        <i></i>
                        <i></i>
                        <h3>Funda Laptop</h3>
                        <p>$550</p>
                        <a href="">Comprar</a>
                    </article>
                    <article class="Productos ProdExt">
                    <img src="images/productos/img12.jpg" alt="">
                    <h3>Pulsera</h3>
                    <p>$900</p>
                    <a href="">Comprar</a>
                </article>
                <article class="Productos ProdExt">
                    <img src="images/productos/img15.jpg" alt="">
                    <h3>Guantes Abrigo</h3>
                    <p>$1200</p>
                    <a href="">Comprar</a>
                </article>
                </section>
            </section>
            
            <section class="Btn-Ext">
            <a href="">More Products</a>
            </section>
        
        </main>
        <!-- FIN DE PRODUCTOS -->

        <!-- FOOTER -->
        <?php require_once "parts/_footer.php"; ?>
    
    </body>
</html>