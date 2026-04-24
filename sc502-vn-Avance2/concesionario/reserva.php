<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva — Concesionario Digital</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav>
        <a class="nav-brand" href="index.php"><span>CD</span> CONCESIONARIO</a>
        <div class="nav-links">
            <a href="index.php">Inicio</a>
            <a href="motos.php">Motos</a>
            <a href="autos.php">Autos</a>
            <a href="inventario.php">Inventario</a>
            <a href="reserva.php" class="active">Reservar</a>
            <a href="contacto.php">Contacto</a>
            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="logout.php" style="color: #e74c3c;">Salir (<?php echo $_SESSION['usuario']; ?>)</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="page-header">
        <span class="label">Proceso</span>
        <h2>Reservar Vehículo</h2>
    </div>

    <main class="page-content">
        <form id="formReserva" class="form-grid" action="procesar_reserva.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" 
                       value="<?php echo isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo'] : ''; ?>" 
                       required>
            </div>

            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" 
                       value="<?php echo isset($_SESSION['correo']) ? $_SESSION['correo'] : ''; ?>" 
                       required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" 
                       value="<?php echo isset($_SESSION['telefono']) ? $_SESSION['telefono'] : ''; ?>" 
                       required>
            </div>

            <div class="form-group">
                <label for="fecha">Fecha de Visita</label>
                <input type="date" id="fecha" name="fecha" required>
            </div>

            <div class="form-group full">
                <label for="vehiculo">Vehículo de Interés</label>
                <select id="vehiculo" name="vehiculo" required>
                    <option value="">— Selecciona un vehículo —</option>
                    <option value="Toyota Corolla">Toyota Corolla — $28,000</option>
                    <option value="Honda Civic">Honda Civic — $26,000</option>
                    <option value="CFMOTO 675NK">CFMOTO 675NK — $9,500</option>
                    <option value="Honda Transalp">Honda Transalp — $11,500</option>
                </select>
            </div>

            <div class="form-group full">
                <label for="mensaje">Notas adicionales</label>
                <textarea id="mensaje" name="mensaje" placeholder="¿Tienes alguna duda adicional?"></textarea>
            </div>

            <div class="form-group full">
                <button class="boton" type="submit">Confirmar Reserva</button>
            </div>
        </form>
    </main>

    <footer>© 2026 Concesionario Digital — San José, Costa Rica</footer>
    
    <script src="./script.js"></script>
</body>
</html>