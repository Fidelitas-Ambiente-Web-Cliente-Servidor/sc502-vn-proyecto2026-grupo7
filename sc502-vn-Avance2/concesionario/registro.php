<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once __DIR__ . '/db.php';

    // Capturamos todos los campos necesarios
    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo']; 
    $telefono = $_POST['telefono'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $rol = "cliente"; 

    // Validar si el usuario o el correo ya existen
    $checkUser = $conn->prepare("SELECT usuario FROM usuarios WHERE usuario = ? OR correo = ?");
    $checkUser->bind_param("ss", $usuario, $correo);
    $checkUser->execute();
    $result = $checkUser->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('El usuario o el correo ya están registrados.'); window.history.back();</script>";
    } else {
        // Insertar con 6 parámetros (nombre, usuario, pass, correo, tel, rol) -> ""
        $sql = "INSERT INTO usuarios (nombre_completo, usuario, password, correo, telefono, rol) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $nombre_completo, $usuario, $password, $correo, $telefono, $rol);

        if ($stmt->execute()) {
            echo "<script>alert('¡Cuenta creada con éxito!'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error técnico: " . $stmt->error . "');</script>";
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro — Concesionario Digital</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { margin: 0; background: #000; color: #fff; font-family: sans-serif; display: flex; flex-direction: column; min-height: 100vh; }
        .register-wrapper { flex: 1; display: flex; justify-content: center; align-items: center; padding: 20px; }
        .register-card { background: #1a1a1a; padding: 30px; border-radius: 10px; border: 1px solid #333; width: 100%; max-width: 400px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; color: #999; margin-bottom: 5px; font-size: 0.8rem; }
        .form-group input { width: 100%; padding: 10px; background: #252525; border: 1px solid #444; color: #fff; border-radius: 5px; box-sizing: border-box; }
        .btn-register { width: 100%; padding: 12px; background: #e74c3c; border: none; color: white; font-weight: bold; cursor: pointer; border-radius: 5px; text-transform: uppercase; }
        .login-link { text-align: center; margin-top: 15px; font-size: 0.8rem; color: #666; }
        .login-link a { color: #e74c3c; text-decoration: none; }
    </style>
</head>
<body>

    <nav>
        <a class="nav-brand" href="index.php"><span>CD</span> CONCESIONARIO</a>
    </nav>

    <div class="register-wrapper">
        <div class="register-card">
            <h2 style="text-align:center;">Crear Cuenta</h2>
            <form action="registro.php" method="POST">
                <div class="form-group">
                    <label>Nombre Completo</label>
                    <input type="text" name="nombre_completo" required>
                </div>
                <div class="form-group">
                    <label>Correo Electrónico</label>
                    <input type="email" name="correo" placeholder="ejemplo@correo.com" required>
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="tel" name="telefono" required>
                </div>
                <div class="form-group">
                    <label>Usuario</label>
                    <input type="text" name="usuario" required>
                </div>
                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" class="btn-register">Registrarse</button>
            </form>
            <div class="login-link">
                ¿Ya tienes cuenta? <a href="login.php">Logueate</a>
            </div>
        </div>
    </div>

</body>
</html>