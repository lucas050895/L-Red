-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2025 a las 00:46:11
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
-- Estructura de tabla para la tabla `presupuestador_categoria`
--

CREATE TABLE `presupuestador_categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `presupuestador_categoria`
--

INSERT INTO `presupuestador_categoria` (`id`, `nombre`) VALUES
(1, 'dvr'),
(2, 'camara'),
(3, 'fichas balun'),
(4, 'fuente'),
(5, 'caja estanca'),
(6, 'balunera'),
(7, 'insumos'),
(8, 'cable utp'),
(9, 'cable electrico'),
(10, 'rack gabinete'),
(11, 'mano de obra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestador_productos`
--

CREATE TABLE `presupuestador_productos` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `modelo` varchar(200) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `presupuestador_productos`
--

INSERT INTO `presupuestador_productos` (`id`, `categoria_id`, `nombre`, `modelo`, `precio`) VALUES
(1, 1, 'Dvr Hikvision 4CH', 'DS-7204HGHI-F1', 120000),
(2, 1, 'Dvr Hikvision 8CH', 'DS-7208HGHI-M1', 170000),
(3, 1, 'Dvr Hikvision 16CH', 'DS-7216HGHI-M1', 290000),
(4, 1, 'Dvr Dahua 4CH', 'XVR1B04-I', 90000),
(5, 1, 'Dvr Dahua 8CH', 'XVR1B08-I', 115000),
(6, 1, 'Dvr Dahua 16CH', 'Xvr1b16h', 320000),
(7, 2, 'Camara Hikvision', 'DS-2CE16D0T-EXIF', 35500),
(8, 2, 'Camara Hikvision', 'DS-2CE10DF3T-F', 52500),
(9, 2, 'Camara Dahua', 'HAC-B1A21P-0360B', 28000),
(10, 2, 'Camara Dahua', 'HAC-B1A21P', 35000),
(11, 3, 'Fichas Balun', 'RJ45', 6500),
(12, 3, 'Fichas Balun', 'Presion', 5000),
(13, 4, 'Fuente 12V 2A', 'Individual', 8000),
(14, 4, 'Fuente 12V 5A', 'Swicht', 13000),
(15, 5, 'Caja estanca', '90x90x55mm', 1500),
(16, 5, 'Caja estanca', '115x115x50mm', 1500),
(17, 6, 'Balunera', 'Plastica ', 35000),
(18, 7, 'Insumos ', 'Varios', 15000),
(19, 8, 'Cable UTP', 'CAT 5', 800),
(20, 8, 'Cable UTP', 'CAT 5e', 950),
(21, 8, 'Cable UTP', 'CAT 6', 1200),
(22, 8, 'Cable UTP', 'CAT 6e', 1500),
(23, 9, 'Zapatilla', '4 Tomas', 10000),
(24, 9, 'Zapatilla', '5 Tomas', 12000),
(25, 10, 'Rack', 'Plastico', 40000),
(26, 10, 'Rack', 'Metalico', 80000),
(27, 11, 'Mano de Obra', '1', 200000),
(28, 11, 'Mano de Obra', '2', 250000),
(29, 11, 'Mano de Obra', '3', 300000);

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
  `acceso_usuario` varchar(50) DEFAULT NULL,
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
  `camara_marca` varchar(100) NOT NULL,
  `camara_modelo` varchar(20) DEFAULT NULL,
  `camara_nombre` varchar(200) NOT NULL,
  `fichas_rj45` int(5) DEFAULT NULL,
  `fichas_plug` int(5) DEFAULT NULL,
  `cables_fuentes` varchar(5) DEFAULT NULL,
  `cables_utp` int(5) DEFAULT NULL,
  `cables_zapatilla` varchar(20) DEFAULT NULL,
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
-- Estructura de tabla para la tabla `trabajos_ip_detalles`
--

CREATE TABLE `trabajos_ip_detalles` (
  `id` int(11) NOT NULL,
  `trabajos_ip_id` int(11) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `puertos` int(5) DEFAULT NULL,
  `camara_nombre` varchar(50) NOT NULL
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
(2, 'Leo', '1234', 1),
(3, 'Mili', '0987', 2);

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
-- Indices de la tabla `presupuestador_categoria`
--
ALTER TABLE `presupuestador_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `presupuestador_productos`
--
ALTER TABLE `presupuestador_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

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
-- Indices de la tabla `trabajos_ip_detalles`
--
ALTER TABLE `trabajos_ip_detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trabajos_ip_detalles_ibfk_1` (`trabajos_ip_id`);

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
-- AUTO_INCREMENT de la tabla `presupuestador_categoria`
--
ALTER TABLE `presupuestador_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `presupuestador_productos`
--
ALTER TABLE `presupuestador_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
-- AUTO_INCREMENT de la tabla `trabajos_ip_detalles`
--
ALTER TABLE `trabajos_ip_detalles`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Filtros para la tabla `presupuestador_productos`
--
ALTER TABLE `presupuestador_productos`
  ADD CONSTRAINT `presupuestador_productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `presupuestador_categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Filtros para la tabla `trabajos_ip_detalles`
--
ALTER TABLE `trabajos_ip_detalles`
  ADD CONSTRAINT `trabajos_ip_detalles_ibfk_1` FOREIGN KEY (`trabajos_ip_id`) REFERENCES `trabajos_ip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
