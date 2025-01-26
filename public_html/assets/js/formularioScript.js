document.getElementById('solicitar-info-btn').addEventListener('click', function () {
    const idAnimal = this.dataset.id;

    // Crear el contenedor del popup
    const popupContainer = document.createElement('div');
    popupContainer.id = 'popup-container';
    popupContainer.style.position = 'fixed';
    popupContainer.style.top = '0';
    popupContainer.style.left = '0';
    popupContainer.style.width = '100%';
    popupContainer.style.height = '100%';
    popupContainer.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    popupContainer.style.display = 'flex';
    popupContainer.style.alignItems = 'center';
    popupContainer.style.justifyContent = 'center';
    popupContainer.style.zIndex = '1000';

    // Cargar el contenido del popup
    const popupContent = document.createElement('div');
    popupContent.style.backgroundColor = '#fff';
    popupContent.style.padding = '20px';
    popupContent.style.borderRadius = '10px';
    popupContent.style.width = '50%';
    popupContent.style.boxShadow = '0 4px 10px rgba(0, 0, 0, 0.3)';

    popupContainer.appendChild(popupContent);
    document.body.appendChild(popupContainer);

    // Realizar la solicitud AJAX para cargar el contenido
    fetch(`<?php echo BASE_URL; ?>src/views/solicitarInformacion.php?id_animal=${idAnimal}`)
    .then(response => response.text())
        .then(data => {
            popupContent.innerHTML = data;

            // Agregar botón de cierre
            const closeButton = document.createElement('button');
            closeButton.innerText = 'Cerrar';
            closeButton.style.marginTop = '10px';
            closeButton.className = 'btn btn-danger';
            closeButton.onclick = () => popupContainer.remove();
            popupContent.appendChild(closeButton);
        })
        .catch(error => {
            popupContent.innerHTML = '<p>Hubo un error al cargar el formulario. Intenta nuevamente.</p>';
            console.error(error);
        });
});