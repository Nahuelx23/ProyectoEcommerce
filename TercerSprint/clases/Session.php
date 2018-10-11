<?php
class Session {
    
    public function __construct() {
        session_start();
    }
    
    // Creamos la sesión. Recibimos como parámetro un array del tipo usuario
    public function crearSesion(User $usuario) {
        
        // Guardamos en la posición usuario de la superglobal SESSION, el array usuario de la persona a loguear.
        $_SESSION['usuario'] = $usuario;
        
        
        // Si marcaron el checkbox de recordar.
        if (isset($_POST['recordar'])) {
            
            // Seteamos el tiempo para las cookies usando Unix Epoch Time (googlear) que nos brinda la función time() y le agregamos 1 semana de tiempo.
            $time = time() + 3600 * 24 * 7;
            
            // Guardamos en la superglobal COOKIE, en la posición usuario, el usuario logueado convertido a JSON ya que no nos permite guardar arrays, usando de tiempo de vida la variable $time anterior.
            setcookie("usuario", json_encode($usuario), $time);
            
            // Guardamos en la superglobal COOKIE, en la posicion email, el email del usuario para que quede grabado en el input de login.
            setcookie("email", $usuario->getEmail(), $time);
        } else {
            
            // De no estar marcado recordar, por las dudas, eliminamos la posición email de la superglobal COOKIE.
            setcookie("email", null, time()-1);
        }
        
    }
    
    // Cerramos la sesión que abrimos antes.
    public function cerrarSesion() {
        
        // Una vez que sabemos que está iniciada, la destruímos.
        session_destroy();
        
        // Seteamos la cookie de usuario con valor null y tiempo en negativo.
        setcookie('usuario', null, time()-1);
    }
    
    // Teniendo en cuenta que vamos a guardar nuestro usuario en la cookie en formato json ya que no podemos guardar arrays, usamos esta función para leer las cookies. Recibe el nombre del campo a leer.
    public function leerCookie($campo) {
        
        // Si la cookie tiene la posición seteada.
        if (isset($_COOKIE[$campo])) {
            
            // Y además la posición seteada es un JSON
            if (json_decode($_COOKIE[$campo]) !== NULL) {
                
                // Decodificamos el JSON y lo devolvemos.
                return json_decode($_COOKIE[$campo], true);
            }
            
            // Si no es un JSON, devolvemos el valor.
            return $_COOKIE[$campo];
        }
        
        // Si no, devolvemos false.
        return false;
    }
    
    // Mantenemos la sesión abierta.
    public function mantenerSesion() {
        
        // Si la cookie está creada (se loguearon con anterioridad marcando "recordarme") pero session no está (cerraron el navegador).
        if (isset($_COOKIE['usuario']) && !isset($_SESSION['usuario'])) {
            
            // Regeneramos la sesión usando la cookie anterior.
            $_SESSION['usuario'] = leerCookie('usuario');
            
            // Ya que regeneramos la sesión, regneramos la cookie también (volvemos a setearla pero con nuevo tiempo).
            setcookie('usuario', $_COOKIE['usuario'], time()+3600*24*7);
        }
    }
}

?>