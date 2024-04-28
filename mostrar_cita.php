<?php
// Incluye el archivo de conexión a la base de datos
include("conexion.php");

// Verifica si se envió una fecha desde la solicitud AJAX
if (isset($_POST['fecha_seleccionada'])) {
    $fechaSeleccionada = $_POST['fecha_seleccionada'];

    // Consulta SQL para obtener las citas para la fecha seleccionada
    $sqlCitasFecha = "SELECT nombre, telefono, motivo, fecha, hora FROM citas WHERE fecha = '$fechaSeleccionada'";
    $resultadoCitasFecha = $conn->query($sqlCitasFecha);

    if ($resultadoCitasFecha->num_rows > 0) {
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<th>Teléfono</th>";
        echo "<th>Motivo</th>";
        echo "<th>Fecha</th>";
        echo "<th>Hora</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($fila = $resultadoCitasFecha->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["nombre"] . "</td>";
            echo "<td>" . $fila["telefono"] . "</td>";
            echo "<td>" . $fila["motivo"] . "</td>";
            echo "<td>" . $fila["fecha"] . "</td>";
            echo "<td>" . $fila["hora"] . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No hay citas programadas para la fecha seleccionada.</p>";
    }
}
?>
