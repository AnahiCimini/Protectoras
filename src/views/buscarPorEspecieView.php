<h1>Animales en adopción: <?php echo htmlspecialchars($especie); ?></h1>

<?php if (empty($animales)): ?>
    <p>No se encontraron animales para esta especie.</p>
<?php else: ?>
    <ul>
        <?php foreach ($animales as $animal): ?>
            <div class="animal">
                <h3><?php echo htmlspecialchars($animal['nombre_animal']); ?></h3>
                <p>Edad: <?php echo htmlspecialchars($animal['edad']); ?></p>
                <p>Descripción: <?php echo nl2br(htmlspecialchars($animal['descripcion'] ?? 'Descripción no disponible')); ?></p>
                <a href="casoIndividual.php?id=<?php echo $animal['id_animal']; ?>">Ver más</a>
            </div>
            <?php endforeach; ?>
    </ul>
<?php endif; ?>