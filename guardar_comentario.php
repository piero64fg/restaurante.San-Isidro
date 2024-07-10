<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reservas";

// Respuesta predeterminada
$response = array('success' => false, 'message' => 'Error al procesar la solicitud.');

try {
    // Crear la conexión a la base de datos
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configurar el modo de error de PDO para que lance excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recoger los datos del formulario
    $opinion = $_POST['review'];
    $valoracion = $_POST['rating'];

    // Preparar la declaración SQL para insertar los datos
    $stmt = $conn->prepare("INSERT INTO Comentarios (comentario, calificacion) VALUES (:opinion, :valoracion)");

    // Vincular parámetros
    $stmt->bindParam(':opinion', $opinion);
    $stmt->bindParam(':valoracion', $valoracion);

    // Ejecutar la declaración y manejar posibles errores
    $stmt->execute();

    // Si se llega aquí, significa que la inserción fue exitosa
    $response['success'] = true;
    $response['message'] = '¡Gracias por tu opinión y valoración!';

} catch (PDOException $e) {
    // Mostrar mensaje de error si ocurre algún problema con la conexión o la consulta SQL
    $response['message'] = 'Error: ' . $e->getMessage();
}

// Cerrar la conexión
$conn = null;

// Enviar respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>

