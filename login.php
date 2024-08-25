<?php
// Nota: En un entorno de producción, deberías usar una base de datos para almacenar y verificar las credenciales.
$valid_username = "admin";
$valid_password = "password123";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php"); // Redirige a la página del dashboard
        exit();
    } else {
        $error_message = "Usuario o contraseña incorrectos. Por favor, intente de nuevo.";
    }
}
?>