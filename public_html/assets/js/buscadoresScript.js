document.addEventListener("DOMContentLoaded", () => {
    const btnEditar = document.getElementById("btn-editar");
    const btnGuardar = document.getElementById("btn-guardar");
    const btnCancelar = document.getElementById("btn-cancelar");
    const inputs = document.querySelectorAll("#form-editar-protectora input");
    const inputGroups = document.querySelectorAll('.input-group');

    // Variable para almacenar los valores originales
    const valoresOriginales = {};

    btnEditar.addEventListener("click", () => {
        // Guardar los valores originales antes de permitir edición
        inputs.forEach(input => {
            valoresOriginales[input.id] = input.value;
            input.classList.remove('input-sin-borde');
            input.removeAttribute("readonly");
        });

        inputGroups.forEach(group => {
            group.style.display = 'block';
        });

        btnEditar.classList.add("d-none");
        btnGuardar.classList.remove("d-none");
        btnCancelar.classList.remove("d-none");
    });

    btnCancelar.addEventListener("click", () => {
        inputs.forEach(input => {
            input.value = valoresOriginales[input.id] || "";
            input.setAttribute("readonly", true);
            input.classList.add('input-sin-borde');
        });

        inputGroups.forEach(group => {
            group.style.display = 'inline-flex';
        });

        btnGuardar.classList.add("d-none");
        btnCancelar.classList.add("d-none");
        btnEditar.classList.remove("d-none");
    });
});

/* BOTONES DE GUARDAR DATOS ANIMALES */

document.addEventListener("DOMContentLoaded", () => {
    const btnGuardar = document.getElementById("guardarBtn");
    const inputs = document.querySelectorAll("#form-editar-animal input, #form-editar-animal select, #form-editar-animal textarea");

    // Almacenamos los valores originales
    const valoresOriginales = {};
    inputs.forEach(input => {
        if (input.tagName === "SELECT" || input.tagName === "TEXTAREA") {
            valoresOriginales[input.name] = input.value;
        } else if (input.type === "radio" || input.type === "checkbox") {
            valoresOriginales[input.name] = input.checked;
        } else {
            valoresOriginales[input.id] = input.value;
        }
    });

    // Función para habilitar los botones si algo ha cambiado
    function detectChanges() {
        let hasChanges = false;

        inputs.forEach(input => {
            let currentValue;
            if (input.tagName === "SELECT" || input.tagName === "TEXTAREA") {
                currentValue = input.value;
            } else if (input.type === "radio" || input.type === "checkbox") {
                currentValue = input.checked;
            } else {
                currentValue = input.value;
            }

            const originalValue = valoresOriginales[input.name] || valoresOriginales[input.id];

            if (currentValue !== originalValue) {
                hasChanges = true;
            }
        });

        // Habilitar o deshabilitar los botones
        btnGuardar.disabled = !hasChanges;

        // Cambiar las clases para el estilo
        if (hasChanges) {
            btnGuardar.classList.remove('btn-disabled');
            btnGuardar.classList.add('btn-enabled');
        } else {
            btnGuardar.classList.remove('btn-enabled');
            btnGuardar.classList.add('btn-disabled');
        }
    }

    // Asignar eventos a los inputs para detectar cambios
    inputs.forEach(input => {
        input.addEventListener('input', detectChanges);
        input.addEventListener('change', detectChanges);
    });

    // Detectar cambios iniciales
    detectChanges();
});
