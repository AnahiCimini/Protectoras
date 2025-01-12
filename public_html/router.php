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
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = $_POST;
                $protectoraController->register($data);
                exit;
            }
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
            $animalController = new AnimalController($conn);
            $animales = $animalController->buscarPorEspecie($especie);
            
            $_GET['page'] = 'busquedaPorEspecies'; 
            $data = ['animales' => $animales, 'especie' => $especie];
            
            include PROJECT_ROOT . '/public_html/index.php';
            exit();

        case 'listadoProvinciasbyCCAA':
            $id_ccaa = $_GET['id_ccaa'] ?? null;
            require_once PROJECT_ROOT . '/src/controllers/ProtectoraController.php';
            $controller = new ProtectoraController($conn);
            $controller->getProvinciasByCCAA($id_ccaa); 
            break;
            
        case 'listadoProtectoras':
            $id_provincia = $_GET['id_provincia'] ?? null;
            $controller = new ProtectoraController($conn);
            $controller->getProtectorasByProvincia($id_provincia);
                break;
            
        // Otros casos para diferentes acciones
        default:
            echo "Acción no encontrada.";
            break;
    }
?>
