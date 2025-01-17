<?php
    if (!defined('PROJECT_ROOT')) {
        define('PROJECT_ROOT', dirname(__DIR__));
    }

    session_start();

    if (isset($_SESSION['message'])) {
        echo "<script>
            alert('" . $_SESSION['message'] . "');
        </script>";
        // Limpiar el mensaje después de mostrarlo
        unset($_SESSION['message']);
    }
    
    
    require_once PROJECT_ROOT . '/config/config.php';
    require_once PROJECT_ROOT . '/src/models/Provincias.php';
    require_once PROJECT_ROOT . '/src/models/Protectora.php';    
    require_once PROJECT_ROOT . '/src/models/CCAA.php';    
    require_once PROJECT_ROOT . '/src/controllers/ProtectoraController.php';


    $database = new Database();
    $conn = $database->getConnection();

    $protectoraController = new Provincias($conn);
    $provincias = $protectoraController->getProvincias();

    $CCAAController = new CCAA($conn);
    $ccaas = $CCAAController->getCCAA();


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
        case 'busquedaPorEspecies':
            $view = '../src/views/resultadosPorEspeciesView.php';
            break;
        case 'busquedaPorProtectoras':
            $view = '../src/views/resultadosPorProtectorasView.php';
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
