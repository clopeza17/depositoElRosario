<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit();
}

require_once "db_config.php";

$id_cliente = $_SESSION['id_cliente'];
$msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $email = trim($_POST["email"]);
    $usuario = trim($_POST["usuario"]);
    $direccion = trim($_POST["direccion"]);
    $telefono = trim($_POST["telefono"]);
    
    $sql = "UPDATE Clientes SET nombre = ?, email = ?, usuario = ?, direccion = ?, telefono = ? WHERE id_cliente = ?";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssssi", $nombre, $email, $usuario, $direccion, $telefono, $id_cliente);
        
        if (mysqli_stmt_execute($stmt)) {
            $msg = "Perfil actualizado con éxito.";
        } else {
            $msg = "Ocurrió un error. Por favor, inténtelo de nuevo más tarde.";
        }
        mysqli_stmt_close($stmt);
    }
}

$sql = "SELECT nombre, email, usuario, direccion, telefono FROM Clientes WHERE id_cliente = ?";
if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $id_cliente);
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $nombre, $email, $usuario, $direccion, $telefono);
            mysqli_stmt_fetch($stmt);
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración - Depósito el Rosario</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
    <style>
        .config-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: var(--input-bg);
            border-radius: 8px;
            box-shadow: var(--box-shadow);
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        .form-group input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid var(--input-border);
            border-radius: 4px;
            font-size: 1rem;
            background-color: var(--input-bg);
            color: var(--text-color);
        }
        .submit-btn {
            background-color: var(--button-bg);
            color: var(--button-text);
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }
        .submit-btn:hover {
            background-color: var(--button-hover);
        }
        .message {
            margin-top: 1rem;
            padding: 0.5rem;
            border-radius: 4px;
            text-align: center;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <header class="dashboard-header">
        <div class="header-container">
            <div class="logo">
                <a href="dashboard.php">Depósito el Rosario</a>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="dashboard.php"><span class="icon">🏠</span> Dashboard</a></li>
                    <li><a href="#"><span class="icon">📦</span> Inventario</a></li>
                    <li><a href="#"><span class="icon">📋</span> Pedidos</a></li>
                    <li><a href="#"><span class="icon">🚚</span> Proveedores</a></li>
                    <li><a href="#"><span class="icon">📊</span> Reportes</a></li>
                </ul>
            </nav>
            <div class="user-menu">
                <div class="user-dropdown">
                    <button class="user-button">
                        <img src="https://via.placeholder.com/32" alt="Usuario" class="user-avatar">
                        <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        <span class="dropdown-arrow">▼</span>
                    </button>
                      <ul class="dropdown-menu">
                            <li><a href="#"><span class="icon">👤</span> Perfil</a></li>
                            <li><a href="configuracion.php"><span class="icon">⚙️</span> Configuración</a></li>
                            <li><a href="#" id="theme-toggle"><span class="icon">🌓</span> Cambiar tema</a></li>
                            <li><a href="logout.php"><span class="icon">🚪</span> Cerrar sesión</a></li>
                        </ul>
                </div>
            </div>
        </div>
    </header>
    <main class="config-container">
        <h1>Configuración de Perfil</h1>
        <?php
        if (!empty($msg)) {
            echo '<div class="message ' . ($msg == "Perfil actualizado con éxito." ? "success" : "error") . '">' . htmlspecialchars($msg) . '</div>';
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($direccion); ?>">
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>">
            </div>
            <button type="submit" class="submit-btn">Actualizar Perfil</button>
        </form>
    </main>
    <script src="script.js"></script>
</body>
</html>