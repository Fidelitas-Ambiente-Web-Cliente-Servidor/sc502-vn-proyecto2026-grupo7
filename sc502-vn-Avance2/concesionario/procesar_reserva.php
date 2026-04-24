<?php
require_once __DIR__ . '/db.php';

// Procesamiento del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre   = $_POST['nombre']   ?? '';
    $correo   = $_POST['correo']   ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $fecha    = $_POST['fecha']    ?? null;
    $vehiculo = $_POST['vehiculo']  ?? '';
    $mensaje  = $_POST['mensaje']   ?? '';

    $stmt = $conn->prepare("INSERT INTO reservas (nombre_solicitante, correo_contacto, telefono_contacto, fecha_visita, vehiculo_interes, mensaje_adicional) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nombre, $correo, $telefono, $fecha, $vehiculo, $mensaje);

    if ($stmt->execute()) {
        echo "<script>
                alert('¡Reserva registrada con éxito!');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo 'Error al guardar: ' . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
