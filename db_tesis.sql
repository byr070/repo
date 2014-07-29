-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-07-2014 a las 05:17:18
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `tesis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alimentacion`
--

CREATE TABLE IF NOT EXISTS `Alimentacion` (
  `aliId` int(11) NOT NULL,
  `aliNombre` varchar(15) NOT NULL,
  `aliHoraInicio` time NOT NULL,
  `alHoraFin` time NOT NULL,
  `Organizacion_orgId` int(11) NOT NULL,
  PRIMARY KEY (`aliId`),
  KEY `Alimentacion_Organizacion` (`Organizacion_orgId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cargo`
--

CREATE TABLE IF NOT EXISTS `Cargo` (
  `car_id` int(11) NOT NULL,
  `car_nombre` varchar(30) NOT NULL,
  `sal_id` int(11) NOT NULL,
  PRIMARY KEY (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('2713413cee52daf30367d746dfc790ea', '192.168.0.20', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36', 1406687828, ''),
('d6034d4e1d74b8ede538f31a1a3273b8', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_4) AppleWebKit/537.77.4 (KHTML, like Gecko) Version/7.0.5 Safari/537.77.4', 1406689479, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EmpHor`
--

CREATE TABLE IF NOT EXISTS `EmpHor` (
  `Empleado_usuId` int(11) NOT NULL,
  `Horario_horId` int(11) NOT NULL,
  PRIMARY KEY (`Empleado_usuId`,`Horario_horId`),
  KEY `EmpHor_Horario` (`Horario_horId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Empleado`
--

CREATE TABLE IF NOT EXISTS `Empleado` (
  `empId` int(11) NOT NULL,
  `Organizacion_orgId` int(11) NOT NULL,
  `Tipo_idTipo` int(11) NOT NULL,
  `Cargo_carId` int(11) NOT NULL,
  `empPassword` varchar(20) NOT NULL,
  `empEmail` varchar(30) NOT NULL,
  `empGenero` char(1) NOT NULL,
  `Jornada_jorId` int(11) NOT NULL,
  `Tarjeta_id` int(11) NOT NULL,
  PRIMARY KEY (`empId`),
  KEY `Empleado_Cargo` (`Cargo_carId`),
  KEY `Empleado_Jornada` (`Jornada_jorId`),
  KEY `Empleado_Organización` (`Organizacion_orgId`),
  KEY `Empleado_Tarjeta` (`Tarjeta_id`),
  KEY `Empleado_Tipo` (`Tipo_idTipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Feriado`
--

CREATE TABLE IF NOT EXISTS `Feriado` (
  `ferId` int(11) NOT NULL,
  `ferNombre` int(11) NOT NULL,
  `ferDia` int(11) NOT NULL,
  PRIMARY KEY (`ferId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `HorarioTrabajo`
--

CREATE TABLE IF NOT EXISTS `HorarioTrabajo` (
  `horId` int(11) NOT NULL,
  `horaInicioTrabajo` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `horaFinTrabajo` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`horId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Jornada`
--

CREATE TABLE IF NOT EXISTS `Jornada` (
  `jorId` int(11) NOT NULL,
  `diasTrabajo` int(11) NOT NULL,
  `diasDescanso` int(11) NOT NULL,
  PRIMARY KEY (`jorId`),
  UNIQUE KEY `Jornada_ak_1` (`diasTrabajo`,`diasDescanso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Objetos`
--

CREATE TABLE IF NOT EXISTS `Objetos` (
  `obj_id` int(11) NOT NULL AUTO_INCREMENT,
  `obj_nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`obj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Organizacion`
--

CREATE TABLE IF NOT EXISTS `Organizacion` (
  `orgId` int(11) NOT NULL,
  `orgNombre` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`orgId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PeriodoSalida`
--

CREATE TABLE IF NOT EXISTS `PeriodoSalida` (
  `Empleado_usuId` int(11) NOT NULL,
  `TipoSalida_tipId` int(11) NOT NULL,
  PRIMARY KEY (`Empleado_usuId`,`TipoSalida_tipId`),
  KEY `SalidaTomada_TipoSalida` (`TipoSalida_tipId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Permisos`
--

CREATE TABLE IF NOT EXISTS `Permisos` (
  `rol_id` int(11) NOT NULL,
  `obj_id` int(11) NOT NULL,
  `perm_ver` tinyint(1) NOT NULL,
  PRIMARY KEY (`rol_id`,`obj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ProEmp`
--

CREATE TABLE IF NOT EXISTS `ProEmp` (
  `Proyecto_proId` int(11) NOT NULL,
  `Empleado_usuId` int(11) NOT NULL,
  PRIMARY KEY (`Proyecto_proId`,`Empleado_usuId`),
  KEY `ProEmp_Empleado` (`Empleado_usuId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Proyecto`
--

CREATE TABLE IF NOT EXISTS `Proyecto` (
  `proId` int(11) NOT NULL,
  PRIMARY KEY (`proId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Roles`
--

CREATE TABLE IF NOT EXISTS `Roles` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_nombre` varchar(20) NOT NULL,
  `usu_id` int(11) NOT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Salario`
--

CREATE TABLE IF NOT EXISTS `Salario` (
  `sal_id` int(11) NOT NULL,
  `sal_valor` int(11) NOT NULL,
  PRIMARY KEY (`sal_id`),
  KEY `Salario_Empleado` (`sal_valor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SalidaAnual`
--

CREATE TABLE IF NOT EXISTS `SalidaAnual` (
  `Empleado_usuId` int(11) NOT NULL,
  `TipoSalida_tipId` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  PRIMARY KEY (`Empleado_usuId`,`TipoSalida_tipId`,`anio`),
  KEY `Salida_TipoSalida` (`TipoSalida_tipId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tarjeta`
--

CREATE TABLE IF NOT EXISTS `Tarjeta` (
  `id` int(11) NOT NULL,
  `valor` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Tarjeta_ak_1` (`valor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipo`
--

CREATE TABLE IF NOT EXISTS `Tipo` (
  `idTipo` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  PRIMARY KEY (`idTipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipoSalida`
--

CREATE TABLE IF NOT EXISTS `TipoSalida` (
  `tipId` int(11) NOT NULL,
  PRIMARY KEY (`tipId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE IF NOT EXISTS `Usuarios` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_usuario` varchar(30) NOT NULL,
  `usu_clave` varchar(15) NOT NULL,
  `usu_estado` tinyint(1) NOT NULL,
  `emp_id` int(11) NOT NULL,
  PRIMARY KEY (`usu_id`),
  UNIQUE KEY `usu_usuario` (`usu_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Alimentacion`
--
ALTER TABLE `Alimentacion`
  ADD CONSTRAINT `Alimentacion_Organizacion` FOREIGN KEY (`Organizacion_orgId`) REFERENCES `Organizacion` (`orgId`);

--
-- Filtros para la tabla `EmpHor`
--
ALTER TABLE `EmpHor`
  ADD CONSTRAINT `EmpHor_Horario` FOREIGN KEY (`Horario_horId`) REFERENCES `HorarioTrabajo` (`horId`),
  ADD CONSTRAINT `EmpHor_Empleado` FOREIGN KEY (`Empleado_usuId`) REFERENCES `Empleado` (`empId`);

--
-- Filtros para la tabla `Empleado`
--
ALTER TABLE `Empleado`
  ADD CONSTRAINT `Empleado_Tipo` FOREIGN KEY (`Tipo_idTipo`) REFERENCES `Tipo` (`idTipo`),
  ADD CONSTRAINT `Empleado_Cargo` FOREIGN KEY (`Cargo_carId`) REFERENCES `Cargo` (`car_id`),
  ADD CONSTRAINT `Empleado_Jornada` FOREIGN KEY (`Jornada_jorId`) REFERENCES `Jornada` (`jorId`),
  ADD CONSTRAINT `Empleado_Organización` FOREIGN KEY (`Organizacion_orgId`) REFERENCES `Organizacion` (`orgId`),
  ADD CONSTRAINT `Empleado_Tarjeta` FOREIGN KEY (`Tarjeta_id`) REFERENCES `Tarjeta` (`id`);

--
-- Filtros para la tabla `PeriodoSalida`
--
ALTER TABLE `PeriodoSalida`
  ADD CONSTRAINT `SalidaTomada_TipoSalida` FOREIGN KEY (`TipoSalida_tipId`) REFERENCES `TipoSalida` (`tipId`),
  ADD CONSTRAINT `SalidaTomada_Empleado` FOREIGN KEY (`Empleado_usuId`) REFERENCES `Empleado` (`empId`);

--
-- Filtros para la tabla `ProEmp`
--
ALTER TABLE `ProEmp`
  ADD CONSTRAINT `ProEmp_Proyecto` FOREIGN KEY (`Proyecto_proId`) REFERENCES `Proyecto` (`proId`),
  ADD CONSTRAINT `ProEmp_Empleado` FOREIGN KEY (`Empleado_usuId`) REFERENCES `Empleado` (`empId`);

--
-- Filtros para la tabla `Salario`
--
ALTER TABLE `Salario`
  ADD CONSTRAINT `Salario_Empleado` FOREIGN KEY (`sal_valor`) REFERENCES `Empleado` (`empId`);

--
-- Filtros para la tabla `SalidaAnual`
--
ALTER TABLE `SalidaAnual`
  ADD CONSTRAINT `Salida_TipoSalida` FOREIGN KEY (`TipoSalida_tipId`) REFERENCES `TipoSalida` (`tipId`),
  ADD CONSTRAINT `Salida_Empleado` FOREIGN KEY (`Empleado_usuId`) REFERENCES `Empleado` (`empId`);
