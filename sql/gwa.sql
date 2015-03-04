-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-03-2015 a las 10:46:55
-- Versión del servidor: 5.5.40-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.6

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
  `red` int(11) NOT NULL,
  `blue` int(11) NOT NULL,
  `green` int(11) NOT NULL,
  `baja` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `padre`, `red`, `blue`, `green`, `baja`) VALUES
(1, 'Autos', 0, 0, 0, 0, 0),
(2, 'Camionetas', 0, 0, 0, 0, 0),
(3, 'Camiones', 0, 0, 0, 0, 0),
(4, 'Volkswagen', 1, 255, 255, 255, 0),
(5, 'Ford', 1, 0, 0, 0, 0),
(8, 'Mercedes Benz', 3, 0, 0, 0, 0),
(11, 'Pepito', 0, 0, 0, 0, 0),
(12, 'jijiji23', 11, 0, 0, 0, 0),
(13, 'Habitaciones', 0, 0, 0, 0, 0),
(14, 'Dormitorios', 13, 0, 0, 0, 0),
(15, 'modelna', 13, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `general`
--

CREATE TABLE IF NOT EXISTS `general` (
  `color_fuente_banner` text NOT NULL,
  `float_logo` text NOT NULL,
  `colorHr` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `general`
--

INSERT INTO `general` (`color_fuente_banner`, `float_logo`, `colorHr`) VALUES
('898989', 'right', 'FF6600');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE IF NOT EXISTS `imagen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modulo` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` text NOT NULL,
  `red` int(11) NOT NULL,
  `green` int(11) NOT NULL,
  `blue` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id`, `modulo`, `titulo`, `descripcion`, `imagen`, `red`, `green`, `blue`) VALUES
(9, 6, 'Titulo', 'Descripcion', './modulos/6/GNOME-Waves-3-orange.png', 255, 1, 2),
(10, 6, 'Blanquito', 'MuNIeco Blanco', './modulos/6/abc.jpg', 255, 255, 225);

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
  `colorHr` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `categoria`, `titulo`, `alineacion`, `anchoTexto`, `anchoImagen`, `altoImagen`, `anchoVideo`, `altoVideo`, `orden`, `texto`, `imagen`, `video`, `colorHr`) VALUES
(1, 4, 'Titulo del modulo', 'left', 100, 100, 95, 1, 1, 2, 'Texto Opcional\r\n\r\nenter\r\n\r\nTexto...', 'modulos/1423158870.jpg', '', ''),
(6, 4, '', '', 0, 0, 0, 0, 0, 0, '', '', '', '');

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