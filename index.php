<!-- PHP -->
<?php

use App\Auth\Authentication;

session_start();

// Incluimos las classes.
require_once __DIR__ . '/bootstrap/autoload.php';

// Define los titulos de cada pagina.
$rutes = [
    'home' => [
        'title' => 'Pagina principal',
    ],
    'shop' => [
        'title' => 'Compra ahora',
    ],
    'product-detail' => [
        'title' => 'Ver producto',
    ],
    'contact' => [
        'title' => 'Contactate',
    ],
    'sign-up' => [
        'title' => 'Registrate',
    ],
    'log-in' => [
        'title' => 'Iniciar sesion',
    ],
    'profile' => [
        'title' => 'Perfil',
        'requiereAutenticacion' => true,
    ],
];

$view = $_GET['s'] ?? 'home';

$rutesConfig = $rutes[$view];

// Autenticamos
$autenticacion = new Authentication;
$requiereAutenticacion = $rutesConfig['requiereAutenticacion'] ?? false;
if ($requiereAutenticacion && !$autenticacion->isAuthenticated()) {
    $_SESSION['mensajeError'] = 'Se requiere iniciar sesion';
    header('Location: index.php?s=log-in');
    exit;
}
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $rutesConfig['title']; ?> | SmarTech</title>
    <link rel="shortcut icon" href="img/logos/logo-mini.svg" type="image/x-icon">
    <!-- Icons  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- CSS Bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Nav -->
    <nav class="navbar navbar-expand-md">
        <div class="container d-flex">
            <a class="navbar-brand" href="index.php?s=home"><img src="img/logos/logo-smartech.svg" alt="SmarTech logo." width="130"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="index.php?s=home">Inicio</a>
                    <a class="nav-link" href="index.php?s=shop">Tienda</a>
                    <a class="nav-link" href="index.php?s=contact">Contacto</a>
                    <a class="nav-link"><i class="bi bi-bag"></i></a>
                    <?php if(!$autenticacion->isAuthenticated()):?>
                    <a class="nav-link" href="index.php?s=log-in">Iniciar Sesion</a>
                    <a class="nav-link" href="index.php?s=sign-up">Registrate</a>
                    <?php else: ?>
                    <a class="nav-link" href="index.php?s=profile">Mi perfil</a>
                    <p>
                        <form action="actions/log-out.php" method="post">
                            <button class="nav-link" type="submit"><?= $autenticacion->getVendedor()->getEmail() ?> (Cerrar sesión)</button>
                        </form>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mensajes de feedback -->
    <?php
        if (isset($_SESSION['mensajeExito'])):
    ?>
    <div class="success"><?= $_SESSION['mensajeExito'];?></div>
    <?php
        unset($_SESSION['mensajeExito']);
        endif;
    ?>

    <?php
        if (isset($_SESSION['mensajeError'])):
    ?>
    <div class="fail"><?= $_SESSION['mensajeError'];?></div>
    <?php
        unset($_SESSION['mensajeError']);
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
                <img src="img/logos/logo-smartech-wh.svg" alt="SmarTech logo." width="200">
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