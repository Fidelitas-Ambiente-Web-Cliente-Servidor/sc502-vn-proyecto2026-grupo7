<!DOCTYPE html>
<?php session_start(); ?>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autos — Concesionario Digital</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- NAVEGACIÓN -->
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
                <a href="login.html" class="boton-login">Login</a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- ENCABEZADO DE PÁGINA -->
    <div class="page-header">
        <span class="label">Catálogo</span>
        <h2>Autos Disponibles</h2>
    </div>

    <!-- CONTENIDO: tarjetas de autos -->
    <main class="page-content">
        <div class="product-grid">

            <!-- AUTO 1 -->
            <div class="producto">
                <img src="img/corolla2000sedan.png" alt="Toyota Corolla">
                <div class="producto-body">
                    <h3>Toyota Corolla</h3>
                    <p class="spec">Motor 2000cc</p>
                    <p class="spec">Sedán | 2023</p>
                    <p class="precio">$28,000</p>
                    <a class="boton" href="reserva.php">Reservar</a>
                </div>
            </div>

            <!-- AUTO 2 -->
            <div class="producto">
                <img src="img/hondacivic2023.png" alt="Honda Civic">
                <div class="producto-body">
                    <h3>Honda Civic</h3>
                    <p class="spec">Motor 1800cc</p>
                    <p class="spec">Sedán | 2023</p>
                    <p class="precio">$26,000</p>
                    <a class="boton" href="reserva.php">Reservar</a>
                </div>
            </div>

            <!-- AUTO 1 -->
            <div class="producto">
                <img src="img/MINIHardtop.png" alt="MINI Cooper Hardtop">
                <div class="producto-body">
                    <h3>MINI Cooper Hardtop</h3>
                    <p class="spec">Motor 2000cc</p>
                    <p class="spec">Hardtop | 2025</p>
                    <p class="precio">$35,000</p>
                    <a class="boton" href="reserva.php">Reservar</a>
                </div>
            </div>

            <!-- AUTO 2 -->
            <div class="producto">
                <img src="img/Volks.png" alt="Taos SUV compacto">
                <div class="producto-body">
                    <h3>Taos SUV compacto</h3>
                    <p class="spec">Motor 1395cc</p>
                    <p class="spec">SUV | 2026</p>
                    <p class="precio">$27,975</p>
                    <a class="boton" href="reserva.php">Reservar</a>
                </div>
            </div>

            <!-- AUTO 1 -->
            <div class="producto">
                <img src="img/BentlyCaro.png" alt="Bentley Flying Spur">
                <div class="producto-body">
                    <h3>Bentley Flying Spur</h3>
                    <p class="spec">Motor 2995cc</p>
                    <p class="spec">Sedán | 2025</p>
                    <p class="precio">$254.000,00</p>
                    <a class="boton" href="reserva.php">Reservar</a>
                </div>
            </div>

            <!-- AUTO 2 -->
            <div class="producto">
                <img src="img/Bentayga.png" alt="Bentley Bentayga">
                <div class="producto-body">
                    <h3>Bentley Bentayga</h3>
                    <p class="spec">Motor 3996cc</p>
                    <p class="spec">SUV | 2025</p>
                    <p class="precio">$234.000,00</p>
                    <a class="boton" href="reserva.php">Reservar</a>
                </div>
            </div>

            <!-- AUTO 1 -->
            <div class="producto">
                <img src="img/BMWM235i.png" alt="BMW 2 Series M235i">
                <div class="producto-body">
                    <h3>BMW 2 Series M235i</h3>
                    <p class="spec">Motor 2979cc</p>
                    <p class="spec">Sedán | 2023</p>
                    <p class="precio">$57.950</p>
                    <a class="boton" href="reserva.php">Reservar</a>
                </div>
            </div>

            <!-- AUTO 2 -->
            <div class="producto">
                <img src="img/bmwm3.png" alt="BMW M3 Berlina">
                <div class="producto-body">
                    <h3>BMW M3 Berlina</h3>
                    <p class="spec">Motor 2993cc</p>
                    <p class="spec">Sedán | 2026</p>
                    <p class="precio">$147.000,00</p>
                    <a class="boton" href="reserva.php">Reservar</a>
                </div>
            </div>

            <!-- AUTO 1 -->
            <div class="producto">
                <img src="img/SubaruEVOLTIS.png" alt="Subaru EVOLTIS TOURING 2.4">
                <div class="producto-body">
                    <h3>Subaru EVOLTIS TOURING 2.4</h3>
                    <p class="spec">Motor 2000cc</p>
                    <p class="spec">Sedán | 2023</p>
                    <p class="precio">$$86.590</p>
                    <a class="boton" href="reserva.php">Reservar</a>
                </div>
            </div>

            <!-- AUTO 2 -->
            <div class="producto">
                <img src="img/RAMPICK.png" alt="RAM 1500">
                <div class="producto-body">
                    <h3>RAM 1500</h3>
                    <p class="spec">Motor 1500cc</p>
                    <p class="spec">Pickup | 2026</p>
                    <p class="precio">$97.900</p>
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