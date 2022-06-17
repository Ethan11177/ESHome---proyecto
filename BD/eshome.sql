-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2022 a las 00:12:05
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `eshome`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `Usuario` varchar(50) NOT NULL,
  `Contrasenia` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arrienda`
--

CREATE TABLE `arrienda` (
  `IdInmueble` int(12) NOT NULL,
  `CURP` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmueble`
--

CREATE TABLE `inmueble` (
  `IdInmueble` int(12) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Calle` varchar(50) NOT NULL,
  `NoInterior` smallint(6) DEFAULT NULL,
  `NoExterior` smallint(6) NOT NULL,
  `Colonia` varchar(50) NOT NULL,
  `Descripción` varchar(300) NOT NULL,
  `Delegación` varchar(50) NOT NULL,
  `Disponibilidad` tinyint(1) NOT NULL,
  `CURP` varchar(18) NOT NULL,
  `Renta` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inmueble`
--

INSERT INTO `inmueble` (`IdInmueble`, `Nombre`, `Calle`, `NoInterior`, `NoExterior`, `Colonia`, `Descripción`, `Delegación`, `Disponibilidad`, `CURP`, `Renta`) VALUES
(1, 'Ethan', 'Lomas', 2, 2, 'Lomas', '¡Está chido!', 'Gustavo A. Madero', 1, 'VAAE010522HMCQGTA7', 700),
(2, 'Saúl', 'Hola', 332, 44, 'Hola', 'Sí está bueno', 'Gustavo A. Madero', 1, 'RICARDO01234567890', 900),
(3, 'Ethan', 'Hola', 234, 4, 'Kakariko', 'Agradable lugar', 'Gustavo A. Madero', 1, 'VAAE010522HMCQGTA7', 3000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `CURP` varchar(18) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `ApellidoP` varchar(50) NOT NULL,
  `ApellidoM` varchar(50) NOT NULL,
  `Sexo` varchar(6) NOT NULL,
  `FechaNacimiento` varchar(10) NOT NULL,
  `Correo` varchar(50) NOT NULL,
  `Contraseña` varchar(50) NOT NULL,
  `Telefono` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`CURP`, `Nombre`, `ApellidoP`, `ApellidoM`, `Sexo`, `FechaNacimiento`, `Correo`, `Contraseña`, `Telefono`) VALUES
('Isaac1234567890912', 'Isaac', 'Perez', 'Perez', 'M', '2000-09-02', 'iasac@correo.com', 'hola', 2147483647),
('RICARDO01234567890', 'King', 'Ricardo', 'Ricardo', 'M', '2000-05-01', 'king@king.com', 'QWERTY', 2147483647),
('VAAE010522HMCQGTA7', 'Ethan', 'Emiliano', 'aguilera', 'M', '2001-05-22', 'jimimorison03@gmail.com', 'hola', 2147483647);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `renta`
--

CREATE TABLE `renta` (
  `IdInmueble` int(12) NOT NULL,
  `CURP` varchar(18) NOT NULL,
  `FechaSolicitud` datetime NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Direccion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `renta`
--

INSERT INTO `renta` (`IdInmueble`, `CURP`, `FechaSolicitud`, `Nombre`, `Direccion`) VALUES
(2, 'VAAE010522HMCQGTA7', '2022-06-12 22:36:49', 'King Ricardo Ricardo', 'Calle: Hola Número Int. 332 Número Ext. 44 Colonia: Hola Delegación: Gustavo A. Madero');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `arrienda`
--
ALTER TABLE `arrienda`
  ADD PRIMARY KEY (`IdInmueble`,`CURP`),
  ADD KEY `cvePersonArr` (`CURP`);

--
-- Indices de la tabla `inmueble`
--
ALTER TABLE `inmueble`
  ADD PRIMARY KEY (`IdInmueble`,`CURP`),
  ADD KEY `cvePerson` (`CURP`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`CURP`);

--
-- Indices de la tabla `renta`
--
ALTER TABLE `renta`
  ADD PRIMARY KEY (`IdInmueble`,`CURP`),
  ADD KEY `cvePersonRen` (`CURP`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inmueble`
--
ALTER TABLE `inmueble`
  MODIFY `IdInmueble` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `arrienda`
--
ALTER TABLE `arrienda`
  ADD CONSTRAINT `cvePersonArr` FOREIGN KEY (`CURP`) REFERENCES `persona` (`CURP`);

--
-- Filtros para la tabla `inmueble`
--
ALTER TABLE `inmueble`
  ADD CONSTRAINT `cvePerson` FOREIGN KEY (`CURP`) REFERENCES `persona` (`CURP`);

--
-- Filtros para la tabla `renta`
--
ALTER TABLE `renta`
  ADD CONSTRAINT `cvePersonRen` FOREIGN KEY (`CURP`) REFERENCES `persona` (`CURP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
