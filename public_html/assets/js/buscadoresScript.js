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

    // Usar jQuery para manejar el evento de clic en los botones de CCAA
    $('.ccaa-button').on('click', function() {
        var idCCAA = $(this).data('id'); // Obtener el ID de la CCAA
        cargarProvincias(idCCAA, $(this)); // Pasar el botón como jQuery
    });

    // Función para cargar las provincias
    function cargarProvincias(idCCAA, button) {
        // Crear un ID único para cada contenedor de provincias usando el id de la CCAA
        var provinciasContainerId = 'provincias-container-' + idCCAA;
        
        // Verificar si ya existe un contenedor de provincias con ese ID
        var existingContainer = $('#' + provinciasContainerId);
        if (existingContainer.length > 0) {
            // Si el contenedor existe, alternar su visibilidad
            existingContainer.toggle();
            return; // Salir si ya hay un contenedor visible
        }

        // Si no existe, realizar la solicitud AJAX
        $.ajax({
            url: 'index.php?page=protectoras&id_ccaa=' + idCCAA, // URL con el ID de la CCAA
            type: 'GET',
            success: function(response) {
                // Crear el contenedor para las provincias con el ID único
                var provinciasContainer = $('<div id="' + provinciasContainerId + '"></div>');
                provinciasContainer.html(response); // Cargar las provincias en el contenedor

                // Insertar las provincias justo después del botón
                button.after(provinciasContainer); // Insertar debajo del botón
            }
        });
    }
});
