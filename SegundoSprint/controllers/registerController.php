<?php

require_once 'filesController.php';

// Creamos un array que va a representar a nuestro usuario y lo devolvemos.
function crearUsuario($username, $email, $password, $fecha, $fotoPerfil)
{
    $usuario = [
        "username" => $username,
        "email" => $email,
        "password" => $password,
        "fecha" => $fecha,
        "fotoPerfil" => guardarFoto($fotoPerfil)
    ];

    return $usuario;
}



?>