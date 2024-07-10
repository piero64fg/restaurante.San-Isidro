<?php
// Conexión a la base de datos
include 'db_config.php';

// Obtener datos del carrito del POST
$data = json_decode(file_get_contents('php://input'), true);

// Verificar si hay datos y guardar en la base de datos
if (!empty($data)) {
    $stmt = $conn->prepare("INSERT INTO compras (nombre, precio, cantidad) VALUES (?, ?, ?)");

    foreach ($data as $item) {
        $name = $item['name'];
        $price = $item['price'];
        $quantity = $item['quantity'];
        $stmt->bind_param("sdi", $name, $price, $quantity);
        $stmt->execute();
    }

    $stmt->close();
    $conn->close();

    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Datos vacíos']);
}
?>

