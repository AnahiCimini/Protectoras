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
    const btnCancelar = document.getElementById("cancelarBtn");
    const inputs = document.querySelectorAll("#form-editar-animal input");
    
    const valoresOriginales = {}; // Almacenamos los valores originales

    // Guardamos los valores originales para cada campo
    inputs.forEach(input => {
        if (input.type === "radio") {
            valoresOriginales[input.name] = document.querySelector(`input[name='${input.name}']:checked`)?.value || "";
        } else {
            valoresOriginales[input.id] = input.value;
        }
    });

    // Función para habilitar los botones si algo ha cambiado
    function detectChanges() {
        let hasChanges = false;

        inputs.forEach(input => {
            let currentValue;
            if (input.type === "radio") {
                currentValue = document.querySelector(`input[name='${input.name}']:checked`)?.value || "";
            } else {
                currentValue = input.value;
            }

            const originalValue = valoresOriginales[input.type === "radio" ? input.name : input.id];
            
            if (currentValue !== originalValue) {
                hasChanges = true;
            }
        });

        // Habilitar o deshabilitar los botones
        btnGuardar.disabled = !hasChanges;
        btnCancelar.disabled = !hasChanges;

        // Cambiar las clases para el estilo
        if (hasChanges) {
            btnGuardar.classList.remove('btn-disabled');
            btnCancelar.classList.remove('btn-disabled');
            btnGuardar.classList.add('btn-enabled');
            btnCancelar.classList.add('btn-enabled');
        } else {
            btnGuardar.classList.remove('btn-enabled');
            btnCancelar.classList.remove('btn-enabled');
            btnGuardar.classList.add('btn-disabled');
            btnCancelar.classList.add('btn-disabled');
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

