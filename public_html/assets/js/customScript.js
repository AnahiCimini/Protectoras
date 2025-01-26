/* URGENTE */

/* EN EL DETALLE DEL ANIMAL */
document.addEventListener('DOMContentLoaded', function () {
    var urgentCaseDiv = document.getElementById('urgentCase');


    // No es necesario manipular las clases con el valor de "urgente" desde PHP
    var urgenteValue = document.querySelector('input[name="urgente"]:checked')?.value;

    // Verificar el valor y asegurarse de que las clases sean consistentes
    if (urgenteValue === "1") {
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

