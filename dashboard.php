<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Depósito el Rosario</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <header class="dashboard-header">
        <div class="header-container">
            <div class="logo">
                <a href="#">Depósito el Rosario</a>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="#"><span class="icon">📦</span> Inventario</a></li>
                    <li><a href="#"><span class="icon">📋</span> Pedidos</a></li>
                    <li><a href="#"><span class="icon">🚚</span> Proveedores</a></li>
                    <li><a href="#"><span class="icon">📊</span> Reportes</a></li>
                </ul>
            </nav>
            <div class="user-menu">
                <div class="theme-switch">
                    <input type="checkbox" id="theme-toggle">
                    <label for="theme-toggle">Cambiar tema</label>
                </div>
                <div class="user-dropdown">
                    <button class="user-button">
                        <img src="https://via.placeholder.com/32" alt="Usuario" class="user-avatar">
                        <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        <span class="dropdown-arrow">▼</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#"><span class="icon">👤</span> Perfil</a></li>
                        <li><a href="#"><span class="icon">⚙️</span> Configuración</a></li>
                        <li><a href="logout.php"><span class="icon">🚪</span> Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <main class="dashboard-main">
        <section class="dashboard-summary">
            <div class="summary-card">
                <h3>Total de Productos</h3>
                <p class="summary-number">1,234</p>
            </div>
            <div class="summary-card">
                <h3>Productos Bajos en Stock</h3>
                <p class="summary-number">23</p>
            </div>
            <div class="summary-card">
                <h3>Pedidos Pendientes</h3>
                <p class="summary-number">15</p>
            </div>
            <div class="summary-card">
                <h3>Valor del Inventario</h3>
                <p class="summary-number">$123,456</p>
            </div>
        </section>
        <section class="recent-activity">
            <h2>Actividad Reciente</h2>
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Actividad</th>
                        <th>Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2023-05-15</td>
                        <td>Ingreso de nuevo producto: Tornillos 3/4"</td>
                        <td>Juan Pérez</td>
                    </tr>
                    <tr>
                        <td>2023-05-14</td>
                        <td>Actualización de stock: Cemento Portland</td>
                        <td>María Gómez</td>
                    </tr>
                    <tr>
                        <td>2023-05-13</td>
                        <td>Pedido realizado: 100 unidades de Ladrillos</td>
                        <td>Carlos Rodríguez</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
    <script src="script.js"></script>
</body>
</html>