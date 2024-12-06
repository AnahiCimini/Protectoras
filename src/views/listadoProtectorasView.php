<?php
    require_once PROJECT_ROOT . '/config/config.php';
?>

<div class="container mt-4">
        <h1 class="text-center">Listado de protectoras</h1>
        <!-- Botones de Comunidades Autónomas -->
        <div id="ccaa-list" class="mt-4">
            <div class="row ccaa-row">
                <div class="col-3">
                    <button class="btn btn-success ccaa-button" onclick="loadProvinciasProtectoras('Andalucía', 1)">Andalucía</button>
                </div>
                <div class="col-3">
                    <button class="btn btn-success ccaa-button" onclick="loadProvinciasProtectoras('Aragón', 2)">Aragón</button>
                </div>
                <div class="col-3">
                    <button class="btn btn-success ccaa-button" onclick="loadProvinciasProtectoras('Asturias', 3)">Asturias</button>
                </div>
                <div class="col-3">
                    <button class="btn btn-success ccaa-button" onclick="loadProvinciasProtectoras('Baleares', 4)">Baleares</button>
                </div>
            </div>
            <div class="row ccaa-row">
                <div class="col-3">
                    <button class="btn btn-success ccaa-button" onclick="loadProvinciasProtectoras('Canarias', 5)">Canarias</button>
                </div>
                <div class="col-3">
                    <button class="btn btn-success ccaa-button" onclick="loadProvinciasProtectoras('Cantabria', 6)">Cantabria</button>
                </div>
                <div class="col-3">
                    <button class="btn btn-success ccaa-button" onclick="loadProvinciasProtectoras('Castilla-La Mancha', 7)">Castilla-La Mancha</button>
                </div>
                <div class="col-3">
                    <button class="btn btn-success ccaa-button" onclick="loadProvinciasProtectoras('Castilla y León', 8)">Castilla y León</button>
                </div>
            </div>
            <div class="row ccaa-row">
                <div class="col-3">
                    <button class="btn btn-success ccaa-button" onclick="loadProvinciasProtectoras('Cataluña', 9)">Cataluña</button>
                </div>
                <div class="col-3">
                    <button class="btn btn-success ccaa-button" onclick="loadProvinciasProtectoras('Extremadura', 10)">Extremadura</button>
                </div>
                <div class="col-3">
                    <button class="btn btn-success ccaa-button" onclick="loadProvinciasProtectoras('Galicia', 11)">Galicia</button>
                </div>
                <div class="col-3">
                    <button class="btn btn-success ccaa-button" onclick="loadProvinciasProtectoras('Madrid', 12)">Madrid</button>
                </div>
            </div>
            <div class="row ccaa-row">
                <div class="col-3">
                    <button class="btn btn-success ccaa-button" onclick="loadProvinciasProtectoras('Murcia', 13)">Murcia</button>
                </div>
                <div class="col-3">
                    <button class="btn btn-success ccaa-button" onclick="loadProvinciasProtectoras('Navarra', 14)">Navarra</button>
                </div>
                <div class="col-3">
                    <button class="btn btn-success ccaa-button" onclick="loadProvinciasProtectoras('La Rioja', 15)">La Rioja</button>
                </div>
                <div class="col-3">
                    <button class="btn btn-success ccaa-button" onclick="loadProvinciasProtectoras('País Vasco', 16)">País Vasco</button>
                </div>
            </div>
            <div class="row ccaa-row">
                <div class="col-3">
                    <button class="btn btn-success ccaa-button" onclick="loadProvinciasProtectoras('Valencia', 17)">Valencia</button>
                </div>
                <div class="col-3">
                    <button class="btn btn-success ccaa-button" onclick="loadProvinciasProtectoras('Ceuta', 18)">Ceuta</button>
                </div>
                <div class="col-3">
                    <button class="btn btn-success ccaa-button" onclick="loadProvinciasProtectoras('Melilla', 19)">Melilla</button>
                </div>
            </div>
        </div>
</div>