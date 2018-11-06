<?php

abstract class Database {
    abstract public function guardarUsuario(User $usuario);
    abstract public function traerUsuarios();
    abstract public function traerUsuario(String $email);

    public function guardarFoto(Array $fotoPerfil)
    {          
        $nombre = $fotoPerfil["name"];
         
        $archivo = $fotoPerfil["tmp_name"];
        
        $ext = pathinfo($nombre, PATHINFO_EXTENSION);
              
        $nombreFinal = uniqid() . "." . $ext;
                
        $miArchivo = realpath(dirname(__FILE__) . '/..');
        $miArchivo = $miArchivo . "/img/";
        $miArchivo = $miArchivo . $nombreFinal;
        
        move_uploaded_file($archivo, $miArchivo);
        
        return $nombreFinal;
    }    
}

?>