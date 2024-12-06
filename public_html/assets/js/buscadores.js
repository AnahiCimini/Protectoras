$(document).ready(function() {
    var page = 1; // Página inicial
    var loading = false; // Evitar múltiples solicitudes simultáneas

    // Detectar cuando llegamos al final de la página
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() == $(document).height() && !loading) {
            loading = true;
            page++; // Incrementar página

            // Mostrar el mensaje de "Cargando más"
            $('#loading').removeClass('d-none');

            // Hacer una solicitud AJAX para cargar más animales
            $.get('ajax_get_animales.php', { page: page, especie: '<?php echo $especie; ?>' }, function(data) {
                if (data) {
                    // Agregar los nuevos animales al contenedor
                    $('#animales-container').append(data);
                    $('#loading').addClass('d-none');
                    loading = false;
                } else {
                    $('#loading').html('<p>No hay más animales.</p>');
                }
            });
        }
    });
});

// Función para cargar provincias y protectoras por CCAA
function loadProvinciasProtectoras(ccaaName, ccaaId) {
    // Realizamos la petición AJAX al controlador
    $.ajax({
        url: 'index.php?page=getProvinciasProtectoras', // Cambia según tu estructura de URLs
        method: 'POST',
        data: { ccaa_id: ccaaId },
        dataType: 'json',
        success: function(response) {
            if(response.error) {
                alert(response.error);
            } else {
                // Cerrar cualquier acordeón abierto antes de abrir el nuevo
                $('.ccaa-accordion').collapse('hide');

                // Generar provincias en el acordeón
                var provinciasHtml = '';
                response.provincias.forEach(function(provincia) {
                    provinciasHtml += '<button class="btn btn-light provincia-button" data-id="' + provincia.id + '">' + provincia.nombre + '</button>';
                });

                // Generar protectoras en el acordeón
                var protectorasHtml = '';
                response.protectoras.forEach(function(protectora) {
                    protectorasHtml += '<p>' + protectora.nombre_protectora + ' - ' + protectora.provincia + '</p>';
                });

                // Insertar provincias y protectoras en el acordeón
                var acordeonHtml = `
                    <div class="ccaa-accordion" id="ccaa-accordion-${ccaaId}">
                        <div class="card">
                            <div class="card-header" id="heading-${ccaaId}">
                                <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapse-${ccaaId}" aria-expanded="true" aria-controls="collapse-${ccaaId}">
                                    Provincias de ${ccaaName}
                                </button>
                            </div>
                            <div id="collapse-${ccaaId}" class="collapse" aria-labelledby="heading-${ccaaId}" data-parent="#ccaa-list">
                                <div class="card-body">
                                    ${provinciasHtml}
                                    <hr>
                                    ${protectorasHtml}
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                // Insertar el acordeón en el DOM justo debajo de la CCAA seleccionada
                $('#ccaa-' + ccaaId).after(acordeonHtml);

                // Mostrar el acordeón de la CCAA seleccionada
                $('#collapse-' + ccaaId).collapse('show');
            }
        },
        error: function() {
            alert('Hubo un error al cargar las provincias y protectoras.');
        }
    });
}
