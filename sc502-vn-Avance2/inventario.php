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
        <a class="nav-brand" href="index.html"><span>CD</span> CONCESIONARIO</a>
        <div class="nav-links">
            <a href="index.html">Inicio</a>
            <a href="motos.html">Motos</a>
            <a href="autos.html">Autos</a>
            <a href="inventario.php" class="active">Inventario</a>
            <a href="clientes.html">Clientes</a>
            <a href="reserva.html">Reservar</a>
            <a href="contacto.html">Contacto</a>
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
                        <th>Vehículo</th>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Configuración de conexión (Igual que en procesar_reserva.php)
                    $host = (getenv('DOCKER_ENV')) ? 'db' : 'localhost';
                    $user = "root";
                    $pass = ""; // En Docker cámbialo a 'root_password' si es necesario
                    $db   = "concesionario_db";

                    $conn = new mysqli($host, $user, $pass, $db);

                    if ($conn->connect_error) {
                        // Reintento para Docker
                        $conn = new mysqli('db', 'root', 'root_password', $db);
                    }

                    // Consulta a la tabla vehiculos
                    $sql = "SELECT nombre_modelo, tipo, precio FROM vehiculos";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><strong>" . htmlspecialchars($row['nombre_modelo']) . "</strong></td>";
                            echo "<td>" . ucfirst($row['tipo']) . "</td>";
                            echo "<td>$" . number_format($row['precio'], 0) . "</td>";
                            echo '<td><span class="badge disponible">Disponible</span></td>';
                            echo '<td><a class="boton" href="reserva.html">Reservar</a></td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No hay vehículos en el inventario.</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer>© 2026 Concesionario Digital — San José, Costa Rica</footer>
    <script src="js/script.js"></script> 
</body>
</html>