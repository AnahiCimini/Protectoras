<?php
    require_once PROJECT_ROOT . '/config/config.php';
?>

<div class="container">
    <div class="row">
        <form class="text-start col-6" action="router.php?action=eliminarAnimal&id_animal=<?php echo $animal['id_animal']; ?>" method="POST">
            <button type="submit" class="btn btn-danger">Eliminar Animal</button>
        </form>
        <div class="text-end col-6">
            <button onclick="window.history.back();" class="btn btn-standard">Volver</button>
        </div>
    </div>
</div>

<div class="container mt-5 infoBasica">
    <!-- Profile Card -->
    <div class="row align-items-center g-0">
        <!-- Pet Image -->
        <div class="col-6">
            <?php if (!empty($animal['foto_principal'])): ?>
                <img src="<?php echo BASE_URL . $animal['foto_principal']; ?>" alt="Foto principal de <?php echo $animal['nombre_animal']; ?>" />
            <?php else: ?>
                <p>No hay imágenes de este animal.</p>
            <?php endif; ?>
        </div>
        <!-- Pet Details -->
        <div class="col-6 text-center">
            <div class="datosAnimal text-center col-6">
                <div class="row">
                    <div class="col-6">
                        <ul class="list-unstyled text-end">
                            <li><strong>Raza:</strong></li>
                            <li><strong>Edad:</strong></li>
                            <li><strong>Tamaño:</strong></li>
                            <li><strong>Salud:</strong></li>
                            <li><strong>Sexo:</strong></li>
                            <li><strong>Esterilización:</strong></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-unstyled text-start">
                            <li><input type="text" name="raza" value="<?= htmlspecialchars($animal['raza']) ?>" id="raza" class="form-control"></li>
                            <li><input type="text" name="edad" value="<?= htmlspecialchars($animal['edad']) ?>" id="edad" class="form-control"></li>
                            <li><input type="text" name="tamano" value="<?= htmlspecialchars($animal['tamano']) ?>" id="tamano" class="form-control"></li>
                            <li><input type="text" name="estado_salud" value="<?= htmlspecialchars($animal['estado_salud']) ?>" id="estado_salud" class="form-control"></li>
                            <li><input type="text" name="sexo" value="<?= htmlspecialchars($animal['sexo']) ?>" id="sexo" class="form-control"></li>
                            <li><input type="text" name="esterilizado" value="<?= htmlspecialchars($animal['esterilizado']) ?>" id="esterilizado" class="form-control"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Urgent Case Section -->
<div class="urgent-case row" id="urgentCase">
    <div class="titleUrgente col-md-8">
        <h3>CASO URGENTE</h3>
    </div>

    <div class="col-md-4 d-flex align-items-center justify-content-center">
        <div class="btn-group btn-group-grey btn-group-toggle" data-toggle="buttons" role="group" aria-label="Urgente">
            <input type="radio"
                class="btn-check btn-check-grey"
                name="urgente"
                id="urgente-no"
                value="no"
                autocomplete="off"
                <?php echo ($animal['urgente'] == 0) ? 'checked' : ''; ?>>
            <label class="btn" for="urgente-no">No</label>

            <input type="radio"
                class="btn-check btn-check-grey"
                name="urgente"
                id="urgente-si"
                value="si"
                autocomplete="off"
                <?php echo ($animal['urgente'] == 1) ? 'checked' : ''; ?>>
            <label class="btn" for="urgente-si">Sí</label>
        </div>
    </div>
</div>


<!-- History Section -->
<div class="history-section">
    <h5>Historia</h5>
    <p>
        <?php echo !empty($animal['historia']) ? htmlspecialchars($animal['historia']) : 'Este animal aún no tiene una historia registrada.'; ?>
    </p>
</div>


<!-- Botones -->
<div class="container mt-4">
    <div class="row">
        <!-- Selector para 'Adoptado' -->
        <div class="col-md-6 mb-4 d-flex align-items-center justify-content-center">
            <div class="btn-group btn-group-green" role="group" aria-label="Adoptado">
                <span class="me-2 fs-4">Adoptado</span>
                <input type="radio" class="btn-check btn-check-green" name="adoptado" id="adoptado-no" value="no" autocomplete="off" checked>
                <label class="btn" for="adoptado-no">No</label>

                <input type="radio" class="btn-check btn-check-green" name="adoptado" id="adoptado-si" value="si" autocomplete="off">
                <label class="btn" for="adoptado-si">Sí</label>
            </div>
        </div>

        <!-- Selector para 'En Acogida' -->
        <div class="col-md-6 mb-4 d-flex align-items-center justify-content-center">
            <div class="btn-group btn-group-green" role="group" aria-label="En Acogida">
                <span class="me-2 fs-4">En Acogida</span>
                <input type="radio" class="btn-check btn-check-green" name="en_acogida" id="en_acogida-no" value="no" autocomplete="off" checked>
                <label class="btn" for="en_acogida-no">No</label>

                <input type="radio" class="btn-check btn-check-green" name="en_acogida" id="en_acogida-si" value="si" autocomplete="off">
                <label class="btn" for="en_acogida-si">Sí</label>
            </div>
        </div>
    </div>
</div>