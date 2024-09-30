-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-09-2024 a las 11:24:18
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `erp`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `compraCliente1` (IN `nombre_cliente1` VARCHAR(20), IN `producto1` VARCHAR(25), IN `cantidad1` INT(4))   BEGIN

    declare id_cliente1 int(4);
    declare id_producto1 int(4);
    declare importe_total1 double(6,2);
    declare id_factura_cli1 int(4);

    SELECT id_cliente into id_cliente1 FROM clientes WHERE nombre_cliente = nombre_cliente1;
    SELECT id_producto into id_producto1 FROM producto WHERE nombre_pro=producto1;
    SELECT sum(precio*cantidad1) into importe_total1 FROM producto WHERE id_producto=id_producto1;

    INSERT INTO factura_cliente (fecha, importe_total, id_cli) VALUES (CURRENT_TIMESTAMP(), importe_total1, id_cliente1);
    SELECT LAST_INSERT_ID() into id_factura_cli1; -- Devuelve el campo auto_increment de la última instrucción
    
    INSERT INTO proceso_fac_cli (id_factura_cli, id_producto, cantidad) VALUES (id_factura_cli1, id_producto1, cantidad1);

    UPDATE producto SET cantidad = cantidad-cantidad1 WHERE id_producto=id_producto1;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `compraProveedor1` (IN `nombre_proveedor1` VARCHAR(20), IN `producto1` VARCHAR(25), IN `cantidad1` INT(4))   BEGIN

    declare id_proveedor1 int(4);
    declare id_producto1 int(4);
    declare importe_total1 double(6,2);
    declare id_factura_prov1 int(4);

    SELECT id_proveedor into id_proveedor1 FROM proveedor WHERE nombre = nombre_proveedor1;
    SELECT id_producto into id_producto1 FROM producto WHERE nombre_pro=producto1;
    SELECT sum(precio*cantidad1) into importe_total1 FROM producto WHERE id_producto=id_producto1;

    INSERT INTO factura_prov (fecha, precio_compra, id_prov) VALUES (CURRENT_TIMESTAMP(), importe_total1, id_proveedor1);
    SELECT LAST_INSERT_ID() into id_factura_prov1; -- Devuelve el campo auto_increment de la última instrucción
    
    INSERT INTO proceso_fac_prov (id_producto, id_factura_prov, cantidad) VALUES (id_producto1, id_factura_prov1 , cantidad1);

    UPDATE producto SET cantidad = cantidad+cantidad1 WHERE id_producto=id_producto1;

end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(9) NOT NULL,
  `nombre_cliente` varchar(20) DEFAULT NULL,
  `dni` varchar(9) DEFAULT NULL,
  `telef` int(9) DEFAULT NULL,
  `ubi` varchar(30) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `dni`, `telef`, `ubi`, `eliminado`) VALUES
(1, 'cliente1', '12345678A', 666666666, 'España', 0),
(2, 'cliente2', '24254354B', 123456789, 'Portugal', 1),
(3, 'cliente3', '76565656C', 987654321, 'Benidorm', 0),
(4, 'cliente1', '12345678A', 666666666, 'España', 0),
(5, 'cliente2', '24254354B', 123456789, 'Portugal', 1),
(6, 'cliente3', '76565656C', 987654321, 'Benidorm', 0),
(7, 'cliente1', '12345678A', 666666666, 'España', 0),
(8, 'cliente2', '24254354B', 123456789, 'Portugal', 1),
(9, 'cliente3', '76565656C', 987654321, 'Benidorm', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `componentes`
--

CREATE TABLE `componentes` (
  `id_producto_final` int(9) NOT NULL,
  `id_producto` int(9) DEFAULT NULL,
  `cantidad_componentes` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `ide_emp` int(11) NOT NULL,
  `nom_emp` varchar(50) NOT NULL,
  `cor_emp` varchar(100) NOT NULL,
  `tel_emp` varchar(20) DEFAULT NULL,
  `ini_emp` date NOT NULL,
  `tit_emp` varchar(50) DEFAULT NULL,
  `dep_emp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_cliente`
--

CREATE TABLE `factura_cliente` (
  `id_factura_cli` int(9) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `importe_total` double(6,2) DEFAULT NULL,
  `id_cli` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_prov`
--

CREATE TABLE `factura_prov` (
  `id_factura_prov` int(9) NOT NULL,
  `fecha` date DEFAULT NULL,
  `precio_compra` double(6,2) DEFAULT NULL,
  `id_prov` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso_fac_cli`
--

CREATE TABLE `proceso_fac_cli` (
  `id_factura_cli` int(9) NOT NULL,
  `id_producto` int(9) NOT NULL,
  `cantidad` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso_fac_prov`
--

CREATE TABLE `proceso_fac_prov` (
  `id_producto` int(9) NOT NULL,
  `id_factura_prov` int(9) NOT NULL,
  `cantidad` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(9) NOT NULL,
  `nombre_pro` varchar(25) DEFAULT NULL,
  `precio` double(6,2) DEFAULT NULL,
  `cantidad` int(4) DEFAULT NULL,
  `info` varchar(1024) DEFAULT NULL,
  `compuesto` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre_pro`, `precio`, `cantidad`, `info`, `compuesto`) VALUES
(1, 'producto123', 12.43, 23, 'Producto 1, Ta weno1', 0),
(2, 'producto2', 43.45, 25, 'Producto 2, Ta weno2', 1),
(3, 'producto3', 43.97, 43, 'Producto 3, Ta weno3', 0),
(4, 'producto4', 12.43, 26, 'Producto 4, Ta weno4', 1),
(5, 'producto5', 43.45, 246, 'Producto 5, Ta weno5', 1),
(6, 'producto6', 43.97, 433, 'Producto 6, Ta weno6', 0),
(7, 'producto1', 12.43, 23, 'Producto 1, Ta weno1', 0),
(8, 'producto2', 43.45, 25, 'Producto 2, Ta weno2', 1),
(9, 'producto3', 43.97, 43, 'Producto 3, Ta weno3', 0),
(10, 'producto4', 12.43, 26, 'Producto 4, Ta weno4', 1),
(11, 'producto5', 43.45, 246, 'Producto 5, Ta weno5', 1),
(12, 'producto6', 43.97, 433, 'Producto 6, Ta weno6', 0),
(13, 'producto1', 12.43, 23, 'Producto 1, Ta weno1', 0),
(14, 'producto2', 43.45, 25, 'Producto 2, Ta weno2', 1),
(15, 'producto3', 43.97, 43, 'Producto 3, Ta weno3', 0),
(16, 'producto4', 12.43, 26, 'Producto 4, Ta weno4', 1),
(17, 'producto5', 43.45, 246, 'Producto 5, Ta weno5', 1),
(18, 'producto6', 43.97, 433, 'Producto 6, Ta weno6', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_final`
--

CREATE TABLE `producto_final` (
  `id_producto_final` int(9) NOT NULL,
  `cantidad` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(9) NOT NULL,
  `telf` int(9) DEFAULT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `ubicacion` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `telf`, `nombre`, `ubicacion`) VALUES
(1, 123456789, 'Hermanos Ramones.SL', 'Cáceres'),
(2, 568412785, 'Lolis.SA', 'León'),
(3, 698534756, 'UPS', 'Masachusets'),
(4, 123456789, 'Hermanos Ramones.SL', 'Cáceres'),
(5, 568412785, 'Lolis.SA', 'León'),
(6, 698534756, 'UPS', 'Masachusets'),
(7, 123456789, 'Hermanos Ramones.SL', 'Cáceres'),
(8, 568412785, 'Lolis.SA', 'León'),
(9, 698534756, 'UPS', 'Masachusets');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usu` int(4) NOT NULL,
  `nom_usu` varchar(20) NOT NULL,
  `con_usu` varchar(200) NOT NULL,
  `niv_usu` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usu`, `nom_usu`, `con_usu`, `niv_usu`) VALUES
(1, 'usu1', 'con1', 1),
(2, 'usu2', 'con2', 2),
(3, 'usu3', 'con3', 1),
(4, 'usu1', 'con1', 1),
(5, 'usu2', 'con2', 2),
(6, 'usu3', 'con3', 1),
(7, 'usu1', 'con1', 1),
(8, 'usu2', 'con2', 2),
(9, 'usu3', 'con3', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `componentes`
--
ALTER TABLE `componentes`
  ADD PRIMARY KEY (`id_producto_final`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`ide_emp`);

--
-- Indices de la tabla `factura_cliente`
--
ALTER TABLE `factura_cliente`
  ADD PRIMARY KEY (`id_factura_cli`),
  ADD KEY `id_cli` (`id_cli`);

--
-- Indices de la tabla `factura_prov`
--
ALTER TABLE `factura_prov`
  ADD PRIMARY KEY (`id_factura_prov`),
  ADD KEY `id_prov` (`id_prov`);

--
-- Indices de la tabla `proceso_fac_cli`
--
ALTER TABLE `proceso_fac_cli`
  ADD PRIMARY KEY (`id_factura_cli`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `proceso_fac_prov`
--
ALTER TABLE `proceso_fac_prov`
  ADD PRIMARY KEY (`id_producto`,`id_factura_prov`),
  ADD KEY `id_factura_prov` (`id_factura_prov`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `producto_final`
--
ALTER TABLE `producto_final`
  ADD PRIMARY KEY (`id_producto_final`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `componentes`
--
ALTER TABLE `componentes`
  MODIFY `id_producto_final` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `ide_emp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura_cliente`
--
ALTER TABLE `factura_cliente`
  MODIFY `id_factura_cli` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura_prov`
--
ALTER TABLE `factura_prov`
  MODIFY `id_factura_prov` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `producto_final`
--
ALTER TABLE `producto_final`
  MODIFY `id_producto_final` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usu` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `componentes`
--
ALTER TABLE `componentes`
  ADD CONSTRAINT `componentes_ibfk_1` FOREIGN KEY (`id_producto_final`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `componentes_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `componentes_ibfk_3` FOREIGN KEY (`id_producto_final`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `componentes_ibfk_4` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `componentes_ibfk_5` FOREIGN KEY (`id_producto_final`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `componentes_ibfk_6` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `factura_cliente`
--
ALTER TABLE `factura_cliente`
  ADD CONSTRAINT `factura_cliente_ibfk_1` FOREIGN KEY (`id_cli`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE;

--
-- Filtros para la tabla `factura_prov`
--
ALTER TABLE `factura_prov`
  ADD CONSTRAINT `factura_prov_ibfk_1` FOREIGN KEY (`id_prov`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE;

--
-- Filtros para la tabla `proceso_fac_cli`
--
ALTER TABLE `proceso_fac_cli`
  ADD CONSTRAINT `proceso_fac_cli_ibfk_1` FOREIGN KEY (`id_factura_cli`) REFERENCES `factura_cliente` (`id_factura_cli`) ON DELETE CASCADE,
  ADD CONSTRAINT `proceso_fac_cli_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `proceso_fac_cli_ibfk_3` FOREIGN KEY (`id_factura_cli`) REFERENCES `factura_cliente` (`id_factura_cli`) ON DELETE CASCADE,
  ADD CONSTRAINT `proceso_fac_cli_ibfk_4` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `proceso_fac_cli_ibfk_5` FOREIGN KEY (`id_factura_cli`) REFERENCES `factura_cliente` (`id_factura_cli`) ON DELETE CASCADE,
  ADD CONSTRAINT `proceso_fac_cli_ibfk_6` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `proceso_fac_cli_ibfk_7` FOREIGN KEY (`id_factura_cli`) REFERENCES `factura_cliente` (`id_factura_cli`) ON DELETE CASCADE,
  ADD CONSTRAINT `proceso_fac_cli_ibfk_8` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `proceso_fac_prov`
--
ALTER TABLE `proceso_fac_prov`
  ADD CONSTRAINT `proceso_fac_prov_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `proceso_fac_prov_ibfk_2` FOREIGN KEY (`id_factura_prov`) REFERENCES `factura_prov` (`id_factura_prov`) ON DELETE CASCADE,
  ADD CONSTRAINT `proceso_fac_prov_ibfk_3` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `proceso_fac_prov_ibfk_4` FOREIGN KEY (`id_factura_prov`) REFERENCES `factura_prov` (`id_factura_prov`) ON DELETE CASCADE,
  ADD CONSTRAINT `proceso_fac_prov_ibfk_5` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `proceso_fac_prov_ibfk_6` FOREIGN KEY (`id_factura_prov`) REFERENCES `factura_prov` (`id_factura_prov`) ON DELETE CASCADE;

--
-- Filtros para la tabla `producto_final`
--
ALTER TABLE `producto_final`
  ADD CONSTRAINT `producto_final_ibfk_1` FOREIGN KEY (`id_producto_final`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `producto_final_ibfk_2` FOREIGN KEY (`id_producto_final`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `producto_final_ibfk_3` FOREIGN KEY (`id_producto_final`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
