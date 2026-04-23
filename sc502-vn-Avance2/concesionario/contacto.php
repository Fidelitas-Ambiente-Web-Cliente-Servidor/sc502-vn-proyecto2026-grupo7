<!DOCTYPE html>
<?php session_start(); ?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto — Concesionario Digital</title>
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
        <span class="label">Comunícate</span>
        <h2>Contacto</h2>
    </div>

    <!-- CONTENIDO: info + formulario -->
    <main class="page-content">
        <div class="contact-grid">

            <!-- COLUMNA IZQUIERDA: información de contacto -->
            <div class="contact-info">
                <h3>Estamos aquí para ayudarte</h3>

                <!-- EMAIL -->
                <div class="contact-item">
                    <div class="contact-icon">✉️</div>
                    <div>
                        <strong>Email</strong>
                        <p>concesionario@email.com</p>
                    </div>
                </div>

                <!-- TELÉFONO -->
                <div class="contact-item">
                    <div class="contact-icon">📞</div>
                    <div>
                        <strong>Teléfono</strong>
                        <p>+506 8888 8888</p>
                    </div>
                </div>

                <!-- UBICACIÓN -->
                <div class="contact-item">
                    <div class="contact-icon">📍</div>
                    <div>
                        <strong>Ubicación</strong>
                        <p>San José, Costa Rica</p>
                    </div>
                </div>

            </div>

            <!-- COLUMNA DERECHA: formulario de mensaje -->
            <div>
                <form class="form-grid" style="grid-template-columns: 1fr;">

                    <!-- NOMBRE -->
                    <div class="form-group">
                        <label for="nombre">Tu nombre</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre completo" required>
                    </div>

                    <!-- EMAIL -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="correo@ejemplo.com" required>
                    </div>

                    <!-- MENSAJE -->
                    <div class="form-group">
                        <label for="mensaje">Mensaje</label>
                        <textarea id="mensaje" name="mensaje" placeholder="¿En qué te podemos ayudar?"
                            required></textarea>
                    </div>

                    <!-- BOTÓN ENVIAR -->
                    <div class="form-group">
                        <button class="boton" type="submit">
                            Enviar Mensaje
                        </button>
                    </div>

                </form>
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