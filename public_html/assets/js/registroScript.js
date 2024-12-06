document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('registro_protectora').addEventListener('submit', function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);

        fetch(form.action, {
            method: form.method,
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            if (result.includes('Protectora registrada exitosamente')) {
                alert('Protectora registrada exitosamente.');
            } else {
                alert('Error al registrar la protectora.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un problema al intentar registrar la protectora.');
        });
    });
});
