<?php
    require_once PROJECT_ROOT . '/config/config.php';

    $animales = $data['animales'] ?? [];
    $nombre_protectora = $data['nombre_protectora'] ?? 'Nombre no disponible';

?>

<div class="container">
    <div class="text-end">
        <button onclick="window.history.back();" class="btn btn-standard">Volver</button>
    </div>
</div>

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
                    <div class="animal animal card p-3 shadow-sm animal_card">
                        <h3><?php echo htmlspecialchars($animal['nombre_animal']); ?></h3>
                        <?php if (!empty($animal['foto_principal'])): ?>
                            <img class="pet-profile-img" src="<?= BASE_URL . 'assets/img/uploads/animales/' . strtolower($animal['nombre_especie']) . '/' . htmlspecialchars($animal['foto_principal']); ?>" alt="Foto principal de <?php echo $animal['nombre_animal']; ?>" />
                        <?php endif; ?>
                        <p>Raza / especie: <?php echo htmlspecialchars($animal['raza']); ?></p>
                        <p>Edad: <?php echo htmlspecialchars($animal['edad']); ?></p>
                        <p>Descripción: <?php echo nl2br(htmlspecialchars($animal['descripcion'] ?? 'Descripción no disponible')); ?></p>
                        <a href="<?php echo BASE_URL; ?>router.php?action=detalleAnimal&id_animal=<?php echo $animal['id_animal']; ?>">Ver más</a>
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
