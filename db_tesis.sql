-- MySQL dump 10.13  Distrib 5.5.36, for linux2.6 (i686)
--
-- Host: localhost    Database: tesis
-- ------------------------------------------------------
-- Server version	5.5.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES UTF8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alimentacion`
--

DROP TABLE IF EXISTS `alimentacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alimentacion` (
  `aliId` int(11) NOT NULL,
  `aliNombre` varchar(15) NOT NULL,
  `aliHoraInicio` time NOT NULL,
  `alHoraFin` time NOT NULL,
  `Organizacion_orgId` int(11) NOT NULL,
  PRIMARY KEY (`aliId`),
  KEY `Alimentacion_Organizacion` (`Organizacion_orgId`),
  CONSTRAINT `Alimentacion_Organizacion` FOREIGN KEY (`Organizacion_orgId`) REFERENCES `organizacion` (`orgId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alimentacion`
--

LOCK TABLES `alimentacion` WRITE;
/*!40000 ALTER TABLE `alimentacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `alimentacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargo`
--

DROP TABLE IF EXISTS `cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargo` (
  `car_id` int(11) NOT NULL,
  `car_nombre` varchar(30) NOT NULL,
  `sal_id` int(11) NOT NULL,
  PRIMARY KEY (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo`
--

LOCK TABLES `cargo` WRITE;
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` VALUES ('2713413cee52daf30367d746dfc790ea','192.168.0.20','Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36',1406687828,'');
INSERT INTO `ci_sessions` VALUES ('448ffa42fd4a852428b1a463840b0d9b','127.0.0.1','Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36',1406673749,'');
INSERT INTO `ci_sessions` VALUES ('d6034d4e1d74b8ede538f31a1a3273b8','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_4) AppleWebKit/537.77.4 (KHTML, like Gecko) Version/7.0.5 Safari/537.77.4',1406689479,'');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emphor`
--

DROP TABLE IF EXISTS `emphor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emphor` (
  `Empleado_usuId` int(11) NOT NULL,
  `Horario_horId` int(11) NOT NULL,
  PRIMARY KEY (`Empleado_usuId`,`Horario_horId`),
  KEY `EmpHor_Horario` (`Horario_horId`),
  CONSTRAINT `EmpHor_Empleado` FOREIGN KEY (`Empleado_usuId`) REFERENCES `empleado` (`empId`),
  CONSTRAINT `EmpHor_Horario` FOREIGN KEY (`Horario_horId`) REFERENCES `horariotrabajo` (`horId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emphor`
--

LOCK TABLES `emphor` WRITE;
/*!40000 ALTER TABLE `emphor` DISABLE KEYS */;
/*!40000 ALTER TABLE `emphor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleado` (
  `empId` int(11) NOT NULL,
  `emp_nombre` varchar(60) NOT NULL,
  `emp_apellido` varchar(60) NOT NULL,
  `emp_genero` char(1) NOT NULL,
  `Organizacion_orgId` int(11) NOT NULL,
  `Tipo_idTipo` int(11) NOT NULL,
  `Cargo_carId` int(11) NOT NULL,
  `Jornada_jorId` int(11) NOT NULL,
  `Tarjeta_id` int(11) NOT NULL,
  PRIMARY KEY (`empId`),
  KEY `Empleado_Cargo` (`Cargo_carId`),
  KEY `Empleado_Jornada` (`Jornada_jorId`),
  KEY `Empleado_Organización` (`Organizacion_orgId`),
  KEY `Empleado_Tarjeta` (`Tarjeta_id`),
  KEY `Empleado_Tipo` (`Tipo_idTipo`),
  CONSTRAINT `Empleado_Cargo` FOREIGN KEY (`Cargo_carId`) REFERENCES `cargo` (`car_id`),
  CONSTRAINT `Empleado_Jornada` FOREIGN KEY (`Jornada_jorId`) REFERENCES `jornada` (`jorId`),
  CONSTRAINT `Empleado_Organización` FOREIGN KEY (`Organizacion_orgId`) REFERENCES `organizacion` (`orgId`),
  CONSTRAINT `Empleado_Tarjeta` FOREIGN KEY (`Tarjeta_id`) REFERENCES `tarjeta` (`id`),
  CONSTRAINT `Empleado_Tipo` FOREIGN KEY (`Tipo_idTipo`) REFERENCES `tipo` (`idTipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feriado`
--

DROP TABLE IF EXISTS `feriado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feriado` (
  `ferId` int(11) NOT NULL,
  `ferNombre` int(11) NOT NULL,
  `ferDia` int(11) NOT NULL,
  PRIMARY KEY (`ferId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feriado`
--

LOCK TABLES `feriado` WRITE;
/*!40000 ALTER TABLE `feriado` DISABLE KEYS */;
/*!40000 ALTER TABLE `feriado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horariotrabajo`
--

DROP TABLE IF EXISTS `horariotrabajo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horariotrabajo` (
  `horId` int(11) NOT NULL,
  `horaInicioTrabajo` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `horaFinTrabajo` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`horId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horariotrabajo`
--

LOCK TABLES `horariotrabajo` WRITE;
/*!40000 ALTER TABLE `horariotrabajo` DISABLE KEYS */;
/*!40000 ALTER TABLE `horariotrabajo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jornada`
--

DROP TABLE IF EXISTS `jornada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jornada` (
  `jorId` int(11) NOT NULL,
  `diasTrabajo` int(11) NOT NULL,
  `diasDescanso` int(11) NOT NULL,
  PRIMARY KEY (`jorId`),
  UNIQUE KEY `Jornada_ak_1` (`diasTrabajo`,`diasDescanso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jornada`
--

LOCK TABLES `jornada` WRITE;
/*!40000 ALTER TABLE `jornada` DISABLE KEYS */;
/*!40000 ALTER TABLE `jornada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_utc` varchar(20) NOT NULL,
  `log_ip` varchar(20) NOT NULL,
  `log_navegador` varchar(50) NOT NULL,
  `Usuarios_usu_id` int(11) NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `Usuarios_usu_id` (`Usuarios_usu_id`),
  CONSTRAINT `Logs_Usuarios` FOREIGN KEY (`Usuarios_usu_id`) REFERENCES `usuarios` (`usu_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objetos`
--

DROP TABLE IF EXISTS `objetos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `objetos` (
  `obj_id` int(11) NOT NULL AUTO_INCREMENT,
  `obj_nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`obj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objetos`
--

LOCK TABLES `objetos` WRITE;
/*!40000 ALTER TABLE `objetos` DISABLE KEYS */;
/*!40000 ALTER TABLE `objetos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organizacion`
--

DROP TABLE IF EXISTS `organizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organizacion` (
  `orgId` int(11) NOT NULL,
  `orgNombre` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`orgId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organizacion`
--

LOCK TABLES `organizacion` WRITE;
/*!40000 ALTER TABLE `organizacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `organizacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodosalida`
--

DROP TABLE IF EXISTS `periodosalida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodosalida` (
  `Empleado_usuId` int(11) NOT NULL,
  `TipoSalida_tipId` int(11) NOT NULL,
  PRIMARY KEY (`Empleado_usuId`,`TipoSalida_tipId`),
  KEY `SalidaTomada_TipoSalida` (`TipoSalida_tipId`),
  CONSTRAINT `SalidaTomada_Empleado` FOREIGN KEY (`Empleado_usuId`) REFERENCES `empleado` (`empId`),
  CONSTRAINT `SalidaTomada_TipoSalida` FOREIGN KEY (`TipoSalida_tipId`) REFERENCES `tiposalida` (`tipId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodosalida`
--

LOCK TABLES `periodosalida` WRITE;
/*!40000 ALTER TABLE `periodosalida` DISABLE KEYS */;
/*!40000 ALTER TABLE `periodosalida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos` (
  `rol_id` int(11) NOT NULL,
  `obj_id` int(11) NOT NULL,
  `perm_ver` tinyint(1) NOT NULL,
  PRIMARY KEY (`rol_id`,`obj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proemp`
--

DROP TABLE IF EXISTS `proemp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proemp` (
  `Proyecto_proId` int(11) NOT NULL,
  `Empleado_usuId` int(11) NOT NULL,
  PRIMARY KEY (`Proyecto_proId`,`Empleado_usuId`),
  KEY `ProEmp_Empleado` (`Empleado_usuId`),
  CONSTRAINT `ProEmp_Empleado` FOREIGN KEY (`Empleado_usuId`) REFERENCES `empleado` (`empId`),
  CONSTRAINT `ProEmp_Proyecto` FOREIGN KEY (`Proyecto_proId`) REFERENCES `proyecto` (`proId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proemp`
--

LOCK TABLES `proemp` WRITE;
/*!40000 ALTER TABLE `proemp` DISABLE KEYS */;
/*!40000 ALTER TABLE `proemp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyecto`
--

DROP TABLE IF EXISTS `proyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyecto` (
  `proId` int(11) NOT NULL,
  PRIMARY KEY (`proId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyecto`
--

LOCK TABLES `proyecto` WRITE;
/*!40000 ALTER TABLE `proyecto` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_nombre` varchar(20) NOT NULL,
  `usu_id` int(11) NOT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salario`
--

DROP TABLE IF EXISTS `salario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salario` (
  `sal_id` int(11) NOT NULL,
  `sal_valor` int(11) NOT NULL,
  PRIMARY KEY (`sal_id`),
  KEY `Salario_Empleado` (`sal_valor`),
  CONSTRAINT `Salario_Empleado` FOREIGN KEY (`sal_valor`) REFERENCES `empleado` (`empId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salario`
--

LOCK TABLES `salario` WRITE;
/*!40000 ALTER TABLE `salario` DISABLE KEYS */;
/*!40000 ALTER TABLE `salario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salidaanual`
--

DROP TABLE IF EXISTS `salidaanual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salidaanual` (
  `Empleado_usuId` int(11) NOT NULL,
  `TipoSalida_tipId` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  PRIMARY KEY (`Empleado_usuId`,`TipoSalida_tipId`,`anio`),
  KEY `Salida_TipoSalida` (`TipoSalida_tipId`),
  CONSTRAINT `Salida_Empleado` FOREIGN KEY (`Empleado_usuId`) REFERENCES `empleado` (`empId`),
  CONSTRAINT `Salida_TipoSalida` FOREIGN KEY (`TipoSalida_tipId`) REFERENCES `tiposalida` (`tipId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salidaanual`
--

LOCK TABLES `salidaanual` WRITE;
/*!40000 ALTER TABLE `salidaanual` DISABLE KEYS */;
/*!40000 ALTER TABLE `salidaanual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarjeta`
--

DROP TABLE IF EXISTS `tarjeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tarjeta` (
  `id` int(11) NOT NULL,
  `valor` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Tarjeta_ak_1` (`valor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarjeta`
--

LOCK TABLES `tarjeta` WRITE;
/*!40000 ALTER TABLE `tarjeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `tarjeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo`
--

DROP TABLE IF EXISTS `tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo` (
  `idTipo` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  PRIMARY KEY (`idTipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo`
--

LOCK TABLES `tipo` WRITE;
/*!40000 ALTER TABLE `tipo` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiposalida`
--

DROP TABLE IF EXISTS `tiposalida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tiposalida` (
  `tipId` int(11) NOT NULL,
  PRIMARY KEY (`tipId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiposalida`
--

LOCK TABLES `tiposalida` WRITE;
/*!40000 ALTER TABLE `tiposalida` DISABLE KEYS */;
/*!40000 ALTER TABLE `tiposalida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_email` varchar(30) NOT NULL,
  `usu_clave` varchar(15) NOT NULL,
  `usu_estado` tinyint(1) NOT NULL,
  `usu_utc` int(20) NOT NULL,
  `usu_ip` varchar(20) NOT NULL,
  `usu_navegador` varchar(100) NOT NULL,
  `Empleado_emp_id` int(11) NOT NULL,
  PRIMARY KEY (`usu_id`),
  UNIQUE KEY `usu_email` (`usu_email`),
  KEY `Empleado_emp_id` (`Empleado_emp_id`),
  CONSTRAINT `Usuarios_Empleado` FOREIGN KEY (`Empleado_emp_id`) REFERENCES `empleado` (`empId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-08-06 19:34:33
