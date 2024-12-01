<?php
    if (!defined('PROJECT_ROOT')) {
        define('PROJECT_ROOT', dirname(__DIR__));
    }

    session_start();

    require_once PROJECT_ROOT . '/config/config.php';
    require_once PROJECT_ROOT . '/src/models/Provincias.php';
    require_once PROJECT_ROOT . '/src/models/Protectora.php';    
    require_once PROJECT_ROOT . '/src/controllers/ProtectoraController.php';


    $database = new Database();
    $conn = $database->getConnection();

    $protectoraController = new Provincias($conn);
    $provincias = $protectoraController->getProvincias();


    $page = $_GET['page'] ?? 'home';

    switch ($page) {
        case 'home':
            $view = '../src/views/home.php';
            break;
        case 'nosotros':
            $view = '../src/views/nosotrosView.php';
            break;
        case 'protectoras':
            $view = '../src/views/listadoProtectorasView.php';
            break;
        case 'busquedaEspecies':
            $view = '../src/views/resultadosEspeciesView.php';
            break;
        case 'busquedaProtectoras':
            $view = '../src/views/resultadosProtectorasView.php';
            break;
        case 'datosAnimal':
            $view = '../src/views/detalleAnimalView.php';
            break;
        case 'datosProtectora':
            $view = '../src/views/detalleProtectoraView.php';
            break;
        case 'nuevoCaso':
            $view = '../src/views/nuevoCasoView.php';
            break;
        case 'login':
            $view = '../src/views/loginView.php';
            break;
        case 'registro':
            $view = '../src/views/registroView.php';
            break;

        default:
            $view = '../src/views/error404View.php';
    }

    include PROJECT_ROOT . '/templates/main.php'; 
?>
