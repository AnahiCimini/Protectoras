<?php
    require_once PROJECT_ROOT . '/config/config.php';
    require_once PROJECT_ROOT . '/src/models/Animal.php';
    require_once PROJECT_ROOT . '/src/controllers/AnimalController.php';

    $animales = $data['animales'] ?? [];
    $nombre_protectora = $data['nombre_protectora'] ?? 'Nombre no disponible';
?>

<!-- buscarPorEspecieView.php -->
<h1>
    <?php 
        echo !empty($nombre_protectora) 
            ? htmlspecialchars($nombre_protectora) 
            : 'Nombre de protectora no disponible'; 
    ?>
</h1>
<br>

<!-- BUSCADORES EXTRA -->

<form action="" method="POST" id="form_filtrosEnProtectoras">
    <input type="hidden" name="nombre_protectora" value="<?php echo $nombre_protectora; ?>">

    <div class="container">
        <div class="row g-3 d-flex justify-content-center">
            <div class="col-12 col-md-2">
                <select class="form-select" name="especie">
                    <option value="">Especie</option>
                    <option value="Perros" <?php echo isset($_POST['especie']) && $_POST['especie'] == 'Perros' ? 'selected' : ''; ?>>Perros</option>
                    <option value="Gatos" <?php echo isset($_POST['especie']) && $_POST['especie'] == 'Gatos' ? 'selected' : ''; ?>>Gatos</option>
                    <option value="Conejos" <?php echo isset($_POST['especie']) && $_POST['especie'] == 'Conejos' ? 'selected' : ''; ?>>Conejos</option>
                    <option value="Pájaros" <?php echo isset($_POST['especie']) && $_POST['especie'] == 'Pájaros' ? 'selected' : ''; ?>>Pájaros</option>
                    <option value="Roedores" <?php echo isset($_POST['especie']) && $_POST['especie'] == 'Roedores' ? 'selected' : ''; ?>>Roedores</option>
                    <option value="Reptiles" <?php echo isset($_POST['especie']) && $_POST['especie'] == 'Reptiles' ? 'selected' : ''; ?>>Reptiles</option>
                    <option value="Otras especies" <?php echo isset($_POST['especie']) && $_POST['especie'] == 'Otras especies' ? 'selected' : ''; ?>>Otras especies</option>
                </select>
            </div>
            <div class="col-12 col-md-2">
                <select class="form-select" name="tamano">
                    <option value="">Tamaño</option>
                    <option value="Enano" <?php echo isset($_POST['tamano']) && $_POST['tamano'] == 'Enano' ? 'selected' : ''; ?>>Enano</option>
                    <option value="Pequeño" <?php echo isset($_POST['tamano']) && $_POST['tamano'] == 'Pequeño' ? 'selected' : ''; ?>>Pequeño</option>
                    <option value="Mediano" <?php echo isset($_POST['tamano']) && $_POST['tamano'] == 'Mediano' ? 'selected' : ''; ?>>Mediano</option>
                    <option value="Grande" <?php echo isset($_POST['tamano']) && $_POST['tamano'] == 'Grande' ? 'selected' : ''; ?>>Grande</option>
                    <option value="Gigante" <?php echo isset($_POST['tamano']) && $_POST['tamano'] == 'Gigante' ? 'selected' : ''; ?>>Gigante</option>
                </select>
            </div>
            <div class="col-12 col-md-2">
                <select class="form-select" name="sexo">
                    <option value="">Sexo</option>
                    <option value="Macho" <?php echo isset($_POST['sexo']) && $_POST['sexo'] == 'Macho' ? 'selected' : ''; ?>>Macho</option>
                    <option value="Hembra" <?php echo isset($_POST['sexo']) && $_POST['sexo'] == 'Hembra' ? 'selected' : ''; ?>>Hembra</option>
                </select>
            </div>
            <div class="col-12 col-md-2">
                <select class="form-select" name="edad">
                    <option value="">Edad</option>
                    <option value="Bebé" <?php echo isset($_POST['edad']) && $_POST['edad'] == 'Bebé' ? 'selected' : ''; ?>>Bebé</option>
                    <option value="Joven" <?php echo isset($_POST['edad']) && $_POST['edad'] == 'Joven' ? 'selected' : ''; ?>>Joven</option>
                    <option value="Adulto" <?php echo isset($_POST['edad']) && $_POST['edad'] == 'Adulto' ? 'selected' : ''; ?>>Adulto</option>
                    <option value="Anciano" <?php echo isset($_POST['edad']) && $_POST['edad'] == 'Anciano' ? 'selected' : ''; ?>>Anciano</option>
                </select>
            </div>
            <div class="col-12 col-md-2">
                <label>
                    <input type="checkbox" name="urgente" value="1" <?php echo isset($_POST['urgente']) && $_POST['urgente'] == 1 ? 'checked' : ''; ?>> Urgente
                </label>
            </div>
            <div class="col-12 col-md-2">
                <button type="submit" class="btn-standard rounded-4 btn-filtros">Buscar</button>
            </div>
        </div>
    </div>
</form>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar los valores del formulario
    $nombre_protectora = $_POST['nombre_protectora'] ?? '';
    $especie = $_POST['especie'] ?? '';
    $tamano = $_POST['tamano'] ?? '';
    $sexo = $_POST['sexo'] ?? '';
    $edad = $_POST['edad'] ?? '';
    $urgente = isset($_POST['urgente']) ? 1 : 0;

    // Construir la consulta SQL con filtros
    require_once PROJECT_ROOT . '/src/models/Animal.php';
    $animalController = new AnimalController ($conn);
    $animalesFiltrados = $animalController->buscarPorProtectoraConFiltros();
}
?>


<!-- CONTENEDOR DE RESULTADOS -->

<div id="animales-list" class="container">
    <div id="animales-container" class="row">
        <?php
        // Determinar si se han aplicado filtros o si se muestran todos los animales
        $listaAnimales = isset($animalesFiltrados) ? $animalesFiltrados : $animales;

        if (empty($listaAnimales)): ?>
            <p>No se encontraron animales para esta búsqueda.</p>
        <?php else: ?>
            <?php foreach ($listaAnimales as $animal): ?>
                <div class="col-md-3 mb-3">
                    <div class="animal card p-3 shadow-sm animal_card">
                        <?php if ($animal['urgente'] == 1): ?>
                            <div class="urgent-label">Urgente</div>
                        <?php endif; ?>
                        <h3><?php echo htmlspecialchars($animal['nombre_animal']); ?></h3>
                        <?php if (!empty($animal['foto_principal'])): ?>
                            <img class="pet-profile-img" src="<?= BASE_URL . 'assets/img/uploads/animales/' . htmlspecialchars($animal['foto_principal']); ?>" alt="Foto principal de <?php echo $animal['nombre_animal']; ?>" />
                        <?php endif; ?>
                        <span>Raza / especie: <?php echo htmlspecialchars($animal['raza']); ?></span>
                        <span>Edad: <?php echo htmlspecialchars($animal['edad']); ?></span>
                        <span>Descripción: <?php echo nl2br(htmlspecialchars($animal['descripcion'] ?? 'Descripción no disponible')); ?></span>
                        <span><a href="<?php echo BASE_URL; ?>router.php?action=detalleAnimal&id_animal=<?php echo $animal['id_animal']; ?>">Ver más</a></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Cargando más -->
<div id="loading" class="text-center d-none">
    <p>Cargando más...</p>
</div>
