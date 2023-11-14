-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-09-2022 a las 19:20:42
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clinica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambulancias`
--

CREATE TABLE `ambulancias` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `servicio` varchar(250) DEFAULT NULL,
  `unidad` varchar(250) DEFAULT NULL,
  `chofer` varchar(250) DEFAULT NULL,
  `enfermera` varchar(250) DEFAULT NULL,
  `medico` varchar(250) DEFAULT NULL,
  `paciente` varchar(250) DEFAULT NULL,
  `acompanante` varchar(250) DEFAULT NULL,
  `diagnostico` varchar(250) DEFAULT NULL,
  `origen` varchar(250) DEFAULT NULL,
  `destino` varchar(250) DEFAULT NULL,
  `comentario` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ambulancias`
--

INSERT INTO `ambulancias` (`id`, `fecha`, `servicio`, `unidad`, `chofer`, `enfermera`, `medico`, `paciente`, `acompanante`, `diagnostico`, `origen`, `destino`, `comentario`, `status`) VALUES
(1, '2022-04-22', 'hospital florencia', '001', 'hugo', 'blanca', 'rodrigo', 'juan', 'hija', 'fractura', 'cemi', 'toluca', 'sin comentaqrios', 0),
(2, '2022-06-03', 'Visita a PetStar', '019', 'TUM-B Edgar Allan Olguin Rossano', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Centro de Especialidades Médicas Ixtlahuaca', 'Carretera libre Toluca- Atlacomulco km 1.5 Parque industrial Cayetano, 50295.', 'Visita a entrega de facturas a empresa de reciclaje PetStar.', 0),
(3, '2022-06-06', 'Traslado Programado', '019', 'TUM-B Edgar Allan Olguin Rossano', 'Fatima, Blanca, Magali', 'Dr. Rodrigo Rodriguez', 'Roman Hernandez Monroy', 'N/A', 'Síndrome isquémico coronario', 'Centro de Especialidades Médicas Ixtlahuaca', 'Hospital Florencia; Paseo General Vicente Guerrero #205. Toluca, Estado de México.', 'Se traslada a paciente a Hospital Florencia, ubicado en Toluca Estado de México,  para ingresarlo a procedimiento médico, con retorno a CEMI el mismo día. Con fecha 11 de Abril del 2022', 1),
(4, '2022-06-06', 'Traslado Programado', '019', 'TUM-B Edgar Allan Olguin Rossano', 'Blanca', 'Dr. Gerardo Miranda', 'Lizbeth Gladis Treviño Cruz', 'Pareja', 'Pancreatitis', 'Centro de Especialidades Médicas Ixtlahuaca', 'Consultorio del Dr. Miranda en Prolongación Tenancingo #508, Col. Sor Juana Inés de la Cruz', 'Se traslada a paciente, al consultorio del Doctor Miranda, al municipio de Toluca para realizar procedimiento médico,  regresando a la paciente ese mismo día 13 de Abril del 2022', 1),
(5, '2022-06-06', 'Traslado Programado', '019', 'Rubén Herrera', 'TUM-B Edgar Allan Olguin Rossano', 'Dr. Rodrigo Rodriguez', 'Roman Hernandez Monroy', 'Adelia Monroy Gonzales (Esposa de paciente)', 'Síndrome isquémico coronario', 'Centro de Especialidades Médicas Ixtlahuaca', 'Emiliano Zapata-Ixtlahuaca de Rayón', 'Se traslada a su domicilio del paciente por alta medica por mejoría de salud. Solicitando el apoyo del vigilante en turno Rubén Herrera para fungir como chofer de la unidad medica ambulancia. El día 15 de Abril del 2022', 1),
(6, '2022-06-06', 'Traslado Programado', '019', 'TUM-B Edgar Allan Olguin Rossano', 'Fatima', 'Dr. Rodrigo Rodriguez', 'Refugio Cruz Félix', 'Familiar', 'Diabetes Mellitus, Hipertensión Arterial.', 'Centro de Especialidades Médicas ixtlahuaca', 'Centro Médico Lic. Adolfo López Mateos; Avenida Doctor Nicolás San Juan S/N. 50010 Toluca de Lerdo, Estado de México', 'Se traslada a petición de familiares al paciente a instalaciones del Centro Médico Lic. Adolfo López Mateos.  Abriendo recepción hospitalaria el Dr. Rodrigo Rodríguez. El día 24 de Abril del 2022.', 1),
(7, '2022-06-07', 'Colecta de concentrados eritrocitarios', '019', 'TUM-B Edgar Allan Olguin Rossano', 'N/A', 'Dr. Rodrigo Rodriguez', 'Leticia Diaz Arriaga', 'N/A', 'Coagulopatia', 'Centro de Especialidades Médicas Ixtlahuaca', 'Centro Médico Lic. Adolfo López Mateos; Avenida Doctor\r\nNicolás San Juan S/N. 50010 Toluca de Lerdo, Estado de\r\nMéxico', 'Se asiste a la colecta de concentrados eritrocitarios solicitados por el médico tratante, el día 25 de Abril del 2022.', 1),
(8, '2022-06-07', 'Traslado Programado', '019', 'TUM-B Edgar Allan Olguin Rossano', 'Enfermera Familiar', 'Dr. Rodrigo Rodriguez', 'María del Socorro Castillo Velazco', 'Sobrina (enfermera)', 'Colecistitis crónica y choque séptico', 'Centro de Especialidades Médicas Ixtlahuaca', 'Jocotitlán, Estado de México.', 'Se apoya con traslado a domicilio de la paciente por alta medica, causa de mejoría de salud. El día 02 de Mayo del 2022.', 1),
(9, '2022-06-07', 'Traslado Programado', '019', 'TUM-B Edgar Allan Olguin Rossano', 'Itzel Cruz Maldonado', 'Dr. José Alberto Vivero', 'Estefanía Gonzales Gonzales', 'Madre de paciente', 'Pancreatitis', 'Centro de Especialidades Médicas Ixtlahuaca', 'San Francisco Cheje, Estado de México.', 'Por alta medica debido a su mejoría de estado de salud, se traslada a paciente a su domicilio. El día 19 de Mayo del 2022.', 1),
(10, '2022-06-07', 'Servicio Especial', '019', 'TUM-B Edgar Allan Olguin Rossano', 'Adriana Olivera Morales', 'Dr. José Alberto Vivero', 'N/A', 'Enfermera  Adriana Olvera Morales', 'N/A', 'Centro de Especialidades Médicas Ixlahuaca', 'Universidad Ixtlahuaca CUI', 'Se pide el servicio preventivo de ambulancia para cobertura de obra de teatro en universidad Ixtlahuaca CUI. El día 19 de Mayo del 2022.', 1),
(11, '2022-06-07', 'Servicio Especial', '019', 'Jonathan López Cruz', 'Adriana Olivera Morales', 'Dr. José Alberto Vivero', 'N/A', 'N/A', 'N/A', 'Centro de Especialidades Médicas Ixtlahuaca', 'Universidad Ixtlahuaca CUI', 'Se solicita el apoyo del operador Jonathan López Cruz para la cobertura de la obra de teatro en Universidad Ixtlahuaca el día 20 de Mayo del 2022, en ausencia del TUM-B Edgar Allan Olguin Rossano.', 1),
(12, '2022-06-07', 'Visita a PetStar', '019', 'TUM-B Edgar Allan Olguin Rossano', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Centro de Especialidades Médicas Ixtlahuaca', 'Carretera Libre Toluca - Atlacomulco Km. 1.5, Parque Industrial Cayetano, 50295 Almoloya de Juárez, Estado de México  27.4 km', 'Se visita la empresa de reciclaje PetStar, para firma de documentos. El día 03 de Junio del 2022.', 1),
(13, '2022-06-07', 'Traslado Programado de Urgencia', '019', 'TUM-B Edgar Allan Olguin Rossano', 'Itzel Cruz Maldonado, Blanca Esthela Martínez Roque', 'Dr. José Alberto Vivero', 'Reyna Guzmán Bernardino', 'Esposo de paciente', 'DIAGNOSTICOS SINDROMATICOS \r\n-	CHOQUE MIXTO \r\n-	TROMBOSIS MESENTERICA PROBABLE \r\n-	ACIDOSIS METABOLICA \r\n-	OBESIDAD GRADO III \r\n-	LESION RENAL AGUDA AKIN II', 'Centro de Especialidades Médicas Ixtlahuaca', 'IMSS Clínica 220, Paseo Tollocan s/n, 50180 Toluca, Estado de México.', 'Se traslada a la unidad médica referida en calidad de urgencia por los diagnósticos, signos y síntomas presentes en la paciente. El día 06 de Junio del 2022.', 1),
(14, '2022-06-07', 'Traslado Programado', '019', 'TUM-B Edgar Allan Olguin Rossano', 'Angelica Cruz Flores', 'Dr. Rodrigo Rodriguez', 'Dionosio Davila Cardelas', 'Esposa de paciente', 'Trauma cerrado de abdomen', 'Centro de Especialidades Médicas Ixtlahuaca', 'Santiago Yeche, Estado de México', 'Se traslada a paciente a su domicilio por alta medica. El día 31 de Mayo del 2022.', 1),
(15, '2022-06-14', 'Traslado Programado', '019', 'Rubén Herrera', 'Angelica Cruz Flores', 'Dr. Rodrigo Rodriguez', 'Williams Mendoza Martinez', 'Madre de paciente', 'Fractura de :\r\n-Fémur izquierdo\r\n-Humero derecho', 'Centro de Especialidades Médicas Ixtlahuaca', 'San Miguel Enyege, Ixtlahuaca de Rayon, Estado de México.', 'Se brinda traslado a paciente por mejoría de salud a su domicilio. EL día 13 de Junio del 2022.', 1),
(16, '2022-06-24', 'Traslado Programado', '019', 'TUM-B Edgar Allan Olguin Rossano', 'N/A', 'Dr. Rodrigo Rodríguez y Dr. Sánchez', 'Williams Mendoza Martinez', 'Nancy Mendoza (hermana de paciente)', 'Consulta por cita médica', 'Dolores Enyege, domicilio conocido.', 'Centro de Especialidades Médicas Ixtlahuaca', 'Por indicación del doctor Sánchez se le brinda al paciente el servicio de ambulancia para trasladarlo a la instancia médica para sus consultas con los médicos tratantes.  24/06/2022.', 1),
(17, '2022-06-27', 'Traslado Programado', '019', 'TUM-B Edgar Allan Olguin Rossano', 'N/A', 'Dr. Rodrigo Rodriguez y Dr Sánchez', 'Williams Mendoza Martinez', 'Nancy Mendoza (hermana de paciente)', 'Retiro de puntos y consulta médica', 'Centro de Especialidades Médicas Ixtlahuaca', 'Dolores Enyege, domicilio conocido', 'Por indicación del Dr. Sánchez se apoya con el servicio de ambulancia al paciente mencionado para valoraciones médicas y retiro de puntos. Se realizan traslados solicitados el día 24 de Junio del 2022.', 1),
(18, '2022-07-01', 'Urgencia', '019', 'TUM-B Edgar Allan Olguin Rossano', 'N/A', 'Dr. José Alberto Vivero', 'Johana Guadalupe Jiménez Gonzales', 'Compañera de trabajo', 'Probable crisis neuro conversiva', 'Centro comercial Bugambilias, Calle Nicolás Bravo Sn, 50740 Ixtlahuaca, México', 'Centro de Especialidades Médicas Ixtlahuaca', 'Se activa al persona prehospitalario para valoración de una femenina de 22 años quien es trasladada a CEMI para valoración médica a petición de directivos de la empleada, el día 30/06/2022.', 1),
(19, '2022-07-13', 'De Urgencia', '019', 'TUM-B Edgar Allan Olguin Rossano', 'N/A', 'Sagrario Gonzales (Medico receptor)', 'Mario Fernando Pérez Hernández', 'N/A', 'Traumatismo por caída de aproximadamente 5 metros de altura, dolor y crepitación de cresta iliaca izquierda y abdomen rígido y doloroso en fosa iliaca izquierda.', 'Universidad Ixtlahuaca CUI', 'Centro de Especialidades Médicas Atlacomulco', 'Se atiende siniestro donde caen al menos 3 personas de una altura aproximadamente de 5 metros, al arribo se reciben dos pacientes mismos que se abordan a la ambulancia; se valoran y canalizan a ambos pacientes cediendo uno a PC I.', 1),
(20, '2022-07-15', 'Traslado Programado', '019', 'TUM-B Edgar Allan Olguin Rossano', 'N/A', 'Dr. Rodrigo Rodriguez', 'José Luciano Bernal', 'Jovita Luciano Martínez', 'insuficiencia renal crónica.', 'Centro de Especialidades Médicas Ixtlahuaca.', 'La Concepción de los baños, Ixtlahuaca de Rayón.', 'Se brinda el servicio de ambulancia al paciente para traslado a su domicilio en calidad de gratuito por alta medica.', 1),
(21, '2022-07-18', 'Traslado Programado', '019', 'TUM-B Edgar Allan Olguin Rossano', 'Mayra Mauro Rangel', 'Dr. Rodrigo Rodriguez', 'Yazmin Hernandez Rivera', 'Juan Hernández Senobio', 'Abdomen agudo post traumático, choque hipovolémico post operación (laparotomía exploratoria)', 'Centro de Especialidades Médicas Ixtlahuaca', 'Santo Domingo de Guzmán, Ixtlahuaca de Rayón', 'Se brinda el traslado con la unidad ambulancia a la paciente referida, por alta médica.', 1),
(22, '2022-08-16', 'Traslado Programado de Urgencia', '019', 'TUM-B Edgar Allan Olguin Rossano', 'Jaqueline López Tapia', 'Dr. Benjamin Medina Miranda', 'Paris Leon Rosas', 'Madre de la paciente.', 'Probable traumatismo craneoencefálico moderado', 'Hospital de Jesús, Sanfelipe Santiago, Municipio de Jiquipilco', 'Clinica IMSS 235, Municipio de Atlacomulco Estado de México', 'Se apoya con la unidad ambulancia a un traslado intrahospitalario en calidad de urgencia, por prioridad y gravedad de la paciente, brindando el servicio sin novedad alguna.', 1),
(23, '2022-08-26', 'Servicio Especial', '019', 'TUM-B Edgar Allan Olguin Rossano', 'Ramirez Flores Lorena', 'N/A', 'N/A', 'N/A', 'Cobertura de servicio Especial', 'Centro de Especialidades Médicas Ixtlahuaca, Avenida Vicente Guerrero #207, Ixtlahuaca de Rayón, Estado de México', 'Universidad Ixtlahuaca CUI, km 1 carretera Ixtlahuaca Jiquipilco, 50740 Ixtlahuaca de Rayón, Estado de México', 'Se brinda cobertura de servicio Especial en universidad Ixtlahuaca.', 1),
(24, '2022-08-31', 'Atención médica a domicilio', '019', 'TUM-B Edgar Allan Olguin Rossano', 'Angelica Cruz Flores e Itzel Cruz Maldonado', 'Dr. Rodrigo Rodriguez', 'Juan Dionicio Morales.', 'N/A', 'Supresión Etílica', 'Centro de Especialidades Médicas Ixtlahuaca, Av. Vicente Guerrero #207, Ixtlahuaca de Rayón, Estado de México', 'Municipio de Jiquipilco, Estado de México, Domicilio conocido.', 'Se activa a personal de ambulancia y enfermería para brindar atención médica a domicilio bajo la coordinación, observación y supervisión del médico tratante, el día 30 de Agosto del 2022.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistentes`
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
-- Volcado de datos para la tabla `asistentes`
--

INSERT INTO `asistentes` (`id`, `nombre`, `celular`, `rfc`, `curp`, `honorarios`, `domicilio`, `fotografia`, `doctores`, `status`) VALUES
(1, 'Usuario Enfermera Demo', '7412589635', '', '', '0.000000', '', '', '', 1),
(2, 'Marisol Navarro Martinez', '', '', '', '0.000000', '', NULL, '1,2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
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
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `paciente_id`, `consultorio_id`, `medico_id`, `enfermera_id`, `fecha`, `hora`, `comentarios`, `status`) VALUES
(1, 1, 0, 6, 0, '2022-01-27', '11:00:00', 'COVID + NEUMONIA', 0),
(2, 3, 0, 8, 0, '2022-01-19', '01:00:00', 'Pedir radiografía', 0),
(3, 7, 0, 7, 0, '2022-05-04', '07:00:00', 'ANGINAS', 0),
(4, 9, 0, 7, 0, '2022-05-04', '02:30:00', 'OK', 0),
(5, 9, 0, 7, 0, '2022-05-04', '03:00:00', 'POK', 0),
(6, 9, 0, 7, 0, '2022-05-04', '04:00:00', 'OK', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(10) NOT NULL,
  `estado` varchar(150) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `clave` varchar(150) NOT NULL,
  `valor` longtext NOT NULL,
  `serializado` int(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `estado`, `tipo`, `clave`, `valor`, `serializado`, `status`) VALUES
(1, '', 'config', 'empresa_nombre', 'AIzaSyBa6o5XiRIAx4ng68PCAsKNKKwFXQnW2uM', 0, 1),
(2, '', 'config', 'empresa_direccion', 'San francisco 12 la herradura, Cordoba veracruz 94470', 0, 1),
(3, '', 'config', 'empresa_logo', 'Posicion origen en el mapa', 0, 1),
(4, '', 'config', 'empresa_rfc', 'Posicion origen en el mapa', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id` int(10) NOT NULL,
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
  `tratamiento` longtext DEFAULT 'NUL',
  `recomendaciones` longtext DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id`, `cita_id`, `paciente_id`, `doctor_id`, `enfermera_id`, `signos_id`, `fc`, `fr`, `temperatura`, `peso`, `talla`, `ta1`, `ta2`, `sato2`, `costo`, `fecha`, `razon_visita`, `diagnostico`, `tratamiento`, `recomendaciones`, `status`) VALUES
(1, 0, 1, 6, 0, 0, '0', '17', '36', '80', '0', '120', '0', '95', '0.000000', '2022-01-17', 'paciente quien se encuentra de pre alta&nbsp;', '<p>neumonia&nbsp;</p>', 'NUL', '', 1),
(2, 1, 1, 6, 0, 0, '0', '0', '0', '0', '0', '0', '0', '0', '0.000000', '2022-01-17', '<p>FXGHSGHSFGH</p>', '<p>SDFHGDHJGJ</p>', 'NUL', '', 1),
(3, 0, 1, 6, 0, 0, '78 X MIN', '17', '36', '80', '165', '120', '70', '95', '0.000000', '2022-01-17', '<p>DIEGNOSTICOS DE&nbsp; INGRESO:</p><p>- NEUMONIA&nbsp; POR COVID 19 POSIBLEMENTE VARIANTE OMICRON&nbsp;</p><p>- SINDROME DE DESLIZAMIENTO SENIL&nbsp;</p><p>-&nbsp;</p>', '<p>DIEGNOSTICOS DE&nbsp; INGRESO:</p><p>- NEUMONIA&nbsp; POR COVID 19 POSIBLEMENTE VARIANTE OMICRON&nbsp;</p><p>- SINDROME DE DESLIZAMIENTO SENIL&nbsp;</p><p>-&nbsp;</p>', 'NUL', '', 1),
(4, 0, 3, 8, 0, 0, '0', '0', '0', '0', '0', '0', '0', '0', '0.000000', '2022-01-17', '<p>XXXX</p>', '<p>XXXXX</p>', 'NUL', '', 0),
(5, 0, 2, 4, 0, 0, '0', '0', '0', '0', '0', '0', '0', '0', '0.000000', '2022-01-17', '<p>MKMLMÑLÑLM<br></p>', '<p>POKOKPOK<br></p>', 'NUL', '', 1),
(6, 0, 3, 7, 0, 0, '0', '0', '0', '0', '0', '0', '0', '0', '0.000000', '2022-01-24', '<p>5151<br></p>', '<p>51132<br></p>', 'NUL', '', 0),
(7, 0, 8, 7, 0, 0, '0', '0', '0', '0', '0', '0', '0', '0', '0.000000', '2022-01-27', '<p>KÑOLKLKMLK<br></p>', '<p>KPOKPOKPOK<br></p>', '<p>KPOPKPOKPOK<br></p>', '', 0),
(8, 0, 3, 8, 0, 0, '87', '23', '36', '84', '0', '110', '85', '90', '0.000000', '2022-05-02', '<p>Tos desde hace 4 días</p>', '<p>Faringitis</p>', '<p>AMPLIRON DUO cada 12 horas 7 días</p>', '', 0),
(9, 0, 3, 8, 0, 0, '0', '0', '0', '0', '0', '0', '0', '0', '0.000000', '2022-05-03', '<p>fiebre</p>', '<p>por comer</p>', '<p>melox</p>', '', 0),
(10, 0, 7, 7, 0, 0, '84', '55', '36', '84', '189', '80', '120', '96', '0.000000', '2022-05-04', '<p>aspirina<br></p>', '<p>fiebre<br></p>', '<p>aspirinas<br></p>', '', 0),
(11, 0, 7, 7, 0, 0, '85', '55', '96', '84', '189', '80', '120', '96', '0.000000', '2022-05-04', '<p>FIEBRE</p>', '<p>COMER</p>', '<p>FEBRAX</p>', '', 0),
(12, 0, 7, 7, 0, 0, '10', '10', '10', '10', '178', '90', '120', '98', '0.000000', '2022-05-04', '<p>CASA</p>', '<p>CASA2</p>', '<p>ASPIRIN</p>', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultorios`
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
-- Volcado de datos para la tabla `consultorios`
--

INSERT INTO `consultorios` (`id`, `numero`, `descripcion`, `medico_id`, `enfermera_id`, `dia_laboral`, `hora_inicio`, `hora_fin`, `status`) VALUES
(1, '123', 'Consultorio Puerta Cafe', 1, 0, 'Lunes', '08:00 AM', '09:00 PM', 1),
(2, '03', 'Nefro', 1, 1, 'Miercoles', '9:00', '7:30', 1),
(3, '04', 'Angeologia', 1, 1, 'Martes', '1:00', '9:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuartos`
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
-- Volcado de datos para la tabla `cuartos`
--

INSERT INTO `cuartos` (`id`, `numero`, `descripcion`, `amenidades`, `equipo`, `costo_dia`, `status`) VALUES
(1, '01', 'Habitacion Estandar HP01', 'Sala, comedor, cunero', 'Oxigeno\r\nCama Matrimonial clinica', '650.000000', 2),
(2, 'A23', 'Suite Ejecutiva', 'Refrigerador de Snaks\r\nSala de espera \r\nMesa de centro\r\nClima', 'Oxigeno\r\nConsola de Signos Vitales', '1550.230000', 2),
(3, '02', 'Basica Sencilla', 'Mesa de centro\r\nSillon de Visitas', 'Ninguno\r\nCama Clinica', '500.000000', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
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
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `nombre`, `impuesto`, `direccion`, `colonia`, `estado`, `ciudad`, `cp`, `correo`, `telefono`, `celular`, `hospedaje`, `hospedaje_iva`, `twitter`, `facebook`, `instagram`, `logotipo`, `status`) VALUES
(1, 'Centro Medico Ixtlahuaca', '16.000000', 'Calle Gral. Vicente Guerrero #207, San Joaquin', '', 'Estado de Mexico', 'Ixtlahuaca', '50740', '', '7122830652 y 7122834616', '', 'Servicio de Habitacion, hospitalizacion', 1, 'twitter.com', 'facebook.com', 'instagram.com', '1642441387_logo final.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermeria`
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `farmacia`
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
  `solicitado` longtext DEFAULT NULL,
  `comentarios` longtext DEFAULT NULL,
  `status` int(1) NOT NULL COMMENT '1: solicitada, 2: surtida'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `farmacia_detalle`
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
-- Estructura de tabla para la tabla `hospitalizacion`
--

CREATE TABLE `hospitalizacion` (
  `id` int(10) NOT NULL,
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
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospitalizacion_servicios`
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
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
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE `laboratorio` (
  `id` int(10) NOT NULL,
  `orden_id` int(10) NOT NULL,
  `paciente_id` int(10) NOT NULL,
  `medico_id` int(10) NOT NULL,
  `enfermera_id` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `diagnostico` longtext DEFAULT NULL,
  `archivo` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `laboratorio`
--

INSERT INTO `laboratorio` (`id`, `orden_id`, `paciente_id`, `medico_id`, `enfermera_id`, `fecha`, `nombre`, `diagnostico`, `archivo`, `status`) VALUES
(1, 0, 2, 4, 0, '2022-01-27', 'analisis demo', '<p>esto es una prueba de analisis demo<br></p>', NULL, 1),
(2, 0, 7, 7, 0, '2022-01-30', 'Prueba finak', 'analisis final para pruebas<br>', NULL, 0),
(3, 0, 8, 7, 0, '2022-02-03', 'php', '<p>lkmlkmlkm<br></p>', NULL, 0),
(4, 0, 7, 7, 0, '2022-02-03', 'prueba2', '<p>mklmñlmñ<br></p>', NULL, 0),
(5, 0, 7, 7, 0, '2022-02-21', 'colon', '<p>gfdfdfdf<br></p>', NULL, 0),
(6, 0, 7, 7, 0, '2022-03-02', 'vih', '<p>gdfgdgfgdfgfg<br></p>', NULL, 0),
(7, 0, 7, 7, 0, '2022-03-14', 'ESTUDIOS REGISTRADOS', '<p>FXGBFFG<br></p>', NULL, 0),
(8, 0, 7, 7, 0, '2022-04-18', 'TOMA SANGRE', '<p>KDFDJSIFHSDKLFDFDFJFKLF</p><p><br></p><p>JDNFJDSFSLKS</p>', NULL, 0),
(9, 0, 3, 8, 0, '2022-05-02', 'BH', '<p>LINFOCITOS 15,000</p>', NULL, 0),
(10, 0, 3, 8, 0, '2022-05-03', 'php', '<p>sangre</p>', NULL, 0),
(11, 0, 7, 7, 0, '2022-05-04', 'ULTIMA PRUEBA', '<p>XCXVXCVCC 123</p>', NULL, 0),
(12, 0, 7, 7, 0, '2022-05-04', 'ULTIMA PRUEBA', '<p>OK ESTA</p>', NULL, 0),
(13, 0, 7, 7, 0, '2022-05-04', 'PHP', '<p>PHP5</p>', NULL, 0),
(14, 0, 7, 7, 0, '2022-05-04', 'VV', '<p>AA</p>', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
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
-- Estructura de tabla para la tabla `medicos`
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
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`id`, `nombre`, `especialidad`, `celular`, `rfc`, `cedula`, `curp`, `honorarios`, `domicilio`, `fotografia`, `status`) VALUES
(1, 'Doctor Demo', 'Medicina General', '7412589635', 'XXXX999999X9X', '123456878', '', '850.000000', '', '1601122328_d1.jpg', 0),
(2, 'Doctora de ejemplo', 'Neurologia', '14785236987', '', '', '', '380.000000', '', '1601245349_4.jpg', 0),
(3, 'Sergio Garduño Gomez', 'Neurologia', '5537430480', '', '', '', '450.000000', '', NULL, 0),
(4, 'Jose Alberto Vivero Garay', 'medico cirujano', '7223896974', '', '11816611', '', '0.000000', '', NULL, 1),
(5, 'miguel', 'general', '7122110329', '', '3453455345', '', '0.000000', 'conocido', NULL, 1),
(6, 'RODRIGO RODRIGUEZ CARRANZA', 'MEDICINA DE URGENCIAS', '7221009138', 'ROCR780927216', '4755527-ESP 09181201', 'ROCR780927HDFDRD02', '0.000000', 'VICENTE GUERRERO 207 COL. CENTRO IXTLAHUACA MEXICO', '1642431782_IMG_20200628_185608.jpg', 1),
(7, 'doc prueba', 'oto', '7122110328', '', '6565654564', '', '0.000000', '', NULL, 1),
(8, 'MARCIAL FLORES TRUJILLO', 'DIABETOLOGO', '7122834616', 'FOTM561011', '625242', 'FOTM561011HMCLRR11', '0.000000', 'VICENTE GUERRERO NÚM. 209 COL. CENTRO IXTLAHUACA EDO. DE MÉXICO', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
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
-- Volcado de datos para la tabla `modulos`
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
(10, NULL, 0, 'Laboratorio', 'admin/laboratorio', 'fa-flask', 14, 1),
(11, NULL, 0, 'Consulta', 'admin/consultas', 'fa-stethoscope', 11, 1),
(12, NULL, 0, 'Recetas', 'admin/recetas', 'fa-file-pdf-o', 15, 1),
(13, NULL, 0, 'Roles y Permisos', 'admin/roles', 'fa-sitemap', 17, 1),
(14, NULL, 0, 'Usuarios', 'admin/users', 'fa-key', 18, 1),
(15, NULL, 0, 'Asistentes', 'admin/asistentes', 'fa-user-secret', 4, 1),
(16, NULL, 0, 'Pagos', 'admin/pagos', 'fa-credit-card', 10, 1),
(17, NULL, 0, 'Configuracion', 'admin/empresas', 'fa-cogs', 16, 1),
(18, NULL, 7, 'Hospitalizacion', 'admin/servicios/?scope=1', 'fa-bed', 1, 1),
(19, NULL, 7, 'Urgencias', 'admin/servicios/?scope=2', 'fa-ambulance', 1, 1),
(20, NULL, 0, 'Urgencias', 'admin/urgencias', 'fa-h-square', 13, 1),
(21, NULL, 0, 'Ambulancias', 'admin/ambulancias', 'fa-ambulance', 14, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
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
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id`, `medico_id`, `paciente_id`, `fecha`, `hora`, `tipo`, `nota_medica`, `status`) VALUES
(1, 4, 2, '2022-01-17', '11:27:26', '1', '<p>KMLKÑKÑKOK<br></p>', 1),
(2, 6, 13, '2022-08-11', '11:45:19', '', '<p>ACUIDE&nbsp; A&nbsp; CONSULTA POR DESCOPNTROL METABOLICO PERSISTENTE</p><p>RETIRO METFORMINA&nbsp; DEJO PIOGLITAZONA&nbsp; DE 15 MG&nbsp;</p><p>INCREMENTO PREGABALINA A 300 AL DIA&nbsp;</p><p><br></p>', 1),
(3, 6, 9, '2022-08-16', '16:07:14', '3', '<p>medicamentos dobles<br></p>', 1),
(4, 6, 9, '2022-08-16', '16:08:42', '3', '<p>11122222<br></p>', 1),
(5, 6, 9, '2022-08-16', '16:13:18', '2', '<p>sfsdfsdfsdf<br></p>', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
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
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(10) NOT NULL,
  `propietario_id` int(10) DEFAULT NULL,
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
  `tratamiento` longtext DEFAULT NULL,
  `fc` varchar(50) DEFAULT NULL,
  `fr` varchar(50) DEFAULT NULL,
  `temperatura` varchar(50) DEFAULT NULL,
  `peso` varchar(50) DEFAULT NULL,
  `talla` varchar(50) DEFAULT NULL,
  `ta1` varchar(50) DEFAULT NULL,
  `ta2` varchar(50) DEFAULT NULL,
  `sato2` varchar(50) DEFAULT NULL,
  `fotografia` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `propietario_id`, `nombre`, `telefono`, `celular`, `domicilio`, `tsangre`, `sexo`, `nacimiento`, `alergias`, `hereditarias`, `cirugias`, `vicios`, `diagnostico`, `tratamiento`, `fc`, `fr`, `temperatura`, `peso`, `talla`, `ta1`, `ta2`, `sato2`, `fotografia`, `status`) VALUES
(1, 6, 'LIDIA LORENZA MALVAEZ CORTES', '', '7122354261', '', '', 'F', NULL, '<p>HIPERTENSA DE LARGA EVOLUCION,  CONTROLADA CON METOPROLOL 100 MG </p>', '<p><b>MOTIVO DE CONSULTA:  DISNEA </b></p><p><br></p>', '<p>LO INICIA HACE  3  DIAS CUANDO REFIERE   MALESTAR GENERAL  FIEBRE DISNEA Y  CIANOSISI  DESATURACION DE 68 %  MOTIVOS DE CONSULTA </p>', '<p>encuentro paciente senil  de  la novena decada de la vida </p>', '<p>neumonia </p>', NULL, '78 X MIN', '17', '36', '80', '165', '120', '70', '95', NULL, 1),
(2, 5, 'MIKE', '7122110329', '7122110329', '', '', 'M', NULL, '<p>SDFSD<br></p>', '<p>DF<br></p>', '<p>SDFS<br></p>', '<p>SDFSD<br></p>', '<p>SDFSD<br></p>', NULL, '12', '112', '36', '40', '15', '58', '60', '95', NULL, 1),
(3, 8, 'Miguel Ricaño Zamora', '', '1234567890', '', 'x', 'M', '2021-12-27', '', '', '', '', '', NULL, '0', '0', '0', '0', '0', '0', '0', '0', NULL, 0),
(4, 6, 'JOAQUIN HERNANDEZ GONZALEZ', '7121815753', '7121815753', 'ACULCO, ESTADO DE MEXICO', 'A+', 'M', '1969-12-31', '<p>INFARTO AL MIOCARDIO HACE 22 AÑOS&nbsp;</p>', 'ANTECEDENTES MADRE DIABETES.&nbsp;', '<p>.....</p>', '<p>.....</p>', '<p>...</p>', NULL, '68 x MIN', '68 X MIN', '36', '61', '165', '112', '58', '86', NULL, 1),
(5, 6, 'MARGARITA ORDOÑEZ MATIAS', '', '7122806402', 'SAN LORENZO MALACOTA, SAN BARTOLO MORELOS.', 'O+', 'F', '1969-12-31', '<p>....</p>', '<p>ANTECEDENTES DE HIPERTESION Y DIABETES POR MADRE&nbsp;</p>', '<p>.....</p>', '<p>.....</p>', '<p>.....</p>', NULL, '81 X MIN', '17', '36', '60', '1.39', '158', '97', '91', NULL, 1),
(6, 6, 'MARIA CARMEN GIL FLORES', '', '7121821699', 'SAN ANTONIO BONIXI, IXTLAHUCA MEXICO', 'O+', 'F', '1969-12-31', '<p>...</p>', '<p>...</p>', '<p>....</p>', '<p>...</p>', '<p>...</p>', NULL, '87', '17', '36', '47', '146', '112', '74', '94', NULL, 1),
(7, 7, 'PEPE', '7122110329', '7122110329', '', '', 'M', NULL, '<p>56++65+656<br></p>', '<p>5654545<br></p>', '<p>6545454<br></p>', '<p>54544545<br></p>', '<p>54544<br></p>', NULL, '0', '0', '0', '0', '0', '0', '0', '0', NULL, 0),
(8, 7, 'PEPITO', '7122110328', '7122110328', '', '', 'M', NULL, '<p>LPÑLÑL<br></p>', '<p>LLLPÑ<br></p>', '<p>KLPKPOPK<br></p>', '<p>KPOKPOK<br></p>', '<p>JIOJIJIL<br></p>', '<p>OKKJOK<br></p>', '0', '0', '0', '0', '0', '0', '0', '0', NULL, 0),
(9, 7, 'MIKE', '7122110329', '7122110329', 'COMOCIDO', 'O+', '', '1979-01-05', '<p>NINGUNO<br></p>', '<p>NINGUNO<br></p>', '<p>NINGUNO<br></p>', '<p>OK<br></p>', '<p>CALAMBRES<br></p>', '<p>PARACETAMOL<br></p>', '85', '85', '18.5', '84', '189', '80', '120', '96', NULL, 1),
(10, 6, 'JUAN JOSE BACILO APARICIO', '7121743754', '7121743754', 'SAN BARTOLO OXTITLAN JIQUPILCO MEXICO', 'SIN DATO', 'M', '1985-03-17', '<p>NEGADO </p>', '<p>NEGADO </p>', '<p>NEGADO </p>', '<p>.....</p>', '<p>.....</p>', '<p>.....</p>', '78', '93', '36', '58', '1.68', '126', '90', '93', NULL, 1),
(11, 6, 'JOSE LUIS MARTINEZ NIETO', '7228346959', '7228346959', 'EL ESTANCO SIN NUMERO DOMICILICIO CONOCIDO, ALMOLOYA DE JUAREZ', 'SIN DATO', 'M', '1969-12-31', '<p>DIABETES MELLITUS II&nbsp;</p><p><br></p>', '<p>NEGADO&nbsp;</p>', '<p>.</p>', '<p>.</p>', '<p>.</p>', '<p>.</p>', '88', '93', '36', '--', '--', '88', '60', '93', NULL, 1),
(12, 6, 'MOISES DAVILA RIVERA', '4426098120', '7122233003', 'CONOCIDO SAN FRANCISCO CHEJE JOCOTITLAN.', 'SIN DATO', 'M', '1969-12-31', '', '<p>NEGADO&nbsp;</p>', '', '', '', '', '87', '20', '36', '70', '167', '119', '59', '92', NULL, 1),
(13, 6, 'CATALINA FELIPE BERNAL', '', '7121743754', '', 'SIN DATO', 'F', '1950-02-02', '<p>ANTECEDENTES DE IMPORTANCIA&nbsp;</p><p>niega crónico degenerativos,&nbsp; quirúrgicos, histerectomía hace 20 años, transfusionales, traumáticos negados&nbsp; ALERGICA A PENICILINA.&nbsp;</p>', '<p>paciente quien acude por dolor en&nbsp; todo el cuerpo&nbsp; durante las noches, motivos de consulta&nbsp;</p><p><br></p><p><br></p>', '<p>PADECIMIENTO ACTUAL:&nbsp; hace 4 meses, refiere&nbsp; inicia dolor abdominal, acude&nbsp; con&nbsp; 2 consultas medicas,&nbsp; que mejora favorablemente, aparentemente sin alteración, sin embargo refiere un mes después iniciar&nbsp; dolor de extremidades, rodilla izquierda,&nbsp; refiere cefalea, ocasional que no amerita medicación,&nbsp; hace&nbsp; 45 días,&nbsp; refiere&nbsp; dolor terebrante,&nbsp; transfictivo, muscular, se asocia a tristeza desde hace 3 meses,&nbsp; insomnio de 30 días a la fecha&nbsp; refiere dormir&nbsp; 3 horas, refiere el dolor la despierta, rigidez matutina,&nbsp; refiere dolor lumbar importante,&nbsp; acudió a medico privado quien detecta&nbsp; hernia lumbar l4 l5,&nbsp;&nbsp;<br></p>', '<p>alerta despierrta orientada neurologicamente integra&nbsp; &nbsp;con craneo normcoefalo pupilkas isometricas de 3 mm adecuada respuesta aestimulos luminosos,&nbsp; cardiologico ruidos cardiacos ritmicos de buen tono e intensidad sin agregados, abdomen blando depresible sin megalias peristalsis presente, sin irritacion peritoneal,&nbsp; extremidades integras rots normales&nbsp;</p>', '<p>FIBROMIALGIA&nbsp;</p>', '<p>ADEPSIQUE TABLETAS 1 POR LA NOCHE&nbsp;</p><p>DOMINION DE 150 MG&nbsp; CADA 12 HORAS&nbsp;</p><p>CITA EN UNA SEMANA.&nbsp;</p>', '80', '20', '36', '60', '154', '108', '62', '92', NULL, 1),
(14, 6, 'SOFIA TRINIDAD GONZALEZ', '7122345217', 'MISMO', 'SAN BARTOLO DEL LLANO', 'SIN DATO', 'F', '1961-09-09', '<p>DIABETICA DESDE HACE&nbsp; 20 años, metformina 500mg, insulina lispro&nbsp; protamina 10 unidades&nbsp; en la mañana,&nbsp; suspendido hace 6 meses.</p><p>PATOLOGIA COVID&nbsp; 19 nov 2020,&nbsp;</p><p>vacunas&nbsp; 3 vacunas&nbsp; con astra seneca.&nbsp;</p><p><br></p><p><br></p>', '<p>PADRE DIABETICO FINADO ,&nbsp; POR COMPLICACIONES DE DIABETES&nbsp;</p>', '<p>descontrol glucémico de 3 meses, de evolución,&nbsp; refiere fatiga mareo, edema de pies, dolor ardoroso por las noches, distermias, motivos de consulta&nbsp;</p>', '<p>alerta despierta orientada&nbsp; palidez de tegumentos, cráneo normocéfalo con&nbsp; tórax amplexión amplexación conservados ruidos cardiacos rítmicos de buen tono e intensidad sin agregados, abdomen plano blando depresible sin megalias peristalsis presente&nbsp; extremidades con insuficiencia venosa periférica,&nbsp;</p>', '<p>descontrol metabolico&nbsp;</p><p>onicomicosis&nbsp;</p><p><br></p>', '<p>galvus met 50 / 1000 1 c 12&nbsp;</p><p>insulina lantus 10 unidades a las 19 hrs&nbsp;</p><p>dieta por nutricion.&nbsp;</p><p><br></p><p><br></p>', '78', '16', '36', '45', '1,48', '140', '77', '92', NULL, 1),
(15, 6, 'DANIELA FLORES MONTIEL', '7227890148', '7227890148', 'CONOCIDO SAN FELIPE DEL PROGRESO.', 'SIN DATO', '', '1969-12-31', '<p>ENFERMEDADES: NEGADAS</p><p>CIRUGIAS: NEGADAS&nbsp;</p><p>ALERGIAS: NEGADAS&nbsp;</p><p>TRAUMATICOS TRANSFUSIONALES NEGADOS&nbsp;</p><p><br></p><p>ANTECEDENTES GINECOBSTETRICOS:&nbsp; menarca a los 15 años,&nbsp; ciclos regulares de 28 x 5,&nbsp; disminorreica&nbsp; IVSA a los 20 años,&nbsp; papanicolau NUNCA,&nbsp; &nbsp;se le hace&nbsp; la recomendación urgente&nbsp; e incapie en&nbsp; medicina preventiva.&nbsp;</p>', '<p>ABUELOS: DIABETES MELLITUS II, ABUELA PATERNA&nbsp;</p>', '<p>lo inicia hace&nbsp; 10 dias c aundo refiere&nbsp; cuadr de disfonia,&nbsp; malestar general,&nbsp; tos&nbsp; escurrimiento nasal,&nbsp; se dio manejo hace&nbsp; 10 dias con&nbsp; celestamine, evocs,&nbsp; dorixina&nbsp; flam&nbsp;</p>', '<p>encuentro&nbsp; disfonica a un , alerta depsierta orientada neurologicoo integro,&nbsp; cardohemodinamico estable,&nbsp; abdomen&nbsp; con dolor en marco colico,&nbsp; sin mas comentarios&nbsp;</p>', '<p>laringo traqueitis.&nbsp;</p><p>sindrome de colon espastico,&nbsp;</p>', '<p>dorixina relax&nbsp; tomar 1 cada 12 horas por 5 dias.&nbsp;</p><p>dorixina trm&nbsp; por&nbsp; dolor&nbsp; cuello&nbsp;</p><p>AMABLY POR&nbsp; INTESTINO IRRITABLE&nbsp;</p><p>SENOKOT FORTE TABLETAS 2 DIARIAS&nbsp; &nbsp;POR 15 DIAS.,&nbsp;</p><p>DIETA&nbsp; SIN PICANTE,&nbsp; REFRESCO, ALCOHOL,&nbsp;</p><p><br></p>', '87', '20', '36', '49', '1.48', '101', '61', '96', NULL, 1),
(16, 6, 'EMILIA FLORES RAMIREZ', '7121723291', '7121723291', 'MUNICIPIO DE SAN FELIPE DEL PROGRESO', 'SIN DATO', '', '1969-12-31', '<p>ENFERMEDADES: NEGADO&nbsp;</p><p>QUIRURGICOS, ALERGICOS, TRAUMATICOS, TRANSFUSIONALES&nbsp; NEGADOS.&nbsp;</p><p><br></p><p>ARTRITIS REUMATOIDE DESDE HACE: 10&nbsp; años&nbsp; en tratamientos múltiples,&nbsp; solamente prednisona, metotrexato, paracetamol&nbsp;</p>', '<p>NEGADO.</p><p>interrogados y negados.&nbsp;</p><p><br></p>', '<p>inicia hace 1 mes cuando refiere dolores musculares, y&nbsp; articulares multiples,&nbsp; refiere&nbsp; rigidez matutoina&nbsp; poliartropatia. se dio manejo con&nbsp; lefluno mida&nbsp;</p>', '<p>encuentro con&nbsp; mejoria de la movilidad en las articuloaciones respecto de su primera consulta, refiere en esta consulta, descamacion de la piel.&nbsp;</p>', '<p>artritis reumatoide&nbsp; de 10 años de evolucion de reciente control en mejoria de dolor&nbsp; de 9&nbsp; a&nbsp; 3 de 10 en escalña de EVA.&nbsp;</p>', '<p>leflunomida&nbsp; de mayo a julio&nbsp; 20 mg&nbsp; diarios&nbsp;</p><p>altruline 50 mg&nbsp;</p><p>biometrix g&nbsp; 1 diaria&nbsp;</p><p><br></p><p>trae estudios&nbsp; los iniciales&nbsp; 01 02 2022&nbsp; con VSG 30&nbsp; FACTOR REUMATOIDE DE&nbsp; 512&nbsp; EN LA ACTUALIDAD JUNIO DEL 2022&nbsp; FR 10&nbsp; PORT C REACTIVA DE&nbsp; MAS DE 10&nbsp;</p><p><br></p><p>ADD&nbsp; &nbsp;SE DETECTA&nbsp; HB DE 16&nbsp; HCT DE&nbsp; MAS DE 50 %&nbsp; SE RECOMIENDA OXIGENO POR LAS NOCHES.&nbsp;</p>', '94', '20', '36', '45', '1.51', '108', '61', '96', NULL, 1),
(17, 6, 'JUANA DE JESUS VELAZCO', '', '5545625172', 'TRABAJA EN CD MEXICO, ORIGINARIA  DE SAN FELIPE DEL PROGRESO.', '', 'F', '1966-06-26', '<p>QUIRURGICOS,&nbsp; ALERGICOS, TRAUMATICOS, TRANSFUIONALES NEGADOS.&nbsp;</p><p>AGO&nbsp; menarca&nbsp; a los 13 años&nbsp; ciclos regulares de 28 x 3&nbsp; eumenorreica&nbsp; &nbsp;g 3 p 3&nbsp; c 0 a 0&nbsp; fur&nbsp; hace&nbsp; 10 años,&nbsp; PAPANICOLAU ultimo hace 1 año, refiere normal.&nbsp;</p>', '<p>DESCONOCE ANTECEDENTES&nbsp;</p>', '<p>lo inicia hace 8 años&nbsp; con osteoartritis&nbsp; con tratamiento con meloxicam,&nbsp; refiere desviacion de articulaciones en manos,&nbsp; dolor&nbsp; en&nbsp; las noches,&nbsp; parestesias,&nbsp; alteraciones de la sensibilidad distal.&nbsp;</p>', '<p>alerta despierta&nbsp; bien conformada de complexion longilinea,&nbsp; torax amplexion amplexacion conservados ruidos cardiacos rimticos de buen tono e intensidad sin agregados,&nbsp; abdomen globoso a epxpensas de panoiculo adiposo, peristalsis presente&nbsp; sin riritacion peritoneal,&nbsp; extremidades con deformidad en&nbsp; articulaciones interfalangicas,&nbsp; de manos,&nbsp; no hay dolor en rodillas, ni codos,&nbsp; ni tobillos&nbsp;</p>', '<p>osteoartritis&nbsp;</p>', '<p>en vio estudios&nbsp; paraclinicos y rx&nbsp;</p>', '78', '16', '36', '78', '154', '126', '61', '93', NULL, 1),
(18, 6, 'EULALIA CATARINO SANTOS', '', '5511950201', 'CONOCIDO SAN FELIPE DEL PROGRESO', '', 'F', '1966-12-10', '<p>QUIRURGICOS,&nbsp; POST OPERADA DE CESAREA HACE 16 AÑOS&nbsp;</p><p>ALERGICOS, TRAUMATICOS, TRANSFUSIONALES NEGADOS.&nbsp;</p><p>AGO&nbsp; MENARCA A LOS 11&nbsp; AÑOS CICLOS REGULARES 28 X 3 DIAS&nbsp; EUMENORREICA&nbsp; FUR&nbsp; 2 AÑOS PAPANICOLAU&nbsp; NUNCA&nbsp;</p>', '<p>&nbsp;NIEGA ANTECEDENTES FAMILIARES&nbsp;</p>', '<p>DOLOR&nbsp; LUMBAR&nbsp; QUE ACIENDE&nbsp; A&nbsp; REGION DORSAL MOTIVOS DE OCNSULTA&nbsp;</p>', '<p>ALERTA DEPSIERTA LASEGUE&nbsp; BRAGARD POSITIVOS,&nbsp; NEUROLOGICO CARDIOHEMODINAMICO&nbsp; ESTABLE ABDOMEN PERISTALSIS PRESENTE&nbsp; SIN IRIRTACION PERITONEAL EXTREMIDADES INTEGRAS&nbsp;</p>', '<p>CONTRACTURA MUSCULAR.&nbsp;</p>', '<p>SIRDALUD 2 MG TOMAR 1 CADA 12 HORAS POR 7 DIAS.&nbsp;</p><p>DORIXINA FLAM 1 CADA 8 HORAS POR 5 DIAS.&nbsp;</p><p>DOMINION DE 75 MG&nbsp; 1 CADA 12&nbsp; X 10 DIAS.&nbsp;</p>', '78', '16', '36', '54', '148', '126', '61', '93', NULL, 1),
(19, 6, 'SOFIA TRINIDAD  GONZALEZ', '', '7122345217', 'CONOCIDO  SAN BARTOLO DEL LLANO', '', '', '1961-09-09', '<p>QUIRURGICOS, ALERGICOS,  TRAUMATICOS, TRANSFUSIONALES NEGADOS. </p><p>DIABETICA DE 20 AÑOS  DE EVOLUCION en tratamiento actual con  Galvus met 50 / 1000  insulina  lantus  10 unidades  ultimos dreguistrso de  junio 30  222 mg / dl pr glucometria </p><p><br></p>', '<p>PADRE FINADO  DIABETICO, </p><p>HERMANOS DIABETICOS, HIPERTENSION </p>', '<p>diabetica  de  larga  evolucion mal control refiere mareo  maletsra genral vision borrosa, confusion mental,  actualemnte  de su ultima cita a la fecha </p><p>refiere  mejoria clinica  mayo r  control glucemico a pesar de reguistrarr 222 mg / dl,  asi mismo mejora deambulacion, energia, nicturia, refiere  actual 2 veces a 3 maximo sigue sin hacer ejercicio  opr dolor en rodillas </p>', '<p>alerta depsierta orientada neurologico integro cardiohemodinamico estable ruidos cardiacos rirtmcios de buen tonoe intensidad sin egregados, reswpiratorioes entrada y salida de aire a decuados, abdomen  blando depreisble sin megalias peristalsis presnete </p>', '<p>diabeste mellitus  2 de larga evolucion </p><p>nefropatia diabetica KDIGO III  DEPURACIOND E CREATININA DE 30 JUNIO 2022  DE 61 .5 ML / MIN </p><p>NEUROPATIA DIABETICA </p>', '<p>GALVUS MET 50 / 1000 2 X DIA </p><p>GLARGINA 15 UNIDADES A LAS 19 HRS </p><p>PRIKUL 75  1 X 2 X 30 </p><p>ASPIRINA PROTEC 100 1 X 30 </p><p>HIDROCLOROTIAZIDA SDE 25 MG 1 DIARIA EN LAS MAÑANAS </p>', '78', '20', '36', '47', '1,48', '126', '61', '93', NULL, 1),
(20, 6, 'RAUL HERNANDEZ MONROY', '', '7221929832', 'CONOCIDO e. ZAPATA  IXTLAHUACA', '', 'M', '1987-07-31', '<p>SINDROME DE CUSHING IATROGENO DE 5 AÑOS DE EVOLUCION SUSPENDIDO  HACE  4 MESES</p><p>OBESIDAD  DE 6  AÑOS DE E VOLUCION </p><p>HIPERTENSIOCN ARTERIAL DE RECIEN DIAGNOSTICO </p><p>HIPERURICEMIA  DE RECIEN DIAGNOTICO  EN TRATAMIENTO INICIAL.</p><p><br></p>', '<p>DIABETES POR  RAMA  MATERNA, ABUELA MATERNA , HERMANO CON HIPERURICEMIA, </p>', '<p>HACE 3 MESES SE  PERCATA DE  DOLORES ARTICULARES MULTIPLES,  QWUE MEJORAN CON LA MINISTRACIOND E INDARSONA,  ESTEROIDE, ARDOSONS,  DE 4  AÑOS DE E VOLUCION SIN CONTROL,  A ESTA UNIDAD A CUDE POR  DOLORES GENERALIZADOS,  MOTIVOS DE CONSULTA  A  ESTA UNIDAD. </p>', '<p> PACIENTE CON MALESTAR GENERAL DOLOR EN PIES AMBOS,  TOBILLOS RODILLAS,  DESPESION MENOR,  FASCIES CARACTERISTICA,  TORAX  AMPLEXION AMPLEXACION  RESTRINGIDA POR OBESIDAD MORBIDA,  HIPOAEREACION BILATERAL BASAL,  RUIDOS CARDIACOS RITMICOS  AUMENTADOS DE FRECUENCIA,  HIPERTENSION ARTERIAL,  ABDOMEN  GLOBOSO A EXPENSAS DE PANICULO ADIPOS PERISTALSIS RESENTE,  EXTREMIDADES  EDEMA GODETE  +++,  DOLOR EN  PLANTAS  Y TOBILLOS. </p><p><br></p>', '<p>SINDROME  METABOLICO </p><p>SINDROME DE CUSHING  EN TRATAMIENTO</p><p>OBESIDAD  GRADO III</p><p>HIPERTENSION ARTERIAL SISTEMICA </p><p>DEPRESION MENOR </p>', '<p>ESPIRONOLACTONA 50 MG DIARIOS </p><p>VALSARTAN 40 MG DIARIOS </p><p>ASPIRINA 100MG DIARIOS </p><p>ESCITALOPRAM 20 MG  DIARIOS </p><p>ZYLOPRIM 300MG 1 DIARIA </p><p>COLCHICINA 1 MG  DIARIO </p><p>TURAZIVE 80 MG  DIARIOS </p><p>LEFLUNOMIDA 20 MG  1 DIARIA </p>', '94', '16', '36', '130', '1,68', '136', '91', '84', NULL, 1),
(21, 6, 'PRICILIANO CRUZ GARCIA', 'SIN DATO', 'SIN DATO', 'CONOCIDO MINAMEXICO, MUNICIPIO DE ALMOLOYA DE JUAREZ.', 'SIN DATO', '', '1969-12-31', '<p>HIPERTENSION HACE 10 AÑOS, EPOC HACE 9 AÑOS.&nbsp;</p><p>CIRUGIAS: APENDICECTOMIA, PROSTATA.&nbsp;</p><p>ALERGIAS: NEGADAS&nbsp;</p><p>ACIDO&nbsp; URICO,&nbsp; COLESTEROL Y&nbsp; TRIGLICERIDOS&nbsp; ELEVADOS,&nbsp;</p><p>HIPERTROFIA PROSTATICA BENIGNA&nbsp; DE 8 AÑOS DE EVOLUCION EN TRATAMIENTO. ASOFLON DUO&nbsp;</p><p>EPÓC&nbsp; EN TX&nbsp; CON&nbsp; SERETIDO , COMENTA IPRATROPIA LE DUELE LA CABEZA&nbsp;</p><p>EN TRATAMIENTO CON ASOFLON DUO SUSPENDIO HACE 3 MESES.&nbsp;</p>', '<p>DIABETES: PADRE </p><p>HIPERTRIGLICERIDEMIA: ABUELO PATERNO </p>', '<p>FIEBRE DE 38.5 C&nbsp; QUE&nbsp; CEDE CON ANALGESICO HABITUALES,&nbsp; DOLOR LUMBAR&nbsp;</p>', '<p>ENCUENTRO AKRETA DEPSIERTO ORIENTADO&nbsp; NEUROLOGICO INTEGRO CARDIOHEMODINAMICO ESTABLE&nbsp; GIORDANOS POSITIVO BILATERAL,&nbsp;</p>', '<p>INFECCION DE VIAS URINARIAS</p><p>HPB&nbsp;</p><p>OBESIDAD GRADO II&nbsp;</p><p>DISLIPIDEMIA MIXTA&nbsp;</p><p><br></p>', '<p>BACTRIM F TABLETAS&nbsp;</p><p>Tomar 1 cada 12 horas por 14 días.&nbsp;</p><p>EXOTIB DUO&nbsp;</p><p>Tomar 1 diaria por 3 meses&nbsp;</p><p>ASOFLON DUO&nbsp;</p><p>tomar 1 diaria por 3 meses</p><p>TEMPRA FORTE 650 MG&nbsp;</p><p>tomar 1 cada 8 horas por 5 días.&nbsp;</p><p>DORIXINA FLAM&nbsp;</p><p>tomar 1 cada 12 horas por 10 dias.&nbsp;</p><p>dieta con muchos liquidos.&nbsp;</p><p><br></p>', '80', '17', '36', '83', '155', '133', '72', '92', NULL, 1),
(22, 6, 'LIDIO MEJIA FLORES', '7226679218', '7226679218', 'CONOCIDO TABORDA MUNICIPIO DE TEMOAYA DEL ESTADO DE MEXICO', 'SIN DATO', '', '1969-12-31', '<p>DIABETES MELLITUS II, HIPERTENSION ARTERIAL SISTEMICA.&nbsp;</p><p>ALERGIAS: NEGADAS&nbsp;</p><p>CIRUGIAS: 1</p><p>COLONOSCOPIA&nbsp; con resultados de CUCI.&nbsp;</p><p>síndrome de cuci, en manejo con&nbsp; sulfazalazina,&nbsp;</p><p>hipertension en manejo con losartan 50&nbsp; mg cada 12&nbsp; mas isosrbide 10 mg&nbsp;</p><p>pop cateterismo cardiaco hace 3 años,&nbsp; con ectasia&nbsp;</p><p>post operado de&nbsp; RAFI con clavo centro medular tipo&nbsp; councher&nbsp;</p><p>DIABETES&nbsp; CON MANEJO CON GLAVUS 1 DESAYUNO 1&nbsp; CENA&nbsp; COMIDA PIOGLÑITAZONA&nbsp;</p><p>LÑANTUS 20 -20 .... GLARGINA&nbsp;</p><p><br></p><p><br></p>', '<p>MADRE: DIABETES MELLITUS II Y HIPERTENSION </p>', '<p>inicia&nbsp; el 16 de&nbsp; junio con sangrado digestivo bajo&nbsp;</p><p>se dio manejo con meticorten 10 c / 24 x 10 dias.&nbsp;</p><p>salofalk 500 actualmente lo toma&nbsp;</p><p>dexivant 60, senokot, unival 2 gr c / 24 hrs&nbsp;</p><p>se refiere con mejoria&nbsp; al dia de hoy 07 / 07 2022&nbsp;</p><p><br></p>', '<p>neurologicamente&nbsp; integro cardiohemodinamico estable&nbsp; gastrointestinal,&nbsp; ASIGNOLOGICO NO PALPO&nbsp; VISCEROMEGALIAS,&nbsp; NO HAY DOLOR EN MARCO COLICO,&nbsp; ASIGNOLOGICO EN GENERAL,&nbsp; BUENA ACTITUD, CUENA CONFORMACION&nbsp;</p>', '<p>TROMBOCITOPENIA&nbsp; POR CONSUMO&nbsp; REMITIDA&nbsp;</p><p>SANGRADO DIGESTIVO BAJO&nbsp; REMITIDO&nbsp;</p><p>DIABESTES EN CONTROL.&nbsp;</p>', '<p>GALVUS&nbsp; 1&nbsp; DESAYUNO Y 1&nbsp; CENA&nbsp;</p><p>PIOGLITAZONA&nbsp;</p><p>1 COMIDA&nbsp;</p><p>GLARGINA&nbsp;</p><p>20&nbsp; Y&nbsp; 15 NOCHE.&nbsp;</p><p>EJERCICIO POR 1 HORA&nbsp;</p>', '74', '17', '36', '87', '165', '142', '69', '91', NULL, 1),
(23, 6, 'HEYDI VENTURA HERNANDEZ', '7122517777', '7122517777', 'EMILINIANO ZAPATA IXTLAHUACA ESTADO DE MEXICO', 'O+', 'F', '1969-12-31', '<p>NEGADAS</p><p>CIRUGIAS: 1 (PLACA EN EL PIE)&nbsp;</p><p>ALERGIAS: PENICILINA&nbsp;</p>', '<p>NEGADOS&nbsp;</p>', '', '', '', '', '66', '17', '36', '80', '154', '114', '70', '90', NULL, 1),
(24, 6, 'LOURDES PATRICIO VALENTIN', '5631361022', '5631361022', 'DOMICILIO BUCIO, TIMILPAN ESTADO DE MEXICO', 'A+', '', '1969-12-31', '<p>NEGADO&nbsp;</p><p>CIRUGIA: 2 (CESARIA Y SALPINGOCLASIA.)</p><p>ALERGIAS: NEGADO&nbsp;</p>', '<p>MADRE: DIABETES MELLITUS II&nbsp;</p><p><br></p>', '', '', '', '', '72', '17', '36', '55', '157', '102', '64', '94', NULL, 1),
(25, 6, 'ESTHELA HERNANDEZ GUTIERREZ', '7227700833', '7227700833', 'DOMICILIO CONOCIDO BUENOS AIRES, MUNICIPIO DE JIQUIPILCO MEXICO', 'SIN DATO', 'F', '1969-12-31', '<p>CIRUGIAS: COLESISTECTOMIA&nbsp;</p><p>ALERGIAS: NEGADAS&nbsp;</p>', '<p>PADRE: HIPERTENSION ARTERIAL SISTEMICA</p><p>MADRE: DIABETES MELLITUS II&nbsp;</p>', '', '', '', '', '75', '16', '36', '72', '154', '114', '72', '94', NULL, 1),
(26, 6, 'IGNACIO MONROY COLIN', '7123002526', '7123002526', 'SANTIAGO YECHE, MUNICIPIO DE JOCOTITLAN.', 'SIN DATO', 'F', '1969-12-31', '', '', '', '', '', '', '75', '16', '36', '61.5', '158', '104', '52', '89', NULL, 1),
(27, 6, 'ITZEL BERNAL CRUZ', '5534892426', '5534892426', 'SANTA CRUZ TEPEXPAN, COLONIA LA PURISIMA, JIQUIPILCO MEXICO', 'O+', '', '1969-12-31', '<p>FIBROMIALGIA en tratamiento&nbsp; duloxetina, flueoxetina, pregabalina, quetiapina, suspendido desde hace 1 año,&nbsp;</p><p>RESISTENCIA A LA INSULINA&nbsp;</p><p>CIRUGIAS: RINOPLASTIA.&nbsp;</p><p>ALERGIAS: METRONIDAZOL&nbsp;</p>', '<p>PADRE Y ABUELOS PATERNOS: DIABETES MELLITUS II </p>', '<p>&nbsp;acude&nbsp; &nbsp;por faringitis&nbsp; &nbsp;dándose tratamiento con&nbsp; esteroide&nbsp; 5 mg cada&nbsp; 8 horas,&nbsp; así mismo&nbsp;</p><p>iniciamos&nbsp; pregabalina 150&nbsp; cada 12 horas,&nbsp; mejoro síndrome&nbsp; piernas inquietas, mejora sueño rem,&nbsp; prefiere&nbsp; dejar&nbsp; tratamiento asi.&nbsp;</p><p>LEXAPRO 20 MG&nbsp; 1&nbsp; diaria por 3 meses inicia&nbsp; &nbsp;julio,&nbsp; reduccion de sosis&nbsp; en octuibre.&nbsp;</p>', '<p>encuentro assignologica,&nbsp; unicamente&nbsp; aseo ocular.&nbsp;</p>', '<p>fibromialgia&nbsp;</p><p>otiti reactiva&nbsp;</p>', '<p>azitromicina 500mg&nbsp; 1&nbsp; diaria por 5 dias.&nbsp;</p><p>meticorten 5 mg cada 12&nbsp; completar 5&nbsp; y lugo cada 24&nbsp; x&nbsp; 5 mas.&nbsp;</p><p><br></p><p><br></p>', '67', '17', '36', '50', '1.53', '100', '70', '98', NULL, 1),
(28, 6, 'LUIS BERNAL PIÑA', '7225121494', '7225121494', 'SANTA CRUZ TEPEXPAN, JIQUIPILCO MEXICO.', 'O+', 'M', '1969-12-31', '<p>DIABETES MELLITUS II&nbsp;</p><p>CIRUGIAS: NEGADAS&nbsp;</p><p>ALERGIAS: NEGADAS</p>', '<p>PADRE Y MADRE: DIABETES MELLITUS II&nbsp;</p>', '', '', '', '', '68', '17', '36', '72', '1.65', '147', '86', '91', NULL, 1),
(29, 6, 'PABLO GARCIA MARTINEZ', '7122572243', '7122572243', 'LAS ARENAS, MUNICIPIO DE ACAMBAY', 'SIN DATO', 'M', '1969-12-31', '<p>CIRROSIS HEPATICA DESDE HACE 5 AÑOS </p><p>INSUFICIENCIA VENOSA </p><p>CIRUGIAS: NEGADAS </p><p>ALERGIAS: NEGADAS </p>', '<p>NEGADAS </p>', '', '', '', '', '62', '17', '36', '64', '1.62', '145', '53', '96', NULL, 1),
(30, 6, 'TOMASA DE JESUS EULALIA', '7122042533', '7122042533', 'SAN ANDRES TIPILMAN', 'SIN DATO', '', '1969-12-31', '<p>HIPERTENSION ARTERIAL SISTEMICA&nbsp;</p><p>CIRUGIAS: HISTERECTOMIA&nbsp;</p><p>ALERGIAS: NEGADAS&nbsp;</p>', '<p>NEGADOS&nbsp;</p>', '', '', '', '', '50', '17', '36', '48', '136', '148', '52', '95', NULL, 1),
(31, 6, 'RIGOBERTO MARIN  GARCIA', '7222930532', '7222930532', 'SANTA CRUZ TEPEXPAN, JIQUIPILCO MEXICO', 'SIN DATO', 'M', '1985-06-13', '<p>CIRUGIAS: APENDICECTOMIA&nbsp;</p><p>ALERGIAS: NEGADOS&nbsp;</p>', '<p>MADRE: HIPERTENSION ARTERIAL&nbsp;</p>', '', '', '', '', '83', '17', '36', '83', '166', '103', '68', '94', NULL, 1),
(32, 6, 'CLAUDIA GARCIA LOPEZ', 'SIN DATO', 'SIN DATO', 'SANTA CRUZ TEPEXPAN, JIQUIPILCO MEXICO', 'SIN DATO', 'F', '1962-07-06', '<p>ENF. NEGADAS.&nbsp;</p><p>CIRUGIAS: MIOMECTOMIA&nbsp;</p><p>ALERGIAS: PENICILINA Y OTRA QUE NO RECUERDA&nbsp;</p><p><br></p>', '<p>NEGADOS&nbsp;</p>', '', '', '', '', '67', '20', '36', '66', '144', '140', '82', '94', NULL, 1),
(33, 6, 'JUAN PIÑA FLORENCIO', '7123341769', '7123341769', 'SAN ANA LA LADERA, IXTLAHUACA MEXICO', 'SIN DATO', 'M', '1969-12-31', '', '<p>MADRE: DIABETES MELLITUS II&nbsp;</p>', '', '', '', '', '90', '17', '36', '62', '165', '93', '55', '88', NULL, 1),
(34, 6, 'JAVIER MIRANDA REMIGIO', '7221919774', '7221919774', 'PRIVADA INSURGENTES #108, SAN LUCAS TUNCO, METEPEC ESTADO DE MEXICO', 'O+', '', '1969-12-31', '<p>DIABETES MELLETUS II&nbsp;</p><p>CIRUGIAS: NEGADAS&nbsp;&nbsp;</p><p><a href=\"ALERGIAS:;\">ALERGIAS:</a>&nbsp;NEGADO&nbsp;</p><p><br></p>', '<p>MADRE Y PADRE: DIABETES MELLITUS II </p>', '', '', '', '', '100', '96', '36', '70', '163', '136', '79', '96', NULL, 1),
(35, 6, 'JESUS GONZALEZ REYES', '7121161399', '7121161399', 'SANTA CRUZ TEPEXPAN, JIQUIPILCO MEXICO', 'SIN DATO', 'F', '1969-12-31', '<p>DIABETES MELLITUS II HACE 22 AÑOS&nbsp;</p><p>CIRUGIAS: NEGADAS&nbsp;</p><p>ALERGIAS: NEGADAS&nbsp;</p>', '<p>NEGADOS&nbsp;</p>', '', '', '', '', '73', '17', '36', '61', '164', '133', '75', '97', NULL, 1),
(36, 6, 'JUANITA RAYMUNDO ALCANTARA', '7223650532', '7223650532', 'SANTA CRUZ TEPEXPAN, JIQUIPILCO MEXICO', 'O+', 'F', '1969-12-31', '<p>CIRUGIAS: NEGADAS</p><p>ALERGIAS: NEGADAS&nbsp;</p>', '<p>NEGADOS&nbsp;</p>', '', '', '', '', '72', '17', '36', '57', '154', '115', '67', '73', NULL, 1),
(37, 6, 'ELSA URBINA NIETO', '7121078202', '7121078202', 'SAN FRANCISCO CHEJE, JOCOTITLAN MEXICO', 'O-', '', '1969-12-31', '<p>HIPERTENSION ARTERIAL SISTEMICA HACE 9 AÑOS&nbsp;</p><p>DIABTES MELLETUS HACE 9 AÑOS&nbsp;</p><p>CIRUGIAS: HERNIA INGLINAL, 2 CESAREAS, COLESISTECTOMIA.&nbsp;</p><p>alergias: sulfa, dexametasona y cetftriaxona&nbsp;</p>', '<p>MADRE Y PADRE: DIABETES MELLITUS</p><p>PADRE: ALZHEIMER </p>', '', '', '', '', '84', '17', '36', '64', '152', '146', '78', '92', NULL, 1),
(38, 6, 'DANIELA FELIPE PASTRANA', '7121849654', '7121849654', 'SANTA MARIA DEL LLANO, IXTLAHUACA MEXICO', 'SIN DATO', 'F', '1969-12-31', '<p>HIPOPLASIA RENAL&nbsp;</p><p>ALERGIAS: LEVOFLOXACINO&nbsp;</p><p>CIRUGIAS: APENCICECTOMIA Y 1 CESARIA&nbsp;</p>', '<p>MADRE Y ABUELA MATERNA: DIABTES MELLITUS II</p>', '', '', '', '', '93', '17', '36', '54', '157', '105', '74', '94', NULL, 1),
(39, 6, 'MARIA EUGENIA PALOMARES PICHARDO', '7224073645', '7224073645', 'FRANCISCO I.MADERO 701, BARRIO SAN FRANCISCO SAN MATEO ATENCO EDO DE MEXICO', 'SIN DATO', 'F', '1969-12-31', '<p>CIRUGIAS: COLECISTECTOMIA&nbsp;</p><p>ALERGIAS: NEGADADAS</p>', '<p>MADRE: DIABTES MELLITUS E HIPERTENSION ARTERIAL&nbsp;</p>', '', '', '', '', '73', '17', '36', '52', '1.52', '130', '88', '94', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes_asignacion`
--

CREATE TABLE `pacientes_asignacion` (
  `id` int(10) NOT NULL,
  `medico_id` int(10) DEFAULT NULL,
  `paciente_id` int(10) DEFAULT NULL,
  `fecha_asignacion` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pacientes_asignacion`
--

INSERT INTO `pacientes_asignacion` (`id`, `medico_id`, `paciente_id`, `fecha_asignacion`, `status`) VALUES
(1, 6, 1, '2022-01-17 08:52:15', 1),
(2, 6, 1, '2022-01-17 09:11:49', 1),
(3, 5, 2, '2022-01-17 10:17:52', 1),
(4, 8, 3, '2022-01-17 10:35:07', 1),
(5, 8, 3, '2022-01-17 10:50:46', 1),
(6, 6, 4, '2022-01-18 11:32:52', 1),
(7, 6, 5, '2022-01-18 11:37:06', 1),
(8, 6, 6, '2022-01-20 11:00:55', 1),
(9, 7, 7, '2022-01-24 08:47:59', 1),
(10, 7, 8, '2022-01-27 11:43:54', 1),
(11, 7, 9, '2022-05-04 16:35:19', 1),
(12, 6, 10, '2022-06-06 11:09:23', 1),
(13, 6, 11, '2022-06-06 11:13:51', 1),
(14, 6, 12, '2022-06-08 10:03:28', 1),
(15, 6, 13, '2022-06-28 11:49:19', 1),
(16, 6, 14, '2022-06-28 14:22:19', 1),
(17, 6, 15, '2022-07-05 10:34:00', 1),
(18, 6, 16, '2022-07-05 11:00:30', 1),
(19, 6, 17, '2022-07-05 12:21:32', 1),
(20, 6, 18, '2022-07-05 12:38:00', 1),
(21, 6, 19, '2022-07-05 12:56:08', 1),
(22, 6, 20, '2022-07-06 12:25:00', 1),
(23, 6, 21, '2022-07-07 11:56:48', 1),
(24, 6, 22, '2022-07-07 12:01:51', 1),
(25, 6, 23, '2022-07-07 12:05:37', 1),
(26, 6, 24, '2022-07-07 12:09:46', 1),
(27, 6, 25, '2022-07-07 12:23:37', 1),
(28, 6, 26, '2022-07-07 12:26:14', 1),
(29, 6, 27, '2022-07-21 10:10:43', 1),
(30, 6, 28, '2022-07-21 10:14:15', 1),
(31, 6, 29, '2022-07-21 10:30:16', 1),
(32, 6, 30, '2022-07-21 11:50:45', 1),
(33, 6, 31, '2022-07-21 12:29:28', 1),
(34, 6, 32, '2022-07-22 15:58:38', 1),
(35, 6, 33, '2022-08-12 11:24:53', 1),
(36, 6, 34, '2022-08-12 11:53:44', 1),
(37, 6, 35, '2022-08-16 10:55:14', 1),
(38, 6, 36, '2022-08-16 10:59:02', 1),
(39, 6, 37, '2022-08-16 11:05:12', 1),
(40, 6, 38, '2022-08-23 11:09:19', 1),
(41, 6, 39, '2022-09-01 11:33:53', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
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
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `paciente_id`, `consulta_id`, `hospitalizacion_id`, `urgencia_id`, `medico_id`, `enfermera_id`, `servicios`, `fecha_apertura`, `fecha_pago`, `monto`, `status`) VALUES
(1, 1, 1, 0, 0, 6, NULL, NULL, '2022-01-17', NULL, '0.000000', 1),
(2, 1, 2, 0, 0, 6, NULL, NULL, '2022-01-17', NULL, '0.000000', 1),
(3, 1, 3, 0, 0, 6, NULL, NULL, '2022-01-17', NULL, '0.000000', 1),
(4, 3, 4, 0, 0, 8, NULL, NULL, '2022-01-17', NULL, '0.000000', 1),
(5, 2, 5, 0, 0, 4, NULL, NULL, '2022-01-17', NULL, '0.000000', 1),
(6, 3, 6, 0, 0, 7, NULL, NULL, '2022-01-24', NULL, '0.000000', 1),
(7, 8, 7, 0, 0, 7, NULL, NULL, '2022-01-27', NULL, '0.000000', 1),
(8, 3, 8, 0, 0, 8, NULL, NULL, '2022-05-02', NULL, '0.000000', 1),
(9, 3, 9, 0, 0, 8, NULL, NULL, '2022-05-03', NULL, '0.000000', 1),
(10, 7, 10, 0, 0, 7, NULL, NULL, '2022-05-04', NULL, '0.000000', 1),
(11, 7, 11, 0, 0, 7, NULL, NULL, '2022-05-04', NULL, '0.000000', 1),
(12, 7, 12, 0, 0, 7, NULL, NULL, '2022-05-04', NULL, '0.000000', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
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
-- Estructura de tabla para la tabla `productos`
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
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `scope`, `descripcion`, `precio`, `iva`, `valor_iva`, `precio_neto`, `status`) VALUES
(1, 1, 'Primer servicio de Ejemplo', '1500.000000', 1, '240.000000', '1740.000000', 0),
(2, 1, 'Segundo Servicio de ejemplo sin iva', '500.000000', 0, '0.000000', '500.000000', 0),
(3, 1, 'Tercer ejemplo con iva', '1870.230000', 1, '299.240000', '2169.470000', 0),
(4, 2, 'Oxigeno en lata', '500.000000', 0, '0.000000', '500.000000', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `id` int(10) NOT NULL,
  `paciente_id` int(10) NOT NULL,
  `medico_id` int(10) NOT NULL,
  `consulta_id` int(10) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `medicamentos` longtext DEFAULT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`id`, `paciente_id`, `medico_id`, `consulta_id`, `fecha`, `medicamentos`, `status`) VALUES
(1, 1, 6, 1, '2022-01-17 00:00:00', '<p>loratadina&nbsp;</p>', 1),
(2, 1, 6, 0, '2022-01-17 00:00:00', '<p>PARACETAMOL</p>', 1),
(3, 3, 8, 0, '2022-01-17 00:00:00', '<p>PARACETAMOL 500 mg cada 8 horas</p>', 0),
(4, 7, 7, 0, '2022-01-24 00:00:00', '<p>4554545<br></p>', 0),
(5, 8, 7, 7, '2022-01-27 00:00:00', '<p>PARACETAMOL<br></p>', 0),
(6, 8, 7, 0, '2022-01-27 00:00:00', '<p>LÑ,ÑLÑL<br></p>', 0),
(7, 7, 7, 0, '2022-01-28 12:00:03', '<p>dfgdfgdfgdfg<br></p>', 0),
(8, 7, 7, 0, '2022-04-19 10:03:48', '<p>SDKLFJSKLFKLD</p>', 0),
(9, 3, 8, 0, '2022-05-02 13:05:19', '<p>AMPLIRON DUO CADA 12 HORAS</p>', 0),
(10, 3, 8, 0, '2022-05-03 16:14:58', '<p>aspirina</p>', 0),
(11, 7, 7, 0, '2022-05-04 11:02:45', '<p>ASPIRINA</p>', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas_detalle`
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
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visual` int(1) NOT NULL,
  `addRecord` int(1) DEFAULT NULL,
  `editRecord` int(1) DEFAULT NULL,
  `viewRecord` int(1) DEFAULT NULL,
  `deleteRecord` int(1) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `visual`, `addRecord`, `editRecord`, `viewRecord`, `deleteRecord`, `description`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Super Usuario', 1, 1, 1, 1, 1, 'Super Usuario', '2020-09-26 05:00:00', '2022-04-21 05:00:00', 1),
(2, 'Doctores', 2, 1, 1, 1, 1, 'Doctores', '2020-09-26 05:00:00', '2022-01-17 06:00:00', 1),
(3, 'Enfermeria', 2, NULL, NULL, NULL, NULL, 'Enfermeria', '2020-09-26 05:00:00', '2020-09-27 05:00:00', 1),
(4, 'Prueba demo de perfiles', 1, 0, 0, 0, 0, 'Prueba demo de perfiles', '2021-01-20 06:00:00', '2021-01-20 06:00:00', 1),
(5, 'URGENCIAS', 1, 1, 1, 1, 1, 'URGENCIAS', '2022-03-28 06:00:00', '2022-05-12 05:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_detalle`
--

CREATE TABLE `rol_detalle` (
  `id` int(10) NOT NULL,
  `rol_id` int(10) NOT NULL,
  `modulo_id` int(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol_detalle`
--

INSERT INTO `rol_detalle` (`id`, `rol_id`, `modulo_id`, `status`) VALUES
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
(174, 2, 2, 1),
(175, 2, 19, 1),
(176, 2, 8, 1),
(177, 2, 10, 1),
(178, 2, 11, 1),
(179, 2, 12, 1),
(181, 1, 1, 1),
(182, 1, 2, 1),
(183, 1, 3, 1),
(184, 1, 4, 1),
(185, 1, 5, 1),
(186, 1, 6, 1),
(187, 1, 7, 1),
(188, 1, 18, 1),
(189, 1, 19, 1),
(190, 1, 8, 1),
(191, 1, 9, 1),
(192, 1, 10, 1),
(193, 1, 11, 1),
(194, 1, 12, 1),
(195, 1, 13, 1),
(196, 1, 14, 1),
(197, 1, 15, 1),
(198, 1, 16, 1),
(199, 1, 17, 1),
(200, 1, 20, 1),
(201, 1, 21, 1),
(204, 5, 21, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `signos_vitales`
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
-- Estructura de tabla para la tabla `urgencias`
--

CREATE TABLE `urgencias` (
  `id` int(10) NOT NULL,
  `medico_id` int(10) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `medico_nombre` varchar(250) DEFAULT NULL,
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
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `urgencias`
--

INSERT INTO `urgencias` (`id`, `medico_id`, `fecha`, `hora`, `medico_nombre`, `paciente`, `edad`, `peso`, `talla`, `motivo`, `padecimiento`, `heredo_diabetes`, `heredo_hipertencion`, `heredo_cancer`, `heredo_convulsiones`, `heredo_lar`, `heredo_leulin`, `patolo_diabetes`, `patolo_hipertencion`, `patolo_cancer`, `patolo_otros`, `operaciones`, `transfuciones`, `fracturas`, `alergias`, `subtotal`, `iva`, `total`, `pagado`, `pendiente`, `status`) VALUES
(1, 4, '2022-03-28', '09:37:54', NULL, 'edgar lopez', '39', '27', '84', '<p>accidente <br></p>', '<p>fractura<br></p>', 'no', 'si', 'no', 'no', 'no', 'no', 'no', 'si', 'no', 'no', 'no', 'no', 'no', 'no', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', 1),
(2, 0, '2022-04-19', '09:36:34', 'BLANCA', 'MIGUEL RICAÑO', '43', '87', '190', '<p>FRACTURA</p>', '<p>2 JERINGAS</p>', 'NO', 'SI', 'NO', 'SI', 'MO', 'MAREOS', 'NO', 'NO', 'NO', 'MAREOS', 'NO', 'NO', 'SI', 'AMOXICILINA', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `urgencias_servicios`
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
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
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `rol`, `asistente_id`, `medico_id`, `enfermera_id`, `paciente_id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `time_login`, `online`, `status`) VALUES
(1, 1, 0, 0, 0, 0, 'Administrador', 'admin@app.com', '$2y$10$E14A0D/2f3uCFPMEod5rV.x11ZdLO45eKccC2Zzbs7bBloo9bmzzK', 't79zPo9RkskCdcznfUrFpKVAFtH8hesCPnk7AbIER2tCD2tC8ySqYeMR1LeZ', NULL, '2020-07-24 01:38:27', '2020-07-23 20:38:27', 1, 1),
(2, 2, 0, 1, 0, 0, 'Demostrativo Doctor', 'demodoctor@app.com', '$2y$10$t1pZR1Sf9tdq7yv9uap/.usgyqhFpbM3vHqKOFogK8Iy.U6noxev2', 'cIhpTQbqSkiJjHAaVCEydYIU0IILqbRpgDT2WVbzDypYP86ZVsPTzbfwMkrE', NULL, '2020-09-27 05:00:00', NULL, 0, 0),
(3, 2, 0, 2, 0, 0, 'Doctora de ejemplo', 'doctora@app.com', '$2y$10$RcLc9lO7db89WL7tiJuel.EI3mG5nhNgNvfvyZu5zCMd98fj3ZRSi', 'dBZkQMnuelOQVglJ3ZALm9LGuaLPOofZZHwCiEITanlyxdZ3jghZnMr6Bj4F', NULL, NULL, NULL, 0, 0),
(4, 3, 0, 0, 1, 0, 'Usuario Enfermera Demo', 'demoenfermera@app.com', '$2y$10$/SrzDaC0I0A7mamJuUg2/OtbLr53pvQJdQA/DC7jw7yFsKu/np10m', NULL, NULL, NULL, NULL, 0, 1),
(5, 1, 0, NULL, NULL, NULL, 'Usuario Root adicional', 'root@app.com', '$2y$10$Ywo6vTyclnEy/7sEubzlC.DHqImNUoK6qraHWdfFT0rV8RX4wa/ES', NULL, '2020-09-27 05:00:00', NULL, NULL, 0, 1),
(6, 2, 2, 0, 0, 0, 'Marisol Navarro Martinez', 'ketsura@gmail.com', '$2y$10$/8Ww31aBpz8NelsRhlSzoef2aeEp.8RyOhC6e/TnKmV2Px62NRwwa', '33v6y0wwA0nijOwCoEiPIMl2NaCPSF6umgMH27xIkE3ZaUqdesQkVdzEuXnC', NULL, NULL, NULL, 0, 0),
(8, 2, 0, 3, 0, 0, 'Sergio Garduño Gomez', 'garduno@app.com', '$2y$10$ldh34qI4m8XFNQPmWLW4VeHs.VK.A9X0Go./kTUQzSAOuiVCwi.2e', NULL, NULL, NULL, NULL, 0, 0),
(9, 1, 0, 0, 0, 0, 'super vendedor', 'superventas@app.com', '$2y$10$fM6g/ClCMWUpfItR3fN.RuzYbgAOmPOWS26q.7bGdFgqs2WixYTva', NULL, '2021-01-14 06:00:00', '2021-01-14 06:00:00', NULL, 0, 1),
(10, 1, 0, 0, 0, 0, 'MIGUEL ANGEL', 'miguell3365@hotmail.com', '$2y$10$HISlAm43dz.Ptq2H1lYjPO5EvXSWsM7wSac124P4jDl2vJsXCKCuq', 'FjL0JUWKft1DZd1L7nQjJjGTHOPGHRvcCQB975oh0tdeWiSTehnAZaewgWtQ', '2021-08-04 05:00:00', '2021-08-06 05:00:00', NULL, 0, 0),
(11, 2, 0, 4, 0, 0, 'Jose Alberto Vivero Garay', 'chino_753alb@hotmail.com', '$2y$10$K8K1XVOS5tX.VDE30D2W6.QIVkiwfsRbRdl0UzUDObh2Izj6r.btm', 'o7wlZMjrG4wjT7taLSWL1rMT0qOOTgbq7Lhpu5sPqwRiKXog50ypab4e6HFf', NULL, NULL, NULL, 0, 1),
(12, 1, 0, 5, 0, 0, 'miguel', 'miguel3365@hotmail.com', '$2y$10$.7qNCZ7afBb/UcU5w8sl3./Kv6W1.xGfuMJ/bpiMsqX7E8ZN86JHa', 'NrKw53L7lYgDV68XKbRiSmaCL2uV8ufwqRGVJWJzrcEniuYeWYlo8LihkEFp', NULL, '2022-01-17 06:00:00', NULL, 0, 1),
(13, 2, 0, 0, 0, 0, 'MARCIAL FLORES TRUJILLO', 'marcial.florestrujillo@gmail.com', '$2y$10$/o8HuwpRa6QjRzGJo.4.MO9o5nrA9mEhJFOm3uHhuX3iBq4tcHmaW', 'OA9uPWvZQ7cqyzhN63KIhPet9EnNrwSq2O3u2umxUOdQamWrnaO0TWVBAln4', '2021-10-05 05:00:00', '2022-01-17 06:00:00', NULL, 0, 0),
(14, 2, 0, 6, 0, 0, 'RODRIGO RODRIGUEZ CARRANZA', 'rodrisz@hotmail.com', '$2y$10$eisvAWRmt5IbwNT16R.xVu5OCfn.y/k2fj6VLvPr4MGoEcCsm9Nti', 'eti67AO73DvAI6sbd9yQDH8q4WbnMWrmyxkA7X9vJAQyO3RUvzK0ki8HhEnS', NULL, '2022-06-06 05:00:00', NULL, 0, 1),
(15, 2, 0, 7, 0, 0, 'doc prueba', 'miguel33651@hotmail.com', '$2y$10$Dgsb0Wa/pJ4YjMa8kLCv6eGAv2Yngl4uMLTvoRA.w5dZPux6.B5lm', 'RvHoS97uoVYKUhVHgIqEcXv0tVAHKR86wE0MtoGEYzq3hmdNDzp0GvBUCCc7', NULL, NULL, NULL, 0, 1),
(16, 2, 0, 8, 0, 0, 'MARCIAL FLORES TRUJILLO', 'marcial.florestrujillo@grupoixtlamar.com', '$2y$10$2x0HnGcJZ9JVJ6L38cSH1eW9FXKhTTE/kNwtuVgpczgsJZuHgSA8y', '6iAb9Lg4Kbift2ofxSKA8W1ml7aOkGdPsFmrCp0PdGvQgiYpIF8yfhOUWfER', NULL, NULL, NULL, 0, 1),
(17, 5, 0, 0, 0, 0, 'URGENCIAS', 'urgencias@grupoixtlamar.com', '$2y$10$IZzkjjUG44PCQooqziAm5OWbS6TU71CjNxNmOdw6MCxdgBjJke2au', 'YPfzRWkbLIVCp74ecxyTjg8p5Kb7VKKS1eCQv0DChBbMIiBUeFFzEPtND7zo', '2022-03-28 06:00:00', NULL, NULL, 0, 1),
(18, 5, 0, 0, 0, 0, 'MARCIAL FLORES PEREZ', 'marcial.floresperez@gmail.com', '$2y$10$AO.Og4aI33.leEcrR2nOoOO41H.JXmAOJulX76JyNJ43wVXRLhlFW', 'pdAXYKx2PUnpQKqpcrdbRlvWvWpJdBqakeycQhOvw3aQMM3p6VHokcVkbyg4', '2022-05-12 05:00:00', '2022-08-31 05:00:00', NULL, 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ambulancias`
--
ALTER TABLE `ambulancias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asistentes`
--
ALTER TABLE `asistentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuartos`
--
ALTER TABLE `cuartos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `enfermeria`
--
ALTER TABLE `enfermeria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `farmacia`
--
ALTER TABLE `farmacia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hospitalizacion`
--
ALTER TABLE `hospitalizacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hospitalizacion_servicios`
--
ALTER TABLE `hospitalizacion_servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pacientes_asignacion`
--
ALTER TABLE `pacientes_asignacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recetas_detalle`
--
ALTER TABLE `recetas_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indices de la tabla `rol_detalle`
--
ALTER TABLE `rol_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `signos_vitales`
--
ALTER TABLE `signos_vitales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `urgencias`
--
ALTER TABLE `urgencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `urgencias_servicios`
--
ALTER TABLE `urgencias_servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ambulancias`
--
ALTER TABLE `ambulancias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `asistentes`
--
ALTER TABLE `asistentes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cuartos`
--
ALTER TABLE `cuartos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `enfermeria`
--
ALTER TABLE `enfermeria`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `farmacia`
--
ALTER TABLE `farmacia`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hospitalizacion`
--
ALTER TABLE `hospitalizacion`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hospitalizacion_servicios`
--
ALTER TABLE `hospitalizacion_servicios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `pacientes_asignacion`
--
ALTER TABLE `pacientes_asignacion`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `recetas_detalle`
--
ALTER TABLE `recetas_detalle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rol_detalle`
--
ALTER TABLE `rol_detalle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT de la tabla `signos_vitales`
--
ALTER TABLE `signos_vitales`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `urgencias`
--
ALTER TABLE `urgencias`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `urgencias_servicios`
--
ALTER TABLE `urgencias_servicios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
