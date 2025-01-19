<?php
    // Obtener el ID de la protectora desde la sesión
    function verificarSesion() {
        if (!isset($_SESSION['id_protectora'])) {
            header('Location: ' . BASE_URL . 'index.php?page=login');
            exit();
        }
    }


    function obtenerProtectoraLoginID() {
        // Obtener el ID de la protectora desde la sesión
        $id_protectora = $_SESSION['id_protectora'] ?? null;

        if ($id_protectora === null) {
            echo "<script>alert('No se ha encontrado el ID de la protectora en la sesión.');</script>";
            exit;
        }
    }
?>