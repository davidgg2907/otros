-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 11-12-2019 a las 09:22:06
-- Versión del servidor: 5.7.27-0ubuntu0.16.04.1
-- Versión de PHP: 7.2.22-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenes`
--

CREATE TABLE `almacenes` (
  `id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `encargado_id` int(10) NOT NULL,
  `clave` varchar(150) DEFAULT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `descripcion` varchar(150) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `pertenencia_id` int(10) NOT NULL,
  `clave` varchar(150) DEFAULT NULL,
  `nombre` varchar(150) NOT NULL,
  `alias` varchar(150) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `rfc` varchar(20) DEFAULT NULL,
  `dom_envio` varchar(250) DEFAULT NULL,
  `dom_fiscal` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `proveedor_id` int(10) NOT NULL,
  `folio` varchar(50) NOT NULL,
  `fecha_compra` date NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subtotal` decimal(20,6) NOT NULL,
  `iva` decimal(20,6) NOT NULL,
  `total` decimal(20,6) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_detalle`
--

CREATE TABLE `compras_detalle` (
  `id` int(10) NOT NULL,
  `compra_id` int(10) NOT NULL,
  `producto_id` int(10) NOT NULL,
  `codigo` varchar(150) NOT NULL,
  `almacen_id` int(10) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `precio` decimal(20,6) NOT NULL,
  `impuesto` decimal(20,6) NOT NULL,
  `precio_neto` decimal(20,6) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `clave` varchar(150) NOT NULL,
  `valor` longtext NOT NULL,
  `serializado` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `sucursal_id`, `tipo`, `clave`, `valor`, `serializado`, `status`) VALUES
(1, 0, 'conf', 'almacen_ventas', '1', 0, 1),
(2, 0, 'conf', 'almacen_soporte', '3', 0, 1),
(6, 0, 'conf', 'almacen_tickets', '7', 0, 1),
(8, 0, 'conf', 'encargado_ventas', '7', 0, 1),
(9, 0, 'conf', 'encargado_soporte', '8', 0, 1),
(10, 0, 'conf', 'encargado_tickets', '7', 0, 1),
(11, 0, 'conf', 'almacen_devoluciones', '7', 0, 1),
(12, 0, 'conf', 'encargado_devoluciones', '7', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `id` int(10) NOT NULL,
  `tipo` int(10) DEFAULT NULL,
  `sucursal_id` int(10) NOT NULL,
  `cliente_id` int(10) NOT NULL,
  `ventedor_id` int(10) NOT NULL,
  `origen_id` int(10) NOT NULL,
  `folio` varchar(150) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `subtotal` decimal(20,6) NOT NULL,
  `iva` decimal(20,6) NOT NULL,
  `total` decimal(20,6) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones_detalle`
--

CREATE TABLE `cotizaciones_detalle` (
  `id` int(10) NOT NULL,
  `venta_id` int(10) NOT NULL,
  `producto_id` int(10) NOT NULL,
  `almacen_id` int(10) NOT NULL,
  `codigo` varchar(150) DEFAULT NULL,
  `clave` varchar(150) DEFAULT NULL,
  `cantidad` varchar(150) NOT NULL,
  `precio` decimal(20,6) NOT NULL,
  `total` decimal(20,6) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familias`
--

CREATE TABLE `familias` (
  `id` int(10) NOT NULL,
  `clave` varchar(150) NOT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `descripcion` varchar(150) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `codigo` varchar(150) NOT NULL,
  `producto_id` int(10) NOT NULL,
  `almacen_id` int(10) NOT NULL,
  `existencias` int(10) NOT NULL,
  `apartados` int(10) NOT NULL,
  `fecha_mov` datetime NOT NULL,
  `concepto` varchar(250) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(10) NOT NULL,
  `padre_id` int(10) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `url` varchar(150) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `orden` int(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `padre_id`, `clave`, `nombre`, `url`, `icon`, `orden`, `status`) VALUES
(1, 0, 'inv', 'Almacenes', 'admin/almacenes', 'fa-folder-o\n', 1, 1),
(2, 0, 'inv', 'Categorias', 'admin/familias', 'fa-sitemap', 0, 1),
(3, 0, 'admin', 'Productos', 'admin/productos', 'fa-camera', 2, 1),
(4, 0, 'opr', 'Proveedores', 'admin/proveedores', 'fa-users', 1, 1),
(5, 0, 'opr', 'Compras', 'admin/compras', 'fa-shopping-basket', 2, 1),
(6, 0, 'inv', 'Inventarios', 'admin/inventario', 'fa-archive', 5, 1),
(7, 0, 'inv', 'Transferencias', 'admin/transferencias/add', 'fa-exchange', 6, 1),
(8, 0, 'conf', 'Roles', 'admin/roles', 'fa-key', 1, 1),
(9, 0, 'conf', 'Usuarios', 'admin/users', 'fa-universal-access', 2, 1),
(10, 0, 'opr', 'Clientes', 'admin/clientes', 'fa-address-card', 3, 1),
(11, 0, 'admin', 'Vendedores', 'admin/vendedores', 'fa-user-secret', 6, 0),
(12, 0, 'opr', 'Ventas', 'admin/ventas/add', 'fa-shopping-cart', 5, 1),
(13, 0, 'admin', 'Sucursales', 'admin/sucursales', 'fa-building', 1, 1),
(14, 0, 'sopt', 'Agentes', 'admin/agentes', 'fa-users', 1, 0),
(15, 0, 'sopt', 'Ingresos', 'admin/ingresos/add', 'fa-refresh', 2, 1),
(16, 0, 'sopt', 'Soporte', 'admin/soporte', 'fa-ticket', 3, 1),
(17, 0, 'sopt', 'Existencias', 'admin/ingresos/transferencias', 'fa-archive', 4, 1),
(18, 15, 'sopt', 'Devoluciones', 'admin/ingresos/add', '', 1, 1),
(19, 15, 'sopt', 'Tickets', 'admin/tickets/add', '', 2, 1),
(20, 0, 'opr', 'Cotizaciones', 'admin/cotizaciones', 'fa-file-pdf-o', 4, 1),
(21, 0, 'admin', 'Origenes', 'admin/origenes', 'fa-sitemap', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `origenes`
--

CREATE TABLE `origenes` (
  `id` int(10) NOT NULL,
  `origen` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `imagen` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pertenencias`
--

CREATE TABLE `pertenencias` (
  `id` int(10) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `familia_id` int(10) NOT NULL,
  `codigo` varchar(150) NOT NULL,
  `sku` varchar(150) NOT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `descripcion` varchar(250) NOT NULL,
  `imagen` varchar(250) DEFAULT NULL,
  `precio_costo` decimal(20,6) DEFAULT NULL COMMENT 'ultimi precio de costo',
  `precio_venta` decimal(20,6) DEFAULT NULL,
  `stock_maximo` int(10) DEFAULT NULL,
  `stock_minimo` int(10) DEFAULT NULL,
  `existencias` int(10) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `clave` varchar(150) DEFAULT NULL,
  `razon_social` varchar(150) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `extension` varchar(20) DEFAULT NULL,
  `contacto` varchar(150) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `comentarios` longtext,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `perfil` int(5) NOT NULL,
  `visual` int(1) NOT NULL,
  `accion` int(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `editable` int(1) NOT NULL DEFAULT '1',
  `removable` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `perfil`, `visual`, `accion`, `name`, `description`, `editable`, `removable`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 1, 1, 'Rol Maestro', 'Rol Maestro', 1, 1, '2019-12-11 06:00:00', NULL, 1);

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
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 5, 1),
(5, 1, 6, 1),
(6, 1, 7, 1),
(7, 1, 8, 1),
(8, 1, 9, 1),
(9, 1, 10, 1),
(10, 1, 12, 1),
(11, 1, 13, 1),
(12, 1, 15, 1),
(13, 1, 18, 1),
(14, 1, 19, 1),
(15, 1, 16, 1),
(16, 1, 17, 1),
(17, 1, 20, 1),
(18, 1, 21, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soporte_ingresos`
--

CREATE TABLE `soporte_ingresos` (
  `id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `agente_id` int(10) NOT NULL,
  `venta_id` int(10) NOT NULL,
  `no_compra` varchar(150) NOT NULL,
  `cliente` varchar(150) NOT NULL,
  `alias` varchar(150) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `importe` decimal(20,6) NOT NULL,
  `referencia` varchar(250) NOT NULL,
  `rastreo` varchar(150) NOT NULL,
  `url` varchar(250) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `comentarios` varchar(250) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soporte_ingresos_detalle`
--

CREATE TABLE `soporte_ingresos_detalle` (
  `id` int(10) NOT NULL,
  `ingreso_id` int(10) NOT NULL,
  `producto_id` int(10) NOT NULL,
  `codigo` varchar(150) NOT NULL,
  `clave` varchar(150) NOT NULL,
  `cantidad` varchar(150) NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `motivo` varchar(250) NOT NULL,
  `condicion` varchar(250) NOT NULL,
  `comentarios` varchar(250) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soporte_mtto`
--

CREATE TABLE `soporte_mtto` (
  `id` int(10) NOT NULL,
  `ingreso_id` int(10) NOT NULL DEFAULT '0',
  `ticket_id` int(10) DEFAULT '0',
  `venta_id` int(10) NOT NULL,
  `producto_id` int(10) NOT NULL,
  `codigo` varchar(150) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `compania` varchar(150) NOT NULL,
  `rastreo` varchar(150) NOT NULL,
  `fecha_ingres` varchar(150) NOT NULL,
  `imagen_recepcion` varchar(250) NOT NULL,
  `imagen_ingreso` varchar(250) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soporte_tickets`
--

CREATE TABLE `soporte_tickets` (
  `id` int(10) NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `agente_id` int(10) NOT NULL,
  `venta_id` int(10) NOT NULL,
  `no_compra` varchar(150) NOT NULL,
  `referencia` varchar(250) NOT NULL,
  `rastreo` varchar(150) NOT NULL,
  `producto_id` int(10) NOT NULL,
  `codigo` varchar(150) NOT NULL,
  `clave` varchar(150) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `url` varchar(250) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `comentarios` varchar(250) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id` int(10) NOT NULL,
  `clave` varchar(20) DEFAULT NULL,
  `razon_social` varchar(150) NOT NULL,
  `nombre_comercial` varchar(150) DEFAULT NULL,
  `encargado` varchar(150) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `calle` varchar(150) DEFAULT NULL,
  `colonia` varchar(150) DEFAULT NULL,
  `ciudad` varchar(150) DEFAULT NULL,
  `estado` varchar(150) DEFAULT NULL,
  `cp` varchar(150) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transferencias`
--

CREATE TABLE `transferencias` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transferencias_detalle`
--

CREATE TABLE `transferencias_detalle` (
  `id` int(10) NOT NULL,
  `producto_id` int(10) NOT NULL,
  `almacen_origen` int(10) NOT NULL,
  `almacen_destino` int(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `sucursal_id` int(10) NOT NULL,
  `rol_id` int(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `time_login` datetime DEFAULT NULL,
  `time_logout` datetime DEFAULT NULL,
  `online` smallint(1) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `sucursal_id`, `rol_id`, `name`, `email`, `password`, `remember_token`, `api_token`, `created_at`, `updated_at`, `time_login`, `time_logout`, `online`, `status`) VALUES
(1, 0, 1, 'Administrador', 'admin@gmail.com', '$2y$10$E14A0D/2f3uCFPMEod5rV.x11ZdLO45eKccC2Zzbs7bBloo9bmzzK', '84GAGAXDwuJh5vMCNHMc3hz86BLU31kzmSXjQlyIRKIyUj8WUUIKk4zs41Vg', NULL, '2019-09-16 05:00:00', NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(10) NOT NULL,
  `tipo` int(10) DEFAULT NULL,
  `sucursal_id` int(10) NOT NULL,
  `cliente_id` int(10) NOT NULL,
  `ventedor_id` int(10) NOT NULL,
  `origen_id` int(10) NOT NULL,
  `cotizacion_id` int(10) NOT NULL,
  `folio` varchar(150) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `subtotal` decimal(20,6) NOT NULL,
  `iva` decimal(20,6) NOT NULL,
  `total` decimal(20,6) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalle`
--

CREATE TABLE `ventas_detalle` (
  `id` int(10) NOT NULL,
  `venta_id` int(10) NOT NULL,
  `producto_id` int(10) NOT NULL,
  `almacen_id` int(10) NOT NULL,
  `codigo` varchar(150) DEFAULT NULL,
  `clave` varchar(150) DEFAULT NULL,
  `cantidad` varchar(150) NOT NULL,
  `precio` decimal(20,6) NOT NULL,
  `total` decimal(20,6) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
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
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cotizaciones_detalle`
--
ALTER TABLE `cotizaciones_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `familias`
--
ALTER TABLE `familias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `origenes`
--
ALTER TABLE `origenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pertenencias`
--
ALTER TABLE `pertenencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol_detalle`
--
ALTER TABLE `rol_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `soporte_ingresos`
--
ALTER TABLE `soporte_ingresos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `soporte_ingresos_detalle`
--
ALTER TABLE `soporte_ingresos_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `soporte_mtto`
--
ALTER TABLE `soporte_mtto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `soporte_tickets`
--
ALTER TABLE `soporte_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transferencias`
--
ALTER TABLE `transferencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transferencias_detalle`
--
ALTER TABLE `transferencias_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
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
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cotizaciones_detalle`
--
ALTER TABLE `cotizaciones_detalle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `familias`
--
ALTER TABLE `familias`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `origenes`
--
ALTER TABLE `origenes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pertenencias`
--
ALTER TABLE `pertenencias`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `rol_detalle`
--
ALTER TABLE `rol_detalle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `soporte_ingresos`
--
ALTER TABLE `soporte_ingresos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `soporte_ingresos_detalle`
--
ALTER TABLE `soporte_ingresos_detalle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `soporte_mtto`
--
ALTER TABLE `soporte_mtto`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `soporte_tickets`
--
ALTER TABLE `soporte_tickets`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `transferencias`
--
ALTER TABLE `transferencias`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `transferencias_detalle`
--
ALTER TABLE `transferencias_detalle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
