<?php
    require_once PROJECT_ROOT . '/config/config.php';
    if (isset($_GET['protectora'])) {
        $protectora = $_GET['protectora'];
    } else {
        echo "No se encontraron datos para esta protectora.";
        exit;
    }
?>

<div class="container">
    <h1>Detalle de la Protectora</h1>
    <p><strong>Nombre:</strong> 
        <?php echo isset($protectora['nombre_protectora']) 
            ? htmlspecialchars($protectora['nombre_protectora']) 
            : 'No disponible'; ?>
    </p>
    <p><strong>Dirección:</strong> 
        <?php echo isset($protectora['direccion']) 
            ? htmlspecialchars($protectora['direccion']) 
            : 'No disponible'; ?>
    </p>
    <p><strong>Teléfono:</strong> 
        <?php echo isset($protectora['telefono']) 
            ? htmlspecialchars($protectora['telefono']) 
            : 'No disponible'; ?>
    </p>
</div>

