<h1>Animales en adopción: <?php echo htmlspecialchars($especie); ?></h1>

<div id="animales-list" class="container"></div>
    <?php if (empty($animales)): ?>
        <p>No se encontraron animales para esta especie.</p>
    <?php else: ?>
        <div id="animales-container" style="max-height: 80vh; overflow-y: auto;">
            <!-- Contenedor con los animales -->
            <?php foreach ($animales as $animal): ?>
                <div class="animal mb-3">
                    <h3><?php echo htmlspecialchars($animal['nombre_animal']); ?></h3>
                    <p>Edad: <?php echo htmlspecialchars($animal['edad']); ?></p>
                    <p>Descripción: <?php echo nl2br(htmlspecialchars($animal['descripcion'] ?? 'Descripción no disponible')); ?></p>
                    <a href="casoIndividual.php?id=<?php echo $animal['id_animal']; ?>">Ver más</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<!-- Cargando más -->
<div id="loading" class="text-center d-none">
    <p>Cargando más...</p>
</div>