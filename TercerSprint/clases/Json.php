<?php
ini_set('xdebug.var_display_max_depth', '10');
ini_set('xdebug.var_display_max_children', '256');
ini_set('xdebug.var_display_max_data', '1024');
class Json extends Database {
    
    public $archivo;

    public function __construct(String $archivo) {
        $this->archivo = $archivo;
    }

    // Guardamos el usuario en la base de datos (json), recibimos como parámetro un array Usuario
    public function guardarUsuario(User $usuario)
    {

        $user = [
            "username" => $usuario->getUsername(),
            "email" => $usuario->getEmail(),
            "password" => $usuario->getPassword(),
            "fotoPerfil" => $usuario->getFotoPerfil()
        ];

        $usuarios = $this->traerUsuarios();
        $usuarios['usuarios'][] = $user;

        // Convertimos el usuario array a json
        $usuarioJson = json_encode($usuarios);
        
        // Guardamos el json a un archivo de texto, agregandole PHP_EOL para que se agregue una nueva linea al final. Le pasamos como parámetro FILE_APPEND para que el texto se agregue y no se pise todo.
        file_put_contents($this->archivo, $usuarioJson);
    }
    
    // Traemos todos los usuarios de la base de datos.
    public function traerUsuarios()
    {
        $arrayUsuarios = [];
        
        // Abrimos el archivo en modo lectura.
        $archivo = file_get_contents('usuarios.json');
        $arrayUsuarios = json_decode($archivo, true);
        
        return $arrayUsuarios;
    }
    
    // Hacemos lo mismo que en la función anterior, excepto que en este caso, en vez de guardar los usuarios en un array, los vamos leyendo uno por uno hasta encontrar el correcto y lo devolvemos.
    // En caso de no encontrar nada, devuelve null.
    public function traerUsuario($email)
    {
        $usuarios = $this->traerUsuarios();

        foreach ($usuarios['usuarios'] as $usuario) {
            if ($usuario['email'] === $email) {
                return new User($usuario['username'], $usuario['email'], $usuario['password'], $usuario['fotoPerfil']);                
            }
        }

        return NULL;
    }  
    
    public function modificarDatos()
    {
        $usuarios = $this->traerUsuarios();
        $usuarioFinal = null;


        foreach ($usuarios['usuarios'] as $posicion => $usuario) {
            if ($usuario['email'] === user()->getEmail()) {

                foreach ($_POST as $campo => $valor) {
                    if ($valor !== '') {
                        if ($campo === 'password') {
                            $usuarios['usuarios'][$posicion][$campo] = password_hash($valor, PASSWORD_DEFAULT);
                        } else {
                            $usuarios['usuarios'][$posicion][$campo] = $valor;
                        }
                    }
                }

                $usuarioFinal = new User($usuarios['usuarios'][$posicion]['username'], $usuarios['usuarios'][$posicion]['email'], $usuarios['usuarios'][$posicion]['password'], $usuarios['usuarios'][$posicion]['fotoPerfil']);
            }
        }

        if ($usuarioFinal !== null) {
            $validacion = Validator::validarRegister($usuarioFinal);   

            if (!$validacion) {
                file_put_contents($this->archivo, json_encode($usuarios));
                return $usuarioFinal;
            } else {
                return $validacion;
            }
        }

    }
}


?>