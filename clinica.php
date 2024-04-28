<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Resto del código de clinica.php aquí (código para mostrar las citas, etc.)
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Psicológica - Inicio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav>
    <div class="logo">
      <a href="index.html"><img  src="logopng.png" alt="logo"></a>
    </div>
    <ul>
      <li><a href="logout.php">Cerrar Sesión</a></li>
    </ul>
  </nav>
  <header>
    <div class="headline">
      <div class="inner">
        <h1>Clínica Psicológica <p></p>"Renacer"</h1>
        <p>Desliza para ver</p>
      </div>
    </div>
  </header>  
  <div class="citas-programadas">
        <h2>Citas Programadas</h2>
        
        <!-- Formulario de selección de fecha -->
        <form action="clinica.php" method="POST">
            <label for="fecha_seleccionada">Selecciona una fecha:</label>
            <input type="date" id="fecha_seleccionada" name="fecha_seleccionada" required>
            <button type="submit">Mostrar Citas</button>
        </form>

        <!-- Tabla de citas (mostrará las citas si se selecciona una fecha) -->
        <?php
        // Incluye el archivo de conexión a la base de datos
        include("conexion.php");

        // Verifica si se envió una fecha desde el formulario
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

        // Cierra la conexión a la base de datos
        $conn->close();
        ?>
    </div>

  
    </div>
  <footer>
    <div class="footer-container">
        <div class="contact-info">
            <h3>Contacto</h3>
            <p>Teléfono: +502 5454 1686</p>
            <p>Correo electrónico: info@clinicapsicologica.com</p>
        </div>
        <div class="social-media">
            <h3>Síguenos en redes sociales</h3>
            <div class="social-icons">
                <a href="https://www.facebook.com/ClinicaPsicologiaNuevaConcepcion" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
    <p class="copyright">&copy; 2023 Clínica Psicológica "Renacer". Todos los derechos reservados.</p>
</footer>
  <script>
    const inputFecha = document.getElementById("fecha");

    function esFinDeSemana(fecha) {
        const dia = fecha.getDay();
        return dia === 5 || dia === 6; 
    }

    inputFecha.addEventListener("input", function() {
        const fechaSeleccionada = new Date(this.value);

        if (esFinDeSemana(fechaSeleccionada)) {
            alert("No se permiten sábados ni domingos. Por favor, selecciona otra fecha.");
            this.value = "";
        }
    });
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
</body>
</html>

