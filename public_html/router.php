<?php

    define('PROJECT_ROOT', dirname(path: __DIR__));

    require_once PROJECT_ROOT . '/config/config.php';
    require_once PROJECT_ROOT . '/src/controllers/ProtectoraController.php';
    require_once PROJECT_ROOT . '/src/controllers/LoginController.php';


    $database = new Database();
    $conn = $database->getConnection();

    $protectoraController = new ProtectoraController($conn);
    $loginController = new LoginController($conn);
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
        // Otros casos para diferentes acciones
        default:
            echo "Acción no encontrada.";
            break;
    }
?>
