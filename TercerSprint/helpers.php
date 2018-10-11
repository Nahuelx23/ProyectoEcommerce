<?php
require_once 'autoloader.php';

$session = new Session();
$db = new Json('usuarios.json');
// $db = new MySQL();

// Nos permite debuggear de forma más fácil.
function dd(...$param)
{
    echo "<pre>";
    die(var_dump($param));
}

// Nos devuelve el valor viejo encontrado en $_POST (para usar en formularios).
function old ($campo)
{
    if (isset($_POST[$campo])) {
        return $_POST[$campo];
    }
}

// Nos permite redirigir sin necesidad de recordar el header/location
function redirect ($url)
{
    header('Location: ' . $url);exit;
}

// Nos devuelve true en caso de que estemos logueados, false en caso de que no lo estemos.
function check()
{
    return isset($_SESSION['usuario']);
}

// Nos devuelve false en caso de que estemos logueados, true en caso de que no lo estemos.
function guest()
{
    return !check();
}

// Nos devuelve el usuario en el caso de que estemos logueados, false en el caso de que no.
function user()
{
    if (check()) {
        return $_SESSION['usuario'];
    } else {
        return false;
    }
}
?>