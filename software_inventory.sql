
-- fecha de modificacion 18/10/2024 - 4:44 p.m

-- user: localhost
-- password: 
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-10-2024 a las 01:43:26
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2024 a las 07:17:33
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `software_inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despachos`
--

CREATE TABLE `despachos` (
  `cedula` int(255) NOT NULL,
  `nombre_conductor` varchar(255) DEFAULT NULL,
  `nombre_empresa` varchar(255) DEFAULT NULL,
  `nit` varchar(255) DEFAULT NULL,
  `cantidad_productos` int(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `destinario` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `despachos`
--

INSERT INTO `despachos` (`cedula`, `nombre_conductor`, `nombre_empresa`, `nit`, `cantidad_productos`, `fecha`, `destinario`) VALUES
(2032032, 'jose', 'summar', '10293003G', 21, '2024-10-18', 'bogota'),
(10203040, 'cristiano', 'elbolo', '102930Ss', 12, '2024-07-29', 'portugal'),
(29706050, 'claudia cilena ', 'Emssanar', '102983S', 12, '2024-07-27', 'Brazil'),
(102920383, 'jose', 'fruver', '1093039F', 17, '2024-07-29', 'pradera'),
(392323939, 'arcangel', 'summar', '1223345g', 12, '2024-07-29', 'francia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion_proveedor`
--

CREATE TABLE `gestion_proveedor` (
  `id` int(11) NOT NULL,
  `nit` varchar(9) DEFAULT NULL,
  `nombre_empresa` varchar(255) DEFAULT NULL,
  `direccion_ubicacion` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gestion_proveedor`
--

INSERT INTO `gestion_proveedor` (`id`, `nit`, `nombre_empresa`, `direccion_ubicacion`, `email`) VALUES
(1, '102930Ss', 'Emssanar', 'colombia', 'diazjhonatan1221@gmail.com'),
(3, '102930S', 'elbolo', 'colombia', 'neymarsantos123@gmail.com'),
(4, '1223345g', 'adidas', 'colombia', 'cristian@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion_proveedor1`
--

CREATE TABLE `gestion_proveedor1` (
  `id` int(11) NOT NULL,
  `nit` varchar(20) NOT NULL,
  `nombre_empresa` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `correo_electronico` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gestion_proveedor1`
--

INSERT INTO `gestion_proveedor1` (`id`, `nit`, `nombre_empresa`, `direccion`, `correo_electronico`, `fecha_creacion`) VALUES
(20, '102210A', 'clinica palmira SA', 'palmira', 'clinica@gmail.com', '2024-08-25 23:26:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_mercancia`
--

CREATE TABLE `ingreso_mercancia` (
  `codigo` int(10) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `proveedor` varchar(255) DEFAULT NULL,
  `cantidad` int(255) DEFAULT NULL,
  `precio_unitario` int(255) DEFAULT NULL,
  `estado_almacen` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `bodega` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingreso_mercancia`
--

INSERT INTO `ingreso_mercancia` (`codigo`, `nombre`, `proveedor`, `cantidad`, `precio_unitario`, `estado_almacen`, `descripcion`, `fecha_ingreso`, `bodega`) VALUES
(1020, 'galletas', 'festival SAS', 12, 1200, 'almacen1', 'el estado de las galletas son optimas', '2024-10-15', 'almacen1'),
(2021, 'coca cola', 'Elonk musk', 10, 3000, 'almacen1', 'Las gaseosas llegan en buen estado', '2024-10-18', 'almacen2'),
(2032, 'caja de metales', 'agroindustria', 100, 300000, 'almacen1', 'metal en buen estado ', '2024-10-18', 'almacen3'),
(2332, 'Jhonatan', 'pepsi', 12, 1222, 'almacen2', 'mala calidad', '2024-10-18', 'almacen3'),
(2336, 'neymar', 'messi', 32, 21111, 'almacen1', 'buena', '2024-10-18', 'almacen1'),
(3049, 'pan', 'panmelos', 100, 500, 'almacen1', 'las mercancia esta en buen estado', '2024-10-18', 'almacen1'),
(5675, 'ponymalta', 'ponimalta', 13, 23333, 'almacen1', 'esta en buen estado ', '2024-10-24', 'almacen3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(255) NOT NULL,
  `producto` varchar(255) DEFAULT NULL,
  `cantidad` varchar(255) DEFAULT NULL,
  `precio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `producto`, `cantidad`, `precio`) VALUES
(23, 'aceite', '6', '4500'),
(24, 'frijol', '2', '2000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_register`
--

CREATE TABLE `login_register` (
  `id` int(255) NOT NULL,
  `nombre_apellido` varchar(255) DEFAULT NULL,
  `numero_identificacion` varchar(10) DEFAULT NULL,
  `cargo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `login_register`
--

INSERT INTO `login_register` (`id`, `nombre_apellido`, `numero_identificacion`, `cargo`, `email`, `contrasena`) VALUES
(10, 'jhonatan', '1112218103', 'Jefe de desarrollo', 'diazjhonatan1221@gmail.com', 'jhonatandiaz123'),
(11, 'jose', '1234556', 'auxiliar', 'josediaz@gmail.com', 'jose123'),
(12, 'messi', '321235454', 'futbolista', 'messi@gmail.com', 'messi123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `despachos`
--
ALTER TABLE `despachos`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `gestion_proveedor`
--
ALTER TABLE `gestion_proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gestion_proveedor1`
--
ALTER TABLE `gestion_proveedor1`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ingreso_mercancia`
--
ALTER TABLE `ingreso_mercancia`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login_register`
--
ALTER TABLE `login_register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `despachos`
--
ALTER TABLE `despachos`
  MODIFY `cedula` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT de la tabla `gestion_proveedor`
--
ALTER TABLE `gestion_proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `gestion_proveedor1`
--
ALTER TABLE `gestion_proveedor1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `ingreso_mercancia`
--
ALTER TABLE `ingreso_mercancia`
  MODIFY `codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5676;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `login_register`
--
ALTER TABLE `login_register`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
