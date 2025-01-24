console.log('Script cargado');  // Verifica si se ejecuta

/* URGENTE */

/* EN EL DETALLE DEL ANIMAL */
document.addEventListener('DOMContentLoaded', function () {
    var urgentCaseDiv = document.getElementById('urgentCase');

    // Asegúrate de que el contenedor existe
    if (!urgentCaseDiv) {
        console.error('El contenedor con id "urgentCase" no se encontró.');
        return;
    }

    // Al seleccionar "No"
    document.getElementById('urgente-no').addEventListener('change', function () {
        urgentCaseDiv.classList.add('urgente-noselected');
        urgentCaseDiv.classList.remove('urgente-selected');
    });

    // Al seleccionar "Sí"
    document.getElementById('urgente-si').addEventListener('change', function () {
        urgentCaseDiv.classList.add('urgente-selected');
        urgentCaseDiv.classList.remove('urgente-noselected');
    });
});
