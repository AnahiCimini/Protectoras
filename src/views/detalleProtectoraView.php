<?php
    require_once PROJECT_ROOT . '/config/config.php';

    // Verificar si el usuario está logado, puedes usar tu lógica de sesión aquí
    $loggedIn = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true;

    if (isset($_GET['protectora'])) {
        $protectora = $_GET['protectora'];
    }
?>

<div class="container">
    <div class="text-end">
        <button onclick="window.history.back();" class="btn btn-standard">Volver</button>
    </div>
</div>

<div class="container container-profileProte">
    <div class="row align-items-center">
        <div class="col-6 align-self-center logoProte">
            <?php if (!empty($protectora['logo'])): ?>
                <img src="<?= BASE_URL . 'assets/img/uploads/protectoras/' . htmlspecialchars($protectora['logo']) ?>" alt="Logo de la protectora">
            <?php endif; ?>
        </div>
        <div class="col-6 btn-adopta">
            <a href="<?php echo BASE_URL; ?>router.php?action=buscarPorProtectora&nombre_protectora=<?php echo urlencode($protectora['nombre_protectora']); ?>">
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
                
                <?php if (isset($_SESSION['nombre_protectora']) && $_SESSION['nombre_protectora'] == $protectora['nombre_protectora']): ?>
                    <form method="post" action="<?= BASE_URL ?>router.php?action=actualizarDatosProtectora" id="form-editar-protectora">
                        <!-- Dirección -->
                        <div class="input-group">
                            <label for="direccion"><strong>Dirección:</strong></label>
                            <input type="text" name="direccion" class="input-sin-borde" value="<?= htmlspecialchars($protectora['direccion']) ?>" 
                                id="direccion" class="form-control" readonly>
                        </div>

                        <!-- Teléfono -->
                        <div class="input-group">
                            <label for="telefono"><strong>Teléfono:</strong></label>
                            <input type="text" name="telefono" class="input-sin-borde" value="<?= htmlspecialchars($protectora['telefono']) ?>" 
                                id="telefono" class="form-control" readonly>
                        </div>

                        <!-- Email -->
                        <div class="input-group">
                            <label for="email"><strong>Email:</strong></label>
                            <input type="email" name="email" class="input-sin-borde no-editable" value="<?= htmlspecialchars($protectora['email']) ?>" 
                                id="email" class="form-control" readonly>
                        </div>

                        <!-- Población -->
                        <div class="input-group">
                            <label for="poblacion"><strong>Población:</strong></label>
                            <input type="text" name="poblacion" class="input-sin-borde" value="<?= htmlspecialchars($protectora['poblacion']) ?>" 
                                id="poblacion" class="form-control" readonly>
                            <p class="text-extraSmall">Si cambias de población, procura que corresponda a la misma provincia en la que te encuentras. Si necesitas cambiar la provincia, escríbenos.</p>
                        </div>

                        <!-- Página web -->
                        <div class="input-group">
                            <label for="web"><strong>Web:</strong></label>
                            <input type="url" name="web" class="input-sin-borde" value="<?= htmlspecialchars($protectora['web']) ?>" 
                                id="web" class="form-control" readonly>
                        </div>
                        <div id="botones">
                            <!-- Botón Editar -->
                            <button type="button" class="btn btn-standard" id="btn-editar">Editar</button>
                            
                            <!-- Botones Guardar y Cancelar (Ocultos inicialmente) -->
                            <button type="submit" class="btn btn-standard btn-success d-none" id="btn-guardar">Guardar</button>
                            <button type="button" class="btn btn-secondary d-none" id="btn-cancelar">Cancelar</button>
                        </div>
                    </form>
                <?php else: ?>
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
                <?php endif; ?>

            </div>
        </div>

        <div class="col-6 formProte">
            <div class="shadow-right">
            <?php if (isset($_SESSION['nombre_protectora']) && $_SESSION['nombre_protectora'] == $protectora['nombre_protectora']): ?>
                <!-- Formulario para contactar con el administrador -->
                    <form action="contactaAdministrador.php" method="post">
                        <h4>Para cambiar el nombre de la protectora, la provincia o la comunidad autónoma, por favor, contacta con el administrador.</h4>
                        <textarea placeholder="Escribe aquí tu mensaje" name="mensajeContacto" required></textarea>
                        <button type="submit" class="rounded-3 btn"><h5>Contacta con el administrador</h5></button>
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


