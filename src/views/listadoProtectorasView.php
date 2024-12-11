<div class="container mt-4">
    <h1 class="text-center">Listado de Protectoras</h1>

    <!-- Botones de Comunidades Autónomas -->
    <div id="ccaa-list" class="mt-4">
        <div class="row ccaa-row">
            <?php foreach ($ccaas as $ccaa): ?>
                <div class="col-3">
                    <button type="button" 
                            class="btn btn-primary ccaa-button" 
                            data-id="<?php echo $ccaa['id_ccaa']; ?>">
                        <?php echo $ccaa['nombre_ccaa']; ?>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Aquí aparecerán las provincias -->
    <div id="provincias-container" class="mt-4"></div>

    <!-- Aquí aparecerá el listado de protectoras -->
    <div id="protectoras-container" class="mt-4"></div>
</div>
