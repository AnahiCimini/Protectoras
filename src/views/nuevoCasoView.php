<?php
    require_once PROJECT_ROOT . '/config/config.php';
?>

<h1>Nuevo caso</h1>

<form action="<?= BASE_URL ?>router.php?action=addCase" method="POST" enctype="multipart/form-data">
    <label for="nombre_animal">Nombre del Animal:</label>
    <input type="text" id="nombre_animal" name="nombre_animal" required>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion"></textarea>

    <label for="raza">Raza:</label>
    <input type="text" id="raza" name="raza">

    <label for="tamano">Tamaño:</label>
    <select id="tamano" name="tamano" required>
        <option value="enano">Enano</option>
        <option value="pequeño">Pequeño</option>
        <option value="mediano">Mediano</option>
        <option value="grande">Grande</option>
        <option value="gigante">Gigante</option>
    </select>

    <label for="sexo">Sexo:</label>
    <select id="sexo" name="sexo" required>
        <option value="Macho">Macho</option>
        <option value="Hembra">Hembra</option>
    </select>

    <label for="edad">Edad:</label>
    <select id="edad" name="edad" required>
        <option value="bebé">Bebé</option>
        <option value="joven">Joven</option>
        <option value="adulto">Adulto</option>
        <option value="anciano">Anciano</option>
    </select>

    <label for="estado_salud">Estado de Salud:</label>
    <select id="estado_salud" name="estado_salud" required>
        <option value="Bueno">Bueno</option>
        <option value="Enfermedad crónica">Enfermedad crónica</option>
        <option value="Malo">Malo</option>
        <option value="Otros (consultar)">Otros (consultar)</option>
    </select>

    <label for="foto_principal">Foto Principal:</label>
    <input type="file" id="foto_principal" name="foto_principal" required>

    <label for="urgente">¿Es urgente?</label>
    <input type="checkbox" id="urgente" name="urgente">

    <label for="en_acogida">¿Está en acogida?</label>
    <input type="checkbox" id="en_acogida" name="en_acogida">

    <label for="esterilizado">Esterilizado:</label>
    <select id="esterilizado" name="esterilizado" required>
        <option value="Sí">Sí</option>
        <option value="Con compromiso de esterilización">Con compromiso de esterilización</option>
    </select>

    <label for="fallecido">¿Está fallecido?</label>
    <input type="checkbox" id="fallecido" name="fallecido">

    <label for="id_especie">Especie:</label>
    <select id="id_especie" name="id_especie" required>
        <option value="Perros">Perros</option>
        <option value="Gatos">Gatos</option>
        <option value="Conejos">Conejos</option>
        <option value="Pájaros">Pájaros</option>
        <option value="Roedores">Roedores</option>
        <option value="Reptiles">Reptiles</option>
        <option value="Otras especies">Otras especies</option>
    </select>

    <button type="submit">Añadir Animal</button>
</form>
