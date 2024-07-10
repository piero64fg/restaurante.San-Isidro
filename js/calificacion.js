// Espera a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Obtén el formulario por su ID
    const form = document.getElementById('calificacionForm');

    // Agrega un event listener para el evento submit
    form.addEventListener('submit', function(event) {
        // Previene el comportamiento predeterminado de envío del formulario
        event.preventDefault();

        // Realiza la solicitud POST con los datos del formulario
        fetch('guardar_comentario.php', {
            method: 'POST',
            body: new FormData(form)
        })
        .then(response => response.json()) // Parsea la respuesta como JSON
        .then(data => {
            // Muestra el mensaje de respuesta debajo del botón enviar
            const alerta = document.getElementById('alertaCalificacion');
            alerta.style.display = 'block';
            alerta.textContent = data.message;
        })
        .catch(error => {
            console.error('Error:', error);
            // Manejo de errores
            const alerta = document.getElementById('alertaCalificacion');
            alerta.style.display = 'block';
            alerta.textContent = 'Ocurrió un error al procesar la solicitud.';
        });
    });
});

