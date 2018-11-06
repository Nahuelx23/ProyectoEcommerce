<?php
abstract class Validator {
    
    public static function validarRegister (User $usuario)
    {
        $errores = [];
        
        if (empty($usuario->getUsername())) {
            $errores['username'] = 'El usuario está vacío.';
                        
        } elseif (strlen($usuario->getUsername()) < 4) {
            $errores['username'] = 'El usuario debe tener 4 caracteres o más.';
                     
        } elseif (strlen($usuario->getUsername()) > 15) {
            $errores['username'] = 'El usuario debe tener 15 caracteres o menos.';           
           
        } 
        
        if (empty($usuario->getEmail())) {
            $errores['email'] = 'El email está vacío.';
                        
        } elseif (!filter_var($usuario->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'El email no es correcto';
        }
        
        if (empty($usuario->getPassword())) {
            $errores['password'] = 'El password está vacío.';
            
            
        } elseif (strlen($usuario->getPassword()) < 8) {
            $errores['password'] = 'El password debe tener 8 caracteres o más.';
                       
        } 

        if ($_FILES && !self::validarFoto($_FILES['fotoPerfil'])) {
            $errores['fotoPerfil'] = 'Hubo un error al subir la foto.';
        }
        
        return $errores;
    }    
    
    public static function validarFoto (Array $foto)
    {
        if ($foto["error"] !== UPLOAD_ERR_OK) {
            return false; 
        }
        return true;
    }
    
    public static function validarLogin(Database $db, String $email, String $password)
    {
        $usuario = $db->traerUsuario($email);
        
        if ($usuario !== null) {
            return password_verify($password, $usuario->getPassword());
        }
        
        return false;
    }
}

?>