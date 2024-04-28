<?php
$servername = "localhost";
$username = "id21354155_admin"; // Cambiar por tu usuario de MySQL
$password = "Gteyu3455@"; // Cambiar por tu contraseña de MySQL
$dbname = "id21354155_clinica_cita"; // Cambiar por el nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Recuperar datos del formulario
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$motivo = $_POST['motivo'];
$fechaSeleccionada = $_POST['fecha'];
$horaSeleccionada = $_POST['hora'];

// Validar que todos los campos estén completos
if (empty($nombre) || empty($telefono) || empty($motivo) || empty($fechaSeleccionada) || empty($horaSeleccionada)) {
    echo "Por favor, completa todos los campos.";
} else {
    // Consulta SQL para obtener las horas ocupadas para la fecha seleccionada
    $sqlHorasOcupadas = "SELECT hora FROM citas WHERE fecha = '$fechaSeleccionada'";
    $resultadoHorasOcupadas = $conn->query($sqlHorasOcupadas);

    $horasOcupadas = array();

    if ($resultadoHorasOcupadas->num_rows > 0) {
        while ($fila = $resultadoHorasOcupadas->fetch_assoc()) {
            $horasOcupadas[] = $fila['hora'];
        }
    }

    // Verificar disponibilidad de la hora
    if (in_array($horaSeleccionada, $horasOcupadas)) {
        echo "Lo sentimos, la hora seleccionada ya está ocupada. Por favor, elige otra hora.";
    }
     else {
        // Consulta SQL para insertar los datos
        $sql = "INSERT INTO citas (nombre, telefono, motivo, fecha, hora)
                VALUES ('$nombre', '$telefono', '$motivo', '$fechaSeleccionada', '$horaSeleccionada')";
        
        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            echo "¡Cita agendada con éxito! Te contactaremos pronto.";
        } else {
            echo "Error al guardar la cita: " . $conn->error;
        }
    }
}

// Cerrar la conexión
$conn->close();
?>
