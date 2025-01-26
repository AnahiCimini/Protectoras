<?php
    require_once PROJECT_ROOT . '/config/config.php';
?>

<?php if (isset($_SESSION['success'])): ?>
    <script>
        alert('<?php echo $_SESSION['success']; ?>');
    </script>
<?php unset($_SESSION['success']); endif; ?>

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

<form action="router.php?action=actualizarDatosAnimal&id_animal=<?= $animal['id_animal']; ?>" method="POST" id="form-editar-animal" enctype="multipart/form-data">
    <div class="container mt-5 infoBasica">
        <!-- Profile Card -->
        <div class="row align-items-center g-0">
            <!-- Pet Image -->
            <div class="col-6 imgAnimal">
                <?php if (!empty($animal['foto_principal'])): ?>
                    <img src="<?= BASE_URL . 'assets/img/uploads/animales/' . htmlspecialchars($animal['foto_principal']); ?>" alt="Foto principal de <?php echo $animal['nombre_animal']; ?>" />
                    <label for="foto_principal"></label>
                    <input type="file" name="foto_principal" placeholder="Cambiar foto" id="foto_principal" class="form-control" accept="image/*">
                <?php else: ?>
                    <p>No hay imágenes de este animal.</p>
                    <label for="foto_principal"></label>
                    <input type="file" name="foto_principal" id="foto_principal" class="form-control" accept="image/*" placeholder="Subir una foto">
                <?php endif; ?>
            </div>
            <!-- Pet Details -->
            <div class="col-6 text-center datosContainer">
                <h4 class="customTitle"><input type="text" name="nombre_animal" id="nombre_animal-editable" class="form-control textarea-transparente" value="<?= htmlspecialchars($animal['nombre_animal']) ?>"></h4>
                <div class="datosAnimal text-center col-6">
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled text-end">
                                <li class="form-control-titles"><strong>Raza:</strong></li>
                                <li class="form-control-titles"><strong><label for="edad">Edad:</label></strong></li>
                                <li class="form-control-titles"><strong><label for="tamano">Tamaño:</label></strong></li>
                                <li class="form-control-titles"><strong><label for="estado_salud">Salud:</label></strong></li>
                                <li class="form-control-titles"><strong><label for="sexo">Sexo:</label></strong></li>
                                <li class="form-control-titles"><strong><label for="esterilizado">Esterilizado:</label></strong></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled text-start">
                                <li><input type="text" name="raza" value="<?= htmlspecialchars($animal['raza']) ?>" id="raza" class="form-control"></li>
                                <li><select id="edad" name="edad" class="form-select" required>
                                        <option value="bebé" <?= $animal['edad'] === 'Bebé' ? 'selected' : '' ?>>Bebé</option>
                                        <option value="joven" <?= $animal['edad'] === 'Joven' ? 'selected' : '' ?>>Joven</option>
                                        <option value="adulto" <?= $animal['edad'] === 'Adulto' ? 'selected' : '' ?>>Adulto</option>
                                        <option value="anciano" <?= $animal['edad'] === 'Anciano' ? 'selected' : '' ?>>Anciano</option>
                                    </select>
                                </li>
                                <li><select id="tamano" name="tamano" class="form-select" required>
                                        <option value="enano" <?= $animal['tamano'] === 'Enano' ? 'selected' : '' ?>>Enano</option>
                                        <option value="pequeño" <?= $animal['tamano'] === 'Pequeño' ? 'selected' : '' ?>>Pequeño</option>
                                        <option value="mediano" <?= $animal['tamano'] === 'Mediano' ? 'selected' : '' ?>>Mediano</option>
                                        <option value="grande" <?= $animal['tamano'] === 'Grande' ? 'selected' : '' ?>>Grande</option>
                                        <option value="gigante" <?= $animal['tamano'] === 'Gigante' ? 'selected' : '' ?>>Gigante</option>
                                    </select>
                                </li>
                                <li><select id="estado_salud" name="estado_salud" class="form-select" required>
                                        <option value="Bueno" <?= $animal['estado_salud'] === 'Bueno' ? 'selected' : '' ?>>Bueno</option>
                                        <option value="Enfermedad crónica" <?= $animal['estado_salud'] === 'Enfermedad crónica' ? 'selected' : '' ?>>Enfermedad crónica</option>
                                        <option value="Malo" <?= $animal['estado_salud'] === 'Enano' ? 'Malo' : '' ?>>Malo</option>
                                        <option value="Otros (consultar)" <?= $animal['estado_salud'] === 'Otros (consultar)' ? 'selected' : '' ?>>Otros (consultar)</option>
                                    </select>
                                </li>
                                <li><select id="sexo" name="sexo" class="form-select" required>
                                        <option value="Macho" <?= $animal['sexo'] === 'Macho' ? 'selected' : '' ?>>Macho</option>
                                        <option value="Hembra" <?= $animal['sexo'] === 'Hembra' ? 'selected' : '' ?>>Hembra</option>
                                    </select>
                                </li>
                                <li><select id="esterilizado" name="esterilizado" class="form-select" required>
                                        <option value="Sí" <?= $animal['esterilizado'] === 'Sí' ? 'selected' : '' ?>>Sí</option>
                                        <option value="Con compromiso de esterilización" <?= $animal['esterilizado'] === 'Con compromiso de esterilización' ? 'selected' : '' ?>>Con compromiso de esterilización</option>
                                    </select>
                                </li>
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
                    value="0"
                    autocomplete="off"
                    <?php echo ($animal['urgente'] == 0) ? 'checked' : ''; ?>>
                <label class="btn" for="urgente-no">No</label>

                <input type="radio"
                    class="btn-check btn-check-grey"
                    name="urgente"
                    id="urgente-si"
                    value="1"
                    autocomplete="off"
                    <?php echo ($animal['urgente'] == 1) ? 'checked' : ''; ?>>
                <label class="btn" for="urgente-si">Sí</label>
            </div>
        </div>
    </div>


<!-- History Section -->
<div class="history-section">
    <h5>Historia</h5>
    <textarea 
        id="descripcion" 
        name="descripcion" 
        class="form-control textarea-transparente text-center" 
        rows="5" 
        placeholder="Este animal aún no tiene una historia registrada. Para añadir alguna descripción o historia, escribe aquí"><?= !empty($animal['descripcion']) ? htmlspecialchars($animal['descripcion']) : ''; ?></textarea>
</div>



    <!-- Botones -->
    <div class="container mt-4">
        <div class="row">
            <!-- Selector para 'Adoptado' -->
            <div class="col-md-6 mb-4 d-flex align-items-center justify-content-center">
                <div class="btn-group btn-group-green" role="group" aria-label="Adoptado">
                    <span class="me-2 fs-4">Adoptado</span>
                    <input type="radio" class="btn-check btn-check-green" name="adoptado" id="adoptado-no" value="0" autocomplete="off" 
                        <?php echo ($animal['adoptado'] == 0) ? 'checked' : ''; ?>>
                    <label class="btn" for="adoptado-no">No</label>

                    <input type="radio" class="btn-check btn-check-green" name="adoptado" id="adoptado-si" value="1" autocomplete="off"
                        <?php echo ($animal['adoptado'] == 1) ? 'checked' : ''; ?>>
                    <label class="btn" for="adoptado-si">Sí</label>
                </div>
            </div>

            <!-- Selector para 'En Acogida' -->
            <div class="col-md-6 mb-4 d-flex align-items-center justify-content-center">
                <div class="btn-group btn-group-green" role="group" aria-label="En Acogida">
                    <span class="me-2 fs-4">En Acogida</span>
                    <input type="radio" class="btn-check btn-check-green" name="en_acogida" id="en_acogida-no" value="0" autocomplete="off"
                        <?php echo ($animal['en_acogida'] == 0) ? 'checked' : ''; ?>>
                    <label class="btn" for="en_acogida-no">No</label>

                    <input type="radio" class="btn-check btn-check-green" name="en_acogida" id="en_acogida-si" value="1" autocomplete="off"
                        <?php echo ($animal['en_acogida'] == 1) ? 'checked' : ''; ?>>
                    <label class="btn" for="en_acogida-si">Sí</label>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4 guardadoDatos">
    <div class="row">
        <div class="">
            <button id="guardarBtn" type="submit" class="btn btn-xl-standard btn-disabled" disabled>
                Guardar Cambios
            </button>
        </div>
    </div>
</div>

</form>