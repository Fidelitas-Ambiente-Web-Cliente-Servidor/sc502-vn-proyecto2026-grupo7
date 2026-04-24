
CREATE DATABASE IF NOT EXISTS appdb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE appdb;

CREATE TABLE IF NOT EXISTS vehiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_modelo VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    tipo ENUM('auto', 'moto') NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    descripcion TEXT,
    estado VARCHAR(50) NOT NULL DEFAULT 'Disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(120) NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    correo VARCHAR(120) NOT NULL,
    telefono VARCHAR(25) NOT NULL,
    rol ENUM('admin', 'cliente') NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_solicitante VARCHAR(120) NOT NULL,
    correo_contacto VARCHAR(120) NOT NULL,
    telefono_contacto VARCHAR(25) NOT NULL,
    fecha_visita DATE DEFAULT NULL,
    vehiculo_interes VARCHAR(120) DEFAULT NULL,
    mensaje_adicional TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO usuarios (nombre_completo, usuario, password, correo, telefono, rol) VALUES
('Administrador', 'admin_j', '12345', 'admin@concesionario.com', '88888888', 'admin'),
('Cliente Test', 'cliente_test', '12345', 'cliente@concesionario.com', '22222222', 'cliente')
ON DUPLICATE KEY UPDATE usuario = VALUES(usuario);

INSERT INTO vehiculos (nombre_modelo, precio, tipo, imagen, descripcion, estado) VALUES
('Toyota Corolla', 28000, 'auto', 'corolla2000sedan.png', 'Motor 2000cc | Sedán | 2023', 'Disponible'),
('Honda Civic', 26000, 'auto', 'hondacivic2023.png', 'Motor 1800cc | Sedán | 2023', 'Disponible'),
('MINI Cooper Hardtop', 35000, 'auto', 'MINIHardtop.png', 'Motor 2000cc | Hardtop | 2025', 'Disponible'),
('Taos SUV compacto', 27975, 'auto', 'Volks.png', 'Motor 1395cc | SUV | 2026', 'Disponible'),
('Bentley Flying Spur', 254000, 'auto', 'BentlyCaro.png', 'Motor 2995cc | Sedán | 2025', 'Disponible'),
('Bentley Bentayga', 234000, 'auto', 'Bentayga.png', 'Motor 3996cc | SUV | 2025', 'Disponible'),
('BMW 2 Series M235i', 57950, 'auto', 'BMWM235i.png', 'Motor 2979cc | Sedán | 2023', 'Disponible'),
('BMW M3 Berlina', 147000, 'auto', 'bmwm3.png', 'Motor 2993cc | Sedán | 2026', 'Disponible'),
('Subaru EVOLTIS TOURING 2.4', 86590, 'auto', 'SubaruEVOLTIS.png', 'Motor 2000cc | Sedán | 2023', 'Disponible'),
('RAM 1500', 97900, 'auto', 'RAMPICK.png', 'Motor 1500cc | Pickup | 2026', 'Disponible'),
('CFMOTO 675NK', 9500, 'moto', 'cf675.png', 'Motor 675cc | Naked Sport | 2024', 'Disponible'),
('Honda XL750 Transalp', 11500, 'moto', 'transalp.png', 'Motor 750cc | Adventure | 2024', 'Disponible'),
('Honda CB650R', 10500, 'moto', 'cb650r.png', 'Motor 650cc | Naked Sport | 2024', 'Disponible'),
('CFMOTO 700MT', 12000, 'moto', 'cfmt700.png', 'Motor 700cc | Touring | 2024', 'Disponible'),
('Honda CRF300L Rally', 7500, 'moto', 'honda rally.png', 'Motor 300cc | Off-Road | 2024', 'Disponible'),
('CFMOTO 450MT', 8500, 'moto', 'mt450.png', 'Motor 450cc | Adventure | 2024', 'Disponible')
ON DUPLICATE KEY UPDATE nombre_modelo = VALUES(nombre_modelo);
