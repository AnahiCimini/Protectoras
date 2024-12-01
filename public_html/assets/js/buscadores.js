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
