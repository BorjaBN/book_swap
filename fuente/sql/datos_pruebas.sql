
USE book_swap;

INSERT INTO `usuario_comun`
(`id_usuario_comun`, `nombre_usuario_comun`, `apellidos_usuario_comun`, `email_usuario_comun`, `password`, `telefono_usuario_comun`, `ciudad_usuario_comun`, `ultima_revision_intercambios`, `created_at`, `updated_at`)
VALUES
(1, 'Laura', 'Pérez Delgado', 'laura@example.com', MD5('password123'), '600123456', 'Badajoz', NULL, NOW(), NOW()),
(2, 'Carlos', 'García Romero', 'carlos@example.com', MD5('password123'), '611987654', 'Mérida', NULL, NOW(), NOW()),
(3, 'María', 'Santos Delgado', 'maria@example.com', MD5('password123'), '622456789', 'Cáceres', NULL, NOW(), NOW()),
(4, 'Javier', 'López Martín', 'javier@example.com', MD5('password123'), '633112233', 'Badajoz', NULL, NOW(), NOW()),
(5, 'Elena', 'Ruiz Sánchez', 'elena@example.com', MD5('password123'), '644998877', 'Don Benito', NULL, NOW(), NOW());
----------------------------------------------------------------------------------------------------------------------------------------------------------
INSERT INTO `entidad_cultural`
(`id_entidad_cultural`, `nombre_entidad_cultural`, `email_entidad_cultural`, `password`, `telefono_entidad_cultural`, `ciudad_entidad_cultural`, `direccion_entidad_cultural`, `web_entidad_cultural`, `created_at`, `updated_at`)
VALUES
(1, 'Biblioteca Central de Badajoz', 'central@badajoz.es', MD5('password123'), '924000111', 'Badajoz', 'Av. Europa, 12', 'https://biblioteca-badajoz.es', NOW(), NOW()),
(2, 'Asociación Cultural Letras Vivas', 'contacto@letrasvivas.es', MD5('password123'), '924111222', 'Mérida', 'Calle Almendralejo, 5', NULL, NOW(), NOW()),
(3, 'Centro Cultural Alcazaba', 'info@alcazaba.es', MD5('password123'), '924333444', 'Mérida', 'Plaza España, 3', 'https://centroalcazaba.es', NOW(), NOW()),
(4, 'Fundación Arte y Letras', 'fundacion@arteyletras.es', MD5('password123'), '924555666', 'Cáceres', 'Calle Pintores, 22', NULL, NOW(), NOW()),
(5, 'Casa de la Cultura de Don Benito', 'cultura@donbenito.es', MD5('password123'), '924777888', 'Don Benito', 'Av. Constitución, 10', 'https://culturadonbenito.es', NOW(), NOW());
------------------------------------------------------------------------------------------------------------------------------------------------------------------------
INSERT INTO `evento_cultural`
(`id_evento`, `nombre_evento`, `fecha_evento`, `descripcion_evento`, `ubicacion_evento`, `tipo_evento`, `id_entidad_cultural`, `created_at`, `updated_at`)
VALUES
(1, 'Encuentro con autor local', DATE_ADD(NOW(), INTERVAL 5 DAY), 'Un encuentro íntimo con escritores de la región.', 'Badajoz', 'encuentro con autor/a', 1, NOW(), NOW()),
(2, 'Club de lectura mensual', DATE_ADD(NOW(), INTERVAL 10 DAY), 'Debate abierto sobre la obra seleccionada del mes.', 'Mérida', 'club de lectura', 2, NOW(), NOW()),
(3, 'Feria del libro de primavera', DATE_ADD(NOW(), INTERVAL 15 DAY), 'Stands, firmas y actividades para todas las edades.', 'Mérida', 'feria del libro', 3, NOW(), NOW()),
(4, 'Presentación de novela histórica', DATE_ADD(NOW(), INTERVAL 20 DAY), 'Un viaje literario al pasado con su autora invitada.', 'Cáceres', 'encuentro con autor/a', 4, NOW(), NOW()),
(5, 'Taller de escritura creativa', DATE_ADD(NOW(), INTERVAL 25 DAY), 'Ejercicios prácticos para estimular la imaginación.', 'Don Benito', 'club de lectura', 5, NOW(), NOW()),
(6, 'Feria del libro solidaria', DATE_ADD(NOW(), INTERVAL 30 DAY), 'Recaudación de fondos mediante venta de libros donados.', 'Badajoz', 'feria del libro', 1, NOW(), NOW()),
(7, 'Lectura dramatizada', DATE_ADD(NOW(), INTERVAL 35 DAY), 'Interpretación teatral de fragmentos literarios.', 'Mérida', 'encuentro con autor/a', 2, NOW(), NOW()),
(8, 'Club de lectura juvenil', DATE_ADD(NOW(), INTERVAL 40 DAY), 'Espacio dedicado a jóvenes lectores.', 'Cáceres', 'club de lectura', 3, NOW(), NOW());
--------------------------------------------------------------------------------------------------------------------------------------------------------------------
INSERT INTO `evento_cultural`
(`id_evento`, `nombre_evento`, `fecha_evento`, `descripcion_evento`, `ubicacion_evento`, `tipo_evento`, `id_entidad_cultural`, `created_at`, `updated_at`)
VALUES
(1, 'Encuentro con autor local', DATE_ADD(NOW(), INTERVAL 5 DAY), 'Un encuentro íntimo con escritores de la región.', 'Badajoz', 'encuentro con autor/a', 1, NOW(), NOW()),
(2, 'Club de lectura mensual', DATE_ADD(NOW(), INTERVAL 10 DAY), 'Debate abierto sobre la obra seleccionada del mes.', 'Mérida', 'club de lectura', 2, NOW(), NOW()),
(3, 'Feria del libro de primavera', DATE_ADD(NOW(), INTERVAL 15 DAY), 'Stands, firmas y actividades para todas las edades.', 'Mérida', 'feria del libro', 3, NOW(), NOW()),
(4, 'Presentación de novela histórica', DATE_ADD(NOW(), INTERVAL 20 DAY), 'Un viaje literario al pasado con su autora invitada.', 'Cáceres', 'encuentro con autor/a', 4, NOW(), NOW()),
(5, 'Taller de escritura creativa', DATE_ADD(NOW(), INTERVAL 25 DAY), 'Ejercicios prácticos para estimular la imaginación.', 'Don Benito', 'club de lectura', 5, NOW(), NOW()),
(6, 'Feria del libro solidaria', DATE_ADD(NOW(), INTERVAL 30 DAY), 'Recaudación de fondos mediante venta de libros donados.', 'Badajoz', 'feria del libro', 1, NOW(), NOW()),
(7, 'Lectura dramatizada', DATE_ADD(NOW(), INTERVAL 35 DAY), 'Interpretación teatral de fragmentos literarios.', 'Mérida', 'encuentro con autor/a', 2, NOW(), NOW()),
(8, 'Club de lectura juvenil', DATE_ADD(NOW(), INTERVAL 40 DAY), 'Espacio dedicado a jóvenes lectores.', 'Cáceres', 'club de lectura', 3, NOW(), NOW());
-----------------------------------------------------------------------------------------------------------------------------------------------
INSERT INTO `libro`
(`id_libro`, `titulo_libro`, `autor_libro`, `ISBN`, `estado_libro`, `genero_libro`, `fecha_publicacion_libro`, `estado_intercambio`, `imagen_libro`, `id_usuario_comun`, `created_at`, `updated_at`)
VALUES
(1, 'El nombre del viento', 'Patrick Rothfuss', '9788401352831', 'seminuevo', 'Fantasía', '2007-03-27', 'libre', 'https://covers.openlibrary.org/b/isbn/9780756404741-L.jpg', 1, NOW(), NOW()),
(2, '1984', 'George Orwell', '9788499890942', 'usado', 'Distopía', '1949-06-08', 'libre', 'https://covers.openlibrary.org/b/isbn/9780451524935-L.jpg', 2, NOW(), NOW()),
(3, 'Cien años de soledad', 'Gabriel García Márquez', '9780307474728', 'usado', 'Realismo mágico', '1967-05-30', 'libre', 'https://covers.openlibrary.org/b/isbn/9780307474728-L.jpg', 3, NOW(), NOW()),
(4, 'El Principito', 'Antoine de Saint-Exupéry', '9780156012195', 'nuevo', 'Fábula', '1943-04-06', 'libre', 'https://covers.openlibrary.org/b/isbn/9780156012195-L.jpg', 4, NOW(), NOW()),
(5, 'Fahrenheit 451', 'Ray Bradbury', '9781451673319', 'usado', 'Ciencia ficción', '1953-10-19', 'libre', 'https://covers.openlibrary.org/b/isbn/9781451673319-L.jpg', 5, NOW(), NOW()),
(6, 'Orgullo y prejuicio', 'Jane Austen', '9780141439518', 'seminuevo', 'Romance', '1813-01-28', 'libre', 'https://covers.openlibrary.org/b/isbn/9780141439518-L.jpg', 1, NOW(), NOW()),
(7, 'Crimen y castigo', 'Fiódor Dostoyevski', '9780140449136', 'usado', 'Drama', '1866-01-01', 'libre', 'https://covers.openlibrary.org/b/isbn/9780140449136-L.jpg', 2, NOW(), NOW()),
(8, 'El retrato de Dorian Gray', 'Oscar Wilde', '9780141439570', 'nuevo', 'Ficción', '1890-07-20', 'libre', 'https://covers.openlibrary.org/b/isbn/9780141439570-L.jpg', 3, NOW(), NOW()),
(9, 'Los juegos del hambre', 'Suzanne Collins', '9780439023528', 'seminuevo', 'Juvenil', '2008-09-14', 'libre', 'https://covers.openlibrary.org/b/isbn/9780439023528-L.jpg', 4, NOW(), NOW()),
(10, 'El código Da Vinci', 'Dan Brown', '9780307474278', 'usado', 'Thriller', '2003-03-18', 'libre', 'https://covers.openlibrary.org/b/isbn/9780307474278-L.jpg', 5, NOW(), NOW()),
(11, 'Los pilares de la Tierra', 'Ken Follett', '9780451225245', 'nuevo', 'Histórica', '1989-09-01', 'libre', 'https://covers.openlibrary.org/b/isbn/9780451225245-L.jpg', 1, NOW(), NOW()),
(12, 'El alquimista', 'Paulo Coelho', '9780061122415', 'seminuevo', 'Fábula', '1988-01-01', 'libre', 'https://covers.openlibrary.org/b/isbn/9780061122415-L.jpg', 2, NOW(), NOW()),
(13, 'La chica del tren', 'Paula Hawkins', '9781594634024', 'usado', 'Suspense', '2015-01-13', 'libre', 'https://covers.openlibrary.org/b/isbn/9781594634024-L.jpg', 3, NOW(), NOW());
----------------------------------------------------------------------------------------------------------
INSERT INTO `cartera_creditos`
(`id_cartera`, `saldo_total`, `id_usuario_comun`, `created_at`, `updated_at`)
VALUES
(1, 500, 1, NOW(), NOW()),
(2, 500, 2, NOW(), NOW()),
(3, 500, 3, NOW(), NOW()),
(4, 500, 4, NOW(), NOW()),
(5, 500, 5, NOW(), NOW());
------------------------------------------------------------------------------------------------------------
INSERT INTO `intercambios`
(`id`, `libro_id`, `solicitante_id`, `propietario_id`, `estado`, `libro_ofrecido_id`, `created_at`, `updated_at`)
VALUES

(1, 2, 1, 2, 'pendiente', NULL, NOW(), NOW()),
(2, 3, 2, 3, 'aceptado', NULL, NOW(), NOW()),
(3, 4, 3, 4, 'rechazado', NULL, NOW(), NOW()),
(4, 5, 4, 5, 'pendiente', NULL, NOW(), NOW()),
(5, 1, 5, 1, 'pendiente', NULL, NOW(), NOW()),
(6, 1, 2, 1, 'aceptado', 6, NOW(), NOW()),
(7, 4, 3, 4, 'rechazado', 7, NOW(), NOW()),
(8, 5, 4, 5, 'pendiente', 8, NOW(), NOW());
