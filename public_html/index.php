<?php
session_start();

    define('PROJECT_ROOT', dirname(__DIR__));
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
        case 'animal':
            $view = '../src/views/animalView.php';
            break;
        case 'especie':
            $view = '../src/views/especieView.php';
            break;
        case 'protectora':
            $view = '../src/views/protectoraView.php';
            break;
        case 'nosotros':
            $view = '../src/views/nosotrosView.php';
            break;
        case 'registro':
            $view = '../src/views/registroView.php';
            break;
        case 'login':
            $view = '../src/views/loginView.php';
            break;
        case 'protectoraIndividual':
            $view = '../src/views/protectoraIndividualView.php.php';
            break;
        case 'caso':
            $view = '../src/views/casoView.php';
            break;
        default:
            $view = '../src/views/home.php';
    }

    include PROJECT_ROOT . '/templates/main.php'; 
?>
