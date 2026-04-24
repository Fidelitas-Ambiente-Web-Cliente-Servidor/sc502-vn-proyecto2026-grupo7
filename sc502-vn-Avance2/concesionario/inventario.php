<?php 
session_start(); 

// 1. CONFIGURACIÓN DE CONEXIÓN
require_once __DIR__ . '/db.php';


// --- LÓGICA DE BORRADO
if (isset($_GET['id_borrar'])) {
    if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
        $id = $_GET['id_borrar'];
        $stmt = $conn->prepare("DELETE FROM vehiculos WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header("Location: inventario.php"); 
            exit();
        }
    }
}

// --- LÓGICA DE CAMBIO DE ESTADO 
if (isset($_GET['id_estado']) && isset($_GET['nuevo_estado']) && $_SESSION['rol'] === 'admin') {
    $id = $_GET['id_estado'];
    $estado = $_GET['nuevo_estado'];
    $stmt = $conn->prepare("UPDATE vehiculos SET estado = ? WHERE id = ?");
    $stmt->bind_param("si", $estado, $id);
    $stmt->execute();
    header("Location: inventario.php");
    exit();
}
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
                    // Agregamos 'estado' a la consulta
                    $sql = "SELECT id, nombre_modelo, tipo, precio, imagen, estado FROM vehiculos";
                    $result = $conn->query($sql);

                    $is_admin = (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin');

                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            // Lógica para el color del badge
                            $estado = $row['estado'] ?? 'Disponible';
                            $clase_estado = (strtolower($estado) == 'vendido') ? 'vendido' : 'disponible';

                            echo "<tr>";
                            echo "<td><img src='img/" . htmlspecialchars($row['imagen']) . "' style='width:80px; height:auto; border-radius:5px; display:block; margin:auto;'></td>";
                            echo "<td><strong>" . htmlspecialchars($row['nombre_modelo']) . "</strong></td>";
                            echo "<td>" . ucfirst($row['tipo']) . "</td>";
                            echo "<td>$" . number_format($row['precio'], 0) . "</td>";
                            
                            // ESTADO DINÁMICO
                            echo "<td><span class='badge $clase_estado'>" . strtoupper($estado) . "</span></td>";
                            
                            if ($is_admin) {
                                echo "<td>
                                        <a href='editar.php?id=".$row['id']."' style='color: #3498db; text-decoration: none; font-weight: bold;'>Editar</a> | ";
                                
                                // Si no está vendido, mostrar opción de marcar como vendido
                                if(strtolower($estado) != 'vendido') {
                                    echo "<a href='inventario.php?id_estado=".$row['id']."&nuevo_estado=Vendido' style='color: #f39c12;'>Marcar Vendido</a> | ";
                                } else {
                                    echo "<a href='inventario.php?id_estado=".$row['id']."&nuevo_estado=Disponible' style='color: #27ae60;'>Disponible</a> | ";
                                }

                                echo "<a href='inventario.php?id_borrar=".$row['id']."' onclick='return confirm(\"¿Seguro?\");' style='color: #e74c3c; text-decoration: none; font-weight: bold;'>Borrar</a>
                                      </td>";
                            } else {
                                echo '<td><a class="boton" href="reserva.php">Reservar</a></td>';
                            }
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align:center;'>No hay vehículos.</td></tr>";
                    }
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
</body>
</html>