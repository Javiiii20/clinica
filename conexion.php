<?php
$servername = "localhost"; // Cambiar por la dirección del servidor de la base de datos si es diferente
$username = "id21354155_admin"; // Cambiar por tu nombre de usuario de MySQL
$password = "Gteyu3455@"; // Cambiar por tu contraseña de MySQL
$dbname = "id21354155_clinica_cita"; // Cambiar por el nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Establecer el conjunto de caracteres a UTF-8 (opcional, dependiendo de tu configuración)
$conn->set_charset("utf8");

// Ahora, puedes utilizar la variable $conn para interactuar con la base de datos en tus otros archivos PHP.
?>
