-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-11-2023 a las 00:21:16
-- Versión del servidor: 10.6.12-MariaDB-0ubuntu0.22.04.1
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cbecrm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenes`
--

CREATE TABLE `almacenes` (
  `id` int(10) NOT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `domicilio` varchar(250) DEFAULT NULL,
  `encargado` varchar(250) DEFAULT NULL,
  `telefono` varchar(250) DEFAULT NULL,
  `celularenc` varchar(250) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) NOT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `padre_id` int(10) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(10) NOT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `zona_id` int(10) DEFAULT NULL,
  `lp_cliente_id` int(10) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `rfc` varchar(250) DEFAULT NULL,
  `curp` varchar(250) DEFAULT NULL,
  `telefono` varchar(250) DEFAULT NULL,
  `celular` varchar(250) DEFAULT NULL,
  `correo` varchar(250) DEFAULT NULL,
  `website` varchar(250) DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `domicilio` varchar(250) DEFAULT NULL,
  `colonia` varchar(250) DEFAULT NULL,
  `estado` varchar(250) DEFAULT NULL,
  `ciudad` varchar(250) DEFAULT NULL,
  `cp` varchar(250) DEFAULT NULL,
  `entre_calles` varchar(250) DEFAULT NULL,
  `nacionalidad` varchar(250) DEFAULT NULL,
  `credito` int(1) DEFAULT NULL,
  `dias_credito` int(10) DEFAULT NULL,
  `limite_credito` int(10) DEFAULT NULL,
  `dias_visita` int(10) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_contacto`
--

CREATE TABLE `clientes_contacto` (
  `id` int(10) NOT NULL,
  `cliente_id` int(10) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `telefono` varchar(250) DEFAULT NULL,
  `celular` varchar(250) DEFAULT NULL,
  `correo` varchar(250) DEFAULT NULL,
  `tipo` varchar(250) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_envios`
--

CREATE TABLE `clientes_envios` (
  `id` int(10) NOT NULL,
  `cliente_id` int(10) DEFAULT NULL,
  `zona_id` int(10) DEFAULT NULL,
  `domicilio` varchar(250) DEFAULT NULL,
  `colonia` varchar(250) DEFAULT NULL,
  `estado` varchar(250) DEFAULT NULL,
  `ciudad` varchar(250) DEFAULT NULL,
  `cp` varchar(10) DEFAULT NULL,
  `entre_calles` varchar(250) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(10) NOT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `proveedor_id` int(10) DEFAULT NULL,
  `almacen_id` int(10) DEFAULT NULL,
  `tipo` varchar(1) DEFAULT NULL,
  `credito` int(1) DEFAULT NULL,
  `fecha_orden` date DEFAULT NULL,
  `fecha_compra` date DEFAULT NULL,
  `fecha_credito` date DEFAULT NULL,
  `fecha_credito_vecncimiento` date DEFAULT NULL,
  `fecha_pago_credito` date DEFAULT NULL,
  `fecha_cancelacion` date DEFAULT NULL,
  `subtotal` decimal(20,6) DEFAULT NULL,
  `impuestos` decimal(20,6) DEFAULT NULL,
  `retenciones` decimal(20,6) DEFAULT NULL,
  `total` decimal(20,6) DEFAULT NULL,
  `pendiente` decimal(20,6) NOT NULL,
  `pagado` decimal(20,6) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_detalle`
--

CREATE TABLE `compras_detalle` (
  `id` int(10) NOT NULL,
  `compra_id` int(10) DEFAULT NULL,
  `producto_id` int(10) DEFAULT NULL,
  `almacen_id` int(10) DEFAULT NULL,
  `unidad_id` int(10) DEFAULT NULL,
  `cantidad` decimal(10,6) DEFAULT NULL,
  `precio` decimal(20,6) DEFAULT NULL,
  `iva` decimal(20,6) DEFAULT NULL,
  `subtotal` decimal(20,6) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_devoluciones`
--

CREATE TABLE `compras_devoluciones` (
  `id` int(10) NOT NULL,
  `compra_id` int(10) DEFAULT NULL,
  `detalle_id` int(10) DEFAULT NULL,
  `producto_id` int(10) DEFAULT NULL,
  `cantidad` decimal(20,6) DEFAULT NULL,
  `motivo` varchar(250) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_impuestos`
--

CREATE TABLE `compras_impuestos` (
  `id` int(10) NOT NULL,
  `compra_id` int(10) DEFAULT NULL,
  `detalle_id` int(10) DEFAULT NULL,
  `tipo` varchar(1) DEFAULT NULL,
  `base` int(11) NOT NULL,
  `impuesto` decimal(10,6) DEFAULT NULL,
  `factor` decimal(10,6) DEFAULT NULL,
  `cuota` decimal(10,6) DEFAULT NULL,
  `importe` decimal(20,6) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_pagos`
--

CREATE TABLE `compras_pagos` (
  `id` int(10) NOT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `compra_id` int(10) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `forma_pago` varchar(250) DEFAULT NULL,
  `importe` decimal(20,6) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corte_caja`
--

CREATE TABLE `corte_caja` (
  `id` int(10) DEFAULT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_termino` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_termino` time DEFAULT NULL,
  `inicial` decimal(20,6) DEFAULT NULL,
  `entradas` decimal(20,6) DEFAULT NULL,
  `salidas` decimal(20,6) DEFAULT NULL,
  `final` decimal(20,6) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` int(10) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `logo` varchar(250) DEFAULT NULL,
  `rfc` varchar(250) DEFAULT NULL,
  `regimen` varchar(250) DEFAULT NULL,
  `calle` varchar(250) DEFAULT NULL,
  `colonia` varchar(250) DEFAULT NULL,
  `ciudad` varchar(250) DEFAULT NULL,
  `estado` varchar(250) DEFAULT NULL,
  `cp` varchar(10) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esquema_sat`
--

CREATE TABLE `esquema_sat` (
  `id` int(10) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `iva` decimal(20,6) DEFAULT NULL,
  `ipes` decimal(20,6) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `esquema_sat`
--

INSERT INTO `esquema_sat` (`id`, `nombre`, `iva`, `ipes`, `status`) VALUES
(1, 'IVA', 0.160000, 0.000000, 1),
(2, 'SIN IVA', 0.000000, 0.000000, 1),
(3, 'Excento IVA 8% IPES', 0.160000, 0.080000, 1),
(4, 'Excento IVA 25% IPES', 0.160000, 0.250000, 1),
(5, 'Excento IVA 50% IPES', 0.160000, 0.500000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id` int(10) NOT NULL,
  `empresa_d` int(10) DEFAULT NULL,
  `gasto_tipo_id` int(10) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_gasto` date DEFAULT NULL,
  `importe` decimal(20,6) DEFAULT NULL,
  `concepto` varchar(250) DEFAULT NULL,
  `comprobante` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_tipos`
--

CREATE TABLE `gastos_tipos` (
  `id` int(10) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(10) NOT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `almacen_id` int(10) DEFAULT NULL,
  `producto_id` int(10) DEFAULT NULL,
  `proveedor_id` int(10) DEFAULT NULL,
  `lote_id` int(10) DEFAULT NULL,
  `cantidad` int(10) DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_log`
--

CREATE TABLE `inventario_log` (
  `id` int(10) NOT NULL,
  `inventario_id` int(10) DEFAULT NULL,
  `producto_id` int(10) DEFAULT NULL,
  `inicial` int(10) DEFAULT NULL,
  `cantidad` int(10) DEFAULT NULL,
  `final` int(10) DEFAULT NULL,
  `evento` varchar(250) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas`
--

CREATE TABLE `lineas` (
  `id` int(10) NOT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `padre_id` int(10) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lp_clientes`
--

CREATE TABLE `lp_clientes` (
  `id` int(10) NOT NULL,
  `empresa_id` int(10) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `porcentaje` decimal(10,6) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lp_proveedor`
--

CREATE TABLE `lp_proveedor` (
  `id` int(10) NOT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `porcentaje` decimal(10,6) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `tipo` varchar(5) DEFAULT NULL,
  `padre_id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `url` varchar(150) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `orden` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `tipo`, `padre_id`, `nombre`, `url`, `icon`, `orden`, `status`) VALUES
(1, 'admin', 0, 'Especialistas', 'admin/medicos', 'fa-user-md', 1, 0),
(2, 'admin', 0, 'Pacientes', 'admin/pacientes', 'fa-users', 2, 1),
(3, 'admin', 0, 'Agenda', 'admin/citas', 'fa-calendar', 3, 0),
(4, 'admin', 0, 'N. de Progreso', 'admin/consultas', 'fa-heartbeat', 4, 0),
(5, 'cats', 0, 'Areas', 'admin/areas', 'fa-sitemap', 1, 1),
(6, 'cats', 0, 'Riesgos', '', 'fa-exclamation-circle', 2, 0),
(7, 'cats', 0, 'Sustancias', 'admin/sustancias', 'fa-beer', 3, 0),
(8, 'cats', 0, 'Tratamientos', 'admin/tratamientos', 'fa-medkit', 4, 0),
(9, 'conf', 0, 'Informacion', 'admin/empresas', 'fa-industry', 1, 1),
(10, 'conf', 0, 'Roles y Permisos', 'admin/roles', 'fa-key', 2, 1),
(11, 'conf', 0, 'Usuarios', 'admin/users', 'fa-universal-access', 3, 1),
(12, 'cats', 6, 'Grupos', 'admin/riesgos/grupos', 'fa-code-fork', 5, 0),
(13, 'cats', 6, 'Parametros', 'admin/riesgos/parametros', 'fa-fire', 6, 0),
(14, 'admin', 0, 'Notas', 'admin/notas', 'fa-commenting-o', 5, 0),
(15, 'admin', 0, 'Supervision', 'admin/supervision', 'fa-check-circle', 6, 0),
(16, 'cats', 0, 'Edos. Civiles', 'admin/relaciones', 'fa-list', 7, 0),
(17, 'cats', 0, 'Delegaciones', 'admin/delegaciones', 'fa-cubes', 0, 1),
(18, 'cats', 0, 'Relaciones', 'admin/familia', 'fa-sitemap', 9, 0),
(19, 'cats', 0, 'Ocupaciones', 'admin/ocupaciones', 'fa-briefcase', 10, 0),
(20, 'shop', 0, 'Paquetes', 'admin/paquetes', 'fa-archive', 0, 0),
(21, 'cats', 0, 'Religiones', 'admin/religiones', 'fa-bell', 11, 0),
(22, 'shop', 0, 'Pagos', 'admin/pagos', 'fa-credit-card', 1, 0),
(23, 'shop', 0, 'Contrataciones', 'admin/contrataciones', 'fa-book', 2, 0),
(24, 'evals', 0, 'Grupos', 'admin/grupos', 'fa-plus-square-o', 1, 1),
(25, 'evals', 0, 'Preguntas', 'admin/preguntas', 'fa-book', 2, 1),
(26, 'evals', 0, 'Resultados', 'admin/resultados', 'fa-list-ol', 3, 1),
(27, 'evals', 0, 'Evaluaciones', '', 'fa-bar-chart', 3, 0),
(28, 'site', 0, 'Informacion', 'admin/informacion', 'fa-inbox', 1, 0),
(29, 'site', 0, 'Slider', 'admin/slider', 'fa-sliders', 2, 0),
(30, 'site', 0, 'Configuracion', 'admin/siteconfig', 'fa-sitemap', 1, 1),
(31, 'site', 0, 'Slider', 'admin/slider', 'fa-bar-chart', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` int(10) NOT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `user_envia_id` int(10) DEFAULT NULL,
  `user_aprueba_id` int(10) DEFAULT NULL,
  `tipo` varchar(1) DEFAULT NULL,
  `almacen_origen` int(10) DEFAULT NULL,
  `almacen_destino` int(10) DEFAULT NULL,
  `fecha_envio` date DEFAULT NULL,
  `fecha_aprobacion` date DEFAULT NULL,
  `fecha_rechazo` date DEFAULT NULL,
  `motivo_rechazo` varchar(250) DEFAULT NULL,
  `observaciones` varchar(250) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_detalle`
--

CREATE TABLE `movimientos_detalle` (
  `id` int(10) NOT NULL,
  `movimiento_id` int(10) DEFAULT NULL,
  `producto_id` int(10) DEFAULT NULL,
  `cantidad` decimal(10,6) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `id` int(10) NOT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_termino` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_termino` time DEFAULT NULL,
  `venta_minima` decimal(20,6) DEFAULT NULL,
  `venta_maxima` decimal(20,6) DEFAULT NULL,
  `tipo` varchar(200) DEFAULT NULL,
  `tipo_aplicacion` varchar(250) DEFAULT NULL,
  `vendidas` int(10) DEFAULT NULL,
  `porcentaje` decimal(10,6) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas_detalle`
--

CREATE TABLE `ofertas_detalle` (
  `id` int(10) NOT NULL,
  `oferta_id` int(10) DEFAULT NULL,
  `categoria_id` int(10) DEFAULT NULL,
  `linea_id` int(10) DEFAULT NULL,
  `almacen_id` int(10) DEFAULT NULL,
  `producto_id_inicia` int(10) DEFAULT NULL,
  `producto_id_termin` int(10) DEFAULT NULL,
  `proveedor_id_inicia` int(10) DEFAULT NULL,
  `proveedor_id_termin` int(10) DEFAULT NULL,
  `cliente_id_inicia` int(10) DEFAULT NULL,
  `cliente_id_termina` int(10) DEFAULT NULL,
  `zona_id` int(10) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `sku` varchar(250) DEFAULT NULL,
  `tipo` varchar(250) DEFAULT NULL,
  `imagen` varchar(250) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `clavesat` varchar(250) DEFAULT NULL,
  `cvesatunidad` varchar(250) DEFAULT NULL,
  `unidadentrada` varchar(250) DEFAULT NULL,
  `unidadsalida` varchar(250) DEFAULT NULL,
  `ubicacion` varchar(250) DEFAULT NULL,
  `uso` longtext DEFAULT NULL,
  `costo` varchar(250) DEFAULT NULL,
  `destacado` int(1) DEFAULT NULL,
  `stock_maximo` int(10) DEFAULT NULL,
  `stock_minimo` int(10) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_categorias`
--

CREATE TABLE `productos_categorias` (
  `id` int(10) NOT NULL,
  `producto_id` int(10) DEFAULT NULL,
  `categoria_id` int(10) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_lotes`
--

CREATE TABLE `productos_lotes` (
  `id` int(10) NOT NULL,
  `producto_id` int(10) DEFAULT NULL,
  `no_lote` varchar(100) DEFAULT NULL,
  `ingreso` date DEFAULT NULL,
  `vencimiento` date DEFAULT NULL,
  `cantidad` decimal(20,6) DEFAULT NULL,
  `stock` decimal(20,6) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_proveedores`
--

CREATE TABLE `productos_proveedores` (
  `id` int(10) NOT NULL,
  `producto_id` int(10) DEFAULT NULL,
  `proveedor_id` int(10) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_linea`
--

CREATE TABLE `producto_linea` (
  `id` int(10) NOT NULL,
  `producto_id` int(10) DEFAULT NULL,
  `linea_id` int(10) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(10) NOT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `lp_proveedor_id` int(10) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `rfc` varchar(250) DEFAULT NULL,
  `regimen` varchar(250) DEFAULT NULL,
  `domicilio` varchar(250) DEFAULT NULL,
  `telefono` varchar(250) DEFAULT NULL,
  `correo` varchar(250) DEFAULT NULL,
  `website` varchar(250) DEFAULT NULL,
  `curp` varchar(250) DEFAULT NULL,
  `credito` int(1) DEFAULT NULL,
  `dias_credito` varchar(250) DEFAULT NULL,
  `limite_credito` varchar(250) DEFAULT NULL,
  `forma_pago` varchar(250) DEFAULT NULL,
  `logo` varchar(250) DEFAULT NULL,
  `constancia` varchar(250) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_contactos`
--

CREATE TABLE `proveedor_contactos` (
  `id` int(10) NOT NULL,
  `proveedor_id` int(10) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `telefono` varchar(250) DEFAULT NULL,
  `extension` varchar(250) DEFAULT NULL,
  `celular` varchar(250) DEFAULT NULL,
  `correo` varchar(250) DEFAULT NULL,
  `tipo` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `visual` int(11) NOT NULL,
  `addRecord` int(11) DEFAULT NULL,
  `editRecord` int(11) DEFAULT NULL,
  `viewRecord` int(11) DEFAULT NULL,
  `deleteRecord` int(11) DEFAULT NULL,
  `expediente` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `visual`, `addRecord`, `editRecord`, `viewRecord`, `deleteRecord`, `expediente`, `description`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Super Usuario', 1, 1, 1, 1, 1, 1, 'Super Usuario', '2021-01-05 06:00:00', '2022-05-11 05:00:00', 1),
(2, 'Administrador', 1, 1, 1, 1, 1, 1, 'Administrador', '2021-06-28 05:00:00', '2022-05-11 05:00:00', 1),
(3, 'Especialista', 2, 1, 0, 1, 0, 1, 'Especialista', '2021-06-28 05:00:00', '2022-05-11 05:00:00', 1),
(4, 'Secretaria', 1, 1, 1, 1, 0, 0, 'Secretaria', '2021-06-28 05:00:00', '2022-05-15 05:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_detalle`
--

CREATE TABLE `rol_detalle` (
  `id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `modulo_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `rol_detalle`
--

INSERT INTO `rol_detalle` (`id`, `rol_id`, `modulo_id`, `status`) VALUES
(320, 3, 2, 1),
(321, 3, 3, 1),
(322, 3, 4, 1),
(323, 3, 15, 1),
(324, 1, 1, 1),
(325, 1, 2, 1),
(326, 1, 3, 1),
(327, 1, 4, 1),
(328, 1, 5, 1),
(329, 1, 6, 1),
(330, 1, 12, 1),
(331, 1, 13, 1),
(332, 1, 7, 1),
(333, 1, 8, 1),
(334, 1, 9, 1),
(335, 1, 10, 1),
(336, 1, 11, 1),
(337, 1, 15, 1),
(338, 1, 16, 1),
(339, 1, 17, 1),
(340, 1, 18, 1),
(341, 1, 19, 1),
(342, 1, 20, 1),
(343, 1, 21, 1),
(344, 1, 22, 1),
(345, 1, 23, 1),
(346, 1, 24, 1),
(347, 1, 25, 1),
(348, 1, 26, 1),
(349, 1, 28, 1),
(350, 1, 29, 1),
(351, 1, 30, 1),
(352, 2, 1, 1),
(353, 2, 2, 1),
(354, 2, 3, 1),
(355, 2, 4, 1),
(356, 2, 5, 1),
(357, 2, 6, 1),
(358, 2, 12, 1),
(359, 2, 13, 1),
(360, 2, 7, 1),
(361, 2, 8, 1),
(362, 2, 9, 1),
(363, 2, 10, 1),
(364, 2, 11, 1),
(365, 2, 15, 1),
(366, 2, 16, 1),
(367, 2, 17, 1),
(368, 2, 18, 1),
(369, 2, 19, 1),
(370, 2, 20, 1),
(371, 2, 21, 1),
(372, 2, 22, 1),
(373, 2, 23, 1),
(374, 4, 2, 1),
(375, 4, 3, 1),
(376, 4, 20, 1),
(377, 4, 22, 1),
(378, 4, 23, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `rol` int(11) NOT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `departamento_id` int(10) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `time_login` datetime DEFAULT NULL,
  `online` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `rol`, `empresa_id`, `departamento_id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `time_login`, `online`, `status`) VALUES
(1, 1, 0, NULL, 'Administrador', 'admin@app.com', '$2y$10$E14A0D/2f3uCFPMEod5rV.x11ZdLO45eKccC2Zzbs7bBloo9bmzzK', 'ozdsuGCm1gDPqpl2u6q8X5mMnbtwewPtrZ86xaUd9A3SnW04OxwBGvyNXaQP', NULL, '2020-07-24 01:38:27', '2020-07-23 20:38:27', 1, 1),
(2, 2, 0, NULL, 'Cui Valenzuela', 'cui5@hotmail.com', '$2y$10$5kHhIIwc1z2w.zi4tojl0e9pzp2KeNn/FvsdMv6.JaHt../g/7Q7S', 'FRgScnhsnc3KOStPlWZQNAzE2rlCBk2kKFktJZIFFlcMG3PSpZ6fdOy6S4lJ', '2021-06-28 05:00:00', '2021-07-19 05:00:00', NULL, 0, 1),
(3, 3, 0, NULL, 'Manuel Aguilar', 'manu75aguilarleyva@gmail.com', '$2y$10$Xqy.ZMa2HrZ2C4B3KpwPiORGXx6TEHShSqLefJrazyAIBPsaDgFp6', 'OO8HOLv1bZOoa173O4mk84zbqk5zTonaQhDIEyggGwrXAYPyq66AGmTwMw1k', '2021-06-28 05:00:00', '2021-07-19 05:00:00', NULL, 0, 1),
(7, 3, 0, NULL, 'Angela Pineda', 'angelapineda@live.com.mx', '$2y$10$n/luZ5ZZI4DhjgRzqGCviO5Vv2QcjHPxF7HIhetON0sT5QNX3PVZi', 'StIg2JJNFi68gMlipeYGIAkGgheFhNwB0ySSSObW7tRjYH6RFoXxFIHkByW4', NULL, NULL, NULL, 0, 1),
(8, 2, 0, NULL, 'Omar Berumen', 'lomarbpa@gmail.com', '$2y$10$NJAWSdQA7smqRiRDYL9YwuY.jSOhFoUayj.7tkiQft1ZXpo7i36LS', 'XuCSygI4a6DHUZzJApVzdHAB6z9nb4xvOSee1STMrpANJc3Ag8fjJcGpjaTX', NULL, NULL, NULL, 0, 1),
(9, 3, 0, NULL, 'Valeria Coria', 'valeria_coria98@outlook.com', '$2y$10$lM448camXUosJaK3me6sLu4vqEyIAmYnNTsxP5rxmWGrCo.4T6FF2', NULL, '2021-06-29 05:00:00', NULL, NULL, 0, 0),
(10, 4, 0, NULL, 'Secretaria', 'institutoqi@icloud.com', '$2y$10$5X7zD2JwWIEjQnhmbL0W5OuyTB7Uy527i4hMiF8T3O/U/VHqhoMx6', 'KDG57vs0I3RyXzD61wbIkQgatRlfhtgYwjk8neetd8qIIWzHSnDJQnx5sxgS', '2021-06-29 05:00:00', '2021-11-24 06:00:00', NULL, 0, 1),
(11, 2, 0, NULL, 'Dirección Clínica', 'lomarbp@hotmail.com', '$2y$10$Q01nRs0m3RvvUOCO99LegeYNEX7dA/vXPKBJq.kFCRn0LOjdPoyJy', 'Bf2w3GHo9Ey4QOXsBzljDtEIIXxbST7wiDmK1V8R1b2RLzKZWIiPWmIhNF9y', '2021-08-13 05:00:00', '2021-09-13 05:00:00', NULL, 0, 1),
(12, 1, 0, NULL, 'LOURDES MONTENEGRO', 'loumon04@yahoo.com.mx', '$2y$10$UGas8FN6k8xcxxiuFmQUretL3m1LOwb5FsEM1uCP4NonQ0wU//F9.', 'd6e1Ogbc9LFTpydDOpIAcEakhja08A3fCR0rjmLFXBQUNIvcLVL1ZZpsUi0E', '2021-11-03 06:00:00', NULL, NULL, 0, 1),
(13, 3, 0, NULL, 'Irma Guzmán', 'icgv01@gmail.com', '$2y$10$To5WIPy707w9koPS6hqxV.qMvy.3XGKA3ZrvGh2PT1HapCMlERoNu', NULL, NULL, NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores`
--

CREATE TABLE `vendedores` (
  `id` int(10) NOT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `foto` varchar(250) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `telefono` varchar(250) DEFAULT NULL,
  `correo` varchar(250) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(10) NOT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `cliente_id` int(10) DEFAULT NULL,
  `cliente_facturacion_id` inet6 DEFAULT NULL,
  `cliente_envio_id` int(10) DEFAULT NULL,
  `almacen_id` int(10) DEFAULT NULL,
  `credito` int(1) DEFAULT NULL,
  `fecha_venta` date DEFAULT NULL,
  `fecha_credito` date DEFAULT NULL,
  `fecha_credito_vencimiento` date DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `fecha_cancelacion` date DEFAULT NULL,
  `subtotal` decimal(20,6) DEFAULT NULL,
  `impuestos` decimal(20,6) DEFAULT NULL,
  `retenciones` decimal(20,6) DEFAULT NULL,
  `total` decimal(20,6) DEFAULT NULL,
  `pendiente` decimal(20,6) DEFAULT NULL,
  `pagado` decimal(20,6) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalle`
--

CREATE TABLE `ventas_detalle` (
  `id` int(10) NOT NULL,
  `venta_id` int(10) DEFAULT NULL,
  `producto_id` int(10) DEFAULT NULL,
  `almacen_id` int(10) DEFAULT NULL,
  `unidad_id` int(10) DEFAULT NULL,
  `cantidad` decimal(10,6) DEFAULT NULL,
  `precio` decimal(20,6) DEFAULT NULL,
  `iva` decimal(20,6) DEFAULT NULL,
  `subtotal` decimal(20,6) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_devoluciones`
--

CREATE TABLE `ventas_devoluciones` (
  `id` int(10) NOT NULL,
  `venta_id` int(10) DEFAULT NULL,
  `detalle_id` int(10) DEFAULT NULL,
  `producto_id` int(10) DEFAULT NULL,
  `cantidad` decimal(20,6) DEFAULT NULL,
  `motivo` varchar(250) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_impuestos`
--

CREATE TABLE `ventas_impuestos` (
  `id` int(10) NOT NULL,
  `venta_id` int(10) DEFAULT NULL,
  `detalle_id` int(10) DEFAULT NULL,
  `tipo` varchar(1) DEFAULT NULL,
  `base` int(11) NOT NULL,
  `impuesto` decimal(10,6) DEFAULT NULL,
  `factor` decimal(10,6) DEFAULT NULL,
  `cuota` decimal(10,6) DEFAULT NULL,
  `importe` decimal(20,6) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_pagos`
--

CREATE TABLE `ventas_pagos` (
  `id` int(10) NOT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `venta_id` int(10) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `forma_pago` varchar(250) DEFAULT NULL,
  `importe` decimal(20,6) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `id` int(10) DEFAULT NULL,
  `empresa_id` int(10) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `estado` varchar(250) DEFAULT NULL,
  `ciudad` varchar(250) DEFAULT NULL,
  `colonia` varchar(250) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes_contacto`
--
ALTER TABLE `clientes_contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes_envios`
--
ALTER TABLE `clientes_envios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras_detalle`
--
ALTER TABLE `compras_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras_devoluciones`
--
ALTER TABLE `compras_devoluciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras_impuestos`
--
ALTER TABLE `compras_impuestos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras_pagos`
--
ALTER TABLE `compras_pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `esquema_sat`
--
ALTER TABLE `esquema_sat`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos_tipos`
--
ALTER TABLE `gastos_tipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario_log`
--
ALTER TABLE `inventario_log`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lineas`
--
ALTER TABLE `lineas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lp_clientes`
--
ALTER TABLE `lp_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lp_proveedor`
--
ALTER TABLE `lp_proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimientos_detalle`
--
ALTER TABLE `movimientos_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ofertas_detalle`
--
ALTER TABLE `ofertas_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_categorias`
--
ALTER TABLE `productos_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_lotes`
--
ALTER TABLE `productos_lotes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_proveedores`
--
ALTER TABLE `productos_proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_linea`
--
ALTER TABLE `producto_linea`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor_contactos`
--
ALTER TABLE `proveedor_contactos`
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
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas_devoluciones`
--
ALTER TABLE `ventas_devoluciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas_impuestos`
--
ALTER TABLE `ventas_impuestos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas_pagos`
--
ALTER TABLE `ventas_pagos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes_contacto`
--
ALTER TABLE `clientes_contacto`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes_envios`
--
ALTER TABLE `clientes_envios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compras_detalle`
--
ALTER TABLE `compras_detalle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compras_devoluciones`
--
ALTER TABLE `compras_devoluciones`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compras_impuestos`
--
ALTER TABLE `compras_impuestos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compras_pagos`
--
ALTER TABLE `compras_pagos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `esquema_sat`
--
ALTER TABLE `esquema_sat`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gastos_tipos`
--
ALTER TABLE `gastos_tipos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario_log`
--
ALTER TABLE `inventario_log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lineas`
--
ALTER TABLE `lineas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lp_clientes`
--
ALTER TABLE `lp_clientes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lp_proveedor`
--
ALTER TABLE `lp_proveedor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `movimientos_detalle`
--
ALTER TABLE `movimientos_detalle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ofertas_detalle`
--
ALTER TABLE `ofertas_detalle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos_categorias`
--
ALTER TABLE `productos_categorias`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos_lotes`
--
ALTER TABLE `productos_lotes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos_proveedores`
--
ALTER TABLE `productos_proveedores`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto_linea`
--
ALTER TABLE `producto_linea`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor_contactos`
--
ALTER TABLE `proveedor_contactos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol_detalle`
--
ALTER TABLE `rol_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=379;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas_devoluciones`
--
ALTER TABLE `ventas_devoluciones`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas_impuestos`
--
ALTER TABLE `ventas_impuestos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas_pagos`
--
ALTER TABLE `ventas_pagos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
