-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 01-12-2024 a las 22:18:04
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `adopciones_animales`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animales`
--

DROP TABLE IF EXISTS `animales`;
CREATE TABLE IF NOT EXISTS `animales` (
  `id_animal` int NOT NULL AUTO_INCREMENT,
  `id_protectora` int DEFAULT NULL,
  `id_especie` int DEFAULT NULL,
  `nombre_animal` varchar(100) NOT NULL,
  `descripcion` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `raza` varchar(100) DEFAULT NULL,
  `tamano` enum('enano','pequeño','mediano','grande','gigante') DEFAULT NULL,
  `sexo` enum('Macho','Hembra') DEFAULT NULL,
  `edad` enum('bebé','joven','adulto','anciano') DEFAULT NULL,
  `estado_salud` enum('Bueno','Enfermedad crónica','Malo','Otros (consultar)') DEFAULT NULL,
  `foto_principal` longblob NOT NULL,
  `fotos_adicionales` longblob,
  `adoptado` tinyint(1) DEFAULT '0',
  `urgente` tinyint(1) DEFAULT '0',
  `en_acogida` tinyint(1) DEFAULT '0',
  `esterilizado` enum('Sí','Con compromiso de esterilización') DEFAULT NULL,
  `fallecido` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_animal`),
  KEY `id_protectora` (`id_protectora`),
  KEY `id_especie` (`id_especie`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `animales`
--

INSERT INTO `animales` (`id_animal`, `id_protectora`, `id_especie`, `nombre_animal`, `descripcion`, `raza`, `tamano`, `sexo`, `edad`, `estado_salud`, `foto_principal`, `fotos_adicionales`, `adoptado`, `urgente`, `en_acogida`, `esterilizado`, `fallecido`) VALUES
(1, 1, 1, 'Max', NULL, 'Labrador', 'mediano', 'Macho', 'adulto', 'Bueno', '', NULL, 0, 0, 0, 'Sí', 0),
(2, 1, 1, 'Bella', NULL, 'Beagle', 'pequeño', 'Hembra', 'bebé', 'Bueno', '', NULL, 0, 1, 0, 'Sí', 0),
(3, 2, 1, 'Rex', NULL, 'Pastor Alemán', 'grande', 'Macho', 'adulto', 'Bueno', '', NULL, 1, 0, 0, 'Sí', 0),
(4, 3, 1, 'Thor', NULL, 'Pitbull', 'grande', 'Macho', 'anciano', 'Malo', '', NULL, 0, 1, 0, 'Sí', 1),
(5, 4, 1, 'Bobby', NULL, 'Bulldog', 'pequeño', 'Macho', 'joven', 'Bueno', '', NULL, 0, 0, 0, 'Sí', 0),
(6, 5, 1, 'Bella', NULL, 'Golden Retriever', 'grande', 'Hembra', 'joven', 'Bueno', '', NULL, 0, 0, 0, 'Sí', 0),
(7, 1, 2, 'Miau', NULL, 'Siames', 'mediano', 'Macho', 'adulto', 'Bueno', '', NULL, 0, 0, 0, 'Sí', 0),
(8, 1, 2, 'Luna', NULL, 'Persa', 'grande', 'Hembra', 'joven', 'Enfermedad crónica', '', NULL, 0, 0, 0, 'Con compromiso de esterilización', 0),
(9, 2, 2, 'Gato Negro', NULL, 'Persa', 'mediano', 'Macho', 'adulto', 'Enfermedad crónica', '', NULL, 0, 0, 0, 'Sí', 0),
(10, 3, 2, 'Cielito', NULL, 'Maine Coon', 'grande', 'Hembra', 'bebé', 'Bueno', '', NULL, 0, 0, 0, 'Sí', 0),
(11, 4, 2, 'Mimi', NULL, 'Ragdoll', 'mediano', 'Hembra', 'adulto', 'Bueno', '', NULL, 0, 0, 0, 'Con compromiso de esterilización', 0),
(12, 5, 2, 'Tommy', NULL, 'Siamés', 'mediano', 'Macho', 'adulto', 'Malo', '', NULL, 1, 0, 0, 'Sí', 0),
(13, 1, 3, 'Conejito', NULL, 'Enano', 'enano', 'Macho', 'bebé', 'Malo', '', NULL, 0, 0, 0, 'Sí', 0),
(14, 2, 3, 'Fluffy', NULL, 'Angora', 'mediano', 'Hembra', 'joven', 'Bueno', '', NULL, 0, 1, 0, 'Con compromiso de esterilización', 0),
(15, 3, 3, 'Pipo', NULL, 'Enano', 'enano', 'Macho', 'bebé', 'Bueno', '', NULL, 0, 0, 0, 'Sí', 0),
(16, 4, 3, 'Bunny', NULL, 'Holandés', 'pequeño', 'Hembra', 'joven', 'Bueno', '', NULL, 0, 0, 0, 'Sí', 0),
(17, 5, 3, 'Cocoa', NULL, 'Mini Rex', 'mediano', 'Macho', 'adulto', 'Enfermedad crónica', '', NULL, 0, 0, 0, 'Sí', 0),
(18, 1, 4, 'Rocky', NULL, 'Serpiente Boa', 'gigante', 'Macho', 'adulto', 'Bueno', '', NULL, 0, 0, 0, 'Sí', 0),
(19, 2, 4, 'Sara', NULL, 'Iguana', 'mediano', 'Hembra', 'bebé', 'Bueno', '', NULL, 0, 0, 0, 'Sí', 0),
(20, 3, 4, 'Paco', NULL, 'Cocodrilo', 'gigante', 'Macho', 'adulto', 'Otros (consultar)', '', NULL, 0, 0, 0, 'Sí', 0),
(21, 4, 4, 'Jake', NULL, 'Camaleón', 'pequeño', 'Macho', 'joven', 'Bueno', '', NULL, 0, 1, 0, 'Sí', 0),
(22, 5, 4, 'Sasha', NULL, 'Tortuga', 'mediano', 'Hembra', 'bebé', 'Bueno', '', NULL, 0, 0, 0, 'Sí', 0),
(23, 1, 5, 'Loro', NULL, 'Cotorra', 'pequeño', 'Macho', 'adulto', 'Bueno', '', NULL, 0, 0, 0, 'Sí', 0),
(24, 2, 5, 'Periquito', NULL, 'Canario', 'pequeño', 'Hembra', 'bebé', 'Bueno', '', NULL, 0, 0, 0, 'Sí', 0),
(25, 3, 5, 'Agapornis', NULL, 'Agapornis', 'pequeño', 'Macho', 'adulto', 'Bueno', '', NULL, 0, 1, 0, 'Sí', 0),
(26, 4, 5, 'Cacatúa', NULL, 'Cacatúa', 'mediano', 'Hembra', 'joven', 'Bueno', '', NULL, 0, 0, 0, 'Sí', 0),
(27, 5, 5, 'Canario', NULL, 'Canario', 'pequeño', 'Macho', 'adulto', 'Malo', '', NULL, 0, 1, 0, 'Sí', 0),
(28, 1, 6, 'Hamster', NULL, 'Dwarft', 'pequeño', 'Macho', 'bebé', 'Bueno', '', NULL, 0, 0, 0, 'Sí', 0),
(29, 2, 6, 'Cobaya', NULL, 'Peruana', 'mediano', 'Hembra', 'joven', 'Enfermedad crónica', '', NULL, 0, 0, 0, 'Sí', 0),
(30, 3, 6, 'Chinchilla', NULL, 'Chinchilla', 'mediano', 'Macho', 'adulto', 'Bueno', '', NULL, 0, 0, 0, 'Sí', 0),
(31, 4, 6, 'Rata', NULL, 'Doméstica', 'pequeño', 'Hembra', 'bebé', 'Bueno', '', NULL, 0, 1, 0, 'Sí', 0),
(32, 5, 6, 'Jerbo', NULL, 'Jerbo', 'pequeño', 'Macho', 'joven', 'Bueno', '', NULL, 0, 0, 0, 'Sí', 0),
(33, 1, 1, 'Max', NULL, 'Labrador Retriever', 'grande', 'Macho', 'adulto', 'Bueno', '', NULL, 0, 0, 0, 'Sí', 0),
(34, 1, 1, 'Bella', NULL, 'Pastor Alemán', 'mediano', 'Hembra', 'anciano', 'Enfermedad crónica', '', NULL, 0, 1, 0, 'Con compromiso de esterilización', 0),
(35, 2, 1, 'Rocky', NULL, 'Pitbull', 'mediano', 'Macho', 'bebé', 'Malo', '', NULL, 0, 0, 1, 'Sí', 0),
(36, 3, 1, 'Luna', NULL, 'Golden Retriever', 'grande', 'Hembra', 'joven', 'Bueno', '', NULL, 0, 0, 0, 'Sí', 0),
(37, 2, 1, 'Toby', NULL, 'Chihuahua', 'pequeño', 'Macho', 'adulto', 'Otros (consultar)', '', NULL, 0, 0, 0, 'Sí', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunidades_autonomas`
--

DROP TABLE IF EXISTS `comunidades_autonomas`;
CREATE TABLE IF NOT EXISTS `comunidades_autonomas` (
  `id_ccaa` int NOT NULL AUTO_INCREMENT,
  `nombre_ccaa` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ccaa`),
  UNIQUE KEY `nombre_ccaa` (`nombre_ccaa`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `comunidades_autonomas`
--

INSERT INTO `comunidades_autonomas` (`id_ccaa`, `nombre_ccaa`) VALUES
(1, 'Andalucía'),
(2, 'Aragón'),
(3, 'Asturias'),
(4, 'Islas Baleares'),
(5, 'Canarias'),
(6, 'Cantabria'),
(7, 'Castilla-La Mancha'),
(8, 'Castilla y León'),
(9, 'Cataluña'),
(10, 'Extremadura'),
(11, 'Galicia'),
(12, 'Madrid'),
(13, 'Murcia'),
(14, 'Navarra'),
(15, 'La Rioja'),
(16, 'País Vasco'),
(17, 'Valencia'),
(18, 'Ceuta'),
(19, 'Melilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especies`
--

DROP TABLE IF EXISTS `especies`;
CREATE TABLE IF NOT EXISTS `especies` (
  `id_especie` int NOT NULL AUTO_INCREMENT,
  `nombre_especie` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_especie`),
  UNIQUE KEY `nombre` (`nombre_especie`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `especies`
--

INSERT INTO `especies` (`id_especie`, `nombre_especie`) VALUES
(1, 'Perros'),
(2, 'Gatos'),
(3, 'Conejos'),
(4, 'Pájaros'),
(5, 'Roedores'),
(6, 'Reptiles'),
(7, 'Otras especies');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `protectoras`
--

DROP TABLE IF EXISTS `protectoras`;
CREATE TABLE IF NOT EXISTS `protectoras` (
  `id_protectora` int NOT NULL AUTO_INCREMENT,
  `nombre_protectora` varchar(100) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `id_provincia` int NOT NULL,
  `poblacion` varchar(50) NOT NULL,
  `web` varchar(100) DEFAULT NULL,
  `logo` longblob,
  `email_visible` tinyint(1) DEFAULT '1',
  `password_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id_protectora`),
  KEY `id_provincia` (`id_provincia`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `protectoras`
--

INSERT INTO `protectoras` (`id_protectora`, `nombre_protectora`, `direccion`, `telefono`, `email`, `id_provincia`, `poblacion`, `web`, `logo`, `email_visible`, `password_user`) VALUES
(1, 'Protectora de Animales La Paz', 'Calle Ficticia 123, Ciudad', '123456789', 'contacto@lapaz.org', 1, 'Ciudad Ficticia', 'www.lapaz.org', NULL, 1, '$2y$10$LO/jbdbAVl2IM96SWJxVhOZ33DZDDFLoQmCJnDGOGY0DSwOQAXPdm'),
(2, 'Fundación Animalista Vida', 'Avenida Verde 456, Barrio', '987654321', 'fundacion@vida.org', 2, 'Barrio Animalista', 'www.vida.org', NULL, 1, '$2y$10$LO/jbdbAVl2IM96SWJxVhOZ33DZDDFLoQmCJnDGOGY0DSwOQAXPdm'),
(3, 'Protectora Huellas de Esperanza', 'Calle Esperanza 789, Pueblo', '555555555', 'info@huellas.org', 3, 'Pueblo Esperanza', 'www.huellas.org', NULL, 1, '$2y$10$LO/jbdbAVl2IM96SWJxVhOZ33DZDDFLoQmCJnDGOGY0DSwOQAXPdm'),
(4, 'Asociación Animal Solidario', 'Plaza Animal 101, Zona Norte', '444444444', 'solidaridad@animal.org', 4, 'Zona Norte', 'www.animal.org', NULL, 1, '$2y$10$LO/jbdbAVl2IM96SWJxVhOZ33DZDDFLoQmCJnDGOGY0DSwOQAXPdm'),
(5, 'Protectora Refugio Esperanza', 'Calle Refugio 112, Capital', '333333333', 'test@test.es', 5, 'Capital Esperanza', 'www.refugio.org', NULL, 1, '$2y$10$LO/jbdbAVl2IM96SWJxVhOZ33DZDDFLoQmCJnDGOGY0DSwOQAXPdm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

DROP TABLE IF EXISTS `provincias`;
CREATE TABLE IF NOT EXISTS `provincias` (
  `id_provincia` int NOT NULL AUTO_INCREMENT,
  `nombre_provincia` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_ccaa` int NOT NULL,
  PRIMARY KEY (`id_provincia`),
  KEY `id_ccaa` (`id_ccaa`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id_provincia`, `nombre_provincia`, `id_ccaa`) VALUES
(1, 'Almería', 1),
(2, 'Cádiz', 1),
(3, 'Córdoba', 1),
(4, 'Granada', 1),
(5, 'Huelva', 1),
(6, 'Jaén', 1),
(7, 'Málaga', 1),
(8, 'Sevilla', 1),
(9, 'Huesca', 2),
(10, 'Teruel', 2),
(11, 'Zaragoza', 2),
(12, 'Asturias', 3),
(13, 'Islas Baleares', 4),
(14, 'Las Palmas', 5),
(15, 'Santa Cruz de Tenerife', 5),
(16, 'Cantabria', 6),
(17, 'Albacete', 7),
(18, 'Ciudad Real', 7),
(19, 'Cuenca', 7),
(20, 'Guadalajara', 7),
(21, 'Toledo', 7),
(22, 'Ávila', 8),
(23, 'Burgos', 8),
(24, 'León', 8),
(25, 'Palencia', 8),
(26, 'Salamanca', 8),
(27, 'Segovia', 8),
(28, 'Soria', 8),
(29, 'Valladolid', 8),
(30, 'Zamora', 8),
(31, 'Barcelona', 9),
(32, 'Girona', 9),
(33, 'Lleida', 9),
(34, 'Tarragona', 9),
(35, 'Badajoz', 10),
(36, 'Cáceres', 10),
(37, 'A Coruña', 11),
(38, 'Lugo', 11),
(39, 'Ourense', 11),
(40, 'Pontevedra', 11),
(41, 'Madrid', 12),
(42, 'Murcia', 13),
(43, 'Navarra', 14),
(44, 'La Rioja', 15),
(45, 'Álava', 16),
(46, 'Bizkaia', 16),
(47, 'Gipuzkoa', 16),
(48, 'Alicante', 17),
(49, 'Castellón', 17),
(50, 'Valencia', 17),
(51, 'Ceuta', 18),
(52, 'Melilla', 19);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
