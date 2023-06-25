<!-- Aqui creamos un nuevo producto en la tabla de la base de datos. -->
<?php
// Session start para generar mensajes de feedback.

use App\Auth\Authentication;
use App\Models\Shop;
use Intervention\Image\ImageManagerStatic as Image;

session_start();

// Incluimos las classes.
require_once __DIR__ . '/../../bootstrap/autoload.php';

// Verificamos que el usuario este autenticado.
if (!(new Authentication)->authenticatedAsAdmin()) {
    $_SESSION['mensajeError'] = 'Se requiere iniciar sesion para realizar esta accion.';
    header("Location: ../index.php?s=log-in");
    exit;
}

// Capturamos los datos de el formulario. 
$id           = $_GET['id'];
$nombre       = $_POST['nombre'];
$descripcion  = $_POST['descripcion'];
$precio       = $_POST['precio'];
$stock        = $_POST['stock'];
$imagen_desc  = $_POST['imagen_desc'];
$categorias          = $_POST['categoria_fk'] ?? [];
$imagen       = $_FILES['imagen'];

$producto = (new Shop)->byId($id);

if (!$producto) {
    // Redireccionamos al form.
    header("Location: ../index.php?s=products");
    exit;
}

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
    header("Location: ../index.php?s=edit-product&id=" . $id);
    exit;
}

// Upload de la imagen.
if (!empty($imagen['tmp_name'])) {
    $nombreImagen = date('YmdHis') . "_" . $imagen['name'];

    // Redimensionamos.
    Image::make($imagen['tmp_name'])
        ->fit(400, 400, function($constraint) {
            $constraint->upsize();
        })
        ->save(__DIR__ . '/../../img/products/' . $nombreImagen);
}


// Grabar los datos de el producto.
try {   
    (new Shop)->edit($id, [
        'nombre'       => $nombre,
        'descripcion'  => $descripcion,
        'precio'       => $precio,
        'stock'        => $stock,
        'imagen'       => ('img/products/' . $nombreImagen) ?? $producto->getImage(),
        'imagen_desc'  => $imagen_desc,
        'categorias_fk'          => $categorias,
    ]);

    // Si la imagen fue editada, borramos la imagen vieja.
    if (isset($nombreImagen) && $producto->getImage() !== null) {
        unlink(__DIR__ . '/../../' . $producto->getImage());   
    }

    // Mensaje de feedback.
    $_SESSION['mensajeExito'] = 'El producto <b>' . $nombre . '</b> fue editado exitosamente.';

    // Redireccionamiento.
    header("Location: ../index.php?s=products");
    exit;
} catch (Exception $e) {
    // Redireccionamos al usuario al formulario de nuevo.
    header("Location: ../index.php?s=edit-product&id=" . $id);
    exit;
}
?>