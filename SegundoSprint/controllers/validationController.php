<?php

    // Validamos todos los datos del usuario, recibimos un array usuario para analizar.
    function validarRegister ($usuario)
    {
        $errores = [];

        // Nos fijamos que la posición exista dentro de nuestro array.
        if (isset($usuario['username'])) {

            // En caso de existir, nos fijamos que no sea un string vacio.
            if (empty($usuario['username'])) {
                $errores['username'] = 'El usuario está vacío.';

            // Si no, nos fijamos que el largo sea menor a 4
            } elseif (strlen($usuario['username']) < 4) {
                $errores['username'] = 'El usuario debe tener 4 caracteres o más.';

            // Si no, nos fijamos que el largo sea mayor a 15
            } elseif (strlen($usuario['username']) > 15) {
                $errores['username'] = 'El usuario debe tener 15 caracteres o menos.';

            // Si no, nos fijamos que contenga al menos una mayúscula
            } elseif ($usuario['username'] === strtolower($usuario['username'])) {
                $errores['username'] = 'El usuario no tiene mayúsculas.';
            }
        }

        // Nos fijamos que la posición exista dentro de nuestro array.
        if (isset($usuario['email'])) {

            // En caso de existir, nos fijamos que no sea un string vacio.
            if (empty($usuario['email'])) {
                $errores['email'] = 'El email está vacío.';

            // Si no, nos fijamos que el correo tenga formato valido (algo@algo.algo)    
            } elseif (!filter_var($usuario['email'], FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = 'El email no es correcto';
            }
        }

        // Nos fijamos que la posición exista dentro de nuestro array.
        if (isset($usuario['password'])) {
            
            // En caso de existir, nos fijamos que no sea un string vacio.
            if (empty($usuario['password'])) {
                $errores['password'] = 'El password está vacío.';

            // Si no, nos fijamos que el largo sea menor a 8    
            } elseif (strlen($usuario['password']) < 8) {
                $errores['password'] = 'El password debe tener 8 caracteres o más.';

            // Si no, nos fijamos que el largo sea mayor a 16
            } elseif (strlen($usuario['password']) >= 16) {
                var_dump(strlen($usuario['password']));exit;
                $errores['password'] = 'El password debe tener 15 caracteres o menos.';
            }
        }
        
        // Validamos la foto que recibimos, nos fijamos que se haya subido bien.
        if (!validarFoto($_FILES['fotoPerfil'])) {
            $errores['fotoPerfil'] = 'Hubo un error al subir la foto.';
        }

        return $errores;
    }


    // Nos fijamos que la foto no tenga errores.
    function validarFoto ($foto)
    {
        if ($foto["error"] !== UPLOAD_ERR_OK) {
            return false; 
        }
        return true;
    }


?>