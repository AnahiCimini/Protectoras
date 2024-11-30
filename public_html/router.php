<?php

    define('PROJECT_ROOT', dirname(__DIR__));

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
            include PROJECT_ROOT . '/src/views/busquedaEspeciesView.php';
            $_SESSION['animales'] = $animales;
            

            header('Location: /Protectoras/public_html/index.php?page=busquedaEspecies&especie=' . urlencode($especie));
            exit();

        // Otros casos para diferentes acciones
        default:
            echo "Acción no encontrada.";
            break;
    }

?>
