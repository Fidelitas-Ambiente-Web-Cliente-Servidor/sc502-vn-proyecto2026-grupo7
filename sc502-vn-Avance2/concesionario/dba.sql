-- 1. Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS concesionario_db;
USE concesionario_db;

-- 2. Tabla de Vehículos (Catálogo)

CREATE TABLE IF NOT EXISTS vehiculos (
    id_vehiculo INT AUTO_INCREMENT PRIMARY KEY,
    nombre_modelo VARCHAR(100) NOT NULL,
    tipo ENUM('auto', 'moto') NOT NULL,
    precio DECIMAL(12, 2) NOT NULL,
    anio INT NOT NULL,
    descripcion TEXT,
    imagen_url VARCHAR(255) 
);

-- 3. Tabla de Clientes

CREATE TABLE IF NOT EXISTS clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(150) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Tabla de Reservas

CREATE TABLE IF NOT EXISTS reservas (
    id_reserva INT AUTO_INCREMENT PRIMARY KEY,
    nombre_solicitante VARCHAR(150) NOT NULL, -- Input 'nombre'
    telefono_contacto VARCHAR(20) NOT NULL,   -- Input 'telefono'
    id_vehiculo_interes INT,                  -- Select 'vehiculo'
    mensaje_adicional TEXT,                   -- Textarea 'mensaje'
    fecha_solicitud TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_vehiculo_interes) REFERENCES vehiculos(id_vehiculo)
);

-- 5. Inserción de datos iniciales
INSERT INTO vehiculos (nombre_modelo, tipo, precio, anio, imagen_url) VALUES 
('Toyota Corolla', 'auto', 28000.00, 2023, 'toyota_corolla.png'),
('Honda Civic', 'auto', 26000.00, 2023, 'hondacivic2023.png'),
('Mini Cooper Hardtop', 'auto', 35000.00, 2023, 'MINIHardtop.png'),
('CFMOTO 675NK', 'moto', 9500.00, 2024, 'cf675.png'),
('Honda Transalp', 'moto', 11500.00, 2024, 'transalp.png');