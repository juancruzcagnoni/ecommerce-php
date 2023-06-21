<?php
session_start();
// Incluimos las classes.
require_once __DIR__ . '/../../classes/DB.php';
require_once __DIR__ . '/../../classes/Shop.php';

$id = $_GET['id'];

$producto = (new Shop)->byId($id);

if (!$producto) {
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
    header("Location: ../index.php?s=products");
    exit;
}
