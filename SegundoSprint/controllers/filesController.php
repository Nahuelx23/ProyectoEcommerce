<?php


// Guardamos la foto, recibimos como parámetro la misma. Si nuestra foto en el input se llamaba "montoto" entonces le pasamos como parámetro $_FILES['montoto']
function guardarFoto($fotoPerfil)
{

    // Ponemos el nombre original de la foto en una variable.
    $nombre = $fotoPerfil["name"];

    // Ponemos el nombre nuevo en otra variable (el que php pone en la carpeta /tmp).
    $archivo = $fotoPerfil["tmp_name"];

    // Ponemos la extensión del archivo en una variable.
    $ext = pathinfo($nombre, PATHINFO_EXTENSION);

    // Generamos el nuevo nombre de la imagen usando un id único con la función uniqid
    $nombreFinal = uniqid() . "." . $ext;

    // Generamos el nuevo path completo de la imagen, usando realpath para permitirnos volver una carpeta hacia atrás.
    $miArchivo = realpath(dirname(__FILE__) . '/..');
    $miArchivo = $miArchivo . "/img/";
    $miArchivo = $miArchivo . $nombreFinal;

    // Movemos el archivo de nuestro /tmp a la nueva locación (en este caso, la carpeta /img)
    move_uploaded_file($archivo, $miArchivo);

    return $nombreFinal;
}

// Guardamos el usuario en la base de datos (json), recibimos como parámetro un array Usuario
function guardarUsuario($usuario)
{
    // Convertimos el usuario array a json
    $usuarioJson = json_encode($usuario);

    // Guardamos el json a un archivo de texto, agregandole PHP_EOL para que se agregue una nueva linea al final. Le pasamos como parámetro FILE_APPEND para que el texto se agregue y no se pise todo.
    file_put_contents('usuarios.txt', $usuarioJson . PHP_EOL, FILE_APPEND);
}


// Traemos todos los usuarios de la base de datos.
function traerUsuarios()
{
    $arrayUsuarios = [];

    // Abrimos el archivo en modo lectura.
    $archivo = fopen('usuarios.txt', 'r');

    // Recorremos linea por linea el archivo y vamos decodificando cada JSON a un Array, para luego agregarlos al arrayUsuarios
    while(($linea = fgets($archivo)) !== false) {
        $arrayUsuarios[] = json_decode($linea, true);
    }

    // Cerramos el archivo
    fclose($archivo);

    return $arrayUsuarios;
}

// Hacemos lo mismo que en la función anterior, excepto que en este caso, en vez de guardar los usuarios en un array, los vamos leyendo uno por uno hasta encontrar el correcto y lo devolvemos.
// En caso de no encontrar nada, devuelve null.
function traerUsuario($email)
{
    $usuario = null;

    $archivo = fopen('usuarios.txt', 'r');

    while(($linea = fgets($archivo)) !== false) {
        $usuarioActual = json_decode($linea, true);

        if ($usuarioActual['email'] === $email) {
            $usuario = $usuarioActual;
            break;
        }
    }

    fclose($archivo);

    return $usuario;
}

// CLAUDIA - NO FUNCIONA
function reemplazarUsuario($email)
{
    $usuario = null;

    $archivo = fopen('usuarios.txt', 'w');

    while(($linea = fgets($archivo)) !== false) {
        $usuarioActual = json_decode($linea, true);
        

        if ($usuarioActual['email'] === $email) {
            // Convertimos el usuario array a json         
            $usuarioJson = json_encode($usuario);
            $usuarioActual = $usuarioJson; 
            file_put_contents('usuarios.txt', $usuarioActual . PHP_EOL, FILE_APPEND);
            break;
        }
    }

    fclose($archivo);

    return $usuario;
}




?>