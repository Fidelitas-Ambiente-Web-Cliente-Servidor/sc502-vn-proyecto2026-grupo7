<?php
$host = getenv('DB_HOST') ?: 'db';
$port = (int) (getenv('DB_PORT') ?: 3306);
$user = getenv('DB_USER') ?: 'appuser';
$pass = getenv('DB_PASSWORD') ?: 'apppass';
$db   = getenv('DB_NAME') ?: 'appdb';

mysqli_report(MYSQLI_REPORT_OFF);

$conn = null;
$maxAttempts = 10;
for ($i = 0; $i < $maxAttempts; $i++) {
    $conn = new mysqli($host, $user, $pass, $db, $port);
    if (!$conn->connect_error) {
        break;
    }
    sleep(1);
}

if (!$conn || $conn->connect_error) {
    http_response_code(500);
    die('Error de conexión: ' . ($conn ? $conn->connect_error : 'No se pudo inicializar la conexión'));
}

$conn->set_charset('utf8mb4');
?>
