-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 03, 2021 at 09:00 PM
-- Server version: 5.7.35-0ubuntu0.18.04.1
-- PHP Version: 7.2.34-23+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `asistentes`
--

CREATE TABLE `asistentes` (
  `id` int(10) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `rfc` varchar(15) DEFAULT NULL,
  `curp` varchar(50) DEFAULT NULL,
  `honorarios` decimal(20,6) DEFAULT NULL,
  `domicilio` varchar(200) DEFAULT NULL,
  `fotografia` varchar(150) DEFAULT NULL,
  `doctores` varchar(50) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asistentes`
--

INSERT INTO `asistentes` (`id`, `nombre`, `celular`, `rfc`, `curp`, `honorarios`, `domicilio`, `fotografia`, `doctores`, `status`) VALUES
(1, 'Usuario Enfermera Demo', '7412589635', '', '', '0.000000', '', '', '', 1),
(2, 'Marisol Navarro Martinez', '', '', '', '0.000000', '', NULL, '1,2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `citas`
--

CREATE TABLE `citas` (
  `id` int(10) NOT NULL,
  `paciente_id` int(10) NOT NULL,
  `consultorio_id` int(10) DEFAULT NULL,
  `medico_id` int(10) DEFAULT NULL,
  `enfermera_id` int(10) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time DEFAULT NULL,
  `comentarios` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `citas`
--

INSERT INTO `citas` (`id`, `paciente_id`, `consultorio_id`, `medico_id`, `enfermera_id`, `fecha`, `hora`, `comentarios`, `status`) VALUES
(1, 1, 2, 1, 1, '2020-09-10', '12:00:00', 'blablabla', 0),
(2, 4, 0, 2, 0, '2020-09-28', '04:00:00', '', 0),
(3, 3, 1, 1, 0, '2020-09-29', '07:30:00', '', 0),
(4, 4, 1, 2, 1, '2020-10-06', '03:00:00', 'blablabla', 0),
(5, 4, 0, 1, 0, '2020-10-20', '07:00:00', 'Comentario de prueba para nuevo rol de doctor', 0),
(6, 4, 0, 3, 0, '2020-10-27', '12:30:00', '', 0),
(7, 4, 0, 3, 0, '2020-12-11', '05:30:00', '', 0),
(8, 4, 0, 2, 0, '2020-12-22', '09:00:00', '', 0),
(9, 1, 0, 2, 0, '2020-12-24', '04:00:00', '', 0),
(10, 2, 0, 3, 0, '2021-01-21', '02:00:00', '', 0),
(11, 1, 0, 2, 0, '2021-02-04', '02:00:00', '', 0),
(12, 3, 0, 2, 0, '2021-02-25', '06:30:00', '', 0),
(13, 1, 0, 1, 0, '2021-05-04', '01:30:00', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(10) NOT NULL,
  `estado` varchar(150) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `clave` varchar(150) NOT NULL,
  `valor` longtext NOT NULL,
  `serializado` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configuracion`
--

INSERT INTO `configuracion` (`id`, `estado`, `tipo`, `clave`, `valor`, `serializado`, `status`) VALUES
(1, '', 'config', 'empresa_nombre', 'AIzaSyBa6o5XiRIAx4ng68PCAsKNKKwFXQnW2uM', 0, 1),
(2, '', 'config', 'empresa_direccion', 'San francisco 12 la herradura, Cordoba veracruz 94470', 0, 1),
(3, '', 'config', 'empresa_logo', 'Posicion origen en el mapa', 0, 1),
(4, '', 'config', 'empresa_rfc', 'Posicion origen en el mapa', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `consultas`
--

CREATE TABLE `consultas` (
  `id` int(10) NOT NULL,
  `cita_id` int(10) DEFAULT NULL,
  `paciente_id` int(10) NOT NULL,
  `doctor_id` int(10) NOT NULL,
  `enfermera_id` int(10) DEFAULT NULL,
  `signos_id` int(10) DEFAULT NULL,
  `costo` decimal(20,6) NOT NULL,
  `fecha` date DEFAULT NULL,
  `razon_visita` longtext,
  `diagnostico` longtext,
  `recomendaciones` longtext,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consultas`
--

INSERT INTO `consultas` (`id`, `cita_id`, `paciente_id`, `doctor_id`, `enfermera_id`, `signos_id`, `costo`, `fecha`, `razon_visita`, `diagnostico`, `recomendaciones`, `status`) VALUES
(1, 0, 1, 1, 0, 0, '0.000000', '2020-09-25', '<p>Dolor de cabeza&nbsp;&nbsp; agudo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br></p>', '<p>Cefalea por estres<br></p>', '<p>reposo y relajacion, ejercicios anti estres y actividad fisica<br></p>', 1),
(2, 0, 2, 2, 0, 0, '0.000000', '2020-09-27', '<p>Dolor estomacal Agudo&nbsp; <br></p>', '<p>Gastritis<br></p>', '', 1),
(3, 2, 4, 2, 0, 0, '0.000000', '2020-09-27', '<p>Esto es una prueba de consultas desde una cita&nbsp;&nbsp;&nbsp;&nbsp;<br></p>', '<p>Veremos lo que pasa al guardar para determinar el diagnostivo<br></p>', '<p>si no hay error ya la salvamos<br></p>', 1),
(4, 2, 4, 2, 0, 0, '0.000000', '2020-09-27', '<p>Esto es una prueba de consultas desde una cita&nbsp;&nbsp;&nbsp;&nbsp;<br></p>', '<p>Veremos lo que pasa al guardar para determinar el diagnostivo<br></p>', '<p>si no hay error ya la salvamos<br></p>', 1),
(5, 0, 4, 1, 0, 0, '0.000000', '2020-10-10', '<p>Dolro articular, nauceas, vomito, dolor estomacal&nbsp;&nbsp;&nbsp;&nbsp;<br></p>', '<p>Infeccion en vias urinarias, infeccion estomacal severa<br></p>', '<p>reposo absoluto durante 7 dias<br></p>', 1),
(6, 0, 4, 2, 0, 0, '0.000000', '2020-10-10', '<p>Cita de revision de rutina&nbsp;&nbsp;&nbsp;&nbsp;<br></p>', '<p>el paciente sigue progresando aun le cuesta caminar por el dolor articular<br></p>', '<p>seguir en reposo<br></p>', 1),
(7, 0, 4, 1, 0, 0, '0.000000', '2020-10-10', '<p>Cita de revision<br></p>', '<p>Cliente con nauseas aun dolor estomacar ya no existe asi como dolor articular<br></p>', '', 1),
(8, 0, 4, 2, 0, 0, '145.000000', '2020-10-22', '<p>blablabla&nbsp;&nbsp;&nbsp;&nbsp;<br></p>', '<p>blebleble<br></p>', '<p>bliblibli<br></p>', 1),
(9, 0, 1, 3, 0, 0, '450.000000', '2020-10-24', '<p>motivo de visita del paciente<br></p>', '<p>diagnostico de ejemplo <br></p>', '<p>te comiendo no hacer tonterias para que no te enfermes<br></p>', 1),
(11, 0, 1, 3, 0, 0, '450.000000', '2020-10-24', '<p>motivo de visita del paciente<br></p>', '<p>diagnostico de ejemplo <br></p>', '<p>te comiendo no hacer tonterias para que no te enfermes<br></p>', 1),
(12, 0, 2, 3, 0, 0, '450.000000', '2020-10-24', 'prueba de almacenamiento por motivo de visita en asistente<br>', 'Diagnostico asignado desde el asistente<br>', '', 1),
(13, 0, 3, 2, 0, 0, '150.000000', '2020-10-24', '<p>Dolor en el molar incisivo derecho<br></p>', '<p>Muela dañada, 4 molar sobre saliendo y afectando otros molares y mandibula<br></p>', '<p>reposo absoluto durante 3 dias</p><p>Regresar en 7 dias para extracciona o una vez que el molar este desinflamado no exista dolor en el mismo<br></p>', 1),
(14, 0, 3, 1, 0, 0, '850.000000', '2020-10-24', '<p>motio de ejemplo para receta<br></p>', '<p>Diagnostico de ejemplo para receta<br></p>', '<p>recomendaciones princiaples no cagarla<br></p>', 1),
(15, 0, 2, 3, 0, 0, '450.000000', '2020-10-24', '<p>motivo de visita<br></p>', '<p>Diagnostico principal de la consulta<br></p>', '', 1),
(16, 0, 2, 3, 0, 0, '450.000000', '2020-11-23', '<p>Motivo de visita desconocido<br></p>', '<p>Esquisofrenico y paranoico<br></p>', '', 1),
(17, 0, 2, 3, 0, 0, '100.000000', '2020-11-23', '<p>blablabla<br></p>', '<p>blebleble<br></p>', '', 1),
(18, 0, 2, 1, 0, 0, '850.000000', '2020-12-07', 'Seguimiento clinico<br>', '<p>diagnostico clinico sin receta<br></p>', '', 1),
(19, 0, 4, 3, 0, 0, '450.000000', '2020-12-07', '<p>Seguimiento clinico con receta<br></p>', '<p>Diagnostico clinico con receta<br></p>', '', 1),
(20, 0, 2, 2, 0, 0, '380.000000', '2020-12-23', '<p>ejemplo<br></p>', '<p>ejemplo de nuevo pago<br></p>', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `consultorios`
--

CREATE TABLE `consultorios` (
  `id` int(10) NOT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `medico_id` int(10) DEFAULT NULL,
  `enfermera_id` int(10) DEFAULT NULL,
  `dia_laboral` varchar(50) DEFAULT NULL,
  `hora_inicio` varchar(10) NOT NULL,
  `hora_fin` varchar(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consultorios`
--

INSERT INTO `consultorios` (`id`, `numero`, `descripcion`, `medico_id`, `enfermera_id`, `dia_laboral`, `hora_inicio`, `hora_fin`, `status`) VALUES
(1, '123', 'Consultorio Puerta Cafe', 1, 0, 'Lunes', '08:00 AM', '09:00 PM', 1),
(2, '03', 'Nefro', 1, 1, 'Miercoles', '9:00', '7:30', 1),
(3, '04', 'Angeologia', 1, 1, 'Martes', '1:00', '9:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cuartos`
--

CREATE TABLE `cuartos` (
  `id` int(10) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `amenidades` varchar(150) DEFAULT NULL,
  `equipo` varchar(150) DEFAULT NULL,
  `costo_dia` decimal(20,6) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cuartos`
--

INSERT INTO `cuartos` (`id`, `numero`, `descripcion`, `amenidades`, `equipo`, `costo_dia`, `status`) VALUES
(1, '01', 'Habitacion Estandar HP01', 'Sala, comedor, cunero', 'Oxigeno\r\nCama Matrimonial clinica', '650.000000', 2),
(2, 'A23', 'Suite Ejecutiva', 'Refrigerador de Snaks\r\nSala de espera \r\nMesa de centro\r\nClima', 'Oxigeno\r\nConsola de Signos Vitales', '1550.230000', 2),
(3, '02', 'Basica Sencilla', 'Mesa de centro\r\nSillon de Visitas', 'Ninguno\r\nCama Clinica', '500.000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `empresas`
--

CREATE TABLE `empresas` (
  `id` int(10) NOT NULL,
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
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empresas`
--

INSERT INTO `empresas` (`id`, `nombre`, `impuesto`, `direccion`, `colonia`, `estado`, `ciudad`, `cp`, `correo`, `telefono`, `celular`, `hospedaje`, `hospedaje_iva`, `twitter`, `facebook`, `instagram`, `logotipo`, `status`) VALUES
(1, 'Empresa Demo', '16.000000', 'Direccion Demo', '', 'Estado Demo', 'Ciudad', '06600', 'admin@app.com', '9999999999', '0000000000', 'Servicio de Habitacion, hospitalizacion', 1, 'twitter.com', 'facebook.com', 'instagram.com', '1602431707_hospital-clinic-plus-logo-7916383C7A-seeklogo.com.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `enfermeria`
--

CREATE TABLE `enfermeria` (
  `id` int(10) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `rfc` varchar(15) DEFAULT NULL,
  `cedula` varchar(50) DEFAULT NULL,
  `curp` varchar(50) DEFAULT NULL,
  `honorarios` decimal(20,6) DEFAULT NULL,
  `domicilio` varchar(200) DEFAULT NULL,
  `fotografia` varchar(150) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enfermeria`
--

INSERT INTO `enfermeria` (`id`, `nombre`, `celular`, `rfc`, `cedula`, `curp`, `honorarios`, `domicilio`, `fotografia`, `status`) VALUES
(1, 'Usuario Enfermera Demo', '7412589635', '', 'ASD74859', '', '0.000000', 'Calle san bartolo 4505 ciudad de mexico', '1601124298_2.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `farmacia`
--

CREATE TABLE `farmacia` (
  `id` int(10) NOT NULL,
  `cuarto_id` int(10) DEFAULT NULL,
  `enfermera_id` int(10) NOT NULL,
  `medico_id` int(10) DEFAULT NULL,
  `asistente_id` int(10) NOT NULL,
  `solicitante` varchar(250) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `fecha_surtido` datetime DEFAULT NULL,
  `solicitado` longtext,
  `comentarios` longtext,
  `status` int(1) NOT NULL COMMENT '1: solicitada, 2: surtida'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmacia`
--

INSERT INTO `farmacia` (`id`, `cuarto_id`, `enfermera_id`, `medico_id`, `asistente_id`, `solicitante`, `fecha_registro`, `fecha_surtido`, `solicitado`, `comentarios`, `status`) VALUES
(1, 2, 0, 0, 0, 'Administrador', '2020-12-27 17:29:09', NULL, '<p>4 de Pimer insumo </p><p>3 de segundo insumo</p><p>10 de tercer insumo</p><p>8 de algo mas<br></p>', NULL, 2),
(2, 2, 0, 0, 0, 'Administrador', '2020-12-29 13:01:56', NULL, '<p>primer requerimineto</p><p>segundo requerimineto</p><p>tercer requrimiento</p><p>cuarto requerimiento</p><p><br></p>', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `farmacia_detalle`
--

CREATE TABLE `farmacia_detalle` (
  `id` int(10) NOT NULL,
  `farmacia_id` int(10) NOT NULL,
  `insumo` varchar(250) DEFAULT NULL,
  `cantidad` int(5) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hospitalizacion`
--

CREATE TABLE `hospitalizacion` (
  `id` int(10) NOT NULL,
  `medico_id` int(10) NOT NULL,
  `paciente_id` int(10) DEFAULT NULL,
  `cuarto_id` int(10) NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `fecha_alta` datetime DEFAULT NULL,
  `motivo` longtext,
  `subtotal` decimal(20,6) NOT NULL,
  `iva` decimal(20,6) NOT NULL,
  `total` decimal(20,6) NOT NULL,
  `pagado` decimal(20,6) NOT NULL,
  `pendiente` decimal(20,6) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospitalizacion`
--

INSERT INTO `hospitalizacion` (`id`, `medico_id`, `paciente_id`, `cuarto_id`, `fecha_ingreso`, `fecha_alta`, `motivo`, `subtotal`, `iva`, `total`, `pagado`, `pendiente`, `status`) VALUES
(1, 3, 2, 1, '2020-12-20 22:44:51', NULL, '<p>Bla bla bla bla bla<br></p>', '1200.000000', '112.000000', '1312.000000', '9106.000000', '-7794.000000', 0),
(2, 3, 4, 3, '2020-12-23 22:46:30', NULL, '<p><br></p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p><p><br></p><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p><p><br></p><p><br></p>', '2500.000000', '320.000000', '2820.000000', '2240.000000', '580.000000', 2),
(3, 1, 2, 1, '2020-12-29 12:05:21', NULL, '<p>blablabla<br></p>', '25350.000000', '4056.000000', '29406.000000', '29406.000000', '0.000000', 2),
(4, 2, 2, 2, '2021-02-11 21:43:06', NULL, '<p>blablabla<br></p>', '1550.230000', '248.040000', '1798.270000', '0.000000', '1798.270000', 0),
(5, 2, 1, 3, '2021-02-11 22:55:37', NULL, '<p>blablabla<br></p>', '500.000000', '80.000000', '580.000000', '0.000000', '580.000000', 0),
(6, 1, 2, 3, '2021-03-27 08:35:57', NULL, '<p>esto es un prueba de servicios<br></p>', '2000.000000', '320.000000', '2320.000000', '0.000000', '2320.000000', 0),
(7, 1, 2, 3, '2021-01-04 12:31:32', NULL, '<p>blablabla<br></p>', '86000.000000', '13760.000000', '99760.000000', '49300.000000', '50460.000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hospitalizacion_servicios`
--

CREATE TABLE `hospitalizacion_servicios` (
  `id` int(10) NOT NULL,
  `hospitalizacion_id` int(10) NOT NULL,
  `servicio_id` int(10) DEFAULT NULL,
  `pago_id` int(10) DEFAULT NULL,
  `fecha_servicio` date DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `cantidad` int(10) DEFAULT NULL,
  `precio` decimal(20,6) DEFAULT NULL,
  `iva` decimal(20,6) DEFAULT NULL,
  `importe` decimal(20,6) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospitalizacion_servicios`
--

INSERT INTO `hospitalizacion_servicios` (`id`, `hospitalizacion_id`, `servicio_id`, `pago_id`, `fecha_servicio`, `descripcion`, `cantidad`, `precio`, `iva`, `importe`, `status`) VALUES
(1, 1, NULL, NULL, '2020-12-20', 'Servicio de Habitacion, hospitalizacion', 53, '650.000000', '5512.000000', '39962.000000', 1),
(2, 1, 1, 2, '2020-12-20', 'Primer servicio de Ejemplo', 1, '1500.000000', '240.000000', '1740.000000', 2),
(3, 1, 2, NULL, '2020-12-21', 'Segundo Servicio de ejemplo sin iva', 1, '500.000000', '0.000000', '500.000000', 1),
(4, 2, NULL, NULL, '2020-12-23', 'Servicio de Habitacion, hospitalizacion', 1, '500.000000', '80.000000', '580.000000', 1),
(5, 2, 1, 3, '2020-12-23', 'Primer servicio de Ejemplo', 1, '1500.000000', '240.000000', '1740.000000', 2),
(6, 2, 2, 3, '2020-12-23', 'Segundo Servicio de ejemplo sin iva', 1, '500.000000', '0.000000', '500.000000', 2),
(7, 1, 1, 4, '2020-12-27', 'Primer servicio de Ejemplo', 1, '1500.000000', '240.000000', '1740.000000', 2),
(8, 1, 0, 4, '2020-12-27', 'Servicio Manual definido', 1, '4850.000000', '776.000000', '5626.000000', 2),
(9, 3, NULL, 5, '2020-12-29', 'Servicio de Habitacion, hospitalizacion', 39, '650.000000', '4056.000000', '29406.000000', 2),
(10, 4, NULL, NULL, '2021-02-11', 'Servicio de Habitacion, hospitalizacion', 1, '1550.230000', '248.040000', '1798.270000', 1),
(11, 5, NULL, NULL, '2021-02-11', 'Servicio de Habitacion, hospitalizacion', 1, '500.000000', '80.000000', '580.000000', 1),
(12, 6, NULL, NULL, '2021-03-27', 'Servicio de Habitacion, hospitalizacion', 4, '500.000000', '320.000000', '2320.000000', 1),
(13, 1, 0, NULL, '2021-03-27', 'Ejemplo de captura manual para urgencias', 2, '350.000000', '112.000000', '812.000000', 1),
(14, 1, 4, NULL, '2021-03-27', 'Oxigeno en lata', 1, '500.000000', '0.000000', '500.000000', 1),
(15, 7, NULL, 11, '2021-03-31', 'Servicio de Habitacion, hospitalizacion', 172, '500.000000', '13760.000000', '99760.000000', 2);

-- --------------------------------------------------------

--
-- Table structure for table `insumos`
--

CREATE TABLE `insumos` (
  `id` int(10) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `iva` int(1) DEFAULT NULL,
  `costo` decimal(20,6) DEFAULT NULL,
  `precio` decimal(20,6) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laboratorio`
--

CREATE TABLE `laboratorio` (
  `id` int(10) NOT NULL,
  `orden_id` int(10) NOT NULL,
  `paciente_id` int(10) NOT NULL,
  `medico_id` int(10) NOT NULL,
  `enfermera_id` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `diagnostico` longtext,
  `archivo` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laboratorio`
--

INSERT INTO `laboratorio` (`id`, `orden_id`, `paciente_id`, `medico_id`, `enfermera_id`, `fecha`, `nombre`, `diagnostico`, `archivo`, `status`) VALUES
(1, 0, 2, 1, 0, '2020-10-02', 'Analisis de Ejemplo', '<p>Esto es una prueba de diagnostico de analisis clinico saludos<br></p>', '1601878152_Captura de pantalla de 2020-10-04 16-38-51.png', 1),
(2, 0, 4, 1, 0, '2020-10-06', 'Analisis de prueba', '<p>Diagnoticado sin ningun resultado negarivo para esta operacion<br></p>', NULL, 1),
(3, 0, 4, 2, 0, '2020-10-06', 'Segunda prueba', '<p>Sin diagnostico hay que revisar de nueva cuenta <br></p>', '1602382633_cdbf08ee-af76-4437-ae45-fe94f07424a0.pdf', 1),
(4, 0, 1, 3, 0, '2020-10-25', 'ejemplo', '<p>diagnostico equivocado&nbsp;&nbsp;&nbsp;&nbsp;<br></p>', '1603345863_1600088669359.remmina-2020-10-6-3:11:57.780838.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id` int(10) NOT NULL,
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
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `medicos`
--

CREATE TABLE `medicos` (
  `id` int(10) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `especialidad` varchar(150) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `rfc` varchar(15) DEFAULT NULL,
  `cedula` varchar(50) DEFAULT NULL,
  `curp` varchar(50) DEFAULT NULL,
  `honorarios` decimal(20,6) DEFAULT NULL,
  `domicilio` varchar(200) DEFAULT NULL,
  `fotografia` varchar(150) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicos`
--

INSERT INTO `medicos` (`id`, `nombre`, `especialidad`, `celular`, `rfc`, `cedula`, `curp`, `honorarios`, `domicilio`, `fotografia`, `status`) VALUES
(1, 'Doctor Demo', 'Medicina General', '7412589635', 'XXXX999999X9X', '123456878', '', '850.000000', '', '1601122328_d1.jpg', 1),
(2, 'Doctora de ejemplo', 'Neurologia', '14785236987', '', '', '', '380.000000', '', '1601245349_4.jpg', 1),
(3, 'Sergio Garduño Gomez', 'Neurologia', '5537430480', '', '', '', '450.000000', '', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `modulos`
--

CREATE TABLE `modulos` (
  `id` int(10) NOT NULL,
  `tipo` varchar(5) DEFAULT NULL,
  `padre_id` int(10) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `url` varchar(150) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `orden` int(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modulos`
--

INSERT INTO `modulos` (`id`, `tipo`, `padre_id`, `nombre`, `url`, `icon`, `orden`, `status`) VALUES
(1, NULL, 0, 'Doctores', 'admin/medicos', 'fa-user-md', 1, 1),
(2, NULL, 0, 'Pacientes', 'admin/pacientes', 'fa-users', 2, 1),
(3, NULL, 0, 'Enfermeras', 'admin/enfermeria', 'fa-female', 3, 1),
(4, NULL, 0, 'Consultorios', 'admin/consultorios', 'fa-heartbeat', 5, 1),
(5, NULL, 0, 'Habitaciones', 'admin/cuartos', 'fa-building', 6, 1),
(6, NULL, 0, 'Farmacia', 'admin/farmacia', 'fa-medkit', 7, 1),
(7, NULL, 0, 'Servicios', 'admin/servicios', 'fa-suitcase', 8, 1),
(8, NULL, 0, 'Citas', 'admin/citas', 'fa-calendar', 9, 1),
(9, NULL, 0, 'Hospitalizacion', 'admin/hospitalizacion', 'fa-bed', 12, 1),
(10, NULL, 0, 'Laboratorio', 'admin/laboratorio', 'fa-flask', 13, 1),
(11, NULL, 0, 'Consulta', 'admin/consultas', 'fa-stethoscope', 11, 1),
(12, NULL, 0, 'Recetas', 'admin/recetas', 'fa-file-pdf-o', 14, 1),
(13, NULL, 0, 'Roles y Permisos', 'admin/roles', 'fa-sitemap', 16, 1),
(14, NULL, 0, 'Usuarios', 'admin/users', 'fa-key', 17, 1),
(15, NULL, 0, 'Asistentes', 'admin/asistentes', 'fa-user-secret', 4, 1),
(16, NULL, 0, 'Pagos', 'admin/pagos', 'fa-credit-card', 10, 1),
(17, NULL, 0, 'Configuracion', 'admin/empresas', 'fa-cogs', 15, 1),
(18, NULL, 7, 'Hospitalizacion', 'admin/servicios/?scope=1', 'fa-bed', 1, 1),
(19, NULL, 7, 'Urgencias', 'admin/servicios/?scope=2', 'fa-ambulance', 1, 0),
(20, NULL, 0, 'Urgencias', 'admin/urgencias', 'fa-ambulance', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notas`
--

CREATE TABLE `notas` (
  `id` int(10) NOT NULL,
  `medico_id` int(10) NOT NULL,
  `paciente_id` int(10) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `tipo` varchar(3) DEFAULT NULL,
  `nota_medica` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notas`
--

INSERT INTO `notas` (`id`, `medico_id`, `paciente_id`, `fecha`, `hora`, `tipo`, `nota_medica`, `status`) VALUES
(2, 1, 7, '2021-03-07', '13:04:43', '1', '<p>examen de laboratorio de ejemplo por nota a paciente de ejemplo esto es solo una prueba y nada mas<br></p>', 1),
(3, 1, 7, '2021-03-07', '13:06:20', '1', '<p>examen de laboratorio de ejemplo por nota a paciente de ejemplo esto es solo una prueba y nada mas<br></p>', 1),
(4, 2, 7, '2021-03-07', '13:17:05', '2', '<p>Estudio clinico de ejemplo<br></p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ordenes`
--

CREATE TABLE `ordenes` (
  `id` int(10) NOT NULL,
  `tipo` varchar(1) NOT NULL COMMENT 'H: Hospitalizacion, L:Laboratorios',
  `medico_id` int(10) NOT NULL,
  `paciente_id` int(10) NOT NULL,
  `fecha_solicitud` date DEFAULT NULL,
  `fecha_aplicacion` date DEFAULT NULL,
  `comentarios` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(10) NOT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `domicilio` varchar(250) DEFAULT NULL,
  `tsangre` varchar(10) DEFAULT NULL,
  `sexo` varchar(1) DEFAULT NULL,
  `nacimiento` date DEFAULT NULL,
  `alergias` longtext,
  `hereditarias` longtext,
  `cirugias` longtext,
  `vicios` longtext,
  `diagnostico` longtext,
  `fotografia` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pacientes`
--

INSERT INTO `pacientes` (`id`, `nombre`, `telefono`, `celular`, `domicilio`, `tsangre`, `sexo`, `nacimiento`, `alergias`, `hereditarias`, `cirugias`, `vicios`, `diagnostico`, `fotografia`, `status`) VALUES
(1, 'Jair Luna', '', '7412589632', '', '', 'F', NULL, '', '', '', '', '', NULL, 1),
(2, 'Santiago Chavez', '', '8225874874', '', '', 'M', NULL, '', '', '', '', '', '1601179225_1.jpg', 1),
(3, 'Arturo Amatista', '', '447845745', '', '', 'M', NULL, '', '', '', '', '', NULL, 1),
(4, 'David Garduño Gomez', '5537430480', '5537430480', 'Cordoba Veracruz', 'B-', 'M', '1990-07-19', '<p>alergico a la penicilina<br></p>', '<p>demencia cenil en familiares de 3ra edad<br></p>', '<p>de la rodilla a los 13 años&nbsp;&nbsp;&nbsp;&nbsp;<br></p>', '<p>tabco</p><p>alcohol</p><p>a la marihuana cuando tenia 20 años<br></p>', '', '1601179283_5.jpg', 1),
(5, 'Marisol Navarro Martinez', '', '2711450273', '', '', '', NULL, '', '', '', '', '', NULL, 1),
(6, 'Nuevo paciente de ejemplo', '5537490480', '5537430480', 'desconocido', 'o+', 'M', '1984-07-29', '<p>tiene varios padecimientos patologicos<br></p>', '<p>tiene varios padecimientos hereditarios&nbsp;&nbsp; <br></p>', 'tien un padecimiento actual muy muy muy raro<br>', 'no le duele nada en el cuerpo no hay nada visible<br>', 'esta loco el david<br>', '1601179225_1.jpg', 1),
(7, 'Paciente limpio', '', '7412589635', '', '', '', NULL, '', '', '', '', '', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pacientes_asignacion`
--

CREATE TABLE `pacientes_asignacion` (
  `id` int(10) NOT NULL,
  `medico_id` int(10) DEFAULT NULL,
  `paciente_id` int(10) DEFAULT NULL,
  `fecha_asignacion` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pacientes_asignacion`
--

INSERT INTO `pacientes_asignacion` (`id`, `medico_id`, `paciente_id`, `fecha_asignacion`, `status`) VALUES
(1, 1, 1, '2020-10-05 00:00:00', 1),
(2, 1, 5, '2020-10-11 20:03:29', 1),
(3, 1, 4, '2020-10-11 20:03:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pagos`
--

CREATE TABLE `pagos` (
  `id` int(10) NOT NULL,
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
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pagos`
--

INSERT INTO `pagos` (`id`, `paciente_id`, `consulta_id`, `hospitalizacion_id`, `urgencia_id`, `medico_id`, `enfermera_id`, `servicios`, `fecha_apertura`, `fecha_pago`, `monto`, `status`) VALUES
(1, 2, 20, 0, 0, 2, NULL, NULL, '2020-12-23', '2021-06-19', '120.000000', 2),
(2, 2, 0, 1, 0, 3, 0, '2', '2020-12-23', '2020-12-23', '1740.000000', 2),
(3, 4, 0, 2, 0, 3, 0, '5,6', '2020-12-23', '2020-12-23', '2240.000000', 2),
(4, 2, 0, 1, 0, 3, 0, '7,8', '2020-12-27', '2020-12-27', '7366.000000', 2),
(5, 2, 0, 3, 0, 1, 0, '9', '2021-02-06', '2021-02-06', '29406.000000', 2),
(6, NULL, 0, 0, 1, 2, 0, '2,3', '2021-03-27', '2021-03-27', '1022.000000', 2),
(7, NULL, 0, 0, 1, 2, 0, '2,3', '2021-03-27', '2021-03-27', '1022.000000', 2),
(8, NULL, 0, 0, 1, 2, 0, '1,4', '2021-03-27', '2021-03-27', '928.000000', 2),
(9, NULL, 0, 0, 2, 2, 0, '6', '2021-03-31', '2021-03-31', '1000.000000', 2),
(10, 0, 0, 0, 2, 2, 0, '5', '2021-03-31', '2021-03-31', '500.000000', 2),
(11, 2, 0, 7, 0, 1, 0, '15', '2021-03-31', '2021-03-31', '49300.000000', 2);

-- --------------------------------------------------------

--
-- Table structure for table `personal`
--

CREATE TABLE `personal` (
  `id` int(10) NOT NULL,
  `tipo` int(1) NOT NULL COMMENT '1: Basicos, 2: Recepcion',
  `nombre` varchar(150) NOT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `rfc` varchar(15) DEFAULT NULL,
  `cedula` varchar(50) DEFAULT NULL,
  `curp` varchar(50) DEFAULT NULL,
  `honorarios` decimal(20,6) DEFAULT NULL,
  `domicilio` varchar(200) DEFAULT NULL,
  `fotografia` varchar(150) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int(10) NOT NULL,
  `scope` int(1) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `precio` decimal(20,6) NOT NULL,
  `iva` int(1) NOT NULL,
  `valor_iva` decimal(20,6) NOT NULL,
  `precio_neto` decimal(20,6) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `scope`, `descripcion`, `precio`, `iva`, `valor_iva`, `precio_neto`, `status`) VALUES
(1, 1, 'Primer servicio de Ejemplo', '1500.000000', 1, '240.000000', '1740.000000', 1),
(2, 1, 'Segundo Servicio de ejemplo sin iva', '500.000000', 0, '0.000000', '500.000000', 1),
(3, 1, 'Tercer ejemplo con iva', '1870.230000', 1, '299.240000', '2169.470000', 1),
(4, 2, 'Oxigeno en lata', '500.000000', 0, '0.000000', '500.000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `recetas`
--

CREATE TABLE `recetas` (
  `id` int(10) NOT NULL,
  `paciente_id` int(10) NOT NULL,
  `medico_id` int(10) NOT NULL,
  `consulta_id` int(10) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `medicamentos` longtext,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recetas`
--

INSERT INTO `recetas` (`id`, `paciente_id`, `medico_id`, `consulta_id`, `fecha`, `medicamentos`, `status`) VALUES
(1, 1, 1, NULL, '2020-09-27 00:00:00', '<p>Ibuprofeno de 1 u, 1 cada 6 horas</p><p>Aspirna protec 1 cada 24 horas permanentemente</p><p>Losartan de 50mb 1 cada 12 horas<br></p>', 1),
(2, 1, 2, NULL, '2020-10-05 00:00:00', '<p>blablabla<br></p>', 1),
(3, 4, 1, NULL, '2020-10-10 00:00:00', '<p>Omeprasol 1 diaria de por vida</p><p>Acido acetil salicilico 1 diaria de por vida<br></p>', 1),
(4, 4, 1, NULL, '2020-10-10 00:00:00', '<p>Pravastatina de 10 mg, 1 cada 8 horas por 30 dias</p><p>Loratadina de 500 1 diaria por 3 dias<br></p>', 1),
(5, 3, 2, NULL, '2020-10-11 00:00:00', '<p>Receta de jeemplo emitida por la asistente</p>', 1),
(6, 2, 3, NULL, '2020-10-22 00:00:00', '<p>Receta de ejemplo con dibujitos<br></p>', 1),
(7, 2, 3, 15, '2020-10-24 00:00:00', '<p>este medicamento fue prescrito desde la consulta<br></p>', 1),
(8, 4, 3, 0, '2020-10-24 00:00:00', '<p>Este medicamento fue prescrito desde el formulario de recetas<br></p>', 1),
(9, 2, 3, 16, '2020-11-23 00:00:00', '<p>una buena chinga para que se le quite lo loco<br></p>', 1),
(10, 2, 3, 17, '2020-11-23 00:00:00', '<p>bla bla bla</p><p>ble ble ble</p><p>bli bli bli<br></p>', 1),
(11, 4, 3, 19, '2020-12-07 00:00:00', '<p>Medicamento 1 cada 8 horas</p><p>Medicamento 2 cada 24 horas</p><p>Medicamento 3 una unica aplicacion<br></p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `recetas_detalle`
--

CREATE TABLE `recetas_detalle` (
  `id` int(10) NOT NULL,
  `receta_id` int(10) NOT NULL,
  `medicamento_id` int(10) NOT NULL,
  `dosificacion` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visual` int(1) NOT NULL,
  `addRecord` int(1) DEFAULT NULL,
  `editRecord` int(1) DEFAULT NULL,
  `viewRecord` int(1) DEFAULT NULL,
  `deleteRecord` int(1) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `visual`, `addRecord`, `editRecord`, `viewRecord`, `deleteRecord`, `description`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Super Usuario', 1, 1, 1, 1, 1, 'Super Usuario', '2020-09-26 05:00:00', '2021-03-27 06:00:00', 1),
(2, 'Doctores', 2, NULL, NULL, NULL, NULL, 'Doctores', '2020-09-26 05:00:00', '2020-09-27 05:00:00', 1),
(3, 'Enfermeria', 2, NULL, NULL, NULL, NULL, 'Enfermeria', '2020-09-26 05:00:00', '2020-09-27 05:00:00', 1),
(4, 'Prueba demo de perfiles', 1, 0, 0, 0, 0, 'Prueba demo de perfiles', '2021-01-20 06:00:00', '2021-01-20 06:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rol_detalle`
--

CREATE TABLE `rol_detalle` (
  `id` int(10) NOT NULL,
  `rol_id` int(10) NOT NULL,
  `modulo_id` int(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rol_detalle`
--

INSERT INTO `rol_detalle` (`id`, `rol_id`, `modulo_id`, `status`) VALUES
(31, 2, 2, 1),
(32, 2, 3, 1),
(33, 2, 8, 1),
(34, 2, 11, 1),
(35, 2, 12, 1),
(36, 3, 2, 1),
(37, 3, 8, 1),
(38, 3, 11, 1),
(39, 3, 12, 1),
(90, 4, 1, 1),
(91, 4, 2, 1),
(92, 4, 3, 1),
(93, 4, 4, 1),
(94, 4, 5, 1),
(95, 4, 6, 1),
(96, 4, 7, 1),
(97, 4, 8, 1),
(98, 4, 9, 1),
(99, 4, 10, 1),
(100, 4, 11, 1),
(101, 4, 12, 1),
(102, 4, 13, 1),
(103, 4, 14, 1),
(104, 4, 15, 1),
(105, 4, 16, 1),
(106, 4, 17, 1),
(107, 1, 1, 1),
(108, 1, 2, 1),
(109, 1, 3, 1),
(110, 1, 4, 1),
(111, 1, 5, 1),
(112, 1, 6, 1),
(113, 1, 7, 1),
(114, 1, 18, 1),
(115, 1, 19, 1),
(116, 1, 8, 1),
(117, 1, 9, 1),
(118, 1, 10, 1),
(119, 1, 11, 1),
(120, 1, 12, 1),
(121, 1, 13, 1),
(122, 1, 14, 1),
(123, 1, 15, 1),
(124, 1, 16, 1),
(125, 1, 17, 1),
(126, 1, 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `signos_vitales`
--

CREATE TABLE `signos_vitales` (
  `id` int(10) NOT NULL,
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
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `urgencias`
--

CREATE TABLE `urgencias` (
  `id` int(10) NOT NULL,
  `medico_id` int(10) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `paciente` varchar(250) DEFAULT NULL,
  `edad` varchar(10) DEFAULT NULL,
  `peso` varchar(10) DEFAULT NULL,
  `talla` varchar(10) DEFAULT NULL,
  `motivo` longtext,
  `padecimiento` longtext,
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
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `urgencias`
--

INSERT INTO `urgencias` (`id`, `medico_id`, `fecha`, `hora`, `paciente`, `edad`, `peso`, `talla`, `motivo`, `padecimiento`, `heredo_diabetes`, `heredo_hipertencion`, `heredo_cancer`, `heredo_convulsiones`, `heredo_lar`, `heredo_leulin`, `patolo_diabetes`, `patolo_hipertencion`, `patolo_cancer`, `patolo_otros`, `operaciones`, `transfuciones`, `fracturas`, `alergias`, `subtotal`, `iva`, `total`, `pagado`, `pendiente`, `status`) VALUES
(1, 2, '2021-03-07', '15:21:44', 'Juan Ramo chavez garcia', '45', '150.33', '1.70', '<p>este motivo es una prueba y nada mas    <br></p>', '<p>dolor de pito por cojer mucho<br></p>', 'no', 'no', 'no', 'no', 'no', 'no', 'si', 'si un poco', 'ninguno detectado', 'tal vez algo que no recuerdo', 'si rodilla a los 13 años, inicios de 1996', 'nunca y tal vez nunca lo haga aun no se', 'si hombro hace 8 y 14 años', 'a todo sentimiento y a la sociedad en general', '1750.000000', '200.000000', '1950.000000', '1950.000000', '0.000000', 2),
(2, 2, '2021-03-27', '20:11:25', 'Paciente de ejemplo final', '33', '156', '33', '<p>esto es una prueba para validar status y mensajes<br></p>', '<p>blablabla    <br></p>', 'no', 'no', 'no', 'no', 'no', 'no', 'si', 'si un poco', 'ninguno detectado', 'tal vez algo que no recuerdo', 'si rodilla a los 13 años, inicios de 1996', 'nunca y tal vez nunca lo haga aun no se', 'si hombro hace 8 y 14 años', 'a todo sentimiento y a la sociedad en general', '1500.000000', '0.000000', '1500.000000', '1500.000000', '0.000000', 2);

-- --------------------------------------------------------

--
-- Table structure for table `urgencias_servicios`
--

CREATE TABLE `urgencias_servicios` (
  `id` int(10) NOT NULL,
  `urgencia_id` int(10) NOT NULL,
  `servicio_id` int(10) DEFAULT NULL,
  `pago_id` int(10) DEFAULT NULL,
  `fecha_servicio` date DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `cantidad` int(10) DEFAULT NULL,
  `precio` decimal(20,6) DEFAULT NULL,
  `iva` decimal(20,6) DEFAULT NULL,
  `importe` decimal(20,6) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `urgencias_servicios`
--

INSERT INTO `urgencias_servicios` (`id`, `urgencia_id`, `servicio_id`, `pago_id`, `fecha_servicio`, `descripcion`, `cantidad`, `precio`, `iva`, `importe`, `status`) VALUES
(1, 1, 0, 8, '2021-03-27', 'Primera prueba', 1, '400.000000', '64.000000', '464.000000', 2),
(2, 1, NULL, 7, '2021-03-27', 'segunda prueba', 3, '150.000000', '72.000000', '522.000000', 2),
(3, 1, 4, 7, '2021-03-27', 'Oxigeno en lata', 1, '500.000000', '0.000000', '500.000000', 2),
(4, 1, 0, 8, '2021-03-27', 'Ingreso por urgencia', 1, '400.000000', '64.000000', '464.000000', 2),
(5, 2, 4, 10, '2021-03-27', 'Oxigeno en lata', 1, '500.000000', '0.000000', '500.000000', 2),
(6, 2, 0, 9, '2021-03-31', 'captra manual cobrada', 5, '200.000000', '0.000000', '1000.000000', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
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
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `rol`, `asistente_id`, `medico_id`, `enfermera_id`, `paciente_id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `time_login`, `online`, `status`) VALUES
(1, 1, 0, 0, 0, 0, 'Administrador', 'admin@app.com', '$2y$10$E14A0D/2f3uCFPMEod5rV.x11ZdLO45eKccC2Zzbs7bBloo9bmzzK', 'ajcbeiPmJdlV3bpgGdNKrhlUFhJQNwS8Ica8vBIQHFXbxzEoE1wb21KcukOZ', NULL, '2020-07-24 01:38:27', '2020-07-23 20:38:27', 1, 1),
(2, 2, 0, 1, 0, 0, 'Demostrativo Doctor', 'demodoctor@app.com', '$2y$10$t1pZR1Sf9tdq7yv9uap/.usgyqhFpbM3vHqKOFogK8Iy.U6noxev2', 'cIhpTQbqSkiJjHAaVCEydYIU0IILqbRpgDT2WVbzDypYP86ZVsPTzbfwMkrE', NULL, '2020-09-27 05:00:00', NULL, 0, 1),
(3, 2, 0, 2, 0, 0, 'Doctora de ejemplo', 'doctora@app.com', '$2y$10$RcLc9lO7db89WL7tiJuel.EI3mG5nhNgNvfvyZu5zCMd98fj3ZRSi', 'dBZkQMnuelOQVglJ3ZALm9LGuaLPOofZZHwCiEITanlyxdZ3jghZnMr6Bj4F', NULL, NULL, NULL, 0, 1),
(4, 3, 0, 0, 1, 0, 'Usuario Enfermera Demo', 'demoenfermera@app.com', '$2y$10$/SrzDaC0I0A7mamJuUg2/OtbLr53pvQJdQA/DC7jw7yFsKu/np10m', NULL, NULL, NULL, NULL, 0, 1),
(5, 1, 0, NULL, NULL, NULL, 'Usuario Root adicional', 'root@app.com', '$2y$10$Ywo6vTyclnEy/7sEubzlC.DHqImNUoK6qraHWdfFT0rV8RX4wa/ES', NULL, '2020-09-27 05:00:00', NULL, NULL, 0, 1),
(6, 2, 2, 0, 0, 0, 'Marisol Navarro Martinez', 'ketsura@gmail.com', '$2y$10$/8Ww31aBpz8NelsRhlSzoef2aeEp.8RyOhC6e/TnKmV2Px62NRwwa', '33v6y0wwA0nijOwCoEiPIMl2NaCPSF6umgMH27xIkE3ZaUqdesQkVdzEuXnC', NULL, NULL, NULL, 0, 1),
(8, 2, 0, 3, 0, 0, 'Sergio Garduño Gomez', 'garduno@app.com', '$2y$10$ldh34qI4m8XFNQPmWLW4VeHs.VK.A9X0Go./kTUQzSAOuiVCwi.2e', NULL, NULL, NULL, NULL, 0, 1),
(9, 1, 0, 0, 0, 0, 'super vendedor', 'superventas@app.com', '$2y$10$fM6g/ClCMWUpfItR3fN.RuzYbgAOmPOWS26q.7bGdFgqs2WixYTva', NULL, '2021-01-14 06:00:00', '2021-01-14 06:00:00', NULL, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asistentes`
--
ALTER TABLE `asistentes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consultorios`
--
ALTER TABLE `consultorios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cuartos`
--
ALTER TABLE `cuartos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enfermeria`
--
ALTER TABLE `enfermeria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farmacia`
--
ALTER TABLE `farmacia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitalizacion`
--
ALTER TABLE `hospitalizacion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitalizacion_servicios`
--
ALTER TABLE `hospitalizacion_servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pacientes_asignacion`
--
ALTER TABLE `pacientes_asignacion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recetas_detalle`
--
ALTER TABLE `recetas_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `rol_detalle`
--
ALTER TABLE `rol_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signos_vitales`
--
ALTER TABLE `signos_vitales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urgencias`
--
ALTER TABLE `urgencias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urgencias_servicios`
--
ALTER TABLE `urgencias_servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asistentes`
--
ALTER TABLE `asistentes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `consultorios`
--
ALTER TABLE `consultorios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cuartos`
--
ALTER TABLE `cuartos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `enfermeria`
--
ALTER TABLE `enfermeria`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `farmacia`
--
ALTER TABLE `farmacia`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hospitalizacion`
--
ALTER TABLE `hospitalizacion`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `hospitalizacion_servicios`
--
ALTER TABLE `hospitalizacion_servicios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pacientes_asignacion`
--
ALTER TABLE `pacientes_asignacion`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `recetas`
--
ALTER TABLE `recetas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `recetas_detalle`
--
ALTER TABLE `recetas_detalle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rol_detalle`
--
ALTER TABLE `rol_detalle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
--
-- AUTO_INCREMENT for table `signos_vitales`
--
ALTER TABLE `signos_vitales`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `urgencias`
--
ALTER TABLE `urgencias`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `urgencias_servicios`
--
ALTER TABLE `urgencias_servicios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
