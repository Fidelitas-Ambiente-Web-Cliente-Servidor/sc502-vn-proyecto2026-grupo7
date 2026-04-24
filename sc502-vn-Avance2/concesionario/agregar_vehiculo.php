<?php
session_start();
// Seguridad: Solo admin
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

require_once __DIR__ . '/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modelo = $_POST['nombre_modelo'];
    $tipo = $_POST['tipo'];
    $precio = $_POST['precio'];
    $desc = $_POST['descripcion'];
    $imagen = $_POST['imagen']; 

    $sql = "INSERT INTO vehiculos (nombre_modelo, tipo, precio, descripcion, imagen) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdss", $modelo, $tipo, $precio, $desc, $imagen);
    
    if ($stmt->execute()) {
        header("Location: inventario.php");
    } else {
        echo "Error al agregar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Vehículo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page-header">
        <h2>Añadir Nuevo Vehículo</h2>
    </div>
    <main class="page-content">
        <form method="POST" style="max-width: 500px; margin: auto; background: #1a1a1a; padding: 20px; border-radius: 8px;">
            <label>Modelo:</label><br>
            <input type="text" name="nombre_modelo" required style="width: 100%; margin-bottom: 10px;"><br>
            
            <label>Tipo:</label><br>
            <select name="tipo" style="width: 100%; margin-bottom: 10px;">
                <option value="auto">Auto</option>
                <option value="moto">Moto</option>
            </select><br>
            
            <label>Precio:</label><br>
            <input type="number" name="precio" required style="width: 100%; margin-bottom: 10px;"><br>
            
            <label>Nombre de Imagen (ej: hilux.jpg):</label><br>
            <input type="text" name="imagen" required style="width: 100%; margin-bottom: 10px;"><br>
            
            <label>Descripción:</label><br>
            <textarea name="descripcion" style="width: 100%; margin-bottom: 10px;"></textarea><br>
            
            <button type="submit" class="boton">Guardar Vehículo</button>
            <a href="inventario.php" style="color: #ccc; margin-left: 10px;">Cancelar</a>
        </form>
    </main>
</body>
</html>