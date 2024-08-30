<?php
// Inicializar la sesión
session_start();

// Verificar si el usuario ya ha iniciado sesión, si es así, redirigir a la página de bienvenida
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("Location: dashboard.php");
    exit;
}

// Incluir archivo de configuración
require_once "login.php";
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
                    <input type="text" id="username" name="username" required value="<?php echo htmlspecialchars($username ?? ''); ?>" placeholder="Ingrese su nombre de usuario">
                    <?php 
                    if(!empty($username_err)){
                        echo '<span class="error-message">' . htmlspecialchars($username_err) . '</span>';
                    }
                    ?>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña:</label>
                    <div class="password-input-wrapper">
                        <input type="password" id="password" name="password" required placeholder="Ingrese su contraseña">
                        <div id="capsLockWarning" class="caps-lock-warning" style="display: none;">Bloq Mayús está activado</div>
                    </div>
                    <?php 
                    if(!empty($password_err)){
                        echo '<span class="error-message">' . htmlspecialchars($password_err) . '</span>';
                    }
                    ?>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var input = document.getElementById('password');
            var warning = document.getElementById('capsLockWarning');

            input.addEventListener("keyup", function(event) {
                if (event.getModifierState("CapsLock")) {
                    warning.style.display = "block";
                } else {
                    warning.style.display = "none";
                }
            });
        });
    </script>
</body>
</html>