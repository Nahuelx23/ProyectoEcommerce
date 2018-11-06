<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once 'autoloader.php';

$session = new Session();
//$db = new Json('usuarios.json');
$host = '127.0.0.1';
$db_user = 'root';
$db_pass = 'root';
$db = new MySQL();

function dd(...$param)
{
    echo "<pre>";
    die(var_dump($param));
}

function old ($campo)
{
    if (isset($_POST[$campo])) {
        return $_POST[$campo];
    }
}

function redirect ($url)
{
    header('Location: ' . $url);exit;
}

function check()
{
    return isset($_SESSION['usuario']);
}

function guest()
{
    return !check();
}

function user()
{
    if (check()) {
        return $_SESSION['usuario'];
    } else {
        return false;
    }
}
?>