-- phpMyAdmin SQL Dump
-- version 3.0.0-rc2
-- http://www.phpmyadmin.net
--
-- Servidor: 192.168.0.59
-- Tiempo de generación: 09-03-2015 a las 00:34:48
-- Versión del servidor: 5.5.34
-- Versión de PHP: 5.3.20

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de datos: `symbelmyne`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `general`
--

CREATE TABLE IF NOT EXISTS `general` (
  `color_fuente_banner` text NOT NULL,
  `float_logo` text NOT NULL,
  `colorBotonHover` text NOT NULL,
  `colorHr` text NOT NULL,
  `colorPDF` text NOT NULL,
  `facebook` text NOT NULL,
  `twitter` text NOT NULL,
  `youtube` text NOT NULL,
  `fontFace` text NOT NULL,
  `colorSubMenu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `general`
--

INSERT INTO `general` (`color_fuente_banner`, `float_logo`, `colorBotonHover`, `colorHr`, `colorPDF`, `facebook`, `twitter`, `youtube`, `fontFace`, `colorSubMenu`) VALUES
('b6b6b6', 'left', '255,0,200,0.100', 'ff008a', 'FFFFFF', 'https://www.facebook.com/SYMBELFACE?fref=ts', '', 'https://www.youtube.com/results?search_query=symbelmyne', 'sansation_light.woff', '0,0,0,0.70');
