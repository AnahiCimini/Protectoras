<div class="container-fluid">
    <div class="row d-flex flex-wrap" id="accordionCCAA">
        <?php foreach ($ccaas as $ccaa): ?>
            <div class="col-12 col-md-3 mb-3 rows_ccaa">
                <!-- Botón de CCAA -->
                <button class="btn btn-block rounded-3 btn-ccaa" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $ccaa['id_ccaa']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $ccaa['id_ccaa']; ?>">
                    <?php echo htmlspecialchars($ccaa['nombre_ccaa']); ?>
                </button>
            </div>

            <!-- Contenedor de provincias colapsable -->
            <div id="collapse<?php echo $ccaa['id_ccaa']; ?>" class="collapse provincias_collapse" data-bs-parent="#accordionCCAA">
                <div class="container-fluid">
                <div class="row d-flex" id="accordionProvincias<?php echo $ccaa['id_ccaa']; ?>">
                    <?php
                        foreach ($provincias as $provincia):
                            if ($provincia['id_ccaa'] == $ccaa['id_ccaa']):
                                $protectoraModel = new Protectora($conn);
                                $protectoras = $protectoraModel->getProtectorasByProvincia($provincia['id_provincia']);
                        ?>
                            <div class="col-6 col-md-3 mb-3">
                                <!-- Botón de provincia -->
                                <button class="btn btn-block rounded-3 btn-ccaa" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-provincia-<?php echo $provincia['id_provincia']; ?>" aria-expanded="false" aria-controls="collapse-provincia-<?php echo $provincia['id_provincia']; ?>">
                                    <?php echo htmlspecialchars($provincia['nombre_provincia']); ?>
                                </button>
                                
                                <!-- Contenedor de protectoras colapsables -->
                                <div id="collapse-provincia-<?php echo $provincia['id_provincia']; ?>" class="collapse" data-bs-parent="#accordionProvincias<?php echo $ccaa['id_ccaa']; ?>">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <?php if (!empty($protectoras)): ?>
                                                <?php foreach ($protectoras as $protectora): ?>
                                                    <div class="col-12 mb-3">
                                                        <div class="">
                                                            <div class="">
                                                                <h4 class="protectoras_lista">
                                                                    <a href="<?php echo BASE_URL; ?>router.php?action=detalleProtectora&nombre_protectora=<?php echo urlencode($protectora['nombre_protectora']); ?>">
                                                                        <?php echo htmlspecialchars($protectora['nombre_protectora']); ?>
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <p>No hay protectoras disponibles para esta provincia.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
