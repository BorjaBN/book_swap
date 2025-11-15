-- phpMyAdmin SQL Dump
-- version #
-- https://www.phpmyadmin.net/
--
-- Servidor: #
-- Tiempo de generación: 15-11-2025 a las 13:58:31
-- Versión del servidor: #
-- Versión de PHP: #

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `book_swap`
--

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_admin`, `nombre_admin`, `apellidos_admin`, `email_admin`, `pass_admin`, `telefono_admin`, `ciudad_admin`) VALUES
(1, 'Borja', 'De La Cruz Lucio', 'fbdelacruzl01@gmail.com', 'pass1234', '123456789', 'Badajoz'),
(2, 'Laura', 'Infantes Corrales', 'linfantesc01@gmail.com', 'pass1234', '987654321', 'Sevilla'),
(3, 'Miguel', 'Jaque Barbero', 'mjaqueb01@gmail.com', 'pass1234', '135798642', 'Madrid');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `cartera_creditos`
--

INSERT INTO `cartera_creditos` (`id_cartera`, `saldo_total`, `id_user_comun`) VALUES
(1, 300.00, 1),
(2, 400.00, 2),
(3, 500.00, 3);

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `entidad_cultural`
--

INSERT INTO `entidad_cultural` (`id_entidad_cultural`, `nombre_entidad_cultural`, `email_entidad_cultural`, `pass_entidad_cultural`, `telefono_entidad_cultural`, `ciudad_entidad_cultural`, `id_admin`) VALUES
(1, 'La casa del libro', 'casalibro@educarex.es', 'pass4321', '910000111', NULL, 1),
(2, 'Asociación Lectores', 'asoclectores@gmail.es', 'pass4321', NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `evento_cultural`
--

INSERT INTO `evento_cultural` (`id_evento`, `nombre_evento`, `fecha_evento`, `descripcion_evento`, `ubicacion_evento`, `tipo_evento`, `estado_evento`, `id_entidad_cultural`, `id_admin`) VALUES
(1, 'Encuentro con Cervantes', '2025-12-01', 'Charla sobre El Quijote', 'Biblioteca Central', 'encuentro con el autor', 'activo', 1, 1),
(2, 'Club de lectura juvenil', '2025-12-15', 'Lectura compartida de El principito', 'Asociación Lectores', 'club de lectura', 'activo', 2, 2);

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`id_libro`, `titulo_libro`, `autor_libro`, `ISBN`, `estado_libro`, `genero_libro`, `fecha_publicacion_libro`, `id_user_comun`) VALUES
(1, 'El Quijote', 'Miguel de Cervantes', 'ISBN001', 'nuevo', 'romance', '1605-01-01', 1),
(2, 'Cien años de soledad', 'Gabriel García Márquez', 'ISBN002', 'seminuevo', 'thriller', '1967-05-30', 1),
(3, 'La sombra del viento', 'Carlos Ruiz Zafón', 'ISBN003', 'usado', 'thriller', '2001-04-01', 1),
(4, 'Donde los árboles cantan', 'Laura Gallego', 'ISBN004', 'nuevo', 'fantasia', '2011-10-01', 2),
(5, 'El principito', 'Antoine de Saint-Exupéry', 'ISBN005', 'usado', 'romance', '1943-04-06', 2);

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `user_comun`
--

INSERT INTO `user_comun` (`id_user_comun`, `nombre_user_comun`, `apellidos_user_comun`, `email_user_comun`, `pass_user_comun`, `telefono_user_comun`, `ciudad_user_comun`, `id_admin`) VALUES
(1, 'Lucas', 'Escobar Gavidia', 'lescobarg02@gmail.es', 'pass1234', '123456789', 'Merida', 1),
(2, 'Ingrit', 'De La Cruz Creado', 'idelacruzl02@gmail.com', 'pass1234', '987654321', 'Cordoba', 2),
(3, 'Gorgonita', 'Blanco Negro', 'gorgonitabn@gmail.com', 'pass1234', '135798642', 'Caceres', 3);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
