-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-08-2021 a las 00:10:49
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `databasez`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `nit` int(45) DEFAULT NULL,
  `edad` date NOT NULL,
  `telefono` int(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `sexo` varchar(45) NOT NULL,
  `adicional` varchar(500) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombres`, `apellidos`, `nit`, `edad`, `telefono`, `correo`, `sexo`, `adicional`, `avatar`, `estado`) VALUES
(1, 'Carlos', 'Escobedo', 34534534, '1992-09-18', 54546676, 'escocarl@gmail.com', 'Masculino', 'Ingeniero en sistemas', NULL, 'A'),
(2, 'Carlos', 'Escobedo', 34534534, '1992-09-18', 54546676, 'escocarl@gmail.com', 'Masculino', 'Ingeniero en sistemas', NULL, 'A'),
(3, 'Eva', 'Escobedo', 123456789, '1998-05-08', 48388418, 'ev.maress@gmail.com', 'Femenino', 'Maestra', 'avatar.png', 'A'),
(4, 'Eva', 'Alvarado', 435345345, '1998-05-08', 111111, 'ev.maress@gmail.com', 'Femenino', 'Licenciada en veterinaria', 'avatar.png', 'A'),
(5, 'Eva', 'Alvarado', 123456, '1994-03-10', 4567656, 'adidas@gmail.com', 'Femenino', 'Licenciada en veterinaria', 'avatar.png', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `fecha_compra` date NOT NULL,
  `fecha_entrega` date NOT NULL,
  `total` float NOT NULL,
  `id_estado_pago` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `codigo`, `fecha_compra`, `fecha_entrega`, `total`, `id_estado_pago`, `id_proveedor`) VALUES
(1, '12', '2021-04-22', '2021-04-23', 23, 2, 10),
(2, '4', '2021-04-22', '2021-04-30', 4, 1, 12),
(3, '9', '2021-04-23', '2021-04-23', 2, 1, 3),
(4, '2', '2021-04-22', '2021-04-23', 1, 2, 3),
(5, '2', '2021-04-22', '2021-04-23', 1, 2, 3),
(6, '6', '2021-04-22', '2021-04-30', 1, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle` int(11) NOT NULL,
  `det_cantidad` int(11) NOT NULL,
  `det_vencimiento` date NOT NULL,
  `id__det_lote` int(11) NOT NULL,
  `id__det_prod` int(11) NOT NULL,
  `lote_id_prov` int(255) NOT NULL,
  `id_det_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_detalle`, `det_cantidad`, `det_vencimiento`, `id__det_lote`, `id__det_prod`, `lote_id_prov`, `id_det_venta`) VALUES
(1, 35, '2020-12-26', 19, 11, 3, 15),
(2, 5, '2020-12-26', 19, 11, 3, 16),
(12, 1, '2021-10-10', 22, 15, 11, 22),
(13, 1, '2021-01-01', 21, 11, 3, 22),
(14, 1, '2021-10-10', 22, 15, 11, 23),
(15, 1, '2021-01-01', 21, 11, 3, 24),
(16, 4, '2021-10-10', 22, 15, 11, 25),
(17, 1, '2021-01-01', 21, 11, 3, 25),
(18, 2, '2021-10-10', 22, 15, 11, 26),
(19, 1, '2021-10-10', 22, 15, 11, 27),
(20, 1, '2021-10-10', 22, 15, 11, 28),
(21, 1, '2021-10-10', 22, 15, 11, 29),
(22, 1, '2021-10-10', 22, 15, 11, 30),
(23, 1, '2021-12-31', 23, 11, 3, 31),
(24, 1, '2021-12-31', 24, 8, 11, 31),
(25, 1, '2021-12-31', 26, 18, 10, 32),
(26, 1, '2021-12-31', 23, 11, 3, 33),
(27, 1, '2021-12-31', 26, 18, 10, 33),
(30, 1, '2021-05-01', 5, 18, 3, 45),
(31, 1, '2021-05-01', 6, 18, 3, 45),
(32, 1, '2021-05-24', 1, 10, 12, 46),
(33, 5, '2021-05-24', 1, 10, 12, 47);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pago`
--

CREATE TABLE `estado_pago` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado_pago`
--

INSERT INTO `estado_pago` (`id`, `nombre`) VALUES
(1, 'Cancelado'),
(2, 'No cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE `laboratorio` (
  `id_laboratorio` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `laboratorio`
--

INSERT INTO `laboratorio` (`id_laboratorio`, `nombre`, `avatar`, `estado`) VALUES
(4, 'Nombre1', '5fefe3e3b3253-logo.png', 'A'),
(5, 'Premier', '5fefe3ec59a99-logo.png', 'A'),
(6, 'Mango', 'lab-default.png', 'A'),
(7, 'Juan', 'lab-default.png', 'A'),
(8, 'Limon', 'lab-default.png', 'A'),
(9, 'Karen', 'lab-default.png', 'A'),
(10, 'Lolo', 'lab-default.png', 'A'),
(11, 'Papaya', 'lab-default.png', 'A'),
(12, 'piña', 'lab-default.png', 'A'),
(13, 'Kiwi', 'lab-default.png', 'A'),
(14, 'Papa', 'lab-default.png', 'A'),
(15, 'Zanahoria', 'lab-default.png', 'A'),
(16, 'Uvas', 'lab-default.png', 'A'),
(17, 'Fresa', 'lab-default.png', 'A'),
(18, 'Cereza', 'lab-default.png', 'A'),
(19, 'Manzana', 'lab-default.png', 'A'),
(23, 'Manzanilla', 'lab-default.png', 'A'),
(24, 'Sandía', 'lab-default.png', 'A'),
(35, 'Banana', 'lab-default.png', 'A'),
(36, 'asdf', 'lab-default.png', 'A'),
(37, 'Melón', 'lab-default.png', 'A'),
(38, 'Mora', 'lab-default.png', 'A'),
(39, 'asdfasdf', 'lab-default.png', 'A'),
(40, 'Tarantino', 'lab-default.png', 'A'),
(41, 'Premier2', 'lab-default.png', 'A'),
(42, 'Test', 'lab-default.png', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `id` int(11) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cantidad_lote` int(11) NOT NULL,
  `vencimiento` date NOT NULL,
  `precio_compra` float NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A',
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`id`, `codigo`, `cantidad`, `cantidad_lote`, `vencimiento`, `precio_compra`, `estado`, `id_compra`, `id_producto`) VALUES
(1, '2', 6, 0, '2021-05-24', 7, 'I', 2, 10),
(2, '5', 5, 5, '2021-04-24', 8, 'A', 2, 6),
(3, '4', 2, 4, '2021-04-30', 1, 'A', 3, 8),
(4, '4', 1, 2, '2021-04-14', 1, 'A', 4, 11),
(5, '5', 1, 0, '2021-05-01', 1, 'I', 5, 18),
(6, '4', 1, 0, '2021-05-01', 1, 'I', 6, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE `presentacion` (
  `id_presentacion` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `presentacion`
--

INSERT INTO `presentacion` (`id_presentacion`, `nombre`, `estado`) VALUES
(3, 'Fresas', 'A'),
(4, 'Manzana', 'A'),
(6, 'Nueva', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `concentracion` varchar(255) DEFAULT NULL,
  `adicional` varchar(255) DEFAULT NULL,
  `precio` float NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A',
  `prod_lab` int(11) NOT NULL,
  `prod_tip_prod` int(11) NOT NULL,
  `prod_present` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `concentracion`, `adicional`, `precio`, `avatar`, `estado`, `prod_lab`, `prod_tip_prod`, `prod_present`) VALUES
(1, 'Mandarina', '12', '23', 12, '5fefd8e1991b6-logo.png', 'A', 17, 4, 3),
(3, 'Pera', '12', 'Verde', 12, '5fefd8c690f93-logo.png', 'A', 35, 6, 4),
(5, 'Manzana', '43', 'Verde', 43, '5fefd8d778c4c-logo.png', 'A', 18, 4, 4),
(6, 'Uvas', '12', 'Tal cosa', 43, '5fefd8b680a6e-logo.png', 'A', 35, 6, 4),
(7, 'Naranja', '12', 'Otras cosas', 12, '5fefd8bdc9e57-logo.png', 'A', 36, 2, 3),
(8, 'Arándanos', '14', 'Tal y tal', 13, '5fefd88e2824c-prod-default.png', 'A', 18, 6, 3),
(9, 'Guanaba', '12', 'Tanto y tanto', 12, '5fefd8a50fa9f-logo.png', 'A', 24, 6, 3),
(10, 'Cereza', '54', 'Todo esto es', 10, '5fefd89c1e74f-logo.png', 'I', 18, 4, 4),
(11, 'Arándano', '12', 'Rojos y verdes', 8.5, '5fefd84ac054c-prod-default.png', 'A', 15, 6, 3),
(12, 'Nances', '32', 'Amarillos rojizos', 7, 'prod-default.png', 'A', 4, 4, 3),
(13, 'Papaya', '2', 'Verde', 19, '5fefd8c3898b3-logo.png', 'A', 36, 5, 3),
(14, 'Platano', '43', 'verde', 4, '5fefd8aff2fe5-logo.png', 'A', 36, 5, 3),
(15, 'Aguacates', '58', 'Jas', 7, 'prod-default.png', 'A', 36, 5, 3),
(18, 'Fresa', '12', 'Esto', 10, 'prod-default.png', 'A', 36, 5, 3),
(19, 'Producto de prueba', '32', 'Tanto y tanto', 87, 'prod-default.png', 'A', 17, 6, 4),
(20, 'Producto para eliminar', '43', 'Esto', 23, 'prod-default.png', 'A', 35, 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre`, `telefono`, `correo`, `direccion`, `avatar`, `estado`) VALUES
(2, 'Converse', 48697831, 'converse@gmail.com', 'USA', 'prov-default.png', 'A'),
(3, 'Adidas', 24589656, 'adidas@gmail.com', 'USA', '604c08907dc45-prov-default.png', 'A'),
(10, 'Rebook', 45248978, 'rebook@info.com', 'USA', 'prov-default.png', 'A'),
(11, 'Andrea', 24589678, 'andrea@contact.com', 'México', 'prov-default.png', 'A'),
(12, 'Nuevo', 43466456, 'correo@gmail.com', 'San Antonio Huista', 'prov-default.png', 'A'),
(13, 'Eva', 43567558, 'eva@gmail.com', 'San Antonio Huista', 'prov-default.png', 'I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id_tip_prod` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id_tip_prod`, `nombre`, `estado`) VALUES
(2, 'Sandía2', 'A'),
(4, 'Melón', 'A'),
(5, 'Manzana', 'A'),
(6, 'Mora', 'A'),
(7, 'Nuevo', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_us`
--

CREATE TABLE `tipo_us` (
  `id_tipo_us` int(11) NOT NULL,
  `nombre_tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_us`
--

INSERT INTO `tipo_us` (`id_tipo_us`, `nombre_tipo`) VALUES
(1, 'Administrador'),
(2, 'Tecnico'),
(3, 'root');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_us` varchar(45) NOT NULL,
  `apellidos_us` varchar(45) NOT NULL,
  `edad` date NOT NULL,
  `dni_us` varchar(45) NOT NULL,
  `contrasena_us` varchar(255) NOT NULL,
  `telefono_us` int(11) DEFAULT NULL,
  `residencia_us` varchar(45) DEFAULT NULL,
  `correo_us` varchar(25) DEFAULT NULL,
  `sexo_us` varchar(25) DEFAULT NULL,
  `adicional_us` varchar(500) DEFAULT NULL,
  `avatar` varchar(255) NOT NULL,
  `us_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_us`, `apellidos_us`, `edad`, `dni_us`, `contrasena_us`, `telefono_us`, `residencia_us`, `correo_us`, `sexo_us`, `adicional_us`, `avatar`, `us_tipo`) VALUES
(1, 'Carlos', 'Escobedo', '1992-09-18', '12345', '$2y$10$BEMIzDJoz1WFyEwUixkHOO9GktkRzmRHAbW18vzDy57idNJY4mGoO', 56105014, 'San Antonio Huista, Huehuetenango', 'escocarl@hotmail.com', 'Masculino', 'Ingeniero en Sistemas', '5fefd87eb71f0-default.jpg', 3),
(2, 'Eva', 'Escobedo', '0000-00-00', '6789', '6789', 48388418, 'San Antonio Huista', 'ev.maress@gmail.com', 'Femenino', 'Maestra de educación parvularia bilingüe intercultural', '5f912b523461b-imagen1.jpg', 1),
(4, 'Tania', 'Recinos', '1993-10-22', '98765', '98765', 52164875, 'Monajil, Santa Ana Huista', 'tania@yahoo.es', 'Femenino', 'Maestra de educación primaria con cierre de pensum en Auditoría', '', 1),
(5, 'José ', 'Gabriel', '1982-03-18', '1234567', '1234567', 52164879, 'San Antonio Huista', 'joangaci@gmail.com', 'Masculino', 'Maestro de educación primaria urbana con cierre de pensum en Licenciatura en Finanzas', '', 1),
(7, 'Ana', 'Armas', '1992-09-18', '36912', '36912', NULL, NULL, NULL, NULL, NULL, 'default.jpg', 2),
(8, 'Laura', 'Castillo', '1993-04-05', '5101520', '5101520', NULL, NULL, NULL, NULL, NULL, 'default.jpg', 2),
(10, 'Elizabeth', 'Díaz', '1999-05-06', '204060', '204060', NULL, NULL, NULL, NULL, NULL, 'default.jpg', 2),
(11, 'Izabel', 'Armas', '1992-09-12', '543210123', '123456', NULL, NULL, NULL, NULL, NULL, 'default.jpg', 2),
(12, 'Mardoqueo', 'Escobedo', '1992-09-18', '2158035901324', '321654', NULL, NULL, NULL, NULL, NULL, 'default.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `cliente` varchar(45) DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `vendedor` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `fecha`, `cliente`, `dni`, `total`, `vendedor`, `id_cliente`) VALUES
(1, '2019-09-11 23:04:50', 'Eva', 0, 20, 1, NULL),
(2, '2019-10-08 22:08:45', 'Carlos', 0, 20, 1, NULL),
(3, '2019-12-21 11:21:52', 'Eva', 0, 20, 1, NULL),
(4, '2019-12-21 11:27:36', 'Eva', 0, 20, 1, NULL),
(5, '2019-12-21 12:14:44', 'Eva', 0, 182, 1, NULL),
(13, '2020-12-21 12:48:24', 'Eva', 0, 182, 1, NULL),
(14, '2020-12-21 12:53:55', 'Carlos', 0, 13, 1, NULL),
(15, '2020-12-22 13:44:22', 'Eva', 0, 297.5, 1, NULL),
(16, '2020-12-22 13:48:38', 'Carlos', 0, 42.5, 1, NULL),
(22, '2020-12-24 15:47:26', 'Eva', 0, 15, 1, NULL),
(23, '2020-12-24 16:26:11', 'Karla', 0, 6.5, 1, NULL),
(24, '2020-12-24 16:27:52', 'Juan', 0, 8.5, 2, NULL),
(25, '2020-12-24 22:38:04', 'Candelaria', 0, 34.5, 1, NULL),
(26, '2021-01-01 02:04:55', 'Juan', 0, 13, 1, NULL),
(27, '2021-01-02 02:29:48', 'Roberto', 456789, 6.5, 12, NULL),
(28, '2021-03-05 17:05:44', 'Juan', 4345, 6.5, 1, NULL),
(29, '2021-04-03 17:46:20', NULL, NULL, 7, 1, NULL),
(30, '2021-04-03 18:01:08', NULL, NULL, 7, 1, 5),
(31, '2021-04-04 15:40:45', NULL, NULL, 21.5, 1, 1),
(32, '2021-04-04 15:41:12', NULL, NULL, 10, 1, 5),
(33, '2021-04-04 15:47:22', NULL, NULL, 18.5, 1, 5),
(45, '2021-05-21 11:47:53', NULL, NULL, 20, 1, 1),
(46, '2021-05-21 12:03:35', NULL, NULL, 10, 1, 1),
(47, '2021-05-22 13:19:38', NULL, NULL, 50, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_producto`
--

CREATE TABLE `venta_producto` (
  `id_ventaproducto` int(11) NOT NULL,
  `precio` float NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` float NOT NULL,
  `producto_id_producto` int(11) NOT NULL,
  `venta_id_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `venta_producto`
--

INSERT INTO `venta_producto` (`id_ventaproducto`, `precio`, `cantidad`, `subtotal`, `producto_id_producto`, `venta_id_venta`) VALUES
(1, 0, 28, 182, 15, 13),
(2, 0, 2, 13, 15, 14),
(3, 0, 35, 297.5, 11, 15),
(4, 0, 5, 42.5, 11, 16),
(13, 0, 1, 6.5, 15, 22),
(14, 0, 1, 8.5, 11, 22),
(15, 0, 1, 6.5, 15, 23),
(16, 0, 1, 8.5, 11, 24),
(17, 0, 4, 26, 15, 25),
(18, 0, 1, 8.5, 11, 25),
(19, 0, 2, 13, 15, 26),
(20, 0, 1, 6.5, 15, 27),
(21, 6.5, 1, 6.5, 15, 28),
(22, 7, 1, 7, 15, 29),
(23, 7, 1, 7, 15, 30),
(24, 8.5, 1, 8.5, 11, 31),
(25, 13, 1, 13, 8, 31),
(26, 10, 1, 10, 18, 32),
(27, 8.5, 1, 8.5, 11, 33),
(28, 10, 1, 10, 18, 33),
(31, 10, 2, 20, 18, 45),
(32, 10, 1, 10, 10, 46),
(33, 10, 5, 50, 10, 47);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado_pago` (`id_estado_pago`,`id_proveedor`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_det_venta_idx` (`id_det_venta`);

--
-- Indices de la tabla `estado_pago`
--
ALTER TABLE `estado_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`id_laboratorio`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_compra` (`id_compra`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD PRIMARY KEY (`id_presentacion`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `prod_lab_idx` (`prod_lab`),
  ADD KEY `prod_tip_prod_idx` (`prod_tip_prod`),
  ADD KEY `prod_present_idx` (`prod_present`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id_tip_prod`);

--
-- Indices de la tabla `tipo_us`
--
ALTER TABLE `tipo_us`
  ADD PRIMARY KEY (`id_tipo_us`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `us_tipo_idx` (`us_tipo`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `vendedor` (`vendedor`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD PRIMARY KEY (`id_ventaproducto`),
  ADD KEY `fk_venta_has_producto_producto1_idx` (`producto_id_producto`),
  ADD KEY `fk_venta_has_producto_venta1_idx` (`venta_id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `estado_pago`
--
ALTER TABLE `estado_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `id_laboratorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `id_presentacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id_tip_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_us`
--
ALTER TABLE `tipo_us`
  MODIFY `id_tipo_us` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  MODIFY `id_ventaproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`id_estado_pago`) REFERENCES `estado_pago` (`id`),
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`);

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `id_det_venta` FOREIGN KEY (`id_det_venta`) REFERENCES `venta` (`id_venta`);

--
-- Filtros para la tabla `lote`
--
ALTER TABLE `lote`
  ADD CONSTRAINT `lote_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id`),
  ADD CONSTRAINT `lote_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `prod_lab` FOREIGN KEY (`prod_lab`) REFERENCES `laboratorio` (`id_laboratorio`),
  ADD CONSTRAINT `prod_present` FOREIGN KEY (`prod_present`) REFERENCES `presentacion` (`id_presentacion`),
  ADD CONSTRAINT `prod_tip_prod` FOREIGN KEY (`prod_tip_prod`) REFERENCES `tipo_producto` (`id_tip_prod`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `us_tipo` FOREIGN KEY (`us_tipo`) REFERENCES `tipo_us` (`id_tipo_us`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`vendedor`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`);

--
-- Filtros para la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD CONSTRAINT `fk_venta_has_producto_producto1` FOREIGN KEY (`producto_id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `fk_venta_has_producto_venta1` FOREIGN KEY (`venta_id_venta`) REFERENCES `venta` (`id_venta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
