<?php
    define('PROJECT_ROOT', dirname(__DIR__));
    require_once PROJECT_ROOT . '/config/config.php';
    require_once PROJECT_ROOT . '/src/models/Animal.php';
    require_once PROJECT_ROOT . '/src/models/Provincias.php';
    require_once PROJECT_ROOT . '/src/models/Protectora.php';    
    require_once PROJECT_ROOT . '/src/controllers/ProtectoraController.php';

	if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
	
    $id_protectora = $_SESSION['id_protectora'] ?? null;   

    $database = new Database();
    $conn = $database->getConnection();
    
    $provinciasController = new Provincias($conn);
    $provincias = $provinciasController->getProvincias();
    $especie = $_GET['especie'] ?? '';


    $page = $_GET['page'] ?? 'home';

    switch ($page) {
        case 'login':
            $view = '../src/views/loginView.php';
            break;
        case 'registro':
            $view = '../src/views/registroView.php';
            break;
        case 'nosotros':
            $view = '../src/views/nosotrosView.php';
            break;
        case 'protectoras':
            $view = '../src/views/listadoProtectorasView.php';
            break;
        case 'busquedaEspecies':
            $view = '../src/views/buscarPorEspecieView.php';
            $animales = $_SESSION['animales'] ?? [];
            break;
        case 'busquedaProtectora':
            $view = '../src/views/buscarPorProtectoraView.php';
            break;
        case 'animalDetalle':
            $view = '../src/views/animalDetailView.php';
            break;
        case 'nuevoCaso':
            $view = '../src/views/nuevoCasoView.php';
            break;
        case 'datosProtectora':
            $view = '../src/views/datosProtectoraView.php';
            break;
        case 'listaProtectoras':
            $view = '../src/views/protectoraResultadosView';
        case 'home':
            $view = '../src/views/home.php';
            break;
        default:
            $view = '../src/views/error404View.php';
    }

    include PROJECT_ROOT . '/templates/main.php'; 
?>
