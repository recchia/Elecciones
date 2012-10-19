-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-10-2012 a las 23:11:17
-- Versión del servidor: 5.5.24
-- Versión de PHP: 5.3.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `smiami`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Anuncio`
--

CREATE TABLE IF NOT EXISTS `Anuncio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `condado_id` int(11) DEFAULT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `pago_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `edad` smallint(6) NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8486F948DB38439E` (`usuario_id`),
  KEY `IDX_8486F948B547B50A` (`condado_id`),
  KEY `IDX_8486F948E8608214` (`ciudad_id`),
  KEY `IDX_8486F94863FB8380` (`pago_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `Anuncio`
--

INSERT INTO `Anuncio` (`id`, `condado_id`, `ciudad_id`, `pago_id`, `usuario_id`, `nombre`, `edad`, `descripcion`, `email`) VALUES
(5, 1, 1, 1, 2, 'Anastasia', 20, 'fdsfds sdfdsf sdfdsf sdfdsf sdfsdf', 'anastasia@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ciudad`
--

CREATE TABLE IF NOT EXISTS `Ciudad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `condado_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_892A00A8B547B50A` (`condado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `Ciudad`
--

INSERT INTO `Ciudad` (`id`, `condado_id`, `nombre`) VALUES
(1, 1, 'Doral');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Condado`
--

CREATE TABLE IF NOT EXISTS `Condado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `Condado`
--

INSERT INTO `Condado` (`id`, `nombre`) VALUES
(1, 'Miami');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fos_user`
--

CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(2, 'recchia', 'recchia', 'piero.recchia@gmail.com', 'piero.recchia@gmail.com', 1, 'aeinsr4gwtcgskso80gc8gsck8wc4cc', 'g5BM2gF1df/qQOJ4tISpJyFoR+jcY0cPGGAA4DbA7OFMeQlb9Vv0Heiuca6UUmPxpQR+q7Os5d3Oxza6Y8DKEg==', '2012-10-17 16:49:19', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Imagen`
--

CREATE TABLE IF NOT EXISTS `Imagen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anuncio_id` int(11) DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_84B5D785963066FD` (`anuncio_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `Imagen`
--

INSERT INTO `Imagen` (`id`, `anuncio_id`, `path`) VALUES
(1, 5, '507f8966defaa.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pago`
--

CREATE TABLE IF NOT EXISTS `Pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `precio` decimal(20,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `Pago`
--

INSERT INTO `Pago` (`id`, `descripcion`, `precio`) VALUES
(1, '1 Semana', '15.99'),
(2, '2 Semanas', '25.55');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Anuncio`
--
ALTER TABLE `Anuncio`
  ADD CONSTRAINT `FK_8486F94863FB8380` FOREIGN KEY (`pago_id`) REFERENCES `Pago` (`id`),
  ADD CONSTRAINT `FK_8486F948B547B50A` FOREIGN KEY (`condado_id`) REFERENCES `Condado` (`id`),
  ADD CONSTRAINT `FK_8486F948DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_8486F948E8608214` FOREIGN KEY (`ciudad_id`) REFERENCES `Ciudad` (`id`);

--
-- Filtros para la tabla `Ciudad`
--
ALTER TABLE `Ciudad`
  ADD CONSTRAINT `FK_892A00A8B547B50A` FOREIGN KEY (`condado_id`) REFERENCES `Condado` (`id`);

--
-- Filtros para la tabla `Imagen`
--
ALTER TABLE `Imagen`
  ADD CONSTRAINT `FK_84B5D785963066FD` FOREIGN KEY (`anuncio_id`) REFERENCES `Anuncio` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
