-- phpMyAdmin SQL Dump
-- version #
-- https://www.phpmyadmin.net/
--
-- Servidor: #
-- Tiempo de generación: 15-11-2025 a las 12:16:17
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
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_admin` int(11) NOT NULL,
  `nombre_admin` varchar(100) NOT NULL,
  `apellidos_admin` varchar(100) NOT NULL,
  `email_admin` varchar(100) NOT NULL,
  `pass_admin` varchar(255) NOT NULL,
  `telefono_admin` varchar(100) DEFAULT NULL,
  `ciudad_admin` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartera_creditos`
--

CREATE TABLE `cartera_creditos` (
  `id_cartera` int(11) NOT NULL,
  `saldo_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `id_user_comun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidad_cultural`
--

CREATE TABLE `entidad_cultural` (
  `id_entidad_cultural` int(11) NOT NULL,
  `nombre_entidad_cultural` varchar(100) NOT NULL,
  `email_entidad_cultural` varchar(100) NOT NULL,
  `pass_entidad_cultural` varchar(255) NOT NULL,
  `telefono_entidad_cultural` varchar(100) DEFAULT NULL,
  `ciudad_entidad_cultural` varchar(100) DEFAULT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento_cultural`
--

CREATE TABLE `evento_cultural` (
  `id_evento` int(11) NOT NULL,
  `nombre_evento` varchar(150) NOT NULL,
  `fecha_evento` date DEFAULT NULL,
  `descripcion_evento` text DEFAULT NULL,
  `ubicacion_evento` varchar(150) DEFAULT NULL,
  `tipo_evento` enum('encuentro con el autor','club de lectura','feria del libro') DEFAULT NULL,
  `estado_evento` varchar(50) DEFAULT NULL,
  `id_entidad_cultural` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `id_libro` int(11) NOT NULL,
  `titulo_libro` varchar(150) NOT NULL,
  `autor_libro` varchar(150) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `estado_libro` enum('nuevo','seminuevo','usado') DEFAULT NULL,
  `genero_libro` enum('fantasia','romance','thriller','ensayo') DEFAULT NULL,
  `fecha_publicacion_libro` date DEFAULT NULL,
  `id_user_comun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento_credito`
--

CREATE TABLE `movimiento_credito` (
  `id_movimiento` int(11) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `tipo_movimiento` enum('ganado','gastado','otorgado') NOT NULL,
  `fecha_movimiento` datetime NOT NULL DEFAULT current_timestamp(),
  `id_cartera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_comun`
--

CREATE TABLE `user_comun` (
  `id_user_comun` int(11) NOT NULL,
  `nombre_user_comun` varchar(100) NOT NULL,
  `apellidos_user_comun` varchar(100) NOT NULL,
  `email_user_comun` varchar(100) NOT NULL,
  `pass_user_comun` varchar(255) NOT NULL,
  `telefono_user_comun` varchar(100) DEFAULT NULL,
  `ciudad_user_comun` varchar(100) DEFAULT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `email_admin` (`email_admin`);

--
-- Indices de la tabla `cartera_creditos`
--
ALTER TABLE `cartera_creditos`
  ADD PRIMARY KEY (`id_cartera`),
  ADD KEY `id_user_comun` (`id_user_comun`);

--
-- Indices de la tabla `entidad_cultural`
--
ALTER TABLE `entidad_cultural`
  ADD PRIMARY KEY (`id_entidad_cultural`),
  ADD UNIQUE KEY `email_entidad_cultural` (`email_entidad_cultural`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indices de la tabla `evento_cultural`
--
ALTER TABLE `evento_cultural`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `id_entidad_cultural` (`id_entidad_cultural`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id_libro`),
  ADD UNIQUE KEY `ISBN` (`ISBN`),
  ADD KEY `id_user_comun` (`id_user_comun`);

--
-- Indices de la tabla `movimiento_credito`
--
ALTER TABLE `movimiento_credito`
  ADD PRIMARY KEY (`id_movimiento`),
  ADD KEY `id_cartera` (`id_cartera`);

--
-- Indices de la tabla `user_comun`
--
ALTER TABLE `user_comun`
  ADD PRIMARY KEY (`id_user_comun`),
  ADD UNIQUE KEY `email_user_comun` (`email_user_comun`),
  ADD KEY `id_admin` (`id_admin`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cartera_creditos`
--
ALTER TABLE `cartera_creditos`
  MODIFY `id_cartera` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entidad_cultural`
--
ALTER TABLE `entidad_cultural`
  MODIFY `id_entidad_cultural` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `evento_cultural`
--
ALTER TABLE `evento_cultural`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `movimiento_credito`
--
ALTER TABLE `movimiento_credito`
  MODIFY `id_movimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user_comun`
--
ALTER TABLE `user_comun`
  MODIFY `id_user_comun` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cartera_creditos`
--
ALTER TABLE `cartera_creditos`
  ADD CONSTRAINT `cartera_creditos_ibfk_1` FOREIGN KEY (`id_user_comun`) REFERENCES `user_comun` (`id_user_comun`);

--
-- Filtros para la tabla `entidad_cultural`
--
ALTER TABLE `entidad_cultural`
  ADD CONSTRAINT `entidad_cultural_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `administrador` (`id_admin`);

--
-- Filtros para la tabla `evento_cultural`
--
ALTER TABLE `evento_cultural`
  ADD CONSTRAINT `evento_cultural_ibfk_1` FOREIGN KEY (`id_entidad_cultural`) REFERENCES `entidad_cultural` (`id_entidad_cultural`),
  ADD CONSTRAINT `evento_cultural_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `administrador` (`id_admin`);

--
-- Filtros para la tabla `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`id_user_comun`) REFERENCES `user_comun` (`id_user_comun`);

--
-- Filtros para la tabla `movimiento_credito`
--
ALTER TABLE `movimiento_credito`
  ADD CONSTRAINT `movimiento_credito_ibfk_1` FOREIGN KEY (`id_cartera`) REFERENCES `cartera_creditos` (`id_cartera`);

--
-- Filtros para la tabla `user_comun`
--
ALTER TABLE `user_comun`
  ADD CONSTRAINT `user_comun_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `administrador` (`id_admin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
