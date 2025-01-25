/* URGENTE */

/* EN EL DETALLE DEL ANIMAL */
document.addEventListener('DOMContentLoaded', function () {
    var urgentCaseDiv = document.getElementById('urgentCase');

    // Asegúrate de que el contenedor existe
    if (!urgentCaseDiv) {
        console.error('El contenedor con id "urgentCase" no se encontró.');
        return;
    }

    // Obtén el valor inicial del campo 'urgente' (si es "si" o "no")
    var urgenteValue = document.querySelector('input[name="urgente"]:checked')?.value;

    // Aplica las clases correctas al cargar la página
    if (urgenteValue === "si") {
        urgentCaseDiv.classList.add('urgente-selected');
        urgentCaseDiv.classList.remove('urgente-noselected');
    } else {
        urgentCaseDiv.classList.add('urgente-noselected');
        urgentCaseDiv.classList.remove('urgente-selected');
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

