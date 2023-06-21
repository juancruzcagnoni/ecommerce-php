<?php
session_start();

require_once __DIR__ . '/../../classes/DB.php';
require_once __DIR__ . '/../../classes/Vendedor.php';
require_once __DIR__ . '/../../classes/Authentication.php';

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