<?php
    require_once PROJECT_ROOT . '/config/config.php';
?>

<!-- buscarPorEspecieView.php -->
<h1><?php echo htmlspecialchars($especie); ?> en adopción</h1>
<br>


<!-- RESULTADOS -->

<div id="animales-list" class="container">
    <div id="animales-container" class="row">
        <?php if (empty($animales)): ?>
            <p>No se encontraron animales para esta especie.</p>
        <?php else: ?>
            <!-- Aquí se cargarán los animales dinámicamente con PHP -->
            <?php foreach ($animales as $animal): ?>

                <div class="col-md-3 mb-3">
                    <div class="animal card p-3 shadow-sm animal_card">
                        <?php if ($animal['urgente'] == 1): ?>
                            <div class="urgent-label">Urgente</div>
                        <?php endif; ?>
                        <h3><?php echo htmlspecialchars($animal['nombre_animal']); ?></h3>
                        <?php if (!empty($animal['foto_principal'])): ?>
                            <img class="pet-profile-img" src="<?= BASE_URL . 'assets/img/uploads/animales/' . htmlspecialchars($animal['foto_principal']); ?>" alt="Foto principal de <?php echo $animal['nombre_animal']; ?>" />
                        <?php endif; ?>
                        <div class="content-card"></div>
                            <span>Raza / especie: <?php echo htmlspecialchars($animal['raza']); ?></span>
                            <span>Edad: <?php echo htmlspecialchars($animal['edad']); ?></span>
                            <span>Descripción: <?php echo nl2br(htmlspecialchars($animal['descripcion'] ?? 'Descripción no disponible')); ?></span>
                        </div>
                        <span><button class="btn-standard rounded-3 btn-filtros" href="<?php echo BASE_URL; ?>router.php?action=detalleAnimal&id_animal=<?php echo $animal['id_animal']; ?>">Ver más</a></span>
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
