<?php
    require_once PROJECT_ROOT . '/config/config.php';
?>

<div class="container">
    <h2>Detalle de la Protectora</h2>
    <?php if ($protectora): ?>
        <p><strong>Nombre:</strong> <?php echo $protectora['nombre_protectora']; ?></p>
        <p><strong>Descripción:</strong> <?php echo $protectora['descripcion']; ?></p>
        <p><strong>Dirección:</strong> <?php echo $protectora['direccion']; ?></p>
        <p><strong>Teléfono:</strong> <?php echo $protectora['telefono']; ?></p>
        <p><strong>Email:</strong> <?php echo $protectora['email']; ?></p>
    <?php else: ?>
        <p>No se encontró la protectora.</p>
    <?php endif; ?>
</div>
