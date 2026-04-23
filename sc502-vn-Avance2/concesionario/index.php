<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concesionario Digital</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav>
        <a class="nav-brand" href="index.php">
            <span>CD</span> CONCESIONARIO
        </a>
        <div class="nav-links">
            <a href="index.php" class="active">Inicio</a>
            <a href="motos.php">Motos</a>
            <a href="autos.php">Autos</a>
            <a href="inventario.php">Inventario</a>
            
            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                <a href="gestion_clientes.php">Gestión de Clientes</a>
            <?php endif; ?>
            
            <a href="contacto.php">Contacto</a>

            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="logout.php" style="color: #e74c3c;">Cerrar Sesión (<?php echo $_SESSION['usuario']; ?>)</a>
            <?php else: ?>
                <a href="login.php" class="boton-login">Login</a>
            <?php endif; ?>
        </div>
    </nav>

    <section class="hero">
        <div>
            <span class="hero-eyebrow">San José, Costa Rica</span>
            <h1>Encuentra tu<br><em>próximo</em><br>vehículo</h1>
            
            <?php if (isset($_SESSION['nombre'])): ?>
                <p style="font-size: 1.2rem; color: #fff; margin-bottom: 20px;">
                    ¡Bienvenido de nuevo, <strong><?php echo $_SESSION['nombre']; ?></strong>!
                </p>
            <?php endif; ?>

            <p>Motos y autos de calidad. Inventario actualizado, precios directos.</p>
            <div class="hero-btns">
                <a class="boton" href="motos.php">Ver Motos</a>
                <a class="boton secondary" href="autos.php">Ver Autos</a>
            </div>
        </div>
    </section>

    <div class="stats-row">
        <div class="stat">
            <span class="stat-num">20+</span>
            <span class="stat-label">Vehículos</span>
        </div>
        <div class="stat">
            <span class="stat-num">10</span> 
            <span class="stat-label">Motos</span>
        </div>
        <div class="stat">
            <span class="stat-num">10</span> 
            <span class="stat-label">Autos</span>
        </div>
        <div class="stat">
            <span class="stat-num">100%</span>
            <span class="stat-label">Disponibles</span>
        </div>
        <div class="stat">
            <span class="stat-num">24h</span>
            <span class="stat-label">Respuesta</span>
        </div>
    </div>

    <footer>
        © 2026 Concesionario Digital — San José, Costa Rica
    </footer>

</body>
</html>