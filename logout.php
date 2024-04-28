<?php
session_start();

// Destruir todas las variables de sesión
session_destroy();

// Redirigir al usuario a la página de inicio u otra página
header("location: login.php"); // Cambia "index.php" a la página deseada
exit;
?>
