-- 1. CREACIÓN DE LA BASE DE DATOS
CREATE DATABASE IF NOT EXISTS concesionario_db;
USE concesionario_db;

-- 2. TABLA DE VEHÍCULOS (Corregida con 'descripcion' y 'estado')
CREATE TABLE IF NOT EXISTS vehiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_modelo VARCHAR(100) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    tipo ENUM('auto', 'moto') NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    descripcion TEXT,
    estado VARCHAR(50) DEFAULT 'Disponible'
);

-- 3. TABLA DE USUARIOS (Para el login)
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'cliente') DEFAULT 'cliente'
);

-- 4. INSERTAR USUARIOS DE PRUEBA (Admin y Cliente)

INSERT INTO usuarios (usuario, password, rol) VALUES 
('admin_j', '12345', 'admin'),
('cliente_test', '12345', 'cliente');

-- 5. INSERTAR INVENTARIO DE AUTOS (Basado en tus imágenes)
INSERT INTO vehiculos (nombre_modelo, precio, tipo, imagen, descripcion, estado) VALUES 
('Toyota Corolla', 28000, 'auto', 'corolla2000sedan.png', 'Motor 2000cc | Sedán | 2023', 'Disponible'),
('Honda Civic', 26000, 'auto', 'hondacivic.png', 'Motor 1500cc | Sedán | 2023', 'Disponible'),
('Mini Cooper Hardtop', 35000, 'auto', 'minicooper.png', 'Motor 2000cc | Hardtop | 2025', 'Disponible'),
('Taos SUV Compacto', 27975, 'auto', 'taos.png', 'Motor 1395cc | SUV | 2025', 'Disponible'),
('Bentley Flying Spur', 254000, 'auto', 'bentley_flying.png', 'Motor 2995cc | Sedán | 2025', 'Disponible'),
('Bentley Bentayga', 234000, 'auto', 'bentley_bentayga.png', 'Motor 3996cc | SUV | 2025', 'Disponible'),
('BMW 2 Series M235i', 57950, 'auto', 'bmw2.png', 'Motor 1998cc | Sedán | 2023', 'Disponible'),
('BMW M3 Berlina', 147000, 'auto', '