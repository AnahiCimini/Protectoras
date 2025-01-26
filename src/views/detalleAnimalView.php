<?php
    require_once PROJECT_ROOT . '/config/config.php';
?>

<div class="container">
    <div class="text-end">
        <button onclick="window.history.back();" class="btn btn-standard">Volver</button>
    </div>
</div>

<div class="container mt-5 infoBasica">
    <!-- Profile Card -->
    <div class="row align-items-center g-0">
        <!-- Pet Image -->
        <div class="col-6 imgAnimal">
            <?php if (!empty($animal['foto_principal'])): ?>
                <img src="<?= BASE_URL . 'assets/img/uploads/animales/' . htmlspecialchars($animal['foto_principal']); ?>" alt="Foto principal de <?php echo $animal['nombre_animal']; ?>" />
            <?php else: ?>
                <p>No hay imágenes de este animal.</p>
            <?php endif; ?>
        </div>
        <!-- Pet Details -->
        <div class="col-6 text-center">
            <div class="datosAnimal text-center col-6">
                <h1 class="customTitle"><?php echo htmlspecialchars($animal['nombre_animal']); ?></h1>
                <div class="row">
                    <div class="col-6">
                        <ul class="list-unstyled text-end">
                            <li class="form-control-titles"><strong>Raza / Especie:</strong></li>
                            <li class="form-control-titles"><strong>Edad:</strong></li>
                            <li class="form-control-titles"><strong>Tamaño:</strong></li>
                            <li class="form-control-titles"><strong>Salud:</strong></li>
                            <li class="form-control-titles"><strong>Sexo:</strong></li>
                            <li class="form-control-titles"><strong>Esterilización:</strong></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-unstyled text-start">
                            <li class="form-control-titles"><?php echo htmlspecialchars($animal['raza']); ?></li>
                            <li class="form-control-titles"><?php echo htmlspecialchars($animal['edad']); ?></li>
                            <li class="form-control-titles"><?php echo htmlspecialchars($animal['tamano']); ?></li>
                            <li class="form-control-titles"><?php echo htmlspecialchars($animal['estado_salud']); ?></li>
                            <li class="form-control-titles"><?php echo htmlspecialchars($animal['sexo']); ?></li>
                            <li class="form-control-titles"><?php echo htmlspecialchars($animal['esterilizado']); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Urgent Case Section -->
<?php if ($animal['urgente'] == 1): ?>
    <div class="urgent-case row caso-urgente" id="urgentCase">
        <div class="titleUrgente">
            <h3>CASO URGENTE</h3>
        </div>
    </div>
<?php endif; ?>

<!-- History Section -->
<div class="history-section">
    <h5>Historia</h5>
    <p class="text-center">
        <?php echo !empty($animal['descripcion']) ? htmlspecialchars($animal['descripcion']) : 'Este animal aún no tiene una historia registrada.'; ?>
    </p>
</div>

<!-- Botones -->
<div class="container mt-4">
    <div class="row">
        <!-- Estado 'Adoptado' -->
        <div class="col-md-6 mb-4 d-flex align-items-center justify-content-center">
            <div class="btn-group btn-group-green" role="group" aria-label="Adoptado">
                <span class="me-2 fs-4">Adoptado:</span>
                <span class="badge fs-5 bg-<?php echo ($animal['adoptado'] == '1') ? 'success' : 'secondary'; ?>">
                    <?php echo ($animal['adoptado'] == '1') ? 'Sí' : 'No'; ?>
                </span>
            </div>
        </div>

        <!-- Estado 'En Acogida' -->
        <div class="col-md-6 mb-4 d-flex align-items-center justify-content-center">
            <div class="btn-group btn-group-green" role="group" aria-label="En Acogida">
                <span class="me-2 fs-4">En Acogida:</span>
                <span class="badge fs-5 bg-<?php echo ($animal['en_acogida'] == '1') ? 'success' : 'secondary'; ?>">
                    <?php echo ($animal['en_acogida'] == '1') ? 'Sí' : 'No'; ?>
                </span>
            </div>
        </div>
    </div>
</div>


<div class="container botones-bottom">
    <div class="row">
        <div class="col-md-6 mb-4 d-flex align-items-center justify-content-center">
            <a href="<?php echo BASE_URL; ?>router.php?action=detalleProtectora&id_protectora=<?php echo urlencode($animal['id_protectora']); ?>"
            class="btn w-100 btn-xl-standard btn-xl-alto">INFO PROTECTORA</a>
        </div>
        <!-- Botón para abrir el popup con el formulario -->
        <div class="col-md-6 mb-4 d-flex align-items-center justify-content-center">
            <a href="#popUp" class="btn w-100 btn-xl-standard btn-xl-alto" id="solicitar-info-btn" data-id="<?php echo $animal['id_animal']; ?>">
                CONTACTAR
            </a>
        </div>
    </div>
</div>

<!-- Contenido del popup -->
<div id="popUp">
    <div class="popup-content">
        <!-- Cerrar el popup -->
        <a href="#" class="close-btn">X</a>
        <?php include 'solicitarInformacion.php'; ?>
    </div>
</div>