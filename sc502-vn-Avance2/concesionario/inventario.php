<?php session_start(); // Necesario para leer el rol del usuario ?>
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

    <div class="page-header">
        <span class="label">Sistema</span>
        <h2>Inventario de Vehículos</h2>
    </div>

    <main class="page-content">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Vehículo</th>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // 1. CONFIGURACIÓN DE CONEXIÓN
                    $host = "127.0.0.1:3307"; 
                    $user = "root";
                    $pass = ""; 
                    $db   = "concesionario_db";

                    $conn = new mysqli($host, $user, $pass, $db);

                    if ($conn->connect_error) {
                        $conn = new mysqli("db", "root", "root_password", $db);
                        if ($conn->connect_error) {
                            die("Error de conexión: " . $conn->connect_error);
                        }
                    }

                    // 2. REALIZAR LA CONSULTA (Se incluye 'imagen' en el SELECT)
                    $sql = "SELECT id, nombre_modelo, tipo, precio, imagen FROM vehiculos";
                    $result = $conn->query($sql);

                    // 3. DETERMINAR EL ROL
                    $is_admin = (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin');

                    // 4. MOSTRAR LOS DATOS
                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            // Columna de Imagen
                            echo "<td><img src='img/" . htmlspecialchars($row['imagen']) . "' style='width:80px; height:auto; border-radius:5px; display:block; margin:auto;'></td>";
                            echo "<td><strong>" . htmlspecialchars($row['nombre_modelo']) . "</strong></td>";
                            echo "<td>" . ucfirst($row['tipo']) . "</td>";
                            echo "<td>$" . number_format($row['precio'], 0) . "</td>";
                            echo '<td><span class="badge disponible">Disponible</span></td>';
                            
                            if ($is_admin) {
                                // Vista de Administrador
                                echo "<td>
                                        <a href='editar.php?id=".$row['id']."' style='color: #3498db; text-decoration: none; font-weight: bold;'>Editar</a> | 
                                        <a href='borrar.php?id=".$row['id']."' style='color: #e74c3c; text-decoration: none; font-weight: bold;'>Borrar</a>
                                      </td>";
                            } else {
                                // Vista de Cliente
                                echo '<td><a class="boton" href="reserva.html">Reservar</a></td>';
                            }
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align:center;'>No hay vehículos en el inventario.</td></tr>";
                    }

                    
                    /*
                    // Configuración de conexión (Igual que en procesar_reserva.php)
                    // $host = (getenv('DOCKER_ENV')) ? 'db' : 'localhost';
                    // $user = "root";
                    // $pass = ""; // En Docker cámbialo a 'root_password' si es necesario
                    // $db   = "concesionario_db";
                    // $conn = new mysqli($host, $user, $pass, $db);
                    // if ($conn->connect_error) {
                    //     $conn = new mysqli('db', 'root', 'root_password', $db);
                    // }
                    */

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

        <?php if ($is_admin): ?>
            <div style="margin-top: 20px; text-align: center;">
                <a href="agregar_vehiculo.php" class="boton" style="background-color: #27ae60;">+ Agregar Nuevo Vehículo</a>
            </div>
        <?php endif; ?>

    </main>

    <footer>© 2026 Concesionario Digital — San José, Costa Rica</footer>
    <script src="js/script.js"></script> 
</body>
</html>