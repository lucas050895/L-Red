-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-05-2025 a las 00:46:07
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lred`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_excel`
--

CREATE TABLE `archivos_excel` (
  `id` int(11) NOT NULL,
  `clientes_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `ruta` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_fotos`
--

CREATE TABLE `archivos_fotos` (
  `id` int(11) NOT NULL,
  `clientes_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `ruta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_pdf`
--

CREATE TABLE `archivos_pdf` (
  `id` int(11) NOT NULL,
  `clientes_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `ruta` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `razon` varchar(30) DEFAULT NULL,
  `cuilcuit` bigint(15) DEFAULT NULL,
  `celular` int(10) DEFAULT NULL,
  `otro` int(10) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `localidad` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestador_balun`
--

CREATE TABLE `presupuestador_balun` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `precio_compra` int(11) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `presupuestador_balun`
--

INSERT INTO `presupuestador_balun` (`id`, `nombre`, `precio_compra`, `porcentaje`, `precio_venta`) VALUES
(1, 'RJ45', 0, 0, 6500),
(2, 'Presion', 0, 0, 5000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestador_balunera`
--

CREATE TABLE `presupuestador_balunera` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio_compra` int(11) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `presupuestador_balunera`
--

INSERT INTO `presupuestador_balunera` (`id`, `nombre`, `precio_compra`, `porcentaje`, `precio_venta`) VALUES
(1, 'Balunera', 0, 0, 35000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestador_caja`
--

CREATE TABLE `presupuestador_caja` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio_compra` int(11) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `presupuestador_caja`
--

INSERT INTO `presupuestador_caja` (`id`, `nombre`, `precio_compra`, `porcentaje`, `precio_venta`) VALUES
(1, 'Caja 9CM', 0, 0, 1500),
(2, 'Caja 11CM', 0, 0, 1500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestador_camaras`
--

CREATE TABLE `presupuestador_camaras` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio_compra` int(11) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL,
  `dvr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `presupuestador_camaras`
--

INSERT INTO `presupuestador_camaras` (`id`, `nombre`, `precio_compra`, `porcentaje`, `precio_venta`, `dvr_id`) VALUES
(1, 'DS-2CE16D0T-EXIF', 0, 0, 35500, 1),
(2, 'DS-2CE10DF3T-F', 0, 0, 52500, 1),
(3, 'HAC-B1A21P-0360B', 0, 0, 28000, 3),
(4, 'HAC-B1A21P', 0, 0, 35000, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestador_dvr`
--

CREATE TABLE `presupuestador_dvr` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `precio_compra` int(10) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `presupuestador_dvr`
--

INSERT INTO `presupuestador_dvr` (`id`, `nombre`, `modelo`, `precio_compra`, `porcentaje`, `precio_venta`) VALUES
(1, 'Hikvision 4CH', 'DS-7204HGHI-F1', 0, 0, 110000),
(2, 'Hikvision 8CH', 'DS-7208HGHI-M1', 0, 0, 170000),
(3, 'Hikvision 16CH', 'DS-7216HGHI-M1', 0, 0, 290000),
(4, 'Dahua 4CH', 'XVR1B04-I', 0, 0, 90000),
(5, 'Dahua 8CH', 'XVR1B08-I', 0, 0, 115000),
(6, 'Dahua 16CH', 'Xvr1b16h', 0, 0, 320000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestador_fuentes`
--

CREATE TABLE `presupuestador_fuentes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio_compra` int(11) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `presupuestador_fuentes`
--

INSERT INTO `presupuestador_fuentes` (`id`, `nombre`, `precio_compra`, `porcentaje`, `precio_venta`) VALUES
(1, 'Fuente Individual', 0, 0, 8000),
(2, 'Fuente Swicht', 0, 0, 13000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestador_insumos`
--

CREATE TABLE `presupuestador_insumos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `presupuestador_insumos`
--

INSERT INTO `presupuestador_insumos` (`id`, `nombre`, `precio_venta`) VALUES
(1, 'Insumos Varios', 15000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestador_utp`
--

CREATE TABLE `presupuestador_utp` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio_compra` int(11) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `presupuestador_utp`
--

INSERT INTO `presupuestador_utp` (`id`, `nombre`, `precio_compra`, `porcentaje`, `precio_venta`) VALUES
(1, 'CAT 5', 0, 0, 800),
(2, 'CAT 5E', 0, 0, 950),
(3, 'CAT 6', 0, 0, 1200),
(4, 'CAT 6E', 0, 0, 1500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestador_zapatilla`
--

CREATE TABLE `presupuestador_zapatilla` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio_compra` int(11) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `presupuestador_zapatilla`
--

INSERT INTO `presupuestador_zapatilla` (`id`, `nombre`, `precio_compra`, `porcentaje`, `precio_venta`) VALUES
(1, 'Ninguna', 0, 0, 0),
(2, 'Zapatilla 5 Tomas', 0, 0, 12000),
(3, 'Zapatilla 4 Tomas', 0, 0, 10000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajos_cctv`
--

CREATE TABLE `trabajos_cctv` (
  `id` int(11) NOT NULL,
  `clientes_id` int(11) DEFAULT NULL,
  `dvr_marca` varchar(30) DEFAULT NULL,
  `dvr_modelo` varchar(30) DEFAULT NULL,
  `dvr_disco` varchar(30) DEFAULT NULL,
  `dvr_capacidad` int(5) DEFAULT NULL,
  `dvr_medida` varchar(5) DEFAULT NULL,
  `camaras_cantidad` int(5) DEFAULT NULL,
  `camaras_modelo` varchar(20) DEFAULT NULL,
  `camaras_caja` int(3) DEFAULT NULL,
  `fichas_balum` int(5) DEFAULT NULL,
  `fichas_rj45` int(5) DEFAULT NULL,
  `cables_utp` int(5) DEFAULT NULL,
  `cables_patch` varchar(5) DEFAULT NULL,
  `cables_zapatilla` varchar(5) DEFAULT NULL,
  `cables_fuente` varchar(5) DEFAULT NULL,
  `cables_pulpito` varchar(5) DEFAULT NULL,
  `cables_hdmi` varchar(5) DEFAULT NULL,
  `insumos_tar6` int(5) DEFAULT NULL,
  `insumos_tor6` int(5) DEFAULT NULL,
  `insumos_tar8` int(5) DEFAULT NULL,
  `insumos_tor8` int(5) DEFAULT NULL,
  `insumos_gra8` int(5) DEFAULT NULL,
  `insumos_prec` int(5) DEFAULT NULL,
  `acceso_usuario` varchar(20) DEFAULT NULL,
  `acceso_contraseña` varchar(20) DEFAULT NULL,
  `observaciones` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajos_ip`
--

CREATE TABLE `trabajos_ip` (
  `id` int(11) NOT NULL,
  `clientes_id` int(11) DEFAULT NULL,
  `camara_modelo` varchar(20) DEFAULT NULL,
  `ip_01` varchar(20) DEFAULT NULL,
  `ip_02` varchar(20) DEFAULT NULL,
  `ip_03` varchar(20) DEFAULT NULL,
  `ip_04` varchar(20) DEFAULT NULL,
  `ip_05` varchar(20) DEFAULT NULL,
  `puerto_01` int(5) DEFAULT NULL,
  `puerto_02` int(5) DEFAULT NULL,
  `puerto_03` int(5) DEFAULT NULL,
  `puerto_04` int(5) DEFAULT NULL,
  `puerto_05` int(5) DEFAULT NULL,
  `fichas_rj45` int(5) DEFAULT NULL,
  `fichas_plug` int(5) DEFAULT NULL,
  `cables_fuentes` varchar(5) DEFAULT NULL,
  `cables_utp` int(5) DEFAULT NULL,
  `cables_zapatilla` varchar(5) DEFAULT NULL,
  `insumos_tar6` int(5) DEFAULT NULL,
  `insumos_tor6` int(5) DEFAULT NULL,
  `insumos_tar8` int(5) DEFAULT NULL,
  `insumos_tor8` int(5) DEFAULT NULL,
  `insumos_gra8` int(5) DEFAULT NULL,
  `insumos_prec` int(5) DEFAULT NULL,
  `acceso_usuario` varchar(20) DEFAULT NULL,
  `acceso_contraseña` varchar(20) DEFAULT NULL,
  `acceso_host` varchar(50) DEFAULT NULL,
  `observaciones` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajos_red`
--

CREATE TABLE `trabajos_red` (
  `id` int(11) NOT NULL,
  `clientes_id` int(11) DEFAULT NULL,
  `equipo_tipo` varchar(20) DEFAULT NULL,
  `equipo_modelo` varchar(20) DEFAULT NULL,
  `cables_utp` int(5) DEFAULT NULL,
  `cables_par` int(5) DEFAULT NULL,
  `fichas_rj45` int(5) DEFAULT NULL,
  `fichas_empalme` int(5) DEFAULT NULL,
  `rack` int(5) DEFAULT NULL,
  `insumos_tar6` int(5) DEFAULT NULL,
  `insumos_tor6` int(5) DEFAULT NULL,
  `insumos_tar8` int(5) DEFAULT NULL,
  `insumos_tor8` int(5) DEFAULT NULL,
  `insumos_gra8` int(5) DEFAULT NULL,
  `insumos_prec` int(5) DEFAULT NULL,
  `observaciones` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(15) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL,
  `usuarios_nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `usuarios_nivel`) VALUES
(1, 'Lucas', '1234', 1),
(2, 'Leo', '1234', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_nivel`
--

CREATE TABLE `usuarios_nivel` (
  `id` int(11) NOT NULL,
  `nombre` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_nivel`
--

INSERT INTO `usuarios_nivel` (`id`, `nombre`) VALUES
(1, 'Admin'),
(2, 'Ventas');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos_excel`
--
ALTER TABLE `archivos_excel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientes_id` (`clientes_id`);

--
-- Indices de la tabla `archivos_fotos`
--
ALTER TABLE `archivos_fotos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientes_id` (`clientes_id`);

--
-- Indices de la tabla `archivos_pdf`
--
ALTER TABLE `archivos_pdf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientes_id` (`clientes_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `presupuestador_balun`
--
ALTER TABLE `presupuestador_balun`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `presupuestador_balunera`
--
ALTER TABLE `presupuestador_balunera`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `presupuestador_caja`
--
ALTER TABLE `presupuestador_caja`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `presupuestador_camaras`
--
ALTER TABLE `presupuestador_camaras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dvr` (`dvr_id`);

--
-- Indices de la tabla `presupuestador_dvr`
--
ALTER TABLE `presupuestador_dvr`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `presupuestador_fuentes`
--
ALTER TABLE `presupuestador_fuentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `presupuestador_insumos`
--
ALTER TABLE `presupuestador_insumos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `presupuestador_utp`
--
ALTER TABLE `presupuestador_utp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `presupuestador_zapatilla`
--
ALTER TABLE `presupuestador_zapatilla`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trabajos_cctv`
--
ALTER TABLE `trabajos_cctv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`clientes_id`);

--
-- Indices de la tabla `trabajos_ip`
--
ALTER TABLE `trabajos_ip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`clientes_id`);

--
-- Indices de la tabla `trabajos_red`
--
ALTER TABLE `trabajos_red`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`clientes_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_nivel` (`usuarios_nivel`);

--
-- Indices de la tabla `usuarios_nivel`
--
ALTER TABLE `usuarios_nivel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos_excel`
--
ALTER TABLE `archivos_excel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivos_fotos`
--
ALTER TABLE `archivos_fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivos_pdf`
--
ALTER TABLE `archivos_pdf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `presupuestador_balun`
--
ALTER TABLE `presupuestador_balun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `presupuestador_balunera`
--
ALTER TABLE `presupuestador_balunera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `presupuestador_caja`
--
ALTER TABLE `presupuestador_caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `presupuestador_camaras`
--
ALTER TABLE `presupuestador_camaras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `presupuestador_dvr`
--
ALTER TABLE `presupuestador_dvr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `presupuestador_fuentes`
--
ALTER TABLE `presupuestador_fuentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `presupuestador_insumos`
--
ALTER TABLE `presupuestador_insumos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `presupuestador_utp`
--
ALTER TABLE `presupuestador_utp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `presupuestador_zapatilla`
--
ALTER TABLE `presupuestador_zapatilla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `trabajos_cctv`
--
ALTER TABLE `trabajos_cctv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `trabajos_ip`
--
ALTER TABLE `trabajos_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `trabajos_red`
--
ALTER TABLE `trabajos_red`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios_nivel`
--
ALTER TABLE `usuarios_nivel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivos_excel`
--
ALTER TABLE `archivos_excel`
  ADD CONSTRAINT `archivos_excel_ibfk_1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `archivos_fotos`
--
ALTER TABLE `archivos_fotos`
  ADD CONSTRAINT `archivos_fotos_ibfk_1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `archivos_pdf`
--
ALTER TABLE `archivos_pdf`
  ADD CONSTRAINT `archivos_pdf_ibfk_1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `presupuestador_camaras`
--
ALTER TABLE `presupuestador_camaras`
  ADD CONSTRAINT `presupuestador_camaras_ibfk_1` FOREIGN KEY (`dvr_id`) REFERENCES `presupuestador_dvr` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `trabajos_cctv`
--
ALTER TABLE `trabajos_cctv`
  ADD CONSTRAINT `trabajos_cctv_ibfk_1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `trabajos_ip`
--
ALTER TABLE `trabajos_ip`
  ADD CONSTRAINT `trabajos_ip_ibfk_1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `trabajos_red`
--
ALTER TABLE `trabajos_red`
  ADD CONSTRAINT `trabajos_red_ibfk_1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`usuarios_nivel`) REFERENCES `usuarios_nivel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
