-- phpMyAdmin SQL Dump
-- version 4.2.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 23-10-2014 a las 21:15:06
-- Versión del servidor: 5.5.39-MariaDB
-- Versión de PHP: 5.5.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `store_core`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `google_config`
--

DROP TABLE IF EXISTS `google_config`;
CREATE TABLE IF NOT EXISTS `google_config` (
`id` int(11) NOT NULL,
  `google_user` varchar(255) NOT NULL,
  `config` varchar(255) NOT NULL,
  `google_api` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL,
  `finish_date` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `google_config`
--
ALTER TABLE `google_config`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `google_config`
--
ALTER TABLE `google_config`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
