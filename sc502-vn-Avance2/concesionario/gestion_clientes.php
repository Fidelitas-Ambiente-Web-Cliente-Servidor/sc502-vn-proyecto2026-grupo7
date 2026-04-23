<?php 
session_start();

// 1. SEGURIDAD: Solo el administrador puede entrar aquí
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// 2. CONEXIÓN A LA BASE DE DATOS (Puerto 3307 según tu XAMPP)
$host = "127.0.0.1:3307"; 
$user = "root"; 
$pass = ""; 
$db   = "concesionario_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// 3. LÓGICA PARA BORRAR USUARIOS
if (isset($_GET['borrar'])) {
    $id_borrar = intval($_GET['borrar']);
    // Evitar que el admin se borre a sí mismo por error
    if ($_SESSION['usuario'] !== 'admin_jesus' || $id_borrar != 1) { 
        $conn->query("DELETE FROM usuarios WHERE id = $id_borrar");
        header("Location: gestion_clientes.php?msg=Usuario eliminado");
        exit();
    }
}

// 4. OBTENER TODOS LOS USUARIOS
$sql = "SELECT id, nombre_completo, correo, telefono, usuario, rol FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes — Panel Admin</title>
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
            <a href="gestion_clientes.php" class="active">Clientes</a>
            <a href="contacto.php">Contacto</a>
            
            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="logout.php" style="color: #e74c3c;">Cerrar Sesión (<?php echo $_SESSION['usuario']; ?>)</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="page-header">
        <span class="label">Administración</span>
        <h2>Gestión de Usuarios y Clientes</h2>
    </div>

    <main class="page-content">
        <?php if (isset($_GET['msg'])): ?>
            <p style="color: #27ae60; text-align: center; font-weight: bold;"><?php echo htmlspecialchars($_GET['msg']); ?></p>
        <?php endif; ?>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Real</th>
                        <th>Usuario</th>
                        <th>Correo / Teléfono</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><strong><?php echo htmlspecialchars($row['nombre_completo']); ?></strong></td>
                                <td><?php echo htmlspecialchars($row['usuario']); ?></td>
                                <td>
                                    <small><?php echo htmlspecialchars($row['correo']); ?></small><br>
                                    <small><?php echo htmlspecialchars($row['telefono']); ?></small>
                                </td>
                                <td>
                                    <span class="badge <?php echo ($row['rol'] === 'admin') ? 'admin' : 'disponible'; ?>" 
                                          style="background: <?php echo ($row['rol'] === 'admin') ? '#e74c3c' : '#27ae60'; ?>; color: white; padding: 2px 8px; border-radius: 4px; font-size: 0.8rem;">
                                        <?php echo ucfirst($row['rol']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="editar_usuario.php?id=<?php echo $row['id']; ?>" style="color: #3498db; text-decoration: none; font-weight: bold;">Editar</a> | 
                                    <a href="gestion_clientes.php?borrar=<?php echo $row['id']; ?>" 
                                       onclick="return confirm('¿Estás seguro de eliminar a este usuario?')" 
                                       style="color: #e74c3c; text-decoration: none; font-weight: bold;">Borrar</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="6" style="text-align:center;">No hay usuarios registrados.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer>© 2026 Concesionario Digital — San José, Costa Rica</footer>
</body>
</html>