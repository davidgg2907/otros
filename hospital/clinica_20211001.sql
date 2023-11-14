-- MariaDB dump 10.17  Distrib 10.4.14-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: clinica
-- ------------------------------------------------------
-- Server version	10.4.14-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `asistentes`
--

DROP TABLE IF EXISTS `asistentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asistentes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `rfc` varchar(15) DEFAULT NULL,
  `curp` varchar(50) DEFAULT NULL,
  `honorarios` decimal(20,6) DEFAULT NULL,
  `domicilio` varchar(200) DEFAULT NULL,
  `fotografia` varchar(150) DEFAULT NULL,
  `doctores` varchar(50) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asistentes`
--

LOCK TABLES `asistentes` WRITE;
/*!40000 ALTER TABLE `asistentes` DISABLE KEYS */;
INSERT INTO `asistentes` VALUES (1,'Usuario Enfermera Demo','7412589635','','',0.000000,'','','',1),(2,'Marisol Navarro Martinez','','','',0.000000,'',NULL,'1,2',1);
/*!40000 ALTER TABLE `asistentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `citas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(10) NOT NULL,
  `consultorio_id` int(10) DEFAULT NULL,
  `medico_id` int(10) DEFAULT NULL,
  `enfermera_id` int(10) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time DEFAULT NULL,
  `comentarios` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` VALUES (1,1,2,1,1,'2020-09-10','12:00:00','blablabla',0),(2,4,0,2,0,'2020-09-28','04:00:00','',0),(3,3,1,1,0,'2020-09-29','07:30:00','',0),(4,4,1,2,1,'2020-10-06','03:00:00','blablabla',0),(5,4,0,1,0,'2020-10-20','07:00:00','Comentario de prueba para nuevo rol de doctor',0),(6,4,0,3,0,'2020-10-27','12:30:00','',0),(7,4,0,3,0,'2020-12-11','05:30:00','',0),(8,4,0,2,0,'2020-12-22','09:00:00','',0),(9,1,0,2,0,'2020-12-24','04:00:00','',0),(10,2,0,3,0,'2021-01-21','02:00:00','',0),(11,1,0,2,0,'2021-02-04','02:00:00','',0),(12,3,0,2,0,'2021-02-25','06:30:00','',0),(13,1,0,1,0,'2021-05-04','01:30:00','',0),(14,9,0,4,0,'2021-08-06','03:30:00','',0),(15,10,0,4,0,'2021-08-13','10:00:00','',0);
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `estado` varchar(150) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `clave` varchar(150) NOT NULL,
  `valor` longtext NOT NULL,
  `serializado` int(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` VALUES (1,'','config','empresa_nombre','AIzaSyBa6o5XiRIAx4ng68PCAsKNKKwFXQnW2uM',0,1),(2,'','config','empresa_direccion','San francisco 12 la herradura, Cordoba veracruz 94470',0,1),(3,'','config','empresa_logo','Posicion origen en el mapa',0,1),(4,'','config','empresa_rfc','Posicion origen en el mapa',0,1);
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultas`
--

DROP TABLE IF EXISTS `consultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cita_id` int(10) DEFAULT NULL,
  `paciente_id` int(10) NOT NULL,
  `doctor_id` int(10) NOT NULL,
  `enfermera_id` int(10) DEFAULT NULL,
  `signos_id` int(10) DEFAULT NULL,
  `fc` varchar(50) DEFAULT NULL,
  `fr` varchar(50) DEFAULT NULL,
  `temperatura` varchar(50) DEFAULT NULL,
  `peso` varchar(50) DEFAULT NULL,
  `talla` varchar(50) DEFAULT NULL,
  `ta1` varchar(50) DEFAULT NULL,
  `ta2` varchar(50) DEFAULT NULL,
  `sato2` varchar(20) DEFAULT NULL,
  `costo` decimal(20,6) NOT NULL,
  `fecha` date DEFAULT NULL,
  `razon_visita` longtext DEFAULT NULL,
  `diagnostico` longtext DEFAULT NULL,
  `recomendaciones` longtext DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultas`
--

LOCK TABLES `consultas` WRITE;
/*!40000 ALTER TABLE `consultas` DISABLE KEYS */;
INSERT INTO `consultas` VALUES (1,0,1,1,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.000000,'2020-09-25','<p>Dolor de cabeza&nbsp;&nbsp; agudo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br></p>','<p>Cefalea por estres<br></p>','<p>reposo y relajacion, ejercicios anti estres y actividad fisica<br></p>',1),(2,0,2,2,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.000000,'2020-09-27','<p>Dolor estomacal Agudo&nbsp; <br></p>','<p>Gastritis<br></p>','',1),(3,2,4,2,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.000000,'2020-09-27','<p>Esto es una prueba de consultas desde una cita&nbsp;&nbsp;&nbsp;&nbsp;<br></p>','<p>Veremos lo que pasa al guardar para determinar el diagnostivo<br></p>','<p>si no hay error ya la salvamos<br></p>',1),(4,2,4,2,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.000000,'2020-09-27','<p>Esto es una prueba de consultas desde una cita&nbsp;&nbsp;&nbsp;&nbsp;<br></p>','<p>Veremos lo que pasa al guardar para determinar el diagnostivo<br></p>','<p>si no hay error ya la salvamos<br></p>',1),(5,0,4,1,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.000000,'2020-10-10','<p>Dolro articular, nauceas, vomito, dolor estomacal&nbsp;&nbsp;&nbsp;&nbsp;<br></p>','<p>Infeccion en vias urinarias, infeccion estomacal severa<br></p>','<p>reposo absoluto durante 7 dias<br></p>',1),(6,0,4,2,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.000000,'2020-10-10','<p>Cita de revision de rutina&nbsp;&nbsp;&nbsp;&nbsp;<br></p>','<p>el paciente sigue progresando aun le cuesta caminar por el dolor articular<br></p>','<p>seguir en reposo<br></p>',1),(7,0,4,1,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.000000,'2020-10-10','<p>Cita de revision<br></p>','<p>Cliente con nauseas aun dolor estomacar ya no existe asi como dolor articular<br></p>','',1),(8,0,4,2,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,145.000000,'2020-10-22','<p>blablabla&nbsp;&nbsp;&nbsp;&nbsp;<br></p>','<p>blebleble<br></p>','<p>bliblibli<br></p>',1),(9,0,1,3,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,450.000000,'2020-10-24','<p>motivo de visita del paciente<br></p>','<p>diagnostico de ejemplo <br></p>','<p>te comiendo no hacer tonterias para que no te enfermes<br></p>',1),(11,0,1,3,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,450.000000,'2020-10-24','<p>motivo de visita del paciente<br></p>','<p>diagnostico de ejemplo <br></p>','<p>te comiendo no hacer tonterias para que no te enfermes<br></p>',1),(12,0,2,3,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,450.000000,'2020-10-24','prueba de almacenamiento por motivo de visita en asistente<br>','Diagnostico asignado desde el asistente<br>','',1),(13,0,3,2,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,150.000000,'2020-10-24','<p>Dolor en el molar incisivo derecho<br></p>','<p>Muela dañada, 4 molar sobre saliendo y afectando otros molares y mandibula<br></p>','<p>reposo absoluto durante 3 dias</p><p>Regresar en 7 dias para extracciona o una vez que el molar este desinflamado no exista dolor en el mismo<br></p>',1),(14,0,3,1,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,850.000000,'2020-10-24','<p>motio de ejemplo para receta<br></p>','<p>Diagnostico de ejemplo para receta<br></p>','<p>recomendaciones princiaples no cagarla<br></p>',1),(15,0,2,3,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,450.000000,'2020-10-24','<p>motivo de visita<br></p>','<p>Diagnostico principal de la consulta<br></p>','',1),(16,0,2,3,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,450.000000,'2020-11-23','<p>Motivo de visita desconocido<br></p>','<p>Esquisofrenico y paranoico<br></p>','',1),(17,0,2,3,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,100.000000,'2020-11-23','<p>blablabla<br></p>','<p>blebleble<br></p>','',1),(18,0,2,1,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,850.000000,'2020-12-07','Seguimiento clinico<br>','<p>diagnostico clinico sin receta<br></p>','',1),(19,0,4,3,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,450.000000,'2020-12-07','<p>Seguimiento clinico con receta<br></p>','<p>Diagnostico clinico con receta<br></p>','',1),(20,0,2,2,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,380.000000,'2020-12-23','<p>ejemplo<br></p>','<p>ejemplo de nuevo pago<br></p>','',1),(21,14,9,4,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.000000,'2021-08-06','<p>ejemplo de consulta</p>','<p>diagnostico de consulta</p>','',0),(22,14,9,4,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,50.000000,'2021-08-06','<p>seguimineto&nbsp;</p>','<p>diagnostico</p>','',0),(23,0,10,4,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,50.000000,'2021-08-06','<p>ACUDE POR DOLOR ABDOMINAL&nbsp;</p>','<p>GEPI</p>','',1),(24,0,12,4,0,0,'78','20','36.5','50','1.58','0','0','98',350.000000,'2021-09-22','<p>masculino de 35 años acxude a reevaloracion por dolor abdominal de 5 dias de evolucion.</p><p>actualmente alerta despierto orientado en sus tres esferas, palidez e piel tegumentos +, abdomen depreible globoso a expensas de paniculo adiposo.</p>','<p>SX COLON IRRITABLE</p>','',1),(25,0,13,4,0,0,'65','0','0','0','0','0','0','0',0.000000,'2021-09-22','<p><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">DVVCFFFFF HOLA COMO</font></font></p>','<font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">GRAMOI</font></font>','',1),(26,0,13,4,0,0,'65','0','0','0','0','0','0','0',0.000000,'2021-09-22','<p>HHOALDS&nbsp;</p>','<p>GEPI&nbsp;</p>','',1),(27,0,13,4,0,0,'65','0','0','0','0','0','0','0',0.000000,'2021-09-22','<p>DGFHJ D</p>','<p>JKDHJKBF FV</p>','',1),(28,0,13,4,0,0,'65','0','0','0','0','0','0','0',0.000000,'2021-09-22','<p>FEMENINO DE 75 AÑOS&nbsp;</p>','<p>DIABETES</p>','',1),(29,0,12,4,0,0,'120/80','15','36','85','1.90','15','20','93',500.000000,'2021-09-25','<p>sfsdfs<br></p>','<p>seguir<br></p>','',1),(30,0,15,5,0,0,'11','11','36','40','1.90','80','70','90',500.000000,'2021-09-28','<p>sdfdfxdfdfdfd<br></p>','<p>fvdfdfdgdfgfgdfgdf<br></p>','',1);
/*!40000 ALTER TABLE `consultas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultorios`
--

DROP TABLE IF EXISTS `consultorios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultorios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `numero` varchar(10) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `medico_id` int(10) DEFAULT NULL,
  `enfermera_id` int(10) DEFAULT NULL,
  `dia_laboral` varchar(50) DEFAULT NULL,
  `hora_inicio` varchar(10) NOT NULL,
  `hora_fin` varchar(10) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultorios`
--

LOCK TABLES `consultorios` WRITE;
/*!40000 ALTER TABLE `consultorios` DISABLE KEYS */;
INSERT INTO `consultorios` VALUES (1,'123','Consultorio Puerta Cafe',1,0,'Lunes','08:00 AM','09:00 PM',1),(2,'03','Nefro',1,1,'Miercoles','9:00','7:30',1),(3,'04','Angeologia',1,1,'Martes','1:00','9:00',1);
/*!40000 ALTER TABLE `consultorios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuartos`
--

DROP TABLE IF EXISTS `cuartos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuartos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `numero` varchar(10) NOT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `amenidades` varchar(150) DEFAULT NULL,
  `equipo` varchar(150) DEFAULT NULL,
  `costo_dia` decimal(20,6) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuartos`
--

LOCK TABLES `cuartos` WRITE;
/*!40000 ALTER TABLE `cuartos` DISABLE KEYS */;
INSERT INTO `cuartos` VALUES (1,'01','Habitacion Estandar HP01','Sala, comedor, cunero','Oxigeno\r\nCama Matrimonial clinica',650.000000,2),(2,'A23','Suite Ejecutiva','Refrigerador de Snaks\r\nSala de espera \r\nMesa de centro\r\nClima','Oxigeno\r\nConsola de Signos Vitales',1550.230000,2),(3,'02','Basica Sencilla','Mesa de centro\r\nSillon de Visitas','Ninguno\r\nCama Clinica',500.000000,1);
/*!40000 ALTER TABLE `cuartos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `impuesto` decimal(10,6) DEFAULT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `colonia` varchar(150) DEFAULT NULL,
  `estado` varchar(150) DEFAULT NULL,
  `ciudad` varchar(150) DEFAULT NULL,
  `cp` varchar(10) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `hospedaje` varchar(250) NOT NULL,
  `hospedaje_iva` int(1) NOT NULL,
  `twitter` varchar(150) DEFAULT NULL,
  `facebook` varchar(150) DEFAULT NULL,
  `instagram` varchar(150) DEFAULT NULL,
  `logotipo` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (1,'Sociedad Medica Ixtlahuaca S.A de C.V.',16.000000,'Calle Gral. Vicente Guerrero #207, San Joaquin','','Estado de Mexico','Ixtlahuaca','50740','admin@app.com','7122830652 y 7122834616','','Servicio de Habitacion, hospitalizacion',1,'twitter.com','facebook.com','instagram.com','1628097705_cemi.jpg',1);
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enfermeria`
--

DROP TABLE IF EXISTS `enfermeria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enfermeria` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `rfc` varchar(15) DEFAULT NULL,
  `cedula` varchar(50) DEFAULT NULL,
  `curp` varchar(50) DEFAULT NULL,
  `honorarios` decimal(20,6) DEFAULT NULL,
  `domicilio` varchar(200) DEFAULT NULL,
  `fotografia` varchar(150) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enfermeria`
--

LOCK TABLES `enfermeria` WRITE;
/*!40000 ALTER TABLE `enfermeria` DISABLE KEYS */;
INSERT INTO `enfermeria` VALUES (1,'Usuario Enfermera Demo','7412589635','','ASD74859','',0.000000,'Calle san bartolo 4505 ciudad de mexico','1601124298_2.jpg',1);
/*!40000 ALTER TABLE `enfermeria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farmacia`
--

DROP TABLE IF EXISTS `farmacia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farmacia` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cuarto_id` int(10) DEFAULT NULL,
  `enfermera_id` int(10) NOT NULL,
  `medico_id` int(10) DEFAULT NULL,
  `asistente_id` int(10) NOT NULL,
  `solicitante` varchar(250) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `fecha_surtido` datetime DEFAULT NULL,
  `solicitado` longtext DEFAULT NULL,
  `comentarios` longtext DEFAULT NULL,
  `status` int(1) NOT NULL COMMENT '1: solicitada, 2: surtida',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farmacia`
--

LOCK TABLES `farmacia` WRITE;
/*!40000 ALTER TABLE `farmacia` DISABLE KEYS */;
INSERT INTO `farmacia` VALUES (1,2,0,0,0,'Administrador','2020-12-27 17:29:09',NULL,'<p>4 de Pimer insumo </p><p>3 de segundo insumo</p><p>10 de tercer insumo</p><p>8 de algo mas<br></p>',NULL,2),(2,2,0,0,0,'Administrador','2020-12-29 13:01:56',NULL,'<p>primer requerimineto</p><p>segundo requerimineto</p><p>tercer requrimiento</p><p>cuarto requerimiento</p><p><br></p>',NULL,1);
/*!40000 ALTER TABLE `farmacia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farmacia_detalle`
--

DROP TABLE IF EXISTS `farmacia_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farmacia_detalle` (
  `id` int(10) NOT NULL,
  `farmacia_id` int(10) NOT NULL,
  `insumo` varchar(250) DEFAULT NULL,
  `cantidad` int(5) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farmacia_detalle`
--

LOCK TABLES `farmacia_detalle` WRITE;
/*!40000 ALTER TABLE `farmacia_detalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `farmacia_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hospitalizacion`
--

DROP TABLE IF EXISTS `hospitalizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hospitalizacion` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `medico_id` int(10) NOT NULL,
  `paciente_id` int(10) DEFAULT NULL,
  `cuarto_id` int(10) NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `fecha_alta` datetime DEFAULT NULL,
  `motivo` longtext DEFAULT NULL,
  `subtotal` decimal(20,6) NOT NULL,
  `iva` decimal(20,6) NOT NULL,
  `total` decimal(20,6) NOT NULL,
  `pagado` decimal(20,6) NOT NULL,
  `pendiente` decimal(20,6) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hospitalizacion`
--

LOCK TABLES `hospitalizacion` WRITE;
/*!40000 ALTER TABLE `hospitalizacion` DISABLE KEYS */;
INSERT INTO `hospitalizacion` VALUES (1,3,2,1,'2020-12-20 22:44:51',NULL,'<p>Bla bla bla bla bla<br></p>',1200.000000,112.000000,1312.000000,9106.000000,-7794.000000,0),(2,3,4,3,'2020-12-23 22:46:30',NULL,'<p><br></p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p><p><br></p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p><p><br></p><p><br></p>',2500.000000,320.000000,2820.000000,2240.000000,580.000000,2),(3,1,2,1,'2020-12-29 12:05:21',NULL,'<p>blablabla<br></p>',25350.000000,4056.000000,29406.000000,29406.000000,0.000000,2),(4,2,2,2,'2021-02-11 21:43:06',NULL,'<p>blablabla<br></p>',1550.230000,248.040000,1798.270000,0.000000,1798.270000,0),(5,2,1,3,'2021-02-11 22:55:37',NULL,'<p>blablabla<br></p>',500.000000,80.000000,580.000000,0.000000,580.000000,0),(6,1,2,3,'2021-03-27 08:35:57',NULL,'<p>esto es un prueba de servicios<br></p>',2000.000000,320.000000,2320.000000,0.000000,2320.000000,0),(7,1,2,3,'2021-01-04 12:31:32',NULL,'<p>blablabla<br></p>',133500.000000,21360.000000,154860.000000,49300.000000,105560.000000,1);
/*!40000 ALTER TABLE `hospitalizacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hospitalizacion_servicios`
--

DROP TABLE IF EXISTS `hospitalizacion_servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hospitalizacion_servicios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `hospitalizacion_id` int(10) NOT NULL,
  `servicio_id` int(10) DEFAULT NULL,
  `pago_id` int(10) DEFAULT NULL,
  `fecha_servicio` date DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `cantidad` int(10) DEFAULT NULL,
  `precio` decimal(20,6) DEFAULT NULL,
  `iva` decimal(20,6) DEFAULT NULL,
  `importe` decimal(20,6) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hospitalizacion_servicios`
--

LOCK TABLES `hospitalizacion_servicios` WRITE;
/*!40000 ALTER TABLE `hospitalizacion_servicios` DISABLE KEYS */;
INSERT INTO `hospitalizacion_servicios` VALUES (1,1,NULL,NULL,'2020-12-20','Servicio de Habitacion, hospitalizacion',53,650.000000,5512.000000,39962.000000,1),(2,1,1,2,'2020-12-20','Primer servicio de Ejemplo',1,1500.000000,240.000000,1740.000000,2),(3,1,2,NULL,'2020-12-21','Segundo Servicio de ejemplo sin iva',1,500.000000,0.000000,500.000000,1),(4,2,NULL,NULL,'2020-12-23','Servicio de Habitacion, hospitalizacion',1,500.000000,80.000000,580.000000,1),(5,2,1,3,'2020-12-23','Primer servicio de Ejemplo',1,1500.000000,240.000000,1740.000000,2),(6,2,2,3,'2020-12-23','Segundo Servicio de ejemplo sin iva',1,500.000000,0.000000,500.000000,2),(7,1,1,4,'2020-12-27','Primer servicio de Ejemplo',1,1500.000000,240.000000,1740.000000,2),(8,1,0,4,'2020-12-27','Servicio Manual definido',1,4850.000000,776.000000,5626.000000,2),(9,3,NULL,5,'2020-12-29','Servicio de Habitacion, hospitalizacion',39,650.000000,4056.000000,29406.000000,2),(10,4,NULL,NULL,'2021-02-11','Servicio de Habitacion, hospitalizacion',1,1550.230000,248.040000,1798.270000,1),(11,5,NULL,NULL,'2021-02-11','Servicio de Habitacion, hospitalizacion',1,500.000000,80.000000,580.000000,1),(12,6,NULL,NULL,'2021-03-27','Servicio de Habitacion, hospitalizacion',4,500.000000,320.000000,2320.000000,1),(13,1,0,NULL,'2021-03-27','Ejemplo de captura manual para urgencias',2,350.000000,112.000000,812.000000,1),(14,1,4,NULL,'2021-03-27','Oxigeno en lata',1,500.000000,0.000000,500.000000,1),(15,7,NULL,11,'2021-03-31','Servicio de Habitacion, hospitalizacion',267,500.000000,21360.000000,154860.000000,2);
/*!40000 ALTER TABLE `hospitalizacion_servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insumos`
--

DROP TABLE IF EXISTS `insumos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `insumos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `iva` int(1) DEFAULT NULL,
  `costo` decimal(20,6) DEFAULT NULL,
  `precio` decimal(20,6) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insumos`
--

LOCK TABLES `insumos` WRITE;
/*!40000 ALTER TABLE `insumos` DISABLE KEYS */;
/*!40000 ALTER TABLE `insumos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laboratorio`
--

DROP TABLE IF EXISTS `laboratorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laboratorio` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `orden_id` int(10) NOT NULL,
  `paciente_id` int(10) NOT NULL,
  `medico_id` int(10) NOT NULL,
  `enfermera_id` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `diagnostico` longtext DEFAULT NULL,
  `archivo` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laboratorio`
--

LOCK TABLES `laboratorio` WRITE;
/*!40000 ALTER TABLE `laboratorio` DISABLE KEYS */;
INSERT INTO `laboratorio` VALUES (1,0,2,1,0,'2020-10-02','Analisis de Ejemplo','<p>Esto es una prueba de diagnostico de analisis clinico saludos<br></p>','1601878152_Captura de pantalla de 2020-10-04 16-38-51.png',1),(2,0,4,1,0,'2020-10-06','Analisis de prueba','<p>Diagnoticado sin ningun resultado negarivo para esta operacion<br></p>',NULL,1),(3,0,4,2,0,'2020-10-06','Segunda prueba','<p>Sin diagnostico hay que revisar de nueva cuenta <br></p>','1602382633_cdbf08ee-af76-4437-ae45-fe94f07424a0.pdf',1),(4,0,1,3,0,'2020-10-25','ejemplo','<p>diagnostico equivocado&nbsp;&nbsp;&nbsp;&nbsp;<br></p>','1603345863_1600088669359.remmina-2020-10-6-3:11:57.780838.png',1);
/*!40000 ALTER TABLE `laboratorio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicamentos`
--

DROP TABLE IF EXISTS `medicamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicamentos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `comercial` varchar(150) NOT NULL,
  `generico` varchar(150) DEFAULT NULL,
  `activo` varchar(150) DEFAULT NULL,
  `componentes` varchar(250) DEFAULT NULL,
  `farmaceutica` varchar(150) DEFAULT NULL,
  `cantidad` int(10) DEFAULT NULL,
  `costo` decimal(20,6) DEFAULT NULL,
  `precio` decimal(20,6) DEFAULT NULL,
  `caducidad` date DEFAULT NULL,
  `efectos` varchar(250) DEFAULT NULL,
  `recomendaciones` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicamentos`
--

LOCK TABLES `medicamentos` WRITE;
/*!40000 ALTER TABLE `medicamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `medicamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicos`
--

DROP TABLE IF EXISTS `medicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `especialidad` varchar(150) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `rfc` varchar(15) DEFAULT NULL,
  `cedula` varchar(50) DEFAULT NULL,
  `curp` varchar(50) DEFAULT NULL,
  `honorarios` decimal(20,6) DEFAULT NULL,
  `domicilio` varchar(200) DEFAULT NULL,
  `fotografia` varchar(150) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicos`
--

LOCK TABLES `medicos` WRITE;
/*!40000 ALTER TABLE `medicos` DISABLE KEYS */;
INSERT INTO `medicos` VALUES (1,'Doctor Demo','Medicina General','7412589635','XXXX999999X9X','123456878','',850.000000,'','1601122328_d1.jpg',0),(2,'Doctora de ejemplo','Neurologia','14785236987','','','',380.000000,'','1601245349_4.jpg',0),(3,'Sergio Garduño Gomez','Neurologia','5537430480','','','',450.000000,'',NULL,0),(4,'Jose Alberto Vivero Garay','medico cirujano','7223896974','','11816611','',0.000000,'',NULL,1),(5,'miguel','general','7122110329','','3453455345','',0.000000,'conocido',NULL,1);
/*!40000 ALTER TABLE `medicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulos`
--

DROP TABLE IF EXISTS `modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(5) DEFAULT NULL,
  `padre_id` int(10) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `url` varchar(150) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `orden` int(10) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulos`
--

LOCK TABLES `modulos` WRITE;
/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
INSERT INTO `modulos` VALUES (1,NULL,0,'Doctores','admin/medicos','fa-user-md',1,1),(2,NULL,0,'Pacientes','admin/pacientes','fa-users',2,1),(3,NULL,0,'Enfermeras','admin/enfermeria','fa-female',3,1),(4,NULL,0,'Consultorios','admin/consultorios','fa-heartbeat',5,1),(5,NULL,0,'Habitaciones','admin/cuartos','fa-building',6,1),(6,NULL,0,'Farmacia','admin/farmacia','fa-medkit',7,1),(7,NULL,0,'Servicios','admin/servicios','fa-suitcase',8,1),(8,NULL,0,'Citas','admin/citas','fa-calendar',9,1),(9,NULL,0,'Hospitalizacion','admin/hospitalizacion','fa-bed',12,1),(10,NULL,0,'Laboratorio','admin/laboratorio','fa-flask',14,1),(11,NULL,0,'Consulta','admin/consultas','fa-stethoscope',11,1),(12,NULL,0,'Recetas','admin/recetas','fa-file-pdf-o',15,1),(13,NULL,0,'Roles y Permisos','admin/roles','fa-sitemap',17,1),(14,NULL,0,'Usuarios','admin/users','fa-key',18,1),(15,NULL,0,'Asistentes','admin/asistentes','fa-user-secret',4,1),(16,NULL,0,'Pagos','admin/pagos','fa-credit-card',10,1),(17,NULL,0,'Configuracion','admin/empresas','fa-cogs',16,1),(18,NULL,7,'Hospitalizacion','admin/servicios/?scope=1','fa-bed',1,1),(19,NULL,7,'Urgencias','admin/servicios/?scope=2','fa-ambulance',1,1),(20,NULL,0,'Urgencias','admin/urgencias','fa-ambulance',13,1);
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notas`
--

DROP TABLE IF EXISTS `notas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `medico_id` int(10) NOT NULL,
  `paciente_id` int(10) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `tipo` varchar(3) DEFAULT NULL,
  `nota_medica` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notas`
--

LOCK TABLES `notas` WRITE;
/*!40000 ALTER TABLE `notas` DISABLE KEYS */;
INSERT INTO `notas` VALUES (2,1,7,'2021-03-07','13:04:43','1','<p>examen de laboratorio de ejemplo por nota a paciente de ejemplo esto es solo una prueba y nada mas<br></p>',1),(3,1,7,'2021-03-07','13:06:20','1','<p>examen de laboratorio de ejemplo por nota a paciente de ejemplo esto es solo una prueba y nada mas<br></p>',1),(4,2,7,'2021-03-07','13:17:05','2','<p>Estudio clinico de ejemplo<br></p>',1),(5,4,10,'2021-08-06','13:30:52','3','<p>REALIZAR QS 32 BH TP&nbsp;</p>',1);
/*!40000 ALTER TABLE `notas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordenes`
--

DROP TABLE IF EXISTS `ordenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordenes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(1) NOT NULL COMMENT 'H: Hospitalizacion, L:Laboratorios',
  `medico_id` int(10) NOT NULL,
  `paciente_id` int(10) NOT NULL,
  `fecha_solicitud` date DEFAULT NULL,
  `fecha_aplicacion` date DEFAULT NULL,
  `comentarios` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordenes`
--

LOCK TABLES `ordenes` WRITE;
/*!40000 ALTER TABLE `ordenes` DISABLE KEYS */;
/*!40000 ALTER TABLE `ordenes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pacientes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `domicilio` varchar(250) DEFAULT NULL,
  `tsangre` varchar(10) DEFAULT NULL,
  `sexo` varchar(1) DEFAULT NULL,
  `nacimiento` date DEFAULT NULL,
  `alergias` longtext DEFAULT NULL,
  `hereditarias` longtext DEFAULT NULL,
  `cirugias` longtext DEFAULT NULL,
  `vicios` longtext DEFAULT NULL,
  `diagnostico` longtext DEFAULT NULL,
  `fc` varchar(50) DEFAULT NULL,
  `fr` varchar(50) DEFAULT NULL,
  `temperatura` varchar(50) DEFAULT NULL,
  `peso` varchar(50) DEFAULT NULL,
  `talla` varchar(50) DEFAULT NULL,
  `ta1` varchar(50) DEFAULT NULL,
  `ta2` varchar(50) DEFAULT NULL,
  `sato2` varchar(50) DEFAULT NULL,
  `fotografia` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes`
--

LOCK TABLES `pacientes` WRITE;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
INSERT INTO `pacientes` VALUES (1,'Jair Luna','','7412589632','','','F',NULL,'','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(2,'Santiago Chavez','','8225874874','','','M',NULL,'','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1601179225_1.jpg',1),(3,'Arturo Amatista','','447845745','','','M',NULL,'','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(4,'David Garduño Gomez','5537430480','5537430480','Cordoba Veracruz','B-','M','1990-07-19','<p>alergico a la penicilina<br></p>','<p>demencia cenil en familiares de 3ra edad<br></p>','<p>de la rodilla a los 13 años&nbsp;&nbsp;&nbsp;&nbsp;<br></p>','<p>tabco</p><p>alcohol</p><p>a la marihuana cuando tenia 20 años<br></p>','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1601179283_5.jpg',1),(5,'Marisol Navarro Martinez','','2711450273','','','',NULL,'','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(6,'Nuevo paciente de ejemplo','5537490480','5537430480','desconocido','o+','M','1984-07-29','<p>tiene varios padecimientos patologicos<br></p>','<p>tiene varios padecimientos hereditarios&nbsp;&nbsp; <br></p>','tien un padecimiento actual muy muy muy raro<br>','no le duele nada en el cuerpo no hay nada visible<br>','esta loco el david<br>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1601179225_1.jpg',1),(7,'Paciente limpio','','7412589635','','','',NULL,'','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(8,'Paciente de ejemplo','','55345698785','','','',NULL,'','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(9,'miguel','7122110329','7122110329','conocido','o+','M','1979-02-01','<p>dfgdfgdfgf</p>','<p>cfgfgfg</p>','<p>fdgfgfg</p>','<p>dfggdfgd</p>','<p>ddfgdfgf</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(10,'ROQUE RAMIREZ MARTINEZ','7122110329','7122110329','IXTLAHUACA','o+','M',NULL,'<p>HAS DE 15 AÑOS DE EVOLUCION TARATADA CON CAPTOPRIL 25 MG C 24 H Y LOSARTAN 50 MG C 12 H</p><p>PO HACE 5 AÑOS DE FX TIBIA Y PERONE IZQ </p>','<p>PADRE Y MADRE FINADOS POR HAS </p>','<p>HOYT CON DELIRIUM. ALTERACION DEL ESTADO DE CONCIENCIA, POLIURIA, POLIDIPSIA, POLIFAGIA</p>','<p>RIUM FACIE ALGICA, HIPERVEMTILADO, PALIDEZ PIEL Y TEGUMNETOS</p>','<p>PB CETOACIDOSIS DIABETICA</p><p>PB ERC</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(11,'ALEJANDRA LEON ROMERO','5563348356','5563348356','FRAC SAN JOAQUIN MZA 4 CAS 1 IXTLAHUACA CENTRO','o+','F','1969-12-31','<p>NEGADOS&nbsp;</p>','<p>NEEGADAS</p>','<p>HACE 1 SEMANA CON CONJUNTIVITIS OJO DEERECHO&nbsp;</p>','','<p>CHALAZION&nbsp;</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(12,'miguel','7122110329','7122110329','conocido','o+','M','1979-02-01','<p><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">nortea</font></font></p>','<p><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">norteda</font></font></p>','<p><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">nortea</font></font></p>','<font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">nortea nada</font></font>','nada',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(13,'BRAYAN PRUEBA','7122110329','7122110329','','o+','M','1969-12-31','<p>HIPERTENSO DE 10 AÑOS DE EVOLUCION EN TX CON LOSARTAN 50 MG&nbsp;</p><p>DIABETICO 5 AÑOS CON METFOREMINA 500 CADA 8 HORAS&nbsp;</p>','<p>MADRE FINADA PÓR DM T2&nbsp;</p><p>PADRE VIVO APARENTEMENTE SANO&nbsp;</p>','<p>INICA AYER CON MALESTAR GENRAL DIARREA NAUSEA Y VOMITO&nbsp;</p>','<p>ABDOMEN GLOBOD DISTENDIDO REBOTE NEGATIVO&nbsp;</p>','<p>GEPI&nbsp;</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(14,'mike','7122110329','7122110329','conocido','o+','M','2019-07-02','<p>dfgdfgdf<br></p>','<p>dlkjdfklgjdf<br></p>','<p>dfgdfgf<br></p>','<p>dfgdfgdf<br></p>','<p>dfdfgdf<br></p>','120/80','15','36','85','1.90','120','80','96',NULL,1),(15,'juanito','7122110329','7122110329','conocido','o+','M','2020-06-09','<p>drfdfdf<br></p>','<p>dfgdfdfgdf<br></p>','<p>dfdfdf<br></p>','<p>sdfdfd<br></p>','<p>sdfsfdsfds<br></p>','28','89','36','85','1.90','120','80','96',NULL,1);
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes_asignacion`
--

DROP TABLE IF EXISTS `pacientes_asignacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pacientes_asignacion` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `medico_id` int(10) DEFAULT NULL,
  `paciente_id` int(10) DEFAULT NULL,
  `fecha_asignacion` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes_asignacion`
--

LOCK TABLES `pacientes_asignacion` WRITE;
/*!40000 ALTER TABLE `pacientes_asignacion` DISABLE KEYS */;
INSERT INTO `pacientes_asignacion` VALUES (1,1,1,'2020-10-05 00:00:00',1),(2,1,5,'2020-10-11 20:03:29',1),(3,1,4,'2020-10-11 20:03:29',1),(4,4,9,'2021-08-06 12:04:29',1),(5,4,10,'2021-08-06 13:29:22',1),(6,4,11,'2021-08-11 13:38:43',1),(7,4,12,'2021-09-22 10:21:45',1),(8,4,13,'2021-09-22 10:38:16',1),(9,5,15,'2021-09-28 11:58:15',1);
/*!40000 ALTER TABLE `pacientes_asignacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(10) DEFAULT NULL,
  `consulta_id` int(10) DEFAULT NULL,
  `hospitalizacion_id` int(10) DEFAULT NULL,
  `urgencia_id` int(10) NOT NULL,
  `medico_id` int(10) NOT NULL,
  `enfermera_id` int(10) DEFAULT NULL,
  `servicios` varchar(100) DEFAULT NULL,
  `fecha_apertura` date DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `monto` decimal(20,6) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
INSERT INTO `pagos` VALUES (1,2,20,0,0,2,NULL,NULL,'2020-12-23','2021-06-19',120.000000,2),(2,2,0,1,0,3,0,'2','2020-12-23','2020-12-23',1740.000000,2),(3,4,0,2,0,3,0,'5,6','2020-12-23','2020-12-23',2240.000000,2),(4,2,0,1,0,3,0,'7,8','2020-12-27','2020-12-27',7366.000000,2),(5,2,0,3,0,1,0,'9','2021-02-06','2021-02-06',29406.000000,2),(6,NULL,0,0,1,2,0,'2,3','2021-03-27','2021-03-27',1022.000000,2),(7,NULL,0,0,1,2,0,'2,3','2021-03-27','2021-03-27',1022.000000,2),(8,NULL,0,0,1,2,0,'1,4','2021-03-27','2021-03-27',928.000000,2),(9,NULL,0,0,2,2,0,'6','2021-03-31','2021-03-31',1000.000000,2),(10,0,0,0,2,2,0,'5','2021-03-31','2021-03-31',500.000000,2),(11,2,0,7,0,1,0,'15','2021-03-31','2021-03-31',49300.000000,2),(12,9,22,0,0,4,NULL,NULL,'2021-08-06',NULL,50.000000,1),(13,10,23,0,0,4,NULL,NULL,'2021-08-06',NULL,50.000000,1),(14,12,24,0,0,4,NULL,NULL,'2021-09-22',NULL,350.000000,1),(15,12,29,0,0,4,NULL,NULL,'2021-09-25',NULL,500.000000,1),(16,15,30,0,0,5,NULL,NULL,'2021-09-28',NULL,500.000000,1);
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal`
--

DROP TABLE IF EXISTS `personal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` int(1) NOT NULL COMMENT '1: Basicos, 2: Recepcion',
  `nombre` varchar(150) NOT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `rfc` varchar(15) DEFAULT NULL,
  `cedula` varchar(50) DEFAULT NULL,
  `curp` varchar(50) DEFAULT NULL,
  `honorarios` decimal(20,6) DEFAULT NULL,
  `domicilio` varchar(200) DEFAULT NULL,
  `fotografia` varchar(150) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal`
--

LOCK TABLES `personal` WRITE;
/*!40000 ALTER TABLE `personal` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `scope` int(1) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `precio` decimal(20,6) NOT NULL,
  `iva` int(1) NOT NULL,
  `valor_iva` decimal(20,6) NOT NULL,
  `precio_neto` decimal(20,6) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,1,'Primer servicio de Ejemplo',1500.000000,1,240.000000,1740.000000,1),(2,1,'Segundo Servicio de ejemplo sin iva',500.000000,0,0.000000,500.000000,1),(3,1,'Tercer ejemplo con iva',1870.230000,1,299.240000,2169.470000,1),(4,2,'Oxigeno en lata',500.000000,0,0.000000,500.000000,1);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recetas`
--

DROP TABLE IF EXISTS `recetas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recetas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(10) NOT NULL,
  `medico_id` int(10) NOT NULL,
  `consulta_id` int(10) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `medicamentos` longtext DEFAULT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recetas`
--

LOCK TABLES `recetas` WRITE;
/*!40000 ALTER TABLE `recetas` DISABLE KEYS */;
INSERT INTO `recetas` VALUES (1,1,1,NULL,'2020-09-27 00:00:00','<p>Ibuprofeno de 1 u, 1 cada 6 horas</p><p>Aspirna protec 1 cada 24 horas permanentemente</p><p>Losartan de 50mb 1 cada 12 horas<br></p>',1),(2,1,2,NULL,'2020-10-05 00:00:00','<p>blablabla<br></p>',1),(3,4,1,NULL,'2020-10-10 00:00:00','<p>Omeprasol 1 diaria de por vida</p><p>Acido acetil salicilico 1 diaria de por vida<br></p>',1),(4,4,1,NULL,'2020-10-10 00:00:00','<p>Pravastatina de 10 mg, 1 cada 8 horas por 30 dias</p><p>Loratadina de 500 1 diaria por 3 dias<br></p>',1),(5,3,2,NULL,'2020-10-11 00:00:00','<p>Receta de jeemplo emitida por la asistente</p>',1),(6,2,3,NULL,'2020-10-22 00:00:00','<p>Receta de ejemplo con dibujitos<br></p>',1),(7,2,3,15,'2020-10-24 00:00:00','<p>este medicamento fue prescrito desde la consulta<br></p>',1),(8,4,3,0,'2020-10-24 00:00:00','<p>Este medicamento fue prescrito desde el formulario de recetas<br></p>',1),(9,2,3,16,'2020-11-23 00:00:00','<p>una buena chinga para que se le quite lo loco<br></p>',1),(10,2,3,17,'2020-11-23 00:00:00','<p>bla bla bla</p><p>ble ble ble</p><p>bli bli bli<br></p>',1),(11,4,3,19,'2020-12-07 00:00:00','<p>Medicamento 1 cada 8 horas</p><p>Medicamento 2 cada 24 horas</p><p>Medicamento 3 una unica aplicacion<br></p>',1),(12,9,4,22,'2021-08-06 00:00:00','<p>medicamento 1</p><p>medicamento 2</p><p>medicamento 3</p>',1),(13,10,4,23,'2021-08-06 00:00:00','<p>1. NSAGBHS</p><p>2. DSGS</p><p>3FDGF</p>',1),(14,12,4,24,'2021-09-22 00:00:00','<p>1. LIBERTRIM SII 75/200 MG&nbsp;</p><p>TOMAR 1 DIARIO PÓR 1 MES&nbsp;</p><p>2. BUTILHCINA 20 MG INY&nbsp;</p><p>APLICAR DOSIS UNICA&nbsp;</p>',1),(15,13,4,26,'2021-09-22 00:00:00','<p>GAGSD&nbsp;</p><p>JAJHS&nbsp;</p><p>JDH&nbsp;</p>',1),(16,13,4,27,'2021-09-22 00:00:00','<p>JHBSJH DCBVUYHVGB&nbsp;</p>',1),(17,13,4,28,'2021-09-22 00:00:00','<p>PARACETAMOL&nbsp;</p>',1),(18,12,4,29,'2021-09-25 00:00:00','<p>flsdñdflñdfldñ<br></p>',1),(19,14,4,0,'2021-09-28 00:00:00','<p>dfdgdfgldfgdñfgdf<br></p>',1),(20,14,4,0,'2021-09-28 00:00:00','<p>fdfdfdggdfggdfgdf<br></p>',1),(21,15,5,30,'2021-09-28 00:00:00','<p>paracetamol<br></p>',1);
/*!40000 ALTER TABLE `recetas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recetas_detalle`
--

DROP TABLE IF EXISTS `recetas_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recetas_detalle` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `receta_id` int(10) NOT NULL,
  `medicamento_id` int(10) NOT NULL,
  `dosificacion` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recetas_detalle`
--

LOCK TABLES `recetas_detalle` WRITE;
/*!40000 ALTER TABLE `recetas_detalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `recetas_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol_detalle`
--

DROP TABLE IF EXISTS `rol_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol_detalle` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rol_id` int(10) NOT NULL,
  `modulo_id` int(10) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol_detalle`
--

LOCK TABLES `rol_detalle` WRITE;
/*!40000 ALTER TABLE `rol_detalle` DISABLE KEYS */;
INSERT INTO `rol_detalle` VALUES (36,3,2,1),(37,3,8,1),(38,3,11,1),(39,3,12,1),(90,4,1,1),(91,4,2,1),(92,4,3,1),(93,4,4,1),(94,4,5,1),(95,4,6,1),(96,4,7,1),(97,4,8,1),(98,4,9,1),(99,4,10,1),(100,4,11,1),(101,4,12,1),(102,4,13,1),(103,4,14,1),(104,4,15,1),(105,4,16,1),(106,4,17,1),(107,1,1,1),(108,1,2,1),(109,1,3,1),(110,1,4,1),(111,1,5,1),(112,1,6,1),(113,1,7,1),(114,1,18,1),(115,1,19,1),(116,1,8,1),(117,1,9,1),(118,1,10,1),(119,1,11,1),(120,1,12,1),(121,1,13,1),(122,1,14,1),(123,1,15,1),(124,1,16,1),(125,1,17,1),(126,1,20,1),(155,2,2,1),(156,2,3,1),(157,2,18,1),(158,2,19,1),(159,2,8,1),(160,2,11,1),(161,2,12,1),(162,2,20,1);
/*!40000 ALTER TABLE `rol_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visual` int(1) NOT NULL,
  `addRecord` int(1) DEFAULT NULL,
  `editRecord` int(1) DEFAULT NULL,
  `viewRecord` int(1) DEFAULT NULL,
  `deleteRecord` int(1) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super Usuario',1,1,1,1,1,'Super Usuario','2020-09-26 05:00:00','2021-03-27 06:00:00',1),(2,'Doctores',2,1,1,1,1,'Doctores','2020-09-26 05:00:00','2021-08-06 05:00:00',1),(3,'Enfermeria',2,NULL,NULL,NULL,NULL,'Enfermeria','2020-09-26 05:00:00','2020-09-27 05:00:00',1),(4,'Prueba demo de perfiles',1,0,0,0,0,'Prueba demo de perfiles','2021-01-20 06:00:00','2021-01-20 06:00:00',1);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `signos_vitales`
--

DROP TABLE IF EXISTS `signos_vitales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `signos_vitales` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(10) NOT NULL,
  `medico_id` int(10) NOT NULL,
  `enfermera_id` int(10) NOT NULL,
  `cita_id` int(10) NOT NULL,
  `hospitalizacion_id` int(10) NOT NULL,
  `fecha` datetime NOT NULL,
  `presion` varchar(20) NOT NULL,
  `temperatura` varchar(20) NOT NULL,
  `pulsaciones` varchar(20) NOT NULL,
  `altura` varchar(20) DEFAULT NULL,
  `peso` varchar(20) DEFAULT NULL,
  `comentarios` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `signos_vitales`
--

LOCK TABLES `signos_vitales` WRITE;
/*!40000 ALTER TABLE `signos_vitales` DISABLE KEYS */;
/*!40000 ALTER TABLE `signos_vitales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `urgencias`
--

DROP TABLE IF EXISTS `urgencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `urgencias` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `medico_id` int(10) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `paciente` varchar(250) DEFAULT NULL,
  `edad` varchar(10) DEFAULT NULL,
  `peso` varchar(10) DEFAULT NULL,
  `talla` varchar(10) DEFAULT NULL,
  `motivo` longtext DEFAULT NULL,
  `padecimiento` longtext DEFAULT NULL,
  `heredo_diabetes` varchar(250) DEFAULT NULL,
  `heredo_hipertencion` varchar(250) DEFAULT NULL,
  `heredo_cancer` varchar(250) DEFAULT NULL,
  `heredo_convulsiones` varchar(250) DEFAULT NULL,
  `heredo_lar` varchar(250) DEFAULT NULL,
  `heredo_leulin` varchar(250) DEFAULT NULL,
  `patolo_diabetes` varchar(250) DEFAULT NULL,
  `patolo_hipertencion` varchar(250) DEFAULT NULL,
  `patolo_cancer` varchar(250) DEFAULT NULL,
  `patolo_otros` varchar(250) DEFAULT NULL,
  `operaciones` varchar(250) DEFAULT NULL,
  `transfuciones` varchar(250) DEFAULT NULL,
  `fracturas` varchar(250) DEFAULT NULL,
  `alergias` varchar(250) DEFAULT NULL,
  `subtotal` decimal(20,6) NOT NULL,
  `iva` decimal(20,6) NOT NULL,
  `total` decimal(20,6) NOT NULL,
  `pagado` decimal(20,6) NOT NULL,
  `pendiente` decimal(20,6) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `urgencias`
--

LOCK TABLES `urgencias` WRITE;
/*!40000 ALTER TABLE `urgencias` DISABLE KEYS */;
INSERT INTO `urgencias` VALUES (1,2,'2021-03-07','15:21:44','Juan Ramo chavez garcia','45','150.33','1.70','<p>este motivo es una prueba y nada mas    <br></p>','<p>dolor de pito por cojer mucho<br></p>','no','no','no','no','no','no','si','si un poco','ninguno detectado','tal vez algo que no recuerdo','si rodilla a los 13 años, inicios de 1996','nunca y tal vez nunca lo haga aun no se','si hombro hace 8 y 14 años','a todo sentimiento y a la sociedad en general',1750.000000,200.000000,1950.000000,1950.000000,0.000000,2),(2,2,'2021-03-27','20:11:25','Paciente de ejemplo final','33','156','33','<p>esto es una prueba para validar status y mensajes<br></p>','<p>blablabla    <br></p>','no','no','no','no','no','no','si','si un poco','ninguno detectado','tal vez algo que no recuerdo','si rodilla a los 13 años, inicios de 1996','nunca y tal vez nunca lo haga aun no se','si hombro hace 8 y 14 años','a todo sentimiento y a la sociedad en general',1500.000000,0.000000,1500.000000,1500.000000,0.000000,2);
/*!40000 ALTER TABLE `urgencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `urgencias_servicios`
--

DROP TABLE IF EXISTS `urgencias_servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `urgencias_servicios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `urgencia_id` int(10) NOT NULL,
  `servicio_id` int(10) DEFAULT NULL,
  `pago_id` int(10) DEFAULT NULL,
  `fecha_servicio` date DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `cantidad` int(10) DEFAULT NULL,
  `precio` decimal(20,6) DEFAULT NULL,
  `iva` decimal(20,6) DEFAULT NULL,
  `importe` decimal(20,6) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `urgencias_servicios`
--

LOCK TABLES `urgencias_servicios` WRITE;
/*!40000 ALTER TABLE `urgencias_servicios` DISABLE KEYS */;
INSERT INTO `urgencias_servicios` VALUES (1,1,0,8,'2021-03-27','Primera prueba',1,400.000000,64.000000,464.000000,2),(2,1,NULL,7,'2021-03-27','segunda prueba',3,150.000000,72.000000,522.000000,2),(3,1,4,7,'2021-03-27','Oxigeno en lata',1,500.000000,0.000000,500.000000,2),(4,1,0,8,'2021-03-27','Ingreso por urgencia',1,400.000000,64.000000,464.000000,2),(5,2,4,10,'2021-03-27','Oxigeno en lata',1,500.000000,0.000000,500.000000,2),(6,2,0,9,'2021-03-31','captra manual cobrada',5,200.000000,0.000000,1000.000000,2);
/*!40000 ALTER TABLE `urgencias_servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rol` int(1) NOT NULL,
  `asistente_id` int(10) NOT NULL,
  `medico_id` int(10) DEFAULT NULL,
  `enfermera_id` int(10) DEFAULT NULL,
  `paciente_id` int(10) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `time_login` datetime DEFAULT NULL,
  `online` int(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,0,0,0,0,'Administrador','admin@app.com','$2y$10$E14A0D/2f3uCFPMEod5rV.x11ZdLO45eKccC2Zzbs7bBloo9bmzzK','JYZuvhJF8yvGcfkDK6baQae93BNxx0uaKwLtxFgxZPg65vHt7hxpDmhxtWuG',NULL,'2020-07-24 01:38:27','2020-07-23 20:38:27',1,1),(2,2,0,1,0,0,'Demostrativo Doctor','demodoctor@app.com','$2y$10$t1pZR1Sf9tdq7yv9uap/.usgyqhFpbM3vHqKOFogK8Iy.U6noxev2','cIhpTQbqSkiJjHAaVCEydYIU0IILqbRpgDT2WVbzDypYP86ZVsPTzbfwMkrE',NULL,'2020-09-27 05:00:00',NULL,0,0),(3,2,0,2,0,0,'Doctora de ejemplo','doctora@app.com','$2y$10$RcLc9lO7db89WL7tiJuel.EI3mG5nhNgNvfvyZu5zCMd98fj3ZRSi','dBZkQMnuelOQVglJ3ZALm9LGuaLPOofZZHwCiEITanlyxdZ3jghZnMr6Bj4F',NULL,NULL,NULL,0,1),(4,3,0,0,1,0,'Usuario Enfermera Demo','demoenfermera@app.com','$2y$10$/SrzDaC0I0A7mamJuUg2/OtbLr53pvQJdQA/DC7jw7yFsKu/np10m',NULL,NULL,NULL,NULL,0,1),(5,1,0,NULL,NULL,NULL,'Usuario Root adicional','root@app.com','$2y$10$Ywo6vTyclnEy/7sEubzlC.DHqImNUoK6qraHWdfFT0rV8RX4wa/ES',NULL,'2020-09-27 05:00:00',NULL,NULL,0,1),(6,2,2,0,0,0,'Marisol Navarro Martinez','ketsura@gmail.com','$2y$10$/8Ww31aBpz8NelsRhlSzoef2aeEp.8RyOhC6e/TnKmV2Px62NRwwa','33v6y0wwA0nijOwCoEiPIMl2NaCPSF6umgMH27xIkE3ZaUqdesQkVdzEuXnC',NULL,NULL,NULL,0,1),(8,2,0,3,0,0,'Sergio Garduño Gomez','garduno@app.com','$2y$10$ldh34qI4m8XFNQPmWLW4VeHs.VK.A9X0Go./kTUQzSAOuiVCwi.2e',NULL,NULL,NULL,NULL,0,1),(9,1,0,0,0,0,'super vendedor','superventas@app.com','$2y$10$fM6g/ClCMWUpfItR3fN.RuzYbgAOmPOWS26q.7bGdFgqs2WixYTva',NULL,'2021-01-14 06:00:00','2021-01-14 06:00:00',NULL,0,1),(10,1,0,0,0,0,'MIGUEL ANGEL','miguell3365@hotmail.com','$2y$10$HISlAm43dz.Ptq2H1lYjPO5EvXSWsM7wSac124P4jDl2vJsXCKCuq','FjL0JUWKft1DZd1L7nQjJjGTHOPGHRvcCQB975oh0tdeWiSTehnAZaewgWtQ','2021-08-04 05:00:00','2021-08-06 05:00:00',NULL,0,1),(11,2,0,4,0,0,'Jose Alberto Vivero Garay','chino_753alb@hotmail.com','$2y$10$K8K1XVOS5tX.VDE30D2W6.QIVkiwfsRbRdl0UzUDObh2Izj6r.btm','jULHN7a5JLxK4gvJIgFnsogISz0XLvwL46K4VBXPIjSqTAmCGd3F5lNGygLg',NULL,NULL,NULL,0,1),(12,2,0,5,0,0,'miguel','miguel3365@hotmail.com','$2y$10$1SYd8F5/QPZKgn2GL5wSt.hd4CntTafpgIr7BiFxJzPiJzOHr1GEC',NULL,NULL,NULL,NULL,0,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-01  0:00:01
