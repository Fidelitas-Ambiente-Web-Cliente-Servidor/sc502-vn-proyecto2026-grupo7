<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

require_once __DIR__ . '/db.php';
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $res = $conn->query("SELECT * FROM vehiculos WHERE id = $id");
    $v = $res->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $modelo = $_POST['nombre_modelo'];
    $precio = $_POST['precio'];
    $tipo = $_POST['tipo'];
    $imagen = $_POST['imagen'];
    $descripcion = $_POST['descripcion']; // Agregada la 's'
    $estado = $_POST['estado'];        

    // SQL actualizado con 'descripcion'
    $sql = "UPDATE vehiculos SET nombre_modelo=?, precio=?, tipo=?, imagen=?, descripcion=?, estado=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdssssi", $modelo, $precio, $tipo, $imagen, $descripcion, $estado, $id);
    
    if ($stmt->execute()) {
        header("Location: inventario.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Vehículo — CD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page-header">
        <h2>Editar Vehículo: <?php echo htmlspecialchars($v['nombre_modelo'] ?? ''); ?></h2>
    </div>
    <main class="page-content">
        <form method="POST" style="max-width: 500px; margin: auto; background: #1a1a1a; padding: 25px; border-radius: 8px;">
            <input type="hidden" name="id" value="<?php echo $v['id']; ?>">
            
            <label>Modelo del Vehículo:</label>
            <input type="text" name="nombre_modelo" value="<?php echo htmlspecialchars($v['nombre_modelo'] ?? ''); ?>" required style="width: 100%; margin-bottom: 15px;">
            
            <label>Precio ($):</label>
            <input type="number" name="precio" value="<?php echo $v['precio'] ?? ''; ?>" required style="width: 100%; margin-bottom: 15px;">
            
            <label>Tipo:</label>
            <select name="tipo" style="width: 100%; margin-bottom: 15px;">
                <option value="auto" <?php if(($v['tipo'] ?? '') == 'auto') echo 'selected'; ?>>Auto</option>
                <option value="moto" <?php if(($v['tipo'] ?? '') == 'moto') echo 'selected'; ?>>Moto</option>
            </select>

            <label>Estado del Vehículo:</label>
            <select name="estado" style="width: 100%; margin-bottom: 15px;">
                <option value="Disponible" <?php if(($v['estado'] ?? '') == 'Disponible') echo 'selected'; ?>>Disponible</option>
                <option value="Vendido" <?php if(($v['estado'] ?? '') == 'Vendido') echo 'selected'; ?>>Vendido</option>
                <option value="Reservado" <?php if(($v['estado'] ?? '') == 'Reservado') echo 'selected'; ?>>Reservado</option>
            </select>

            <label>Descripción (Motor, Año, etc):</label>
            <textarea name="descripcion" required style="width: 100%; margin-bottom: 15px; height: 80px;"><?php echo htmlspecialchars($v['descripcion'] ?? ''); ?></textarea>
            
            <label>Nombre del archivo de imagen:</label>
            <input type="text" name="imagen" value="<?php echo htmlspecialchars($v['imagen'] ?? ''); ?>" required style="width: 100%; margin-bottom: 15px;">
            
            <button type="submit" class="boton">Guardar Cambios</button>
            <a href="inventario.php" style="color: #999; margin-left: 15px;">Volver</a>
        </form>
    </main>
</body>
</html>