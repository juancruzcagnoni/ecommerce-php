<!-- PHP -->
<?php
// Incluimos las classes.
session_start();
require_once __DIR__ . '/../classes/DB.php';
require_once __DIR__ . '/../classes/Shop.php';

// Define los titulos de cada pagina.
$rutes = [
    'dashboard' => [
        'title' => 'Tablero de Administracion',
    ],
    'log-in' => [
        'title' => 'Iniciar Sesion',
    ],
    'products' => [
        'title' => 'Compra ahora',
    ],
    'publish-product' => [
        'title' => 'Publicar producto',
    ],
    'edit-product' => [
        'title' => 'Editar producto',
    ],
    'delete-product' => [
        'title' => 'Eliminar producto',
    ],
];

$view = $_GET['s'] ?? 'dashboard';

$rutesConfig = $rutes[$view];
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $rutesConfig['title']; ?> | Panel de Administracion de SmarTech</title>
    <link rel="shortcut icon" href="../img/logos/logo-mini.svg" type="image/x-icon">
    <!-- Icons  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- CSS Bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- Nav -->
    <nav class="navbar navbar-expand-md">
        <div class="container d-flex">
            <a class="navbar-brand" href="index.php?s=dashboard"><img src="../img/logos/logo-smartech.svg" alt="SmarTech logo." width="130"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="index.php?s=dashboard">Tablero</a>
                    <a class="nav-link" href="index.php?s=products">Productos</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mensaje de feedback -->
    <?php
        if (isset($_SESSION['mensajeExito'])):
    ?>
    <div class="success"><?= $_SESSION['mensajeExito'];?></div>
    <?php
        unset($_SESSION['mensajeExito']);
        endif;
    ?>

    <!-- Content  -->
    <main class="main-content">
        <?php
        require 'views/' . $view . '.php';
        ?>
    </main>

    <!-- Footer  -->
    <footer class="p-5 footer">
        <div class="row">
            <div class="col-12 col-md-6 footer-first">
                <img src="../img/logos/logo-smartech-wh.svg" alt="SmarTech logo." width="200">
                <p>La mejor tecnología y los mejores precios del mercado encontralos acá, en Smartech.</p>
            </div>

            <div class="col-12 col-md-6">
                <div class="social">
                    <i class="bi bi-instagram"></i>
                    <i class="bi bi-facebook"></i>
                    <i class="bi bi-youtube"></i>
                    <i class="bi bi-twitter"></i>
                </div>
            </div>

            <p class="text-center m-0 copy">&copy; Todos los derechos reservados. Smartech.</p>
        </div>
    </footer>

    <!-- Javascript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>