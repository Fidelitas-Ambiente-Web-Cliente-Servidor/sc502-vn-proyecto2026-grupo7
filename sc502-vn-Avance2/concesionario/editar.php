<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$host = "127.0.0.1:3307"; $user = "root"; $pass = ""; $db = "concesionario_db";
$conn = new mysqli($host, $user, $pass, $db);

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

    $sql = "UPDATE vehiculos SET nombre_modelo=?, precio=?, tipo=?, imagen=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdssi", $modelo, $precio, $tipo, $imagen, $id);
    
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
        <h2>Editar Vehículo: <?php echo htmlspecialchars($v['nombre_modelo']); ?></h2>
    </div>
    <main class="page-content">
        <form method="POST" style="max-width: 500px; margin: auto; background: #1a1a1a; padding: 25px; border-radius: 8px;">
            <input type="hidden" name="id" value="<?php echo $v['id']; ?>">
            
            <label>Modelo del Vehículo:</label>
            <input type="text" name="nombre_modelo" value="<?php echo htmlspecialchars($v['nombre_modelo']); ?>" required style="width: 100%; margin-bottom: 15px;">
            
            <label>Precio ($):</label>
            <input type="number" name="precio" value="<?php echo $v['precio']; ?>" required style="width: 100%; margin-bottom: 15px;">
            
            <label>Tipo:</label>
            <select name="tipo" style="width: 100%; margin-bottom: 15px;">
                <option value="auto" <?php if($v['tipo']=='auto') echo 'selected'; ?>>Auto</option>
                <option value="moto" <?php if($v['tipo']=='moto') echo 'selected'; ?>>Moto</option>
            </select>
            
            <label>Nombre del archivo de imagen (ej: hilux.jpg):</label>
            <input type="text" name="imagen" value="<?php echo htmlspecialchars($v['imagen']); ?>" required style="width: 100%; margin-bottom: 15px;">
            
            <button type="submit" class="boton">Guardar Cambios</button>
            <a href="inventario.php" style="color: #999; margin-left: 15px;">Volver</a>
        </form>
    </main>
</body>
</html>