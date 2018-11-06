<?php

  ini_set('xdebug.var_display_max_depth', '10');
  ini_set('xdebug.var_display_max_children', '256');
  ini_set('xdebug.var_display_max_data', '1024');

class MySQL extends Database {

    public function __construct() {
        
    }
    public function traerUsuarios() {

    }

    public function guardarUsuario(User $usuario) {

        $host = 'mysql:host=localhost;dbname=nobasic;port=3306';
        $db_user = 'root';
        $db_pass = '';
        $database = 'nobasic';
        $tabla = 'usuarios';
        $opt = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];
       
        $user = [
            "username" => $usuario->getUsername(),
            "email" => $usuario->getEmail(),
            "password" => $usuario->getPassword(),
            "fotoPerfil" => $usuario->getFotoPerfil()
        ];

        $username = $user['username'];
        $email = $user['email'];
        $password = $user['password'];
        $fotoPerfil = $user['fotoPerfil'];

        try {
           $con = new PDO($host,$db_user,$db_pass,$opt);
           $sql = "INSERT INTO $tabla(username, email, password, fotoPerfil) VALUES ('$username','$email','$password','$fotoPerfil')";
         
           $query = $con->prepare($sql);
           $query->execute();
               
           }
           catch (PDOException $e) {
           echo $sql.'<br'.$e->getMessage();
           }    
                 
       $con=null;      
                    
     }
    
    public function traerUsuario(String $email) {
        $host = 'mysql:host=localhost;dbname=nobasic;port=3306';
        $db_user = 'root';
        $db_pass = '';
        $database = 'nobasic';
        $tabla = 'usuarios';
        $opt = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];
        
        try {
         $con = new PDO($host,$db_user,$db_pass,$opt);
         $query=$con->prepare("SELECT * FROM $tabla WHERE email LIKE '$email' ");
          
        $query->execute();
        $resultado=$query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($resultado as $key => $value){
            $actual = $resultado[$key];
            $usuario = [];
            foreach($actual as $key1 =>$value1){
                $usuario[$key1] = $value1;        
            }                    
            return new User($usuario['username'], $usuario['email'], $usuario['password'], $usuario['fotoPerfil']);   
        }
           
        }       
        catch (PDOException $e) {
            echo $sql.'<br'.$e->getMessage();
        }    
                  
        $con=null;        
    }

    public function modificarDatos()
    {
        $host = 'mysql:host=localhost;dbname=nobasic;port=3306';
        $db_user = 'root';
        $db_pass = '';
        $database = 'nobasic';
        $tabla = 'usuarios';
        $opt = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];
    
     try {
        
        $con = new PDO($host,$db_user,$db_pass,$opt); 
        $usuario = null;     
         foreach($_POST as $campo => $valor){
            if($valor !=""){

                $sql = 'UPDATE ' . $tabla . ' SET ' . $campo . ' = "' . $valor . '" WHERE email LIKE "' . $_SESSION['usuario']->getEmail() . '" ';
                $stml = $con->prepare($sql);
                $stml->execute();
            }
        }
        return $usuario = $this->traerUsuario($_SESSION['usuario']->getEmail()); 
       }
          
    catch (PDOException $e) {
           echo $sql.'<br'.$e->getMessage();
       }    
                 
       $con=null;     
    }
}

?>