<?php
abstract class Database {
    abstract public function guardarUsuario(User $usuario);
    abstract public function traerUsuarios();
    abstract public function traerUsuario(String $email);

    // Guardamos la foto, recibimos como parámetro la misma. Si nuestra foto en el input se llamaba "montoto" entonces le pasamos como parámetro $_FILES['montoto']
    public function guardarFoto(Array $fotoPerfil)
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
}

?>