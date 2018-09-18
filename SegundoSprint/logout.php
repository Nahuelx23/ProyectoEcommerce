<?php 
require_once 'helpers.php';

// Iniciamos la sesión para luego destruirla.
session_start();
session_destroy();

// Redirigimos al login luego de estar deslogueados.
redirect('login.php');

?>