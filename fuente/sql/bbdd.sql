DROP DATABASE IF EXISTS book_swap;
CREATE DATABASE book_swap;
CREATE USER IF NOT EXISTS 'book'@'localhost' IDENTIFIED BY 'book';
GRANT ALL ON book_swap.* TO 'book'@'localhost';
USE book_swap;


CREATE TABLE `usuario_comun` (
    `id_usuario_comun` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nombre_usuario_comun` VARCHAR(100) NOT NULL,
    `apellidos_usuario_comun` VARCHAR(100) NOT NULL,
    `email_usuario_comun` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `telefono_usuario_comun` VARCHAR(100) NOT NULL,
    `ciudad_usuario_comun` VARCHAR(100) NOT NULL,
    `ultima_revision_intercambios` TIMESTAMP NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id_usuario_comun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `cartera_creditos` (
    `id_cartera` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `saldo_total` BIGINT UNSIGNED NOT NULL DEFAULT 0,
    `id_usuario_comun` BIGINT UNSIGNED NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id_cartera`),
    CONSTRAINT `cartera_usuario_fk`
        FOREIGN KEY (`id_usuario_comun`)
        REFERENCES `usuario_comun`(`id_usuario_comun`)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `entidad_cultural` (
    `id_entidad_cultural` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nombre_entidad_cultural` VARCHAR(100) NOT NULL,
    `email_entidad_cultural` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `telefono_entidad_cultural` VARCHAR(100) NOT NULL,
    `ciudad_entidad_cultural` VARCHAR(100) NOT NULL,
    `direccion_entidad_cultural` VARCHAR(255) NOT NULL,
    `web_entidad_cultural` VARCHAR(255) NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id_entidad_cultural`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `evento_cultural` (
    `id_evento` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nombre_evento` VARCHAR(150) NOT NULL,
    `fecha_evento` DATETIME NOT NULL,
    `descripcion_evento` TEXT NOT NULL,
    `ubicacion_evento` VARCHAR(150) NOT NULL,
    `tipo_evento` ENUM('encuentro con autor/a', 'club de lectura', 'feria del libro') NOT NULL,
    `id_entidad_cultural` BIGINT UNSIGNED NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id_evento`),
    CONSTRAINT `evento_entidad_fk`
        FOREIGN KEY (`id_entidad_cultural`)
        REFERENCES `entidad_cultural`(`id_entidad_cultural`)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `libro` (
    `id_libro` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `titulo_libro` VARCHAR(150) NOT NULL,
    `autor_libro` VARCHAR(150) NOT NULL,
    `ISBN` VARCHAR(20) NOT NULL UNIQUE,
    `estado_libro` ENUM('nuevo', 'seminuevo', 'usado') NOT NULL,
    `genero_libro` VARCHAR(150) NULL,
    `fecha_publicacion_libro` DATE NOT NULL,
    `estado_intercambio` VARCHAR(255) NOT NULL DEFAULT 'libre',
    `imagen_libro` VARCHAR(255) NOT NULL,
    `id_usuario_comun` BIGINT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id_libro`),
    CONSTRAINT `libro_usuario_fk`
        FOREIGN KEY (`id_usuario_comun`)
        REFERENCES `usuario_comun`(`id_usuario_comun`)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `intercambios` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `libro_id` BIGINT UNSIGNED NOT NULL,
    `solicitante_id` BIGINT UNSIGNED NOT NULL,
    `propietario_id` BIGINT UNSIGNED NOT NULL,
    `estado` ENUM('pendiente', 'aceptado', 'rechazado') NOT NULL DEFAULT 'pendiente',
    `libro_ofrecido_id` BIGINT UNSIGNED NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),

    CONSTRAINT `intercambios_libro_fk`
        FOREIGN KEY (`libro_id`)
        REFERENCES `libro`(`id_libro`)
        ON DELETE CASCADE,

    CONSTRAINT `intercambios_solicitante_fk`
        FOREIGN KEY (`solicitante_id`)
        REFERENCES `usuario_comun`(`id_usuario_comun`)
        ON DELETE CASCADE,

    CONSTRAINT `intercambios_propietario_fk`
        FOREIGN KEY (`propietario_id`)
        REFERENCES `usuario_comun`(`id_usuario_comun`)
        ON DELETE CASCADE,

    CONSTRAINT `intercambios_libro_ofrecido_fk`
        FOREIGN KEY (`libro_ofrecido_id`)
        REFERENCES `libro`(`id_libro`)
        ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
