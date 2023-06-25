<?php

use App\Auth\Authentication;

session_start();
require_once __DIR__ . '/../bootstrap/autoload.php';

(new Authentication)->logOut();

$_SESSION['mensajeExito'] = 'La sesion se cerro correctamente';
header('Location: ../index.php?s=log-in');
exit;