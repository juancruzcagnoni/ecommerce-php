<?php
session_start();

require_once __DIR__ . '/../../classes/Authentication.php';

(new Authentication)->logOut();

$_SESSION['mensajeExito'] = "La sesión se cerró exitósamente";
header("Location: ../index.php?s=log-in");
exit;
?>