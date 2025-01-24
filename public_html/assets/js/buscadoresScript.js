document.addEventListener("DOMContentLoaded", () => {
    // Comprobar si la página actual es 'router.php?action=detalleProtectora'
    const urlPath = window.location.pathname;
    const urlParams = window.location.search;

    if (urlPath.endsWith('router.php') && urlParams.includes('action=detalleProtectora')){
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
    }
});
