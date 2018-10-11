<?php
abstract class Validator {
    
    // Validamos todos los datos del usuario, recibimos un array usuario para analizar.
    public static function validarRegister (User $usuario)
    {
        $errores = [];
        
        /*
         *  Podemos hacer esto que hacemos abajo de usar $usuario->getAlgo() en cada if o podríamos para ser más performantes, usar lo siguiente
         * $user = [
         *    'username' => $usuario->getUsername(),
         *    'email' => $usuario->getEmail(),
         *    'password' => $usuario->getPassword(),
         *    'fotoPerfil' => $usuario->(),
         * ];
         * 
         * y luego llamar a $user['algo'] ahorrandonós procesamiento en conseguir los datos cada vez.
         */


        // En caso de existir, nos fijamos que no sea un string vacio.
        if (empty($usuario->getUsername())) {
            $errores['username'] = 'El usuario está vacío.';
            
            // Si no, nos fijamos que el largo sea menor a 4
        } elseif (strlen($usuario->getUsername()) < 4) {
            $errores['username'] = 'El usuario debe tener 4 caracteres o más.';
            
            // Si no, nos fijamos que el largo sea mayor a 15
        } elseif (strlen($usuario->getUsername()) > 15) {
            $errores['username'] = 'El usuario debe tener 15 caracteres o menos.';
            
            // Si no, nos fijamos que contenga al menos una mayúscula
        } 
        // elseif ($usuario->getUsername() === strtolower($usuario->getUsername())) {
        //     $errores['username'] = 'El usuario no tiene mayúsculas.';
        // }
        
        
        // En caso de existir, nos fijamos que no sea un string vacio.
        if (empty($usuario->getEmail())) {
            $errores['email'] = 'El email está vacío.';
            
            // Si no, nos fijamos que el correo tenga formato valido (algo@algo.algo)    
        } elseif (!filter_var($usuario->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'El email no es correcto';
        }
        
        
        // En caso de existir, nos fijamos que no sea un string vacio.
        if (empty($usuario->getPassword())) {
            $errores['password'] = 'El password está vacío.';
            
            // Si no, nos fijamos que el largo sea menor a 8    
        } elseif (strlen($usuario->getPassword()) < 8) {
            $errores['password'] = 'El password debe tener 8 caracteres o más.';
            
            // Si no, nos fijamos que el largo sea mayor a 16
        } //elseif (strlen($usuario->getPassword()) >= 16) {
            //$errores['password'] = 'El password debe tener 15 caracteres o menos.';
        //}
        
        // Validamos la foto que recibimos, nos fijamos que se haya subido bien.
        if ($_FILES && !self::validarFoto($_FILES['fotoPerfil'])) {
            $errores['fotoPerfil'] = 'Hubo un error al subir la foto.';
        }
        
        return $errores;
    }
    
    
    // Nos fijamos que la foto no tenga errores.
    public static function validarFoto (Array $foto)
    {
        if ($foto["error"] !== UPLOAD_ERR_OK) {
            return false; 
        }
        return true;
    }
    
    // Verificamos que el usuario exista en base de datos y su contraseña sea correcta
    public static function validarLogin(Database $db, String $email, String $password)
    {
        $usuario = $db->traerUsuario($email);
        
        if ($usuario !== null) {
            return password_verify($password, $usuario->getPassword());
        }
        
        return false;
    }
}


// $montoto = new Algo(); -> objeto -> $this
// Algo -> clase -> self

?>