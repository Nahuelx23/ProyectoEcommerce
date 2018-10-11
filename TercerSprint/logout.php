<?php 
// Requerimos los archivos necesarios.
require_once 'helpers.php';

// Destruímos la sesión.
$session->cerrarSesion();

// Redirigimos al login luego de estar deslogueados.
redirect('login.php');

?>