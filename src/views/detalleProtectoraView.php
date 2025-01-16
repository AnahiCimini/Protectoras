<?php
    require_once PROJECT_ROOT . '/config/config.php';

    // Verificar si el usuario está logado, puedes usar tu lógica de sesión aquí
    $loggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true;

    if (isset($_GET['protectora'])) {
        $protectora = $_GET['protectora'];
    }
?>

<div class="container container-profileProte">
    <div class="row align-items-center">
        <div class="col-6 align-self-center logoProte">
            <?php if (!empty($protectora['logo'])): ?>
                <img src="<?= BASE_URL . 'assets/img/uploads/protectoras/' . htmlspecialchars($protectora['logo']) ?>" alt="Logo de la protectora">
            <?php endif; ?>
        </div>
        <div class="col-6 btn-adopta">
            <a href="<?php echo BASE_URL; ?>router.php?action=buscarPorProtectora&protectora=<?php echo urlencode($protectora['nombre_protectora']); ?>">
                <button class="btn-adopciones rounded-4 shadow-right"><h4>Adopciones</h4></button>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-6 datosProte">
            <div class="shadow-left">
                <!-- Nombre -->
                <h4>
                    <?php echo isset($protectora['nombre_protectora']) 
                        ? htmlspecialchars($protectora['nombre_protectora']) 
                        : 'No disponible'; ?>
                </h4>
                <!-- Dirección -->
                <p><strong>Dirección:</strong> <?= htmlspecialchars($protectora['direccion']) ?></p>

                <!-- Teléfono -->
                <p><strong>Teléfono:</strong> <?= htmlspecialchars($protectora['telefono']) ?></p>

                <!-- Email -->
                <p><strong>Email:</strong> <?= htmlspecialchars($protectora['email']) ?></p>

                <!-- Población -->
                <p><strong>Población:</strong> <?= htmlspecialchars($protectora['poblacion']) ?></p>

                <!-- Página web -->
                <p><strong>Web:</strong> <a href="<?= htmlspecialchars($protectora['web']) ?>" target="_blank"><?= htmlspecialchars($protectora['web']) ?></a></p>

            </div>
        </div>

        <div class="col-6 formProte">
            <div class="shadow-right">
            <?php if (isset($_SESSION['nombre_protectora']) && $_SESSION['nombre_protectora'] == $protectora['nombre_protectora']): ?>
                <!-- Formulario para contactar con el administrador -->
                    <form action="contactaAdministrador.php" method="post">
                        <h4>Para cambiar el nombre de la protectora, la provincia o la comunidad autónoma, por favor, contacta con el administrador.</h4>
                        <textarea placeholder="Escribe aquí tu mensaje" name="mensajeContacto" required></textarea>
                        <button type="submit" class="rounded-3"><h5>Contacta con el administrador</h5></button>
                    </form>
                <?php else: ?>
                    <!-- Formulario original de contacto -->
                    <form>
                        <h2>Contacta</h2>
                        <input placeholder="Escribe aquí tu nombre" name="nombreContacto" type="text">
                        <input placeholder="Email de contacto*" name="emailContacto" type="email" required>
                        <textarea placeholder="Escribe aquí el mensaje para la protectora" name="mensajeContacto" type="textarea"></textarea>                    
                        <button type="submit" class="rounded-3"><h5>Enviar</h5></button>
                    </form>
                <?php endif; ?>
        </div>
    </div>
</div>


