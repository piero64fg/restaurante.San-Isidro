<?php

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$db = "carta";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}else {
    echo "Conexión exitosa"; // Esto imprimirá si la conexión fue exitosa
}
?>
