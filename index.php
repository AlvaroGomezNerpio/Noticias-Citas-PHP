<?php

// Carga del archivo de configuración
require_once 'config.php';

// Función para cargar controladores
function cargarControlador($controller) {
    $controllerNombre = ucwords($controller) . 'Controller';
    $controllerArchivo = "./controllers/" . $controllerNombre . '.php';
    if (file_exists($controllerArchivo)) {
        require_once $controllerArchivo;
        return new $controllerNombre();
    } else {
        // Controlador no encontrado, puedes manejar el error como desees
        return null;
    }
}

// Obtiene el controlador y la acción de la URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Cargar el controlador solicitado
$controlador = cargarControlador($controller);

// Si el controlador no se encuentra, mostrar página de error
if (!$controlador) {
    // Puedes mostrar una página de error 404 aquí
    exit('Página no encontrada');
}

// Llamar a la acción solicitada
if (method_exists($controlador, $action)) {
    $controlador->$action();
} else {
    // Si la acción no existe en el controlador, mostrar página de error
    exit('Acción no encontrada');
}

?>
