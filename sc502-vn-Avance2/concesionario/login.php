<?php
session_start();

// 1. LÓGICA DE AUTENTICACIÓN
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configuración de tu servidor local XAMPP
    $host = "127.0.0.1:3307"; 
    $user = "root"; 
    $pass = ""; 
    $db   = "concesionario_db";

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $u = $_POST['usuario'];
    $p = $_POST['password'];

    // Consulta segura con Prepared Statements
    $sql = "SELECT usuario, rol, nombre_completo FROM usuarios WHERE usuario = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $u, $p);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        // Guardamos los datos en la sesión para que el NAV los reconozca
        $_SESSION['usuario'] = $row['usuario'];
        $_SESSION['rol']     = $row['rol'];
        $_SESSION['nombre']  = $row['nombre_completo'];

        // Redirección inmediata al index
        header("Location: index.php");
        exit();
    } else {
        // Alerta si los datos son incorrectos
        echo "<script>alert('Usuario o contraseña incorrectos. Intenta de nuevo.'); window.location.href='login.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión — Concesionario Digital</title>
    <link rel="stylesheet" href="style.css">
    <style>
        
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .login-wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-card {
            background: #1a1a1a;
            padding: 40px;
            border-radius: 12px;
            border: 1px solid #333;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            text-align: center;
        }

        .login-card h2 {
            margin-bottom: 30px;
            font-size: 1.8rem;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #999;
            font-size: 0.9rem;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            background: #252525;
            border: 1px solid #444;
            border-radius: 6px;
            color: #fff;
            outline: none;
            box-sizing: border-box; 
        }

        .input-group input:focus {
            border-color: #e74c3c;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: #e74c3c; /* Rojo de tu marca */
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            text-transform: uppercase;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        .register-footer {
            margin-top: 25px;
            color: #999;
            font-size: 0.9rem;
        }

        .register-footer a {
            color: #e74c3c;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <nav>
        <a class="nav-brand" href="index.php"><span>CD</span> CONCESIONARIO</a>
        <div class="nav-links">
            <a href="index.php">Inicio</a>
            <a href="motos.php">Motos</a>
            <a href="autos.php">Autos</a>
            <a href="inventario.php">Inventario</a>
            <a href="contacto.php">Contacto</a>
        </div>
    </nav>

    <div class="login-wrapper">
        <div class="login-card">
            <h2>Acceso</h2>
            
            <form action="login.php" method="POST">
                <div class="input-group">
                    <label>Usuario / Username</label>
                    <input type="text" name="usuario" placeholder="Tu usuario" required>
                </div>
                
                <div class="input-group">
                    <label>Contraseña / Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                
                <button type="submit" class="btn-login">Entrar al Sistema</button>
            </form>

            <div class="register-footer">
                ¿Eres nuevo? <a href="registro.php">Crea una cuenta aquí</a>
            </div>
        </div>
    </div>

    <footer>© 2026 Concesionario Digital — San José, Costa Rica</footer>

</body>
</html>