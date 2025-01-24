<?php
    require_once PROJECT_ROOT . '/config/config.php';
?>

<div class="container mt-5">
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
<div class="urgent-case">
    <h3>CASO URGENTE</h3>
</div>

<!-- History Section -->
<div class="history-section">
    <h5>Historia</h5>
    <p>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vitae ornare tortor, vel aliquet mi.
    Mauris cursus sodales lobortis. Nullam placerat dignissim quam nec elementum.
    </p>
</div>

<div>
    CHECK BUTTONS
</div>