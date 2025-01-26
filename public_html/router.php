<?php

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    if (!defined('PROJECT_ROOT')) {
        define('PROJECT_ROOT', dirname(__DIR__));
    }

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
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

        case 'detalleProtectora':
            // Manejar la lógica para el detalle de protectora
            $nombre_protectora = $_GET['nombre_protectora'] ?? null;
    
            if ($nombre_protectora) {
                require_once PROJECT_ROOT . '/src/controllers/ProtectoraController.php';
                $controller = new ProtectoraController($conn);
                $protectora = $controller->getProtectoraByName($nombre_protectora);
    
                if ($protectora) {
                    // Pasar los datos al índice para cargar la vista
                    $_GET['page'] = 'datosProtectora';
                    $_GET['protectora'] = $protectora;
                    include PROJECT_ROOT . '/public_html/index.php';
                    exit;
                } else {
                    echo "Protectora no encontrada.";
                    exit;
                }
            } else {
                echo "Nombre de protectora no especificado.";
                exit;       
            }
        
        case 'actualizarDatosProtectora':
            require_once PROJECT_ROOT . '/src/controllers/ProtectoraController.php';
            $controller = new ProtectoraController($conn);
            $controller->actualizarDatosProtectora($_POST);
            break;

        case 'detalleAnimal':
            $id_animal = $_GET['id_animal'] ?? null;
            
            require_once PROJECT_ROOT . '/src/controllers/AnimalController.php';
            $animalController = new AnimalController($conn);
            $animal = $animalController->buscarPorID($id_animal);

            if (isset($_SESSION['id_protectora']) && $_SESSION['id_protectora'] === $animal['id_protectora']) {
                $_GET['page'] = 'edicionAnimal'; 
                include PROJECT_ROOT . '/public_html/index.php';
                exit; 
            }
        
            $_GET['page'] = 'datosAnimal'; 
            include PROJECT_ROOT . '/public_html/index.php';
            exit;
            
        case 'actualizarDatosAnimal':
            require_once PROJECT_ROOT . '/src/controllers/AnimalController.php';
            $animalController = new AnimalController($conn);
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $animalController->actualizarDatosAnimal($_POST);
            } else {
                echo "Método no permitido.";
            }
            
            break;

        case 'eliminarAnimal':
            $id_animal = $_GET['id_animal'] ?? null;
            require_once PROJECT_ROOT . '/src/controllers/AnimalController.php';
            $animalController = new AnimalController($conn);
            $animal = $animalController->eliminarAnimal($id_animal);

        case 'nuevoCaso':
            require_once PROJECT_ROOT . '/src/controllers/AnimalController.php';
            $animalController = new AnimalController($conn);
            $animalController->addCase($_POST);
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

        case 'buscarPorProtectora':
            require_once PROJECT_ROOT . '/src/controllers/AnimalController.php';
        
            $nombre_protectora = $_GET['nombre_protectora'] ?? null;

            if (empty($nombre_protectora)) {
                die('Nombre de protectora no especificado.');
            }        

            $animalController = new AnimalController($conn);
            $animales = $animalController->buscarPorProtectora($nombre_protectora);
        
            $_GET['page'] = 'busquedaPorProtectoras';
            $data = ['animales' => $animales, 'nombre_protectora' => $nombre_protectora];

            // Incluir la vista pasando las variables necesarias
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
