<div class="container-fluid">
    <div class="row d-flex flex-wrap">
        <?php foreach ($ccaas as $ccaa): ?>
            <div class="col-12 col-md-3 mb-3 rows_ccaa">
                <!-- Botón de CCAA -->
                <button class="btn btn-block rounded-3 btn-ccaa" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $ccaa['id_ccaa']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $ccaa['id_ccaa']; ?>">
                    <?php echo $ccaa['nombre_ccaa']; ?>
                </button>
            </div>

            <!-- Contenedor de provincias colapsable -->
            <div id="collapse<?php echo $ccaa['id_ccaa']; ?>" class="collapse provincias_collapse" data-bs-parent="#accordionExample">
                <div class="container-fluid">
                    <div class="row d-flex">
                        <?php
                            // Filtrar las provincias para esta CCAA
                            foreach ($provincias as $provincia) {
                                if ($provincia['id_ccaa'] == $ccaa['id_ccaa']) {
                                    // Obtener las protectoras para esta provincia
                                    $protectoraModel = new Protectora($conn);
                                    $protectoras = $protectoraModel->getProtectorasByProvincia($provincia['id_provincia']);
                                    
                                    // Mostrar las provincias y protectoras
                                    echo '
                                    <div class="col-6 col-md-3 mb-3">
                                        <button class="btn btn-block rounded-3 btn-ccaa" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-provincia-'.$provincia['id_provincia'].'" aria-expanded="false" aria-controls="collapse-provincia-'.$provincia['id_provincia'].'">
                                            ' . $provincia['nombre_provincia'] . ' 
                                        </button>
                                        
                                        <!-- Contenedor de protectoras colapsables -->
                                        <div id="collapse-provincia-'.$provincia['id_provincia'].'" class="collapse">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    ';
                                                        // Mostrar protectoras para esta provincia
                                                        if (!empty($protectoras)) {
                                                            foreach ($protectoras as $protectora) {
                                                                echo '
                                                                <div class="col-12 mb-3">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">' . $protectora['nombre_protectora'] . '</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>';
                                                            }
                                                        } else {
                                                            echo '<p>No hay protectoras disponibles para esta provincia.</p>';
                                                        }
                                                    echo '
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
