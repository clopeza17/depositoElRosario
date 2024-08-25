<?php
session_start();
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'login.php';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - Depósito el Rosario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h1>Depósito el Rosario</h1>
            <h2>Sistema de Inventarios</h2>
            <?php
            if (!empty($error_message)) {
                echo "<p class='error-message'>$error_message</p>";
            }
            ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="input-group">
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="username" value="Ingrese su usuario" onfocus="this.value=''" required>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                    <p class="password-hint"></p>
                </div>
                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>
    </div>
    <div class="theme-switch">
        <input type="checkbox" id="theme-toggle">
        <label for="theme-toggle">Cambiar tema</label>
    </div>
    <script src="script.js"></script>
</body>
</html>