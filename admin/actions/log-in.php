<?php

use App\Auth\Authentication;

session_start();

require_once __DIR__ . '/../../bootstrap/autoload.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Autenticación
try {
    if((new Authentication)->authenticate($email, $password)){
        $_SESSION['mensajeExito'] = '¡Bienvenido otra vez!';
        header("Location: ../index.php?s=dashboard");
        exit;
    };
    
    $_SESSION['mensajeError'] = "Los datos ingresados no coinciden con ningun usuario.";
    header("Location: ../index.php?s=log-in");
} catch (Exception $e) {
    $_SESSION['mensajeError'] = "Ocurrió un error inesperado.";
    header("Location: ../index.php?s=log-in");
}

?>