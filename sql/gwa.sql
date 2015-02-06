-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-02-2015 a las 13:24:31
-- Versión del servidor: 5.5.40-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gwa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `padre` int(11) NOT NULL,
  `baja` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `padre`, `baja`) VALUES
(1, 'Autos', 0, 0),
(2, 'Camionetas', 0, 0),
(3, 'Camiones', 0, 0),
(4, 'Volkswagen', 1, 0),
(5, 'Ford', 1, 0),
(8, 'Mercedes Benz', 3, 0),
(11, 'Pepito', 0, 0),
(12, 'jijiji23', 11, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `general`
--

CREATE TABLE IF NOT EXISTS `general` (
  `color_fuente_banner` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `general`
--

INSERT INTO `general` (`color_fuente_banner`) VALUES
('FFFFFF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE IF NOT EXISTS `modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `alineacion` text NOT NULL,
  `anchoTexto` int(11) NOT NULL,
  `anchoImagen` int(11) NOT NULL,
  `altoImagen` int(11) NOT NULL,
  `anchoVideo` int(11) NOT NULL,
  `altoVideo` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `texto` text NOT NULL,
  `imagen` text NOT NULL,
  `video` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `categoria`, `titulo`, `alineacion`, `anchoTexto`, `anchoImagen`, `altoImagen`, `anchoVideo`, `altoVideo`, `orden`, `texto`, `imagen`, `video`) VALUES
(1, 4, 'Titulo del modulo', 'left', 100, 100, 100, 1, 1, 2, 'Texto Opcional', 'modulos/1423158870.jpg', ''),
(2, 4, 'Titulo del modulo 2', 'left', 50, 50, 50, 1, 1, 1, 'Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto Texto ', 'modulos/1423158857.jpg', ''),
(6, 4, '', '', 0, 0, 0, 0, 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` text NOT NULL,
  `clave` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `mail`, `clave`) VALUES
(2, 'costanzo_pablo@hotmail.com', '123456');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
