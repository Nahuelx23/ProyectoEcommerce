<?php
    require_once 'filesController.php';

    // Verificamos que el usuario exista en base de datos y su contraseña sea correcta
    function verificaUsuario($email, $password)
    {
        $usuario = traerUsuario($email);

        if ($usuario !== null) {
            return password_verify($password, $usuario['password']);
        }

        return false;
    }

?>