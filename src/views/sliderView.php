<div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="8000">
    <!-- Indicadores -->
    <div class="carousel-indicators">
        <?php if (!empty($animalesUrgentes)) : ?>
            <?php foreach ($animalesUrgentes as $index => $animal): ?>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" aria-current="true" aria-label="Slide <?php echo $index + 1; ?>"></button>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay animales urgentes disponibles.</p>
        <?php endif; ?>
    </div>

    <!-- Contenido del Slider -->
    <div class="carousel-inner">
        <?php if (!empty($animalesUrgentes)) : ?>
            <?php foreach ($animalesUrgentes as $index => $animal): ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <div class="carousel-content">
                        <div class="carousel-image col-6">
                            <img src="<?= BASE_URL . 'assets/img/uploads/animales/' . htmlspecialchars($animal['foto_principal']); ?>" alt="<?php echo $animal['nombre_animal']; ?>">
                        </div>
                        <div class="carousel-data col-6">
                            <h3><?php echo $animal['nombre_animal']; ?></h3>
                            <p><?php echo $animal['descripcion'] ?? ''; ?></p>
                            <a href="<?php echo BASE_URL; ?>router.php?action=detalleAnimal&id_animal=<?php echo $animal['id_animal']; ?>" class="btn btn-success">¡Conoce a <?php echo $animal['nombre_animal']; ?>!</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Controles de Navegación -->
    <button class="carousel-control-prev carousel-navigation" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next carousel-navigation" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>
