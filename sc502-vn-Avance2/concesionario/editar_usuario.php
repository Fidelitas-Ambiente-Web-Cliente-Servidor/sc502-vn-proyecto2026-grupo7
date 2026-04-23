<?php
session_start();
// Seguridad: Solo el administrador entra aquí
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$host = "127.0.0.1:3307"; $user = "root"; $pass = ""; $db = "concesionario_db";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener datos del usuario actual
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $res = $conn->query("SELECT * FROM usuarios WHERE id = $id");
    $u = $res->fetch_assoc();
}

// Procesar la actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre_completo'];
    $usuario = $_POST['usuario'];
    $rol = $_POST['rol'];
    $correo = $_POST['correo'];

    $update = "UPDATE usuarios SET nombre_completo=?, usuario=?, rol=?, correo=? WHERE id=?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("ssssi", $nombre, $usuario, $rol, $correo, $id);
    
    if ($stmt->execute()) {
        header("Location: gestion_clientes.php?msg=Usuario actualizado correctamente");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario — CD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page-header">
        <h2>Editar Perfil: <?php echo htmlspecialchars($u['usuario']); ?></h2>
    </div>
    <main class="page-content">
        <form method="POST" style="max-width: 500px; margin: auto; background: #1a1a1a; padding: 25px; border-radius: 8px; border: 1px solid #333;">
            <input type="hidden" name="id" value="<?php echo $u['id']; ?>">
            
            <label style="color: #eee;">Nombre Completo:</label>
            <input type="text" name="nombre_completo" value="<?php echo htmlspecialchars($u['nombre_completo']); ?>" required style="width: 100%; padding: 10px; margin: 10px 0; background: #333; color: white; border: none;">
            
            <label style="color: #eee;">Correo Electrónico:</label>
            <input type="email" name="correo" value="<?php echo htmlspecialchars($u['correo']); ?>" required style="width: 100%; padding: 10px; margin: 10px 0; background: #333; color: white; border: none;">
            
            <label style="color: #eee;">Nombre de Usuario:</label>
            <input type="text" name="usuario" value="<?php echo htmlspecialchars($u['usuario']); ?>" required style="width: 100%; padding: 10px; margin: 10px 0; background: #333; color: white; border: none;">
            
            <label style="color: #eee;">Rol en el Sistema:</label>
            <select name="rol" style="width: 100%; padding: 10px; margin: 10px 0; background: #333; color: white; border: none;">
                <option value="admin" <?php if($u['rol']=='admin') echo 'selected'; ?>>Administrador</option>
                <option value="cliente" <?php if($u['rol']=='cliente') echo 'selected'; ?>>Cliente</option>
            </select>
            
            <div style="margin-top: 20px;">
                <button type="submit" class="boton">Actualizar Datos</button>
                <a href="gestion_clientes.php" style="color: #999; margin-left: 15px; text-decoration: none;">Cancelar</a>
            </div>
        </form>
    </main>
</body>
</html>