<?php

use App\Auth\Authentication;

session_start();
require_once __DIR__ . '/../bootstrap/autoload.php'; 

$email      = $_POST['email'];
$password   = $_POST['password'];

if((new Authentication)->authenticate($email, $password)){
    $_SESSION['mensajeExito'] = 'Usted inicio sesión correctamente';

    header("Location: ../index.php?s=profile");
    exit;
} else {
    $_SESSION['mensajeError'] = "La informacion no coincide con ningun usuario";
    $_SESSION['oldData'] = $_POST;

    header("Location: ../index.php?s=log-in");
    exit;
}
