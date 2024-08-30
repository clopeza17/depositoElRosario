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
                    <li><a href="#inventario"><span class="icon">📦</span> Inventario</a></li>
                    <li><a href="#pedidos"><span class="icon">📋</span> Pedidos</a></li>
                    <li><a href="#proveedores"><span class="icon">🚚</span> Proveedores</a></li>
                    <li><a href="#reportes"><span class="icon">📊</span> Reportes</a></li>
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
                        <li><a href="#" id="theme-toggle"><span class="icon theme-icon">🌞</span> <span class="theme-text">Cambiar a modo oscuro</span></a></li>
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
                <p class="summary-number">Q.123,456</p>
            </div>
        </section>
        
        <section id="inventario" class="section">
            <h2>Inventario</h2>
            <div class="section-grid">
                <div class="section-card">
                    <h3>Productos más vendidos</h3>
                    <ul>
                        <li>Producto A - 100 unidades</li>
                        <li>Producto B - 85 unidades</li>
                        <li>Producto C - 70 unidades</li>
                    </ul>
                </div>
                <div class="section-card">
                    <h3>Productos con bajo stock</h3>
                    <ul>
                        <li>Producto X - 5 unidades</li>
                        <li>Producto Y - 3 unidades</li>
                        <li>Producto Z - 2 unidades</li>
                    </ul>
                </div>
            </div>
            <a href="#" class="btn">Ver inventario completo</a>
        </section>
        
        <section id="pedidos" class="section">
            <h2>Pedidos</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Pedido</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>Juan Pérez</td>
                        <td>2023-05-15</td>
                        <td>En proceso</td>
                        <td>Q.500</td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>María Gómez</td>
                        <td>2023-05-14</td>
                        <td>Enviado</td>
                        <td>Q.750</td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>Carlos Rodríguez</td>
                        <td>2023-05-13</td>
                        <td>Entregado</td>
                        <td>Q.1000</td>
                    </tr>
                </tbody>
            </table>
            <a href="#" class="btn">Ver todos los pedidos</a>
        </section>
        
        <section id="proveedores" class="section">
            <h2>Proveedores</h2>
            <div class="section-grid">
                <div class="section-card">
                    <h3>Proveedor A</h3>
                    <p>Productos: 50</p>
                    <p>Última entrega: 2023-05-10</p>
                </div>
                <div class="section-card">
                    <h3>Proveedor B</h3>
                    <p>Productos: 35</p>
                    <p>Última entrega: 2023-05-08</p>
                </div>
                <div class="section-card">
                    <h3>Proveedor C</h3>
                    <p>Productos: 40</p>
                    <p>Última entrega: 2023-05-12</p>
                </div>
            </div>
            <a href="#" class="btn">Gestionar proveedores</a>
        </section>
        
        <section id="reportes" class="section">
            <h2>Reportes</h2>
            <div class="section-grid">
                <div class="section-card">
                    <h3>Ventas mensuales</h3>
                    <p>Total: Q.50,000</p>
                    <p>Crecimiento: +5%</p>
                </div>
                <div class="section-card">
                    <h3>Productos más rentables</h3>
                    <p>1. Producto X</p>
                    <p>2. Producto Y</p>
                    <p>3. Producto Z</p>
                </div>
            </div>
            <a href="#" class="btn">Ver reportes detallados</a>
        </section>
    </main>
    <script src="script.js"></script>
</body>
</html>