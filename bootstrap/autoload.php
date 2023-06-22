<?php
    // Funcion para indicar como deben cargarse las clases que php busque utilizar.
    spl_autoload_register(function(string $className) {
        // Definimos en una variable la ruta al archivo.
        $className = substr($className, 4);
        $className = 'classes/' . str_replace('\\', '/', $className);

        $classPath = __DIR__ . '/../' . $className . '.php';

        // Incluimos la clase si es que existe.
        if (file_exists($classPath)) {
            require_once $classPath;
        }
    })
?>