<?php
session_start();
require_once __DIR__ . '/db.php';
?>
<!DOCTYPE html>
<!-- < ?php session_start(); ?>-->
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto — Concesionario Digital</title>
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
            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                <a href="gestion_clientes.php">Gestión de Clientes</a>
            <?php endif; ?>
            <a href="contacto.php" class="active">Contacto</a>
            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="logout.php" style="color: #e74c3c;">Cerrar Sesión (<?php echo $_SESSION['usuario']; ?>)</a>
            <?php else: ?>
                <a href="login.php" class="boton-login">Login</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="page-header">
        <span class="label">Comunícate</span>
        <h2>Contacto</h2>
    </div>

    <main class="page-content">
        <div class="contact-grid">
            <div class="contact-info">
                <h3>Estamos aquí para ayudarte</h3>
                <div class="contact-item"><span>✉️</span><strong> Email</strong><p>concesionario@email.com</p></div>
                <div class="contact-item"><span>📞</span><strong> Teléfono</strong><p>+506 8888 8888</p></div>
                <div class="contact-item"><span>📍</span><strong> Ubicación</strong><p>San José, Costa Rica</p></div>
            </div>

            <div>
                <form id="formContacto" class="form-grid" style="grid-template-columns: 1fr;">
                    <div class="form-group">
                        <label>Tu nombre</label>
                        <input type="text" id="c_nombre" placeholder="Nombre completo" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="c_email" placeholder="correo@ejemplo.com" required>
                    </div>
                    <div class="form-group">
                        <label>Asunto</label>
                        <input type="text" id="c_asunto" placeholder="Motivo del contacto" required>
                    </div>
                    <div class="form-group">
                        <label>Mensaje</label>
                        <textarea id="c_mensaje" placeholder="¿En qué te podemos ayudar?" required></textarea>
                    </div>
                    <div class="form-group">
                        <button class="boton" type="submit">Enviar Mensaje</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>© 2026 Concesionario Digital — San José, Costa Rica</footer>

    <script src="./script.js"></script>
</body>
</html>