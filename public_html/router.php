<?php
    if (!defined('PROJECT_ROOT')) {
        define('PROJECT_ROOT', dirname(__DIR__));
    }

    require_once PROJECT_ROOT . '/config/config.php';

    $database = new Database();
    $conn = $database->getConnection();

    $action = isset($_GET['action']) ? $_GET['action'] : '';

    switch ($action) {
        case 'register':
            require_once PROJECT_ROOT . '/src/controllers/ProtectoraController.php';
            $protectoraController = new ProtectoraController($conn);
            $protectoraController->register();
            break;

        case 'login':
            require_once PROJECT_ROOT . '/src/controllers/LoginController.php';
            $loginController = new LoginController($conn);
            $loginController->login();
            break;

        case 'logout':
            require_once PROJECT_ROOT . '/src/controllers/LoginController.php';
            $loginController = new LoginController($conn);
            $loginController->logout();
            break;

        case 'buscarPorEspecie':
            require_once PROJECT_ROOT . '/src/controllers/AnimalController.php';
            $especie = isset($_GET['especie']) ? $_GET['especie'] : '';
            // Llamar al controlador de animales
            $animalController = new AnimalController($conn);
            $animales = $animalController->buscarPorEspecie($especie);
            
            // Establecer la página y pasar los datos
            $_GET['page'] = 'busquedaEspecies'; // Página de búsqueda
            $data = ['animales' => $animales, 'especie' => $especie];
            
            include PROJECT_ROOT . '/public_html/index.php'; // Cargar el index para renderizar la vista
            exit();
        // Otros casos para diferentes acciones
        default:
            echo "Acción no encontrada.";
            break;
    }
?>
