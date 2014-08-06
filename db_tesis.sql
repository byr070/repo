-- MySQL dump 10.13  Distrib 5.6.16, for osx10.6 (x86_64)
--
-- Host: localhost    Database: tesis
-- ------------------------------------------------------
-- Server version	5.6.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Alimentacion`
--

DROP TABLE IF EXISTS `Alimentacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Alimentacion` (
  `aliId` int(11) NOT NULL,
  `aliNombre` varchar(15) NOT NULL,
  `aliHoraInicio` time NOT NULL,
  `alHoraFin` time NOT NULL,
  `Organizacion_orgId` int(11) NOT NULL,
  PRIMARY KEY (`aliId`),
  KEY `Alimentacion_Organizacion` (`Organizacion_orgId`),
  CONSTRAINT `Alimentacion_Organizacion` FOREIGN KEY (`Organizacion_orgId`) REFERENCES `Organizacion` (`orgId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Alimentacion`
--

LOCK TABLES `Alimentacion` WRITE;
/*!40000 ALTER TABLE `Alimentacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `Alimentacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Cargo`
--

DROP TABLE IF EXISTS `Cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Cargo` (
  `car_id` int(11) NOT NULL,
  `car_nombre` varchar(30) NOT NULL,
  `sal_id` int(11) NOT NULL,
  PRIMARY KEY (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cargo`
--

LOCK TABLES `Cargo` WRITE;
/*!40000 ALTER TABLE `Cargo` DISABLE KEYS */;
/*!40000 ALTER TABLE `Cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EmpHor`
--

DROP TABLE IF EXISTS `EmpHor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EmpHor` (
  `Empleado_usuId` int(11) NOT NULL,
  `Horario_horId` int(11) NOT NULL,
  PRIMARY KEY (`Empleado_usuId`,`Horario_horId`),
  KEY `EmpHor_Horario` (`Horario_horId`),
  CONSTRAINT `EmpHor_Empleado` FOREIGN KEY (`Empleado_usuId`) REFERENCES `Empleado` (`empId`),
  CONSTRAINT `EmpHor_Horario` FOREIGN KEY (`Horario_horId`) REFERENCES `HorarioTrabajo` (`horId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EmpHor`
--

LOCK TABLES `EmpHor` WRITE;
/*!40000 ALTER TABLE `EmpHor` DISABLE KEYS */;
/*!40000 ALTER TABLE `EmpHor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Empleado`
--

DROP TABLE IF EXISTS `Empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Empleado` (
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
  KEY `Empleado_Tipo` (`Tipo_idTipo`),
  CONSTRAINT `Empleado_Cargo` FOREIGN KEY (`Cargo_carId`) REFERENCES `Cargo` (`car_id`),
  CONSTRAINT `Empleado_Jornada` FOREIGN KEY (`Jornada_jorId`) REFERENCES `Jornada` (`jorId`),
  CONSTRAINT `Empleado_Organización` FOREIGN KEY (`Organizacion_orgId`) REFERENCES `Organizacion` (`orgId`),
  CONSTRAINT `Empleado_Tarjeta` FOREIGN KEY (`Tarjeta_id`) REFERENCES `Tarjeta` (`id`),
  CONSTRAINT `Empleado_Tipo` FOREIGN KEY (`Tipo_idTipo`) REFERENCES `Tipo` (`idTipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Empleado`
--

LOCK TABLES `Empleado` WRITE;
/*!40000 ALTER TABLE `Empleado` DISABLE KEYS */;
/*!40000 ALTER TABLE `Empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Feriado`
--

DROP TABLE IF EXISTS `Feriado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Feriado` (
  `ferId` int(11) NOT NULL,
  `ferNombre` int(11) NOT NULL,
  `ferDia` int(11) NOT NULL,
  PRIMARY KEY (`ferId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Feriado`
--

LOCK TABLES `Feriado` WRITE;
/*!40000 ALTER TABLE `Feriado` DISABLE KEYS */;
/*!40000 ALTER TABLE `Feriado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HorarioTrabajo`
--

DROP TABLE IF EXISTS `HorarioTrabajo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HorarioTrabajo` (
  `horId` int(11) NOT NULL,
  `horaInicioTrabajo` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `horaFinTrabajo` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`horId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HorarioTrabajo`
--

LOCK TABLES `HorarioTrabajo` WRITE;
/*!40000 ALTER TABLE `HorarioTrabajo` DISABLE KEYS */;
/*!40000 ALTER TABLE `HorarioTrabajo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Jornada`
--

DROP TABLE IF EXISTS `Jornada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Jornada` (
  `jorId` int(11) NOT NULL,
  `diasTrabajo` int(11) NOT NULL,
  `diasDescanso` int(11) NOT NULL,
  PRIMARY KEY (`jorId`),
  UNIQUE KEY `Jornada_ak_1` (`diasTrabajo`,`diasDescanso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Jornada`
--

LOCK TABLES `Jornada` WRITE;
/*!40000 ALTER TABLE `Jornada` DISABLE KEYS */;
/*!40000 ALTER TABLE `Jornada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Objetos`
--

DROP TABLE IF EXISTS `Objetos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Objetos` (
  `obj_id` int(11) NOT NULL AUTO_INCREMENT,
  `obj_nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`obj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Objetos`
--

LOCK TABLES `Objetos` WRITE;
/*!40000 ALTER TABLE `Objetos` DISABLE KEYS */;
/*!40000 ALTER TABLE `Objetos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Organizacion`
--

DROP TABLE IF EXISTS `Organizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Organizacion` (
  `orgId` int(11) NOT NULL,
  `orgNombre` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`orgId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Organizacion`
--

LOCK TABLES `Organizacion` WRITE;
/*!40000 ALTER TABLE `Organizacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `Organizacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PeriodoSalida`
--

DROP TABLE IF EXISTS `PeriodoSalida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PeriodoSalida` (
  `Empleado_usuId` int(11) NOT NULL,
  `TipoSalida_tipId` int(11) NOT NULL,
  PRIMARY KEY (`Empleado_usuId`,`TipoSalida_tipId`),
  KEY `SalidaTomada_TipoSalida` (`TipoSalida_tipId`),
  CONSTRAINT `SalidaTomada_Empleado` FOREIGN KEY (`Empleado_usuId`) REFERENCES `Empleado` (`empId`),
  CONSTRAINT `SalidaTomada_TipoSalida` FOREIGN KEY (`TipoSalida_tipId`) REFERENCES `TipoSalida` (`tipId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PeriodoSalida`
--

LOCK TABLES `PeriodoSalida` WRITE;
/*!40000 ALTER TABLE `PeriodoSalida` DISABLE KEYS */;
/*!40000 ALTER TABLE `PeriodoSalida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Permisos`
--

DROP TABLE IF EXISTS `Permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Permisos` (
  `rol_id` int(11) NOT NULL,
  `obj_id` int(11) NOT NULL,
  `perm_ver` tinyint(1) NOT NULL,
  PRIMARY KEY (`rol_id`,`obj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Permisos`
--

LOCK TABLES `Permisos` WRITE;
/*!40000 ALTER TABLE `Permisos` DISABLE KEYS */;
/*!40000 ALTER TABLE `Permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProEmp`
--

DROP TABLE IF EXISTS `ProEmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProEmp` (
  `Proyecto_proId` int(11) NOT NULL,
  `Empleado_usuId` int(11) NOT NULL,
  PRIMARY KEY (`Proyecto_proId`,`Empleado_usuId`),
  KEY `ProEmp_Empleado` (`Empleado_usuId`),
  CONSTRAINT `ProEmp_Empleado` FOREIGN KEY (`Empleado_usuId`) REFERENCES `Empleado` (`empId`),
  CONSTRAINT `ProEmp_Proyecto` FOREIGN KEY (`Proyecto_proId`) REFERENCES `Proyecto` (`proId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProEmp`
--

LOCK TABLES `ProEmp` WRITE;
/*!40000 ALTER TABLE `ProEmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `ProEmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Proyecto`
--

DROP TABLE IF EXISTS `Proyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Proyecto` (
  `proId` int(11) NOT NULL,
  PRIMARY KEY (`proId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Proyecto`
--

LOCK TABLES `Proyecto` WRITE;
/*!40000 ALTER TABLE `Proyecto` DISABLE KEYS */;
/*!40000 ALTER TABLE `Proyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Roles`
--

DROP TABLE IF EXISTS `Roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Roles` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_nombre` varchar(20) NOT NULL,
  `usu_id` int(11) NOT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Roles`
--

LOCK TABLES `Roles` WRITE;
/*!40000 ALTER TABLE `Roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `Roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Salario`
--

DROP TABLE IF EXISTS `Salario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Salario` (
  `sal_id` int(11) NOT NULL,
  `sal_valor` int(11) NOT NULL,
  PRIMARY KEY (`sal_id`),
  KEY `Salario_Empleado` (`sal_valor`),
  CONSTRAINT `Salario_Empleado` FOREIGN KEY (`sal_valor`) REFERENCES `Empleado` (`empId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Salario`
--

LOCK TABLES `Salario` WRITE;
/*!40000 ALTER TABLE `Salario` DISABLE KEYS */;
/*!40000 ALTER TABLE `Salario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SalidaAnual`
--

DROP TABLE IF EXISTS `SalidaAnual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SalidaAnual` (
  `Empleado_usuId` int(11) NOT NULL,
  `TipoSalida_tipId` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  PRIMARY KEY (`Empleado_usuId`,`TipoSalida_tipId`,`anio`),
  KEY `Salida_TipoSalida` (`TipoSalida_tipId`),
  CONSTRAINT `Salida_Empleado` FOREIGN KEY (`Empleado_usuId`) REFERENCES `Empleado` (`empId`),
  CONSTRAINT `Salida_TipoSalida` FOREIGN KEY (`TipoSalida_tipId`) REFERENCES `TipoSalida` (`tipId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SalidaAnual`
--

LOCK TABLES `SalidaAnual` WRITE;
/*!40000 ALTER TABLE `SalidaAnual` DISABLE KEYS */;
/*!40000 ALTER TABLE `SalidaAnual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tarjeta`
--

DROP TABLE IF EXISTS `Tarjeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Tarjeta` (
  `id` int(11) NOT NULL,
  `valor` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Tarjeta_ak_1` (`valor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tarjeta`
--

LOCK TABLES `Tarjeta` WRITE;
/*!40000 ALTER TABLE `Tarjeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `Tarjeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tipo`
--

DROP TABLE IF EXISTS `Tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Tipo` (
  `idTipo` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  PRIMARY KEY (`idTipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tipo`
--

LOCK TABLES `Tipo` WRITE;
/*!40000 ALTER TABLE `Tipo` DISABLE KEYS */;
/*!40000 ALTER TABLE `Tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TipoSalida`
--

DROP TABLE IF EXISTS `TipoSalida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TipoSalida` (
  `tipId` int(11) NOT NULL,
  PRIMARY KEY (`tipId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TipoSalida`
--

LOCK TABLES `TipoSalida` WRITE;
/*!40000 ALTER TABLE `TipoSalida` DISABLE KEYS */;
/*!40000 ALTER TABLE `TipoSalida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuarios`
--

DROP TABLE IF EXISTS `Usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuarios` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_email` varchar(30) NOT NULL,
  `usu_clave` varchar(32) NOT NULL,
  PRIMARY KEY (`usu_id`),
  UNIQUE KEY `usu_usuario` (`usu_email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuarios`
--

LOCK TABLES `Usuarios` WRITE;
/*!40000 ALTER TABLE `Usuarios` DISABLE KEYS */;
INSERT INTO `Usuarios` VALUES (1,'daniel','aa47f8215c6f30a0dcdb2a36a9f4168e');
INSERT INTO `Usuarios` VALUES (2,'byron','8720070ac8f94bbbff5a347eed656925');
/*!40000 ALTER TABLE `Usuarios` ENABLE KEYS */;
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
INSERT INTO `ci_sessions` VALUES ('1e1da35784d699ed08a67158ba21b667','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_4) AppleWebKit/537.77.4 (KHTML, like Gecko) Version/7.0.5 Safari/537.77.4',1407368226,'a:3:{s:9:\"user_data\";s:0:\"\";s:6:\"e-mail\";s:6:\"daniel\";s:12:\"is_logged_in\";b:1;}');
INSERT INTO `ci_sessions` VALUES ('5353f241e240fc42843b092a1c544035','192.168.0.9','Mozilla/5.0 (X11; Linux i686; rv:27.0) Gecko/20100101 Firefox/27.0',1407367190,'');
INSERT INTO `ci_sessions` VALUES ('af2faf3e24b9637b6a3f9108394c60a6','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_4) AppleWebKit/537.77.4 (KHTML, like Gecko) Version/7.0.5 Safari/537.77.4',1407364704,'');
INSERT INTO `ci_sessions` VALUES ('f65e948550caef6bcddeafec1daaa105','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_4) AppleWebKit/537.77.4 (KHTML, like Gecko) Version/7.0.5 Safari/537.77.4',1407368063,'a:2:{s:6:\"e-mail\";s:5:\"byron\";s:12:\"is_logged_in\";b:1;}');
INSERT INTO `ci_sessions` VALUES ('f71b82e31712424c3175d1c47a8c6da2','::1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_4) AppleWebKit/537.77.4 (KHTML, like Gecko) Version/7.0.5 Safari/537.77.4',1407364747,'');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-08-06 18:46:54
