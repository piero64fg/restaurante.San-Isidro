<?php
    // Configuración de la base de datos
    $servername = "localhost";  // Servidor de la base de datos, usualmente es "localhost" en XAMPP
    $username = "root";         // Nombre de usuario de la base de datos, por defecto es "root" en XAMPP
    $password = "";             // Contraseña de la base de datos, por defecto es vacía en XAMPP
    $dbname = "reservaciones";     // Nombre de la base de datos

    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("La conexión falló: " . $conn->connect_error);
    } 
    echo "Conexión exitosa";
?>
