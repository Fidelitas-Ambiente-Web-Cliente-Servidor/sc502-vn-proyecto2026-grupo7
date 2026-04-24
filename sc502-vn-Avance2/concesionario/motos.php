<?php 
session_start(); 

require_once __DIR__ . '/db.php';

// Obtener vehículos disponibles
$sql = "SELECT * FROM vehiculos WHERE estado = 'Disponible'";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario — Concesionario Digital</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav>
        <a class="nav-brand" href="index.php">
            <span>CD</span> CONCESIONARIO
        </a>
        <div class="nav-links">
            <a href="index.php">Inicio</a>
            <a href="motos.php">Motos</a>
            <a href="autos.php">Autos</a>
            <a href="inventario.php" class="active">Inventario</a>
            
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

    <!-- ENCABEZADO DE PÁGINA -->
    <div class="page-header">
        <span class="label">Catálogo</span>
        <h2>Motos Disponibles</h2>
    </div>

    <!-- CONTENIDO: tarjetas de motos -->
    <main class="page-content">
        <div class="product-grid">

            <!-- MOTO 1 -->
            <div class="producto">
                <img src="img/cf675.png" alt="CFMOTO 675NK">
                <div class="producto-body">
                    <h3>CFMOTO 675NK</h3>
                    <p class="spec">Motor 675cc</p>
                    <p class="spec">Naked Sport | 2024</p>
                    <p class="descripcion">Estilo naked con excelente potencia y maniobrabilidad.</p>
                    <p class="precio">$9,500</p>
                    <<a class="boton" href="reserva.php">Reservar</a>
                </div>
            </div>

            <!-- MOTO 2 -->
            <div class="producto">
                <img src="img/transalp.png" alt="Honda XL750 Transalp">
                <div class="producto-body">
                    <h3>Honda XL750 Transalp</h3>
                    <p class="spec">Motor 750cc</p>
                    <p class="spec">Adventure | 2024</p>
                    <p class="descripcion">Equilibrio ideal entre potencia, tecnología y aventura.</p>
                    <p class="precio">$11,500</p>
                    <a class="boton" href="reserva.php">Reservar</a>
                </div>
            </div>

            <!-- MOTO 3 -->
            <div class="producto">
                <img src="img/cb650r.png" alt="Honda CB650R">
                <div class="producto-body">
                    <h3>Honda CB650R</h3>
                    <p class="spec">Motor 650cc</p>
                    <p class="spec">Naked Sport | 2024</p>
                    <p class="descripcion">Diseño deportivo con rendimiento sobresaliente.</p>
                    <p class="precio">$10,500</p>
                    <a class="boton" href="reserva.php">Reservar</a>
                </div>
            </div>

            <!-- MOTO 4 -->
            <div class="producto">
                <img src="img/cfmt700.png" alt="CFMOTO 700MT">
                <div class="producto-body">
                    <h3>CFMOTO 700MT</h3>
                    <p class="spec">Motor 700cc</p>
                    <p class="spec">Touring | 2024</p>
                    <p class="descripcion">Diseñada para viajes largos con alto nivel de confort.</p>
                    <p class="precio">$12,000</p>
                    <a class="boton" href="reserva.php">Reservar</a>
                </div>
            </div>

            <!-- MOTO 5 -->
            <div class="producto">
                <img src="img/honda rally.png" alt="Honda CRF300L Rally">
                <div class="producto-body">
                    <h3>Honda CRF300L Rally</h3>
                    <p class="spec">Motor 300cc</p>
                    <p class="spec">Off-Road | 2024</p>
                    <p class="descripcion">Perfecta para rutas mixtas y aventuras off-road.</p>
                    <p class="precio">$7,500</p>
                    <a class="boton" href="reserva.php">Reservar</a>
                </div>
            </div>

            <!-- MOTO 6 -->
            <div class="producto">
                <img src="img/mt450.png" alt="CFMOTO 450MT">
                <div class="producto-body">
                    <h3>CFMOTO 450MT</h3>
                    <p class="spec">Motor 450cc</p>
                    <p class="spec">Adventure | 2024</p>
                    <p class="descripcion">Motocicleta versátil ideal para aventura y uso diario.</p>
                    <p class="precio">$8,500</p>
                    <a class="boton" href="reserva.php">Reservar</a>
                </div>
            </div>

            <!-- MOTO 7 -->
            <div class="producto">
                <img src="img/transalp.png" alt="Honda XL750 Transalp">
                <div class="producto-body">
                    <h3>Honda XL750 Transalp</h3>
                    <p class="spec">Motor 750cc</p>
                    <p class="spec">Adventure | 2024</p>
                    <p class="descripcion">Equilibrio ideal entre potencia, tecnología y aventura.</p>
                    <p class="precio">$11,500</p>
                    <a class="boton" href="reserva.php">Reservar</a>
                </div>
            </div>

            <!-- MOTO 8 -->
            <div class="producto">
                <img src="img/transalp.png" alt="Honda XL750 Transalp">
                <div class="producto-body">
                    <h3>Honda XL750 Transalp</h3>
                    <p class="spec">Motor 750cc</p>
                    <p class="spec">Adventure | 2024</p>
                    <p class="descripcion">Equilibrio ideal entre potencia, tecnología y aventura.</p>
                    <p class="precio">$11,500</p>
                    <a class="boton" href="reserva.php">Reservar</a>
                </div>
            </div>

            <!-- MOTO 9 -->
            <div class="producto">
                <img src="img/transalp.png" alt="Honda XL750 Transalp">
                <div class="producto-body">
                    <h3>Honda XL750 Transalp</h3>
                    <p class="spec">Motor 750cc</p>
                    <p class="spec">Adventure | 2024</p>
                    <p class="descripcion">Equilibrio ideal entre potencia, tecnología y aventura.</p>
                    <p class="precio">$11,500</p>
                    <a class="boton" href="reserva.php">Reservar</a>
                </div>
            </div>

            <!-- MOTO 10 -->
            <div class="producto">
                <img src="img/transalp.png" alt="Honda XL750 Transalp">
                <div class="producto-body">
                    <h3>Honda XL750 Transalp</h3>
                    <p class="spec">Motor 750cc</p>
                    <p class="spec">Adventure | 2024</p>
                    <p class="descripcion">Equilibrio ideal entre potencia, tecnología y aventura.</p>
                    <p class="precio">$11,500</p>
                    <a class="boton" href="reserva.php">Reservar</a>
                </div>
            </div>

        </div>
    </main>

    <!-- PIE DE PÁGINA -->
    <footer>
        © 2026 Concesionario Digital — San José, Costa Rica
    </footer>
<script src="js/script.js"></script>
</body>

</html>