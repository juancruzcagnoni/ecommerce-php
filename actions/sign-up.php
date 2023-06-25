<?php

use App\Models\Vendedor;

session_start();
require_once __DIR__ . '/../bootstrap/autoload.php';

$nombre   = $_POST['nombre'];
$email      = $_POST['email'];
$password   = $_POST['password'];

try {
    (new Vendedor)->create([
        'rol_fk'    => 2, 
        'nombre'     => $nombre,
        'email'     => $email,
        'password'  => password_hash($password, PASSWORD_DEFAULT), 
    ]);

    $_SESSION['mensajeExito'] = "La cuenta se creó exitosamente.";

    header('Location: ../index.php?s=log-in');
    exit;
} catch(Exception $e) {
    $_SESSION['mensajeError'] = "Ocurrió un error inesperado al tratar de crear la cuenta.";
    $_SESSION['oldData'] = $_POST;

    header('Location: ../index.php?s=sign-up');
    exit;
}