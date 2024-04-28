<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Realiza una consulta SQL para verificar las credenciales en la base de datos
    // Asegúrate de hacer una comparación segura de contraseñas (por ejemplo, mediante hashing)
    $servername = "localhost";
    $dbusername = "id21354155_admin"; // Cambia esto al nombre de usuario de la base de datos
    $dbpassword = "Gteyu3455@"; // Cambia esto a la contraseña de la base de datos
    $dbname = "id21354155_clinica_cita"; // Cambia esto al nombre de tu base de datos

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // Consulta SQL para verificar las credenciales
    $sql = "SELECT * FROM usuarios WHERE BINARY nombre_usuario = '$username' AND contrasena = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        header("location: clinica.php"); // Redirige a la página restringida
    } else {
        $error_message = "Credenciales incorrectas.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: rgb(3,106,173);
background: linear-gradient(90deg, rgba(3,106,173,0.8963234952183998) 0%, rgba(9,77,121,0.9579481450783438) 100%, rgba(0,212,255,1) 100%);
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px; /* Establece un ancho máximo para el contenedor */
            width: 100%;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
        }

        .login-form label {
            display: block;
            text-align: left;
            margin-left: 10px;
            margin-bottom: 5px;
        }

        .login-form input {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            width: 50%;
            margin-top: 10px;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #ff0000;
            margin-top: 10px;
        }
    </style>

</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form class="login-form" method="post" action="">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="Entrar">
        </form>
        <?php
        if (isset($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>
    </div>
</body>
</html>

