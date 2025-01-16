<?php
    require_once PROJECT_ROOT . '/config/config.php';

    $animales = $data['animales'] ?? [];
    $nombre_protectora = $data['nombre_protectora'] ?? 'Nombre no disponible';

?>

<!-- buscarPorEspecieView.php -->
<h1>
    <?php 
        echo !empty($nombre_protectora) 
            ? htmlspecialchars($nombre_protectora) 
            : 'Nombre de protectora no disponible'; 
    ?>
</h1>
<br>

<div id="animales-list" class="container">
    <div id="animales-container" class="row">
        <?php if (empty($animales)): ?>
            <p>No se encontraron animales para esta protectora.</p>
        <?php else: ?>
            <!-- Aquí se cargarán los animales dinámicamente con PHP -->
            <?php foreach ($animales as $animal): ?>
                <div class="col-md-3 mb-3">
                    <div class="animal card p-3 shadow-sm">
                        <h3><?php echo htmlspecialchars($animal['nombre_animal']); ?></h3>
                        <p>Raza / especie: <?php echo htmlspecialchars($animal['raza']); ?></p>
                        <p>Edad: <?php echo htmlspecialchars($animal['edad']); ?></p>
                        <p>Descripción: <?php echo nl2br(htmlspecialchars($animal['descripcion'] ?? 'Descripción no disponible')); ?></p>
                        <a href="casoIndividual.php?id=<?php echo $animal['id_animal']; ?>">Ver más</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Cargando más -->
<div id="loading" class="text-center d-none">
    <p>Cargando más...</p>
</div>
