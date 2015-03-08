-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-03-2015 a las 14:51:17
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
  `rgb` text NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `padre`, `rgb`, `orden`) VALUES
(1, 'Autos', 0, '0', 2),
(4, 'Volkswagen', 1, '0,0,0,0.7', 0),
(5, 'Ford', 1, '0', 0),
(8, 'Mercedes Benz', 3, '0', 0),
(12, 'jijiji23', 11, '0', 0),
(14, 'Dormitorios', 13, '0', 0),
(15, 'modelna', 13, '0', 0),
(18, 'Dormitorios', 0, '0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `footer`
--

CREATE TABLE IF NOT EXISTS `footer` (
  `texto1` text NOT NULL,
  `texto2` text NOT NULL,
  `texto3` text NOT NULL,
  `link1` text NOT NULL,
  `link2` text NOT NULL,
  `link3` text NOT NULL,
  `background1` text NOT NULL,
  `background2` text NOT NULL,
  `background3` text NOT NULL,
  `newsletter` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `footer`
--

INSERT INTO `footer` (`texto1`, `texto2`, `texto3`, `link1`, `link2`, `link3`, `background1`, `background2`, `background3`, `newsletter`) VALUES
('texto1', 'texto2', 'texto3', 'link1', 'link2', 'link3', '', '', '', 'newsletter XD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `general`
--

CREATE TABLE IF NOT EXISTS `general` (
  `color_fuente_banner` text NOT NULL,
  `float_logo` text NOT NULL,
  `colorBotonHover` text NOT NULL,
  `colorHr` text NOT NULL,
  `facebook` text NOT NULL,
  `twitter` text NOT NULL,
  `google` text NOT NULL,
  `fontFace` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `general`
--

INSERT INTO `general` (`color_fuente_banner`, `float_logo`, `colorBotonHover`, `colorHr`, `facebook`, `twitter`, `google`, `fontFace`) VALUES
('000000', 'left', '100,0,0,0.6', 'ffa200', 'facebook.com', 'twitter.com', 'google.com', 'TrajanPro-Regular_1.otf');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id`, `modulo`, `titulo`, `descripcion`, `imagen`, `red`, `green`, `blue`) VALUES
(10, 6, 'Blanquito', 'MuNIeco Blanco', './modulos/6/abc.jpg', 255, 255, 225),
(11, 6, 'El Noble', 'Empanadas caseras', './modulos/6/1146594_549634695086168_698302897_n.jpg', 255, 255, 255);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `categoria`, `titulo`, `alineacion`, `anchoTexto`, `anchoImagen`, `altoImagen`, `anchoVideo`, `altoVideo`, `orden`, `texto`, `imagen`, `video`, `colorHr`) VALUES
(1, 4, 'MAURIS AC RISUS NEQUE, UT PULVINAR RISUS', 'left', 20, 79, 30, 1, 1, 2, 'Pendisse blandit ligula turpis, ac convallis risus fermentum non. Duis vestibulum quis quam vel accumsan. Nunc a vulputate lectus. Vestibulum eleifend nisl sed massa sagittis vestibulum. Vestibulum pretium blandit tellus, sodales volutpat sapien varius vel. Phasellus tristique cursus erat, a placerat tellus laoreet eget. Blandit ligula turpis, ac convallis risus fermentum non. Duis vestibulum quis.', 'modulos/1425573979.jpg', '', 'b2b2b2'),
(6, 4, '', '', 0, 0, 0, 0, 0, 1, '', '', '', ''),
(7, 4, 'THIS IS AUDIO POST', 'right', 48, 50, 30, 1, 1, 3, 'Pendisse blandit ligula turpis, ac convallis risus fermentum non. Duis vestibulum quis quam vel accumsan. Nunc a vulputate lectus. Vestibulum eleifend nisl sed massa sagittis vestibulum. Vestibulum pretium blandit tellus, sodales volutpat sapien varius vel. Phasellus tristique cursus erat, a placerat tellus laoreet eget. Blandit ligula turpis, ac convallis risus fermentum non. Duis vestibulum quis.\r\n......................................................................................................\r\n\r\n<b>Gracias !!!</b>', 'modulos/1425577202.jpg', '', 'b2b2b2'),
(8, 4, '', '', 0, 0, 0, 0, 0, 0, '', '', '', ''),
(9, 4, 'Hola', 'left', 50, 45, 50, 1, 1, 4, 'Lalalala', 'modulos/1425577760.jpg', '', 'b2b2b2');

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