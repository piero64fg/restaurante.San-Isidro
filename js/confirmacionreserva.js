// Función para mostrar la alerta cuando se envía el formulario
function mostrarAlerta() {
    console.log("Función mostrarAlerta llamada."); // Depuración
    // Mostrar la alerta
    var alerta = document.getElementById("alertaReserva");
    alerta.innerText = "¡Reservación exitosa! Sus datos han sido enviados correctamente.";
    alerta.style.display = "block";
}

// Seleccionar el formulario y asignar la función al evento submit
document.addEventListener("DOMContentLoaded", function() {
    console.log("DOM completamente cargado y analizado."); // Depuración
    var formulario = document.getElementById("reservaForm");
    formulario.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevenir el envío predeterminado del formulario
        console.log("Formulario enviado."); // Depuración
        mostrarAlerta(); // Mostrar la alerta personalizada
    });
});



