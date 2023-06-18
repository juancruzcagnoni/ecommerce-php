<!-- Aqui creamos un nuevo producto en la tabla de la base de datos. -->
<?php
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

// Upload de la imagen.
$nombreImagen = date('YmdHis') . "_" . $imagen['name'];
$rutaImagen = __DIR__ . 'img/products/' . $nombreImagen;

move_uploaded_file($imagen['tmp_name'], $rutaImagen);

// Grabar los datos de el producto.
try {
    (new Shop)->create([
        'vendedor_fk'  => 1,
        'nombre'       => $nombre,
        'descripcion'  => $descripcion,
        'precio'       => $precio,
        'stock'        => $stock,
        'imagen'       => $nombreImagen,
        'imagen_desc'  => $imagen_desc,
    ]);

    // Redireccionamiento.
    header("Location: ../index.php?s=products");
    exit;
} catch (Exception $e) {
    // Redireccionamos al usuario al formulario de nuevo.
    header("Location: ../index.php?s=publish-product");
    exit;
}
?>