<?php

use App\Auth\Authentication;
use App\Models\Shop;

session_start();
// Incluimos las classes.
require_once __DIR__ . '/../../bootstrap/autoload.php';

// Verificamos que el usuario este autenticado.
if (!(new Authentication)->authenticatedAsAdmin()) {
    $_SESSION['mensajeError'] = 'Se requiere iniciar sesion para realizar esta accion.';
    header("Location: ../index.php?s=log-in");
    exit;
}

$id = $_GET['id'];

$producto = (new Shop)->byId($id);

if (!$producto) {
    $_SESSION['mensajeError'] = 'El producto que esta intentando eliminar no existe';
    // Redireccionamos al form.
    header("Location: ../index.php?s=products");
    exit;
}

try {
    (new Shop)->eliminar($id);

    // Eliminamos la imagen
    if ($producto->getImage() !== null) {
        unlink(__DIR__ . '/../../' . $producto->getImage());   
    }

    $_SESSION['mensajeExito'] = '<i class="bi bi-check"></i> El producto se elimino exitosamente';
    header("Location: ../index.php?s=products");
    exit;
} catch (Exception $e) {
    $_SESSION['mensajeError'] = 'Ocurrio un error inesperado al intentar eliminar la noticia';
    header("Location: ../index.php?s=products");
    exit;
}
