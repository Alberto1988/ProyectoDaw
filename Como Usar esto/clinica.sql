-- phpMyAdmin SQL Dump
-- version 3.5.0
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-12-2012 a las 15:49:14
-- Versión del servidor: 5.5.22
-- Versión de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `clinica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermeros`
--

CREATE TABLE IF NOT EXISTS `enfermeros` (
  `id_enfermero` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cedula` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `nombre_enf` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `apellido_enf1` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `apellido_enf2` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `fecha_enfermero` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `especialidad` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `usu_enfermero` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `pass_enfermero` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_enfermero`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `enfermeros`
--

INSERT INTO `enfermeros` (`id_enfermero`, `cedula`, `nombre_enf`, `apellido_enf1`, `apellido_enf2`, `fecha_enfermero`, `especialidad`, `usu_enfermero`, `pass_enfermero`) VALUES
(1, 'KJOF10GH', 'Juan', 'Torro', 'Jimenez', '12/05/1985', 'vacunacion', 'Juan2', 'Juan1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE IF NOT EXISTS `medicos` (
  `id_medico` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cedula` varchar(10) NOT NULL,
  `nombre_medico` varchar(200) NOT NULL,
  `apellido_medico1` varchar(200) NOT NULL,
  `apellido_medico2` varchar(200) NOT NULL,
  `fecha_medico` varchar(20) NOT NULL,
  `especialidad` varchar(100) NOT NULL,
  `usu_medico` varchar(30) NOT NULL,
  `pass_medico` varchar(30) NOT NULL,
  PRIMARY KEY (`id_medico`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`id_medico`, `cedula`, `nombre_medico`, `apellido_medico1`, `apellido_medico2`, `fecha_medico`, `especialidad`, `usu_medico`, `pass_medico`) VALUES
(1, 'KJOF10GH', 'Juan', 'Torro', 'Jimenez', '12/05/1985', 'vacunacion', 'Juan2', 'Juan1'),
(2, 'QD654123', 'Dianey', 'Martinez', 'Lopez', '22/05/1975', 'Traumatologia', 'Dia2', 'Mar1'),
(3, 'asas', 'Jesus', 'Majadhonda', 'Mais', '26/07/1984', 'Fisioterapeuta', 'asdasd', 'asdasd'),
(20, 'ggg', 'Ataulfo', 'Rodriguez', 'asdasd', '12/17/2012', 'adas', 'asdsd', 'asdad'),
(21, 'jghj', 'kjljkl', 'trhrh', 'hdfhdfh', '12/17/2012', 'sfsdf', 'fsdfdf', 'rete'),
(22, 'retert', 'ertet', 'gfdgfg', 'gdfgdg', '12/24/2012', 'dgdfg', 'gdfhh', 'jhj'),
(24, 'dadas', 'saddad', 'sdfsdf', 'hrthtrh', '12/13/2012', 'dsfsdac', 'sgdgdfg', 'gdfgdfgdg'),
(25, 'asdasd', 'asdasd', 'fafef', 'thrtrh', '12/19/2012', 'sdfsdf', 'jytjtyj', 'jtyjtyj');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE IF NOT EXISTS `pacientes` (
  `id_paciente` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `clave` varchar(10) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `apellido_paterno` varchar(80) NOT NULL,
  `apellido_materno` varchar(80) NOT NULL,
  `sexo` varchar(2) NOT NULL,
  `domicilio` text NOT NULL,
  `fecha_pa` text NOT NULL,
  `fecha_consulta` varchar(10) NOT NULL,
  `diagnostico` text NOT NULL,
  `usu_paciente` varchar(30) NOT NULL,
  `pass_paciente` varchar(30) NOT NULL,
  PRIMARY KEY (`id_paciente`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `clave`, `nombre`, `apellido_paterno`, `apellido_materno`, `sexo`, `domicilio`, `fecha_pa`, `fecha_consulta`, `diagnostico`, `usu_paciente`, `pass_paciente`) VALUES
(1, 'JULL2010AB', 'Juan', 'Lopez', 'Lopez', 'M', 'av. del lago #240', '12/04/2012', '12/04/2012', 'DIARREA CRÓNICA', 'Juan', 'Juan1'),
(2, 'OLPP2010AB', 'Olivia', 'Perez', 'Perez', 'F', 'Av. las rosas sin numero.', '', '', '', 'Olivia', 'Olivia1'),
(11, 'dad', 'wdfwef', 'ewfwef', 'qwfwef', 'F', 'wefwef', '12/03/2012', '', '', 'wefewf', 'ewfwf'),
(13, 'ergerg', 'egerg', 'ergerg', 'fsdfgerg', 'M', 'ergergerg', '12/10/2012', '', '', 'ergerg', 'gergerg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` bigint(22) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `tipo_usuario` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `password`, `tipo_usuario`) VALUES
(1, 'Alberto1', 'Miras1', 'A');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
