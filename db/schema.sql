-- SQL schema for CasinoControl
CREATE DATABASE IF NOT EXISTS casinos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE casinos;

CREATE TABLE IF NOT EXISTS casinos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(150) NOT NULL,
  direccion VARCHAR(255),
  telefono_sala VARCHAR(50),
  lider_sala VARCHAR(150),
  technicians TEXT,
  policia VARCHAR(100),
  security_company VARCHAR(150),
  security_phone VARCHAR(80),
  security_email VARCHAR(150),
  security_notes TEXT,
  camaras JSON DEFAULT NULL,
  horarios JSON DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS control_horarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  casino_id INT NOT NULL,
  fecha DATE NOT NULL,
  tipo ENUM('casino','oficina') DEFAULT 'casino',
  hora_ingreso TIME,
  hora_apertura_publico TIME,
  hora_apertura_personal TIME,
  hora_salida TIME,
  responsable VARCHAR(150),
  observaciones TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (casino_id) REFERENCES casinos(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS novedades (
  id INT AUTO_INCREMENT PRIMARY KEY,
  casino_id INT NOT NULL,
  fecha DATETIME NOT NULL,
  tipo VARCHAR(80),
  descripcion TEXT,
  responsable VARCHAR(150),
  evidencia VARCHAR(255),
  uniformidad VARCHAR(100),
  conclusion TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (casino_id) REFERENCES casinos(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(80) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
