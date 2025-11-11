CREATE TABLE Administrador (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    nombre_admin VARCHAR(100) NOT NULL,
    apellidos_admin VARCHAR(100) NOT NULL,
    email_admin VARCHAR(100) NOT NULL UNIQUE,
    pass_admin VARCHAR(255) NOT NULL,
    telefono_admin VARCHAR(100),
    ciudad_admin VARCHAR(100),
    fecha_registro_admin DATE,
    id_usuario INT,
    id_user_comun INT,
    id_entidad_cultural INT,
    id_evento INT
);

CREATE TABLE Usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(100) NOT NULL,
    apellidos_usuario VARCHAR(100) NOT NULL,
    email_usuario VARCHAR(100) NOT NULL UNIQUE,
    pass_usuario VARCHAR(255) NOT NULL,
    telefono_usuario VARCHAR(100),
    ciudad_usuario VARCHAR(100),
    fecha_registro_usuario DATE,
    id_admin INT,
    id_user_comun INT,
    id_entidad_cultural INT
);

CREATE TABLE User_comun (
    id_user_comun INT AUTO_INCREMENT PRIMARY KEY,
    nombre_user_comun VARCHAR(100) NOT NULL,
    apellidos_user_comun VARCHAR(100) NOT NULL,
    email_user_comun VARCHAR(100) NOT NULL UNIQUE,
    pass_user_comun VARCHAR(255) NOT NULL,
    telefono_user_comun VARCHAR(100),
    ciudad_user_comun VARCHAR(100),
    fecha_registro_user_comun DATE,
    id_admin INT,
    id_usuario INT
);

CREATE TABLE Entidad_cultural (
    id_entidad_cultural INT AUTO_INCREMENT PRIMARY KEY,
    nombre_entidad_cultural VARCHAR(100) NOT NULL,
    email_entidad_cultural VARCHAR(100) NOT NULL UNIQUE,
    pass_entidad_cultural VARCHAR(255) NOT NULL,
    telefono_entidad_cultural VARCHAR(100),
    ciudad_entidad_cultural VARCHAR(100),
    fecha_registro_entidad_cultural DATE,
    id_admin INT,
    id_usuario INT,
    id_evento INT
);

CREATE TABLE Evento_cultural (
    id_evento INT AUTO_INCREMENT PRIMARY KEY,
    nombre_evento VARCHAR(150) NOT NULL,
    fecha_evento DATE,
    descripcion_evento TEXT,
    ubicacion_evento VARCHAR(150),
    tipo_evento ENUM(),
    estado_evento VARCHAR(50),
    id_entidad_cultural INT,
    id_administrador INT
);

/*----------TABLAS RELACIONADAS LIBROS------*/
CREATE TABLE Libro (
    id_libro INT AUTO_INCREMENT PRIMARY KEY,
    titulo_libro VARCHAR(150) NOT NULL,
    autor_libro VARCHAR(150) NOT NULL,
    ISBN VARCHAR(255) NOT NULL,
    estado_libro ENUM('nuevo','seminuevo','usado'),
    genero_libro ENUM(),
    fecha_publicacion_libro DATE,
    fecha_alta_libro DATE,
    id_catalogo INT,
    id_user_comun INT
);

CREATE TABLE Catalogo_libro ( 
    id_catalogo INT AUTO_INCREMENT PRIMARY KEY,
    tipo_catalogo VARCHAR(100),
    id_user_comun INT
);

CREATE TABLE lIBRO_Catalogo ( 
    id_catalogo INT  PRIMARY KEY,
    id_libro INT PRIMARY KEY
);