<?php
    require_once PROJECT_ROOT . '/config/config.php';
?>

<div class="container mt-5 infoBasica">
    <!-- Profile Card -->
    <div class="row align-items-center g-0">
        <!-- Pet Image -->
        <div class="col-6">
            <img src="<?php echo BASE_URL; ?>assets/img/perroLapiz2.png" alt="Pet" class="pet-profile-img">
        </div>
        <!-- Pet Details -->
        <div class="col-6 text-center">
            <div class="datosAnimal text-center col-6">
                <h4 class="customTitle">NOMBRE</h4>
                <div class="row">
                    <div class="col-6">
                        <ul class="list-unstyled text-end">
                            <li><strong>Raza:</strong></li>
                            <li><strong>Edad:</strong></li>
                            <li><strong>Tamaño:</strong></li>
                            <li><strong>Peso:</strong></li>
                            <li><strong>Salud:</strong></li>
                            <li><strong>Sexo:</strong></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-unstyled text-start">
                            <li>Rottweiler</li>
                            <li>Bebé</li>
                            <li>Grande</li>
                            <li>20 kg</li>
                            <li>Buena</li>
                            <li>Macho</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Urgent Case Section -->
<div class="urgent-case row urgente-noselected" id="urgentCase">
    <div class="titleUrgente col-md-8">
        <h3>CASO URGENTE</h3>
    </div>

    <div class="col-md-4 d-flex align-items-center justify-content-center">
        <div class="btn-group btn-group-grey btn-group-toggle" data-toggle="buttons" role="group" aria-label="Urgente">
            <input type="radio" class="btn-check btn-check-grey" name="urgente" id="urgente-no" value="no" autocomplete="off" checked>
            <label class="btn" for="urgente-no">No</label>

            <input type="radio" class="btn-check btn-check-grey" name="urgente" id="urgente-si" value="si" autocomplete="off">
            <label class="btn" for="urgente-si">Sí</label>
        </div>
    </div>
</div>


<!-- History Section -->
<div class="history-section">
    <h5>Historia</h5>
    <p>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vitae ornare tortor, vel aliquet mi.
    Mauris cursus sodales lobortis. Nullam placerat dignissim quam nec elementum.
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

    <div class="row">
        <!-- Selector para 'Esterilizado' -->
        <div class="col-md-6 mb-4 d-flex align-items-center justify-content-center">
            <div class="btn-group btn-group-green" role="group" aria-label="Esterilizado">
                <span class="me-2 fs-4">Esterilizado</span>
                <input type="radio" class="btn-check btn-check-green" name="esterilizado" id="esterilizado-no" value="no" autocomplete="off" checked>
                <label class="btn" for="esterilizado-no">No</label>

                <input type="radio" class="btn-check btn-check-green" name="esterilizado" id="esterilizado-compromiso" value="compromiso" autocomplete="off">
                <label class="btn" for="esterilizado-compromiso">Compromiso</label>
            </div>
        </div>

        <!-- Selector para 'Fallecido' -->
        <div class="col-md-6 mb-4 d-flex align-items-center justify-content-center">
            <div class="btn-group btn-group-green" role="group" aria-label="Fallecido">
                <span class="me-2 fs-4">Fallecido</span>
                <input type="radio" class="btn-check btn-check-green" name="fallecido" id="fallecido-no" value="no" autocomplete="off" checked>
                <label class="btn" for="fallecido-no">No</label>

                <input type="radio" class="btn-check btn-check-green" name="fallecido" id="fallecido-compromiso" value="compromiso" autocomplete="off">
                <label class="btn" for="fallecido-compromiso">Sí</label>
            </div>
        </div>
    </div>
</div>