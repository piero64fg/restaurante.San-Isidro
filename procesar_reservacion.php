<link rel="stylesheet" href="style_procesar_reserva.css">
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

    // Recoger los datos del formulario
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $fecha = $_POST['date'];
    $hora = $_POST['time'];
    $numero_de_personas = $_POST['guests'];
    $adelanto = 50; // Monto del adelanto en soles

    // Preparar la declaración SQL
    $stmt = $conn->prepare("INSERT INTO Mesas (nombre, email, fecha, hora, numero_de_personas, estado) VALUES (:nombre, :email, :fecha, :hora, :numero_de_personas, 'pendiente')");

    // Vincular parámetros
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':hora', $hora);
    $stmt->bindParam(':numero_de_personas', $numero_de_personas);

    // Ejecutar la declaración y manejar posibles errores
    $stmt->execute();
    $last_id = $conn->lastInsertId(); // Obtener el ID de la última inserción

    // Mostrar instrucciones de pago
    echo "<h2>Gracias por tu reserva</h2>
          <p>Por favor, realiza un pago de adelanto de S/. $adelanto para confirmar tu reserva.</p>
          <h3>Opciones de pago:</h3>
    <ul>
              <li>Yape o Plin: +51 930 532 846</li>
              <li>BCP: 123-456789-0-12</li>
              <li>BBVA: 345-678901-2-34</li>
              <li>Interbank: 105-523801-9-15</li>
              <li>Scotiabank: 475-423197-1-13</li>
    </ul>
          <p>Una vez realizado el pago, envía una foto del comprobante a nuestro WhatsApp: <a href='https://wa.link/cfx17w'>+51 930 532 846</a>.</p>
          <p>Tu reserva estará pendiente de confirmación hasta que recibamos el comprobante de pago.</p>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión
$conn = null;
?>
