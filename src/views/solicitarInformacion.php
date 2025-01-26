<?php
require_once PROJECT_ROOT . '/config/config.php';

// Validar que se ha enviado un ID de animal
if (isset($_GET['id_animal'])) {
    $id_animal = htmlspecialchars($_GET['id_animal']);
} else {
    die('ID de animal no proporcionado.');
}
?>

<div class="popup-content">
    <h3 class="popup-title">CONTACTA</h3>
    <form action="<?php echo BASE_URL; ?>router.php?action=solicitarInformacion" method="POST" id="form-infoAnimal">
        <input type="hidden" name="id_animal" value="<?php echo $id_animal; ?>">
        <div class="mb-3">
            <label for="nombre" class="form-label"></label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe aquí tu nombre" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label"></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label"></label>
            <input type="telefono" class="form-control" id="telefono" name="telefono" placeholder="Teléfono de contacto">
        </div>
        <div class="mb-3">
            <label for="mensaje" class="form-label"></label>
            <textarea class="form-control" id="mensaje" name="mensaje" rows="4" placeholder="Si quieres explicar algo sobre ti o preguntar algo sobre este caso, por favor, escríbelo aquí."></textarea>
        </div>
        <button type="submit" class="btn btn-standard">Enviar</button>
    </form>
</div>
