<?php
// Conexión a la base de datos
include 'reserva.php';
    if(isset($_POST['reservar'])){
        if(strlen($_POST['name'])>= 1 && strlen($_POST['email'])>= 1 && strlen($_POST['date'])>=1 &&
        strlen($_POST['time'])>= 1 && strlen($_POST['guests'])>= 1){
            // Recuperar los datos del formulario
            $nombre = $_POST['name'];
            $correo = $_POST['email'];
            $fecha = $_POST['date'];
            $hora = $_POST['time'];
            $personas = $_POST['guests'];
            $sql="INSERT INTO reserva_mesa(Nombre, Email, Fecha, Hora, `N°personas`) 
            VALUES ('$nombre','$correo','$fecha','$hora','$personas')";
            
            // Ejecutar la consulta
            if ($conn->query($sql) === TRUE) {
                echo "Nueva reserva creada con éxito";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "No se enviaron todos los datos necesarios.";
        }
    } else {
        echo "El formulario no se envió correctamente.";
    }
?>

