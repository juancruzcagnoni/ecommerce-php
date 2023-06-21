<!-- Aqui creamos un nuevo producto en la tabla de la base de datos. -->
<?php
// Session start para generar mensajes de feedback.
session_start();

// Incluimos las classes.
require_once __DIR__ . '/../../classes/DB.php';
require_once __DIR__ . '/../../classes/Shop.php';

// Capturamos los datos de el formulario. 
$nombre       = $_POST['nombre'];
$descripcion  = $_POST['descripcion'];
$precio       = $_POST['precio'];
$stock        = $_POST['stock'];
$imagen_desc  = $_POST['imagen_desc'];
$imagen       = $_FILES['imagen'];

// Validamos los datos. 
$errores = [];

// Nombre
if (empty($nombre)) {
    $errores['nombre'] = 'Tienes que escribir el nombre de el producto.';
} else if (strlen($nombre) < 2) {
    $errores['nombre'] = 'El nombre de el producto debe tener al menos 2 caracteres.';
}

// Descripción
if (empty($descripcion)) {
    $errores['descripcion'] = 'Tienes que escribir la descripcion de el producto.';
}

// Precio
if (empty($precio)) {
    $errores['precio'] = 'Tienes que escribir el precio de el producto.';
}

// Verificamos los errores.
if (count($errores) > 0) {
    // Enviamos los mensajes de error.
    $_SESSION['errores'] = $errores;

    // Enviamos los datos que recibimos por POST.
    $_SESSION['oldData'] = $_POST;

    // Redireccionamos al form.
    header("Location: ../index.php?s=publish-product");
    exit;
}

// Upload de la imagen.
if (!empty($imagen['tmp_name'])) {
    $nombreImagen = date('YmdHis') . "_" . $imagen['name'];

    move_uploaded_file($imagen['tmp_name'], __DIR__ . '/../../img/products/' . $nombreImagen);
}


// Grabar los datos de el producto.
try {
    (new Shop)->create([
        'vendedor_fk'  => 1,
        'nombre'       => $nombre,
        'descripcion'  => $descripcion,
        'precio'       => $precio,
        'stock'        => $stock,
        'imagen'       => ('img/products/' . $nombreImagen) ?? null,
        'imagen_desc'  => $imagen_desc,
    ]);

    // Mensaje de feedback.
    $_SESSION['mensajeExito'] = '<i class="bi bi-check"></i> El producto <b>' . $nombre . '</b> fue publicado exitosamente.';

    // Redireccionamiento.
    header("Location: ../index.php?s=products");
    exit;
} catch (Exception $e) {
    // Redireccionamos al usuario al formulario de nuevo.
    header("Location: ../index.php?s=publish-product");
    exit;
}
?>