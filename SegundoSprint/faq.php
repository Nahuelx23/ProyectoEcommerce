<?php

session_start();

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

        <!-- PREGUNTAS -->
        <main>
            <section class="container">            
                <article class="faq">

                    <h2> Preguntas Frecuentes</h2>

                    <ol>
                        <li>
                            <strong>¿Cómo realizo la compra?</strong>
                            <p> Para realizar una compra necesitás estar registrado como usuario de NoBasic. Una vez registrado elegí los
                                productos que te gusten presionando el ícono del carrito para incorporarlo a tu compra. Cuando termines
                                de elegir productos, presioná el carrito de compras que se encuentra en el navegador en la parte superior,
                                elegí la forma de pago y las condiciones de entrega.</p>
                        </li>

                        <li>
                            <strong>¿Cómo sé si un producto está en stock?</strong>
                            <p> Todos los productos que están en la página están disponibles. Cuando detectamos que falta stock de un producto
                                lo retiramos de la página..</p>
                        </li>

                        <li>
                            <strong>¿cómo realizo el pago?</strong>
                            <p> Una vez elegidos los productos presioná el carrito de compras de la parte superior y elegí la tarjeta de
                                crédito, débito con la que quieras pagar ó el sistema de Pago Fácil. Completá los datos y la entrega
                                comienza a ponerse en ejecución.</p>
                        </li>

                        <li>
                            <strong>¿cómo rastreo el envío?</strong>
                            <p> Una vez realizado el pago te llegará un mail con el código de compra. Al ingresar a tu cuenta en la página
                                ese código mostrará el estado del trámite. Cuando figure como PRONTA ENTREGA significa que el producto
                                llegará en 24hs.</p>
                        </li>

                        <li>
                            <strong>¿cómo realizo un cambio?</strong>
                            <p> Tenés 72hs para verificar el buen estado del producto. Si está defectuoso ó no cumple con las condiciones
                                de venta enviá un mensaje al +54 911 4589 9023 indicando el Código de Compra y el motivo. Nos comunicaremos
                                para retirar y entregar el nuevo producto.</p>
                        </li>
                    </ol>
                </article>

                <div class="volver">
                    <a href="faq.php">
                        <i class="fas fa-angle-double-up fa-2x"></i>
                    </a>
                </div>
            </section>
        </main>
        <!-- FIN DE PREGUNTAS -->   

        <!-- FOOTER -->
        <?php require_once "parts/_footer.php"; ?>

    </body>
</html>
