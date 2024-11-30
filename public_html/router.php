<?php

    if (!defined('PROJECT_ROOT')) {
        define('PROJECT_ROOT', dirname(__DIR__));
    }

    require_once PROJECT_ROOT . '/config/config.php';
    require_once PROJECT_ROOT . '/src/controllers/ProtectoraController.php';
    require_once PROJECT_ROOT . '/src/controllers/LoginController.php';
    require_once PROJECT_ROOT . '/src/controllers/AnimalController.php';

    $database = new Database();
    $conn = $database->getConnection();

    $protectoraController = new ProtectoraController($conn);
    $loginController = new LoginController($conn);
    $animalController = new AnimalController($conn);

    $action = isset($_GET['action']) ? $_GET['action'] : '';

    switch ($action) {
        case 'register':
            $protectoraController->register();
            break;

        case 'login':
            $loginController->login();
            break;

        case 'logout':
            $loginController->logout();
            break;

        case 'buscarPorEspecie':
            $especie = isset($_GET['especie']) ? $_GET['especie'] : '';
            $animales = $animalController->buscarPorEspecie($especie);

            $_GET['page'] = 'busquedaEspecies'; // Establece la página actual
            $GLOBALS['animales'] = $animales;  // Pasamos los datos globalmente al index
            $GLOBALS['especie'] = $especie;    // También la especie seleccionada

            include PROJECT_ROOT . '/public_html/index.php'; // Carga el index para renderizar la vista

            exit();

        // Otros casos para diferentes acciones
        default:
            echo "Acción no encontrada.";
            break;
    }

?>
