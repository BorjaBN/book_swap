DROP DATABASE IF EXISTS book_swap;
CREATE DATABASE book_swap;
CREATE USER IF NOT EXISTS 'book'@'localhost' IDENTIFIED BY 'book';
GRANT ALL ON book_swap.* TO 'book'@'localhost';
USE book_swap;

-- Tabla de usuarios comunes
CREATE TABLE user_comun (
  id_user_comun INT AUTO_INCREMENT PRIMARY KEY,
  nombre_user_comun VARCHAR(100) NOT NULL,
  apellidos_user_comun VARCHAR(100) NOT NULL,
  email_user_comun VARCHAR(100) NOT NULL UNIQUE,
  pass_user_comun VARCHAR(255) NOT NULL,
  telefono_user_comun VARCHAR(100) NOT NULL,
  ciudad_user_comun VARCHAR(100) NOT NULL
);

-- Tabla de cartera de créditos
CREATE TABLE cartera_creditos (
  id_cartera INT AUTO_INCREMENT PRIMARY KEY,
  saldo_total DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  id_user_comun INT NOT NULL,
  FOREIGN KEY (id_user_comun) REFERENCES user_comun(id_user_comun)
);

-- Tabla de entidades culturales
CREATE TABLE entidad_cultural (
  id_entidad_cultural INT AUTO_INCREMENT PRIMARY KEY,
  nombre_entidad_cultural VARCHAR(100) NOT NULL,
  email_entidad_cultural VARCHAR(100) NOT NULL UNIQUE,
  pass_entidad_cultural VARCHAR(255) NOT NULL,
  telefono_entidad_cultural VARCHAR(100) NOT NULL,
  ciudad_entidad_cultural VARCHAR(100) NOT NULL
);

-- Tabla de eventos culturales
CREATE TABLE evento_cultural (
  id_evento INT AUTO_INCREMENT PRIMARY KEY,
  nombre_evento VARCHAR(150) NOT NULL,
  fecha_evento DATE DEFAULT NULL,
  descripcion_evento TEXT DEFAULT NULL,
  ubicacion_evento VARCHAR(150) DEFAULT NULL,
  tipo_evento ENUM('encuentro','club','feria') DEFAULT NULL,
  estado_evento VARCHAR(50) DEFAULT NULL,
  id_entidad_cultural INT NOT NULL,
  FOREIGN KEY (id_entidad_cultural) REFERENCES entidad_cultural(id_entidad_cultural)
);

-- Tabla de libros
CREATE TABLE libro (
  id_libro INT AUTO_INCREMENT PRIMARY KEY,
  titulo_libro VARCHAR(150) NOT NULL,
  autor_libro VARCHAR(150) NOT NULL,
  ISBN VARCHAR(20) NOT NULL UNIQUE,
  estado_libro ENUM('nuevo','seminuevo','usado') DEFAULT NULL,
  genero_libro ENUM('fantasia','romance','thriller','ensayo') DEFAULT NULL,
  fecha_publicacion_libro DATE DEFAULT NULL,
  id_user_comun INT NOT NULL,
  FOREIGN KEY (id_user_comun) REFERENCES user_comun(id_user_comun)
);

-- Tabla de movimientos de crédito
CREATE TABLE movimiento_credito (
  id_movimiento INT AUTO_INCREMENT PRIMARY KEY,
  cantidad DECIMAL(10,2) NOT NULL,
  tipo_movimiento ENUM('ganado','gastado','otorgado') NOT NULL,
  fecha_movimiento DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  id_cartera INT NOT NULL,
  FOREIGN KEY (id_cartera) REFERENCES cartera_creditos(id_cartera)
);
