let page = 2; // Empieza desde la segunda página (ya que los primeros animales están cargados al inicio)
let isLoading = false; // Para prevenir múltiples solicitudes al mismo tiempo

const loadingElement = document.getElementById('loading'); // El mensaje de "Cargando más"
const container = document.getElementById('animales-container'); // El contenedor de los animales

// Función para cargar más animales
const loadMoreAnimals = () => {
    if (isLoading) return; // Evita solicitudes mientras estamos cargando

    isLoading = true;
    loadingElement.classList.remove('d-none'); // Muestra el mensaje de "Cargando más"

    // Aquí hacemos el "fetch" de más animales
    fetch(`index.php?page=${page}&especie=<?php echo htmlspecialchars($especie); ?>`) // Aquí usa el endpoint que te da los animales en formato HTML
        .then(response => response.text()) // Obtener HTML
        .then(html => {
            if (html.trim() === '') { // Si no hay más resultados
                loadingElement.innerHTML = "No hay más animales."; // Muestra mensaje de fin de lista
            } else {
                container.insertAdjacentHTML('beforeend', html); // Agrega los nuevos animales al contenedor
                page++; // Incrementa la página para la siguiente carga
            }
            loadingElement.classList.add('d-none'); // Oculta el mensaje de "Cargando más"
            isLoading = false;
        })
        .catch(error => {
            console.error('Error al cargar más animales:', error);
            loadingElement.classList.add('d-none');
            isLoading = false;
        });
};

// Detecta el scroll y llama a la función loadMoreAnimals cuando se llega al final
container.addEventListener('scroll', () => {
    if (container.scrollTop + container.clientHeight >= container.scrollHeight - 100) {
        loadMoreAnimals(); // Llama a la función para cargar más animales
    }
});