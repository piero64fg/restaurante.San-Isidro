<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reservas";

try {
    // Crear la conexión
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configurar el modo de error de PDO para que lance excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $reserva_id = $_POST['reserva_id'];

        // Obtener detalles de la reserva para enviar el correo
        $stmt = $conn->prepare("SELECT nombre, email, fecha, hora FROM Mesas WHERE id = :id");
        $stmt->bindParam(':id', $reserva_id);
        $stmt->execute();
        $reserva = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($reserva) {
            // Actualizar el estado de la reserva a "pagado"
            $stmt = $conn->prepare("UPDATE Mesas SET estado = 'pagado' WHERE id = :id");
            $stmt->bindParam(':id', $reserva_id);
            $stmt->execute();

            // Datos del cliente
            $nombre = $reserva['nombre'];
            $email = $reserva['email'];
            $fecha = $reserva['fecha'];
            $hora = $reserva['hora'];

            // Enviar correo de confirmación
            $to = $email;
            $subject = "Confirmación de Reserva - Restaurante San Isidro";
            $message = "Hola $nombre,\n\nTu reserva para el $fecha a las $hora ha sido confirmada. Te esperamos en el Restaurante San Isidro.\n\nGracias,\nRestaurante San Isidro";
            $headers = "From: no-reply@tudominio.com";

            if (mail($to, $subject, $message, $headers)) {
                echo "Reserva confirmada exitosamente y notificación enviada.";
            } else {
                echo "Reserva confirmada exitosamente, pero no se pudo enviar la notificación.";
            }
        } else {
            echo "No se encontró la reserva con ID: $reserva_id";
        }
    } else {
        echo "<form method='post'>
                <label for='reserva_id'>ID de la Reserva:</label>
                <input type='text' id='reserva_id' name='reserva_id' required>
                <button type='submit'>Confirmar Pago</button>
              </form>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión
$conn = null;
?>
