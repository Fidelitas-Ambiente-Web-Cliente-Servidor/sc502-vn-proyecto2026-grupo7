<?php
/**
 * Configuración de conexión compatible con XAMPP y Docker
 */


// Configuración estándar para XAMPP
$host = "127.0.0.1:3307"; 
$user = "root";
$pass = ""; // XAMPP por defecto no tiene contraseña
$db   = "concesionario_db";

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    // Si falla, intentamos con la configuración de Docker por si acaso
    $conn = new mysqli("db", "root", "root_password", $db);
    
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
}



// En XAMPP el host suele ser 'localhost' o '127.0.0.1'
// En Docker usamos el nombre del servicio, por ejemplo 'db'
//$host = (getenv('DOCKER_ENV')) ? 'db' : 'localhost'; 
//$user = "root";
//$pass = ""; // XAMPP por defecto no tiene contraseña. 
//$db   = "concesionario_db";

// Intentar conexión
//$conn = new mysqli($host, $user, $pass, $db);

//if ($conn->connect_error) {
    // Si falla en 'localhost', intentamos con 'db' por si estamos en Docker
 //   $conn = new mysqli('db', $user, 'root_password', $db);
 //   if ($conn->connect_error) {
 //       die("Error crítico de conexión: " . $conn->connect_error);
 //   }
//}

// Procesamiento del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Captura de datos del formulario reserva.html
    $nombre   = $_POST['nombre']   ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $vehiculo = $_POST['vehiculo'] ?? '';
    $mensaje  = $_POST['mensaje']  ?? '';

    // Sentencia preparada para seguridad
    $stmt = $conn->prepare("INSERT INTO reservas (nombre_solicitante, telefono_contacto, mensaje_adicional) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $telefono, $mensaje);

    if ($stmt->execute()) {
        echo "<script>
                alert('¡Reserva registrada con éxito!');
                window.location.href = 'index.html';
              </script>";
    } else {
        echo "Error al guardar: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>