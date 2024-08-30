<?php
// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inicializar la sesión (solo si no está ya iniciada)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario ya ha iniciado sesión, si es así, redirigir a la página de bienvenida
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("Location: dashboard.php");
    exit;
}

// Definir variables e inicializar con valores vacíos
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Procesar datos del formulario cuando se envía el formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Incluir archivo de login
    require_once "login.php";
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
            if(!empty($login_err)){
                echo '<div class="error-message">' . htmlspecialchars($login_err) . '</div>';
            }        
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="input-group">
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="username" required value="<?php echo htmlspecialchars($username ?? ''); ?>">
                    <?php 
                    if(!empty($username_err)){
                        echo '<span class="error-message">' . htmlspecialchars($username_err) . '</span>';
                    }
                    ?>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                    <?php 
                    if(!empty($password_err)){
                        echo '<span class="error-message">' . htmlspecialchars($password_err) . '</span>';
                    }
                    ?>
                    <p class="password-hint">La contraseña distingue entre mayúsculas y minúsculas</p>
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