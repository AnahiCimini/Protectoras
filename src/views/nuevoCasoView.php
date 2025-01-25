<?php require_once PROJECT_ROOT . '/config/config.php'; ?>

<div class="container">
    <div class="text-end">
        <button onclick="window.history.back();" class="btn btn-standard">Volver</button>
    </div>
</div>

<div class="container mt-5">
    <h1 class="text-center">Añadir Nuevo Caso</h1>
    <form action="<?= BASE_URL ?>router.php?action=addCase" method="POST" enctype="multipart/form-data">
        <!-- Imagen Principal -->
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <label for="foto_principal">Foto Principal:</label>
                <input type="file" id="foto_principal" name="foto_principal" class="form-control" required>
            </div>
            <div class="col-md-6 text-center">
                <label for="nombre_animal">Nombre del Animal:</label>
                <input type="text" id="nombre_animal" name="nombre_animal" class="form-control" required>
            </div>
        </div>

        <!-- Datos del Animal -->
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="raza">Raza:</label>
                <input type="text" id="raza" name="raza" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="id_especie">Especie:</label>
                <select id="id_especie" name="id_especie" class="form-select" required>
                    <option value="Perros">Perros</option>
                    <option value="Gatos">Gatos</option>
                    <option value="Conejos">Conejos</option>
                    <option value="Pájaros">Pájaros</option>
                    <option value="Roedores">Roedores</option>
                    <option value="Reptiles">Reptiles</option>
                    <option value="Otras especies">Otras especies</option>
                </select>
            </div>
        </div>

        <!-- Características -->
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="edad">Edad:</label>
                <select id="edad" name="edad" class="form-select" required>
                    <option value="bebé">Bebé</option>
                    <option value="joven">Joven</option>
                    <option value="adulto">Adulto</option>
                    <option value="anciano">Anciano</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="tamano">Tamaño:</label>
                <select id="tamano" name="tamano" class="form-select" required>
                    <option value="enano">Enano</option>
                    <option value="pequeño">Pequeño</option>
                    <option value="mediano">Mediano</option>
                    <option value="grande">Grande</option>
                    <option value="gigante">Gigante</option>
                </select>
            </div>
        </div>

        <!-- Selección de Opciones -->
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="sexo">Sexo:</label>
                <select id="sexo" name="sexo" class="form-select" required>
                    <option value="Macho">Macho</option>
                    <option value="Hembra">Hembra</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="estado_salud">Estado de Salud:</label>
                <select id="estado_salud" name="estado_salud" class="form-select" required>
                    <option value="Bueno">Bueno</option>
                    <option value="Enfermedad crónica">Enfermedad crónica</option>
                    <option value="Malo">Malo</option>
                    <option value="Otros (consultar)">Otros (consultar)</option>
                </select>
            </div>
        </div>

        <!-- Casos Especiales -->
        <div class="row mb-4">
            <div class="col-md-4 text-center">
                <label for="urgente">¿Es urgente?</label>
                <input type="checkbox" id="urgente" name="urgente" class="form-check-input">
            </div>
            <div class="col-md-4 text-center">
                <label for="en_acogida">¿Está en acogida?</label>
                <input type="checkbox" id="en_acogida" name="en_acogida" class="form-check-input">
            </div>
            <div class="col-md-4 text-center">
                <label for="fallecido">¿Está fallecido?</label>
                <input type="checkbox" id="fallecido" name="fallecido" class="form-check-input">
            </div>
        </div>

        <!-- Historia -->
        <div class="mb-4">
            <label for="descripcion">Descripción / Historia:</label>
            <textarea id="descripcion" name="descripcion" class="form-control"></textarea>
        </div>

        <!-- Botón de Envío -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Añadir Animal</button>
        </div>
    </form>
</div>
