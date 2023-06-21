<?php
session_start();
// Incluimos las classes.
require_once __DIR__ . '/../../classes/DB.php';
require_once __DIR__ . '/../../classes/Shop.php';

$id = $_GET['id'];

try {
    (new Shop)->eliminar($id);

    $_SESSION['mensajeExito'] = '<i class="bi bi-check"></i> El producto se elimino exitosamente';
    header("Location: ../index.php?s=products");
    exit;
} catch (Exception $e) {
    header("Location: ../index.php?s=products");
    exit;
}
