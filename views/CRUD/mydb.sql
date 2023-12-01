-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-09-2023 a las 20:43:40
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mydb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `IdCITAS` int(11) NOT NULL,
  `Citas_fechas` datetime NOT NULL,
  `CLIENTES_idCLIENTES` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCLIENTES` int(11) NOT NULL,
  `USUARIOS_idUSUARIOS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comisiones`
--

CREATE TABLE `comisiones` (
  `IdCOMISIONES` int(11) NOT NULL,
  `comision_pagar` varchar(45) NOT NULL,
  `comision_estado_pago` tinyint(4) NOT NULL,
  `ESTILISTAS_idESTILISTAS` int(11) NOT NULL,
  `FACTURAS_idFACTURAS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilistas`
--

CREATE TABLE `estilistas` (
  `idESTILISTAS` int(11) NOT NULL,
  `USUARIOS_idUSUARIOS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilistas_has_citas`
--

CREATE TABLE `estilistas_has_citas` (
  `ESTILISTAS_idESTILISTAS` int(11) NOT NULL,
  `CITAS_IdCITAS` int(11) NOT NULL,
  `Esteticistas_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `idFACTURAS` int(11) NOT NULL,
  `factura_fecha` datetime NOT NULL,
  `factura_total_productos` decimal(7,2) NOT NULL,
  `factura_total_servicios` decimal(7,2) NOT NULL,
  `factura_total` decimal(7,2) NOT NULL,
  `CLIENTES_idCLIENTES` int(11) NOT NULL,
  `FORMAS_DE_PAGOS_idFORMAS_DE_PAGOS` int(11) NOT NULL,
  `SERVICIOS_idSERVICIOS` int(11) NOT NULL,
  `PRODUCTOS_idPRODUCTOS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formas_de_pagos`
--

CREATE TABLE `formas_de_pagos` (
  `idFORMAS_DE_PAGOS` int(11) NOT NULL,
  `pago_nombre` varchar(45) NOT NULL,
  `estado_del_pago` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idPRODUCTOS` int(11) NOT NULL,
  `producto_nombre` varchar(45) NOT NULL,
  `producto_precio` varchar(45) NOT NULL,
  `producto_cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `IdROLES` int(11) NOT NULL,
  `Nombres_Roles` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`IdROLES`, `Nombres_Roles`) VALUES
(1, 'CLIENTE'),
(2, 'ESTILISTA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `idSERVICIOS` int(11) NOT NULL,
  `servicio_nombre` varchar(45) NOT NULL,
  `servicio_valor` varchar(45) NOT NULL,
  `servicio_cantidad` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUSUARIOS` int(11) NOT NULL,
  `usuarios_nombres` varchar(45) NOT NULL,
  `usuario_apellido` varchar(45) NOT NULL,
  `usuario_username` varchar(45) NOT NULL,
  `usuario_contraseña` varchar(45) NOT NULL,
  `usuario_correo` varchar(45) NOT NULL,
  `ROLES_IdROLES` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUSUARIOS`, `usuarios_nombres`, `usuario_apellido`, `usuario_username`, `usuario_contraseña`, `usuario_correo`, `ROLES_IdROLES`) VALUES
(2, 'JOSE', 'GUERRA', 'JOSESITOBB', 'JOSE12345', 'JOSE12345', 1),
(3, 'MARYURI', 'LEON', 'LEONCITO', '12345678', 'LEO@GMAIL.COM', 1),
(5, 'ARROZ', 'MOCHO', 'MOCHO', 'MOCHO', 'MOCHO', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`IdCITAS`),
  ADD KEY `fk_CITAS_CLIENTES1_idx` (`CLIENTES_idCLIENTES`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCLIENTES`),
  ADD KEY `fk_CLIENTES_USUARIOS1_idx` (`USUARIOS_idUSUARIOS`);

--
-- Indices de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  ADD PRIMARY KEY (`IdCOMISIONES`),
  ADD KEY `fk_COMISIONES_ESTILISTAS1_idx` (`ESTILISTAS_idESTILISTAS`),
  ADD KEY `fk_COMISIONES_FACTURAS1_idx` (`FACTURAS_idFACTURAS`);

--
-- Indices de la tabla `estilistas`
--
ALTER TABLE `estilistas`
  ADD PRIMARY KEY (`idESTILISTAS`),
  ADD KEY `fk_CLIENTES_USUARIOS1_idx` (`USUARIOS_idUSUARIOS`);

--
-- Indices de la tabla `estilistas_has_citas`
--
ALTER TABLE `estilistas_has_citas`
  ADD KEY `fk_ESTILISTAS_has_CITAS_ESTILISTAS1_idx` (`ESTILISTAS_idESTILISTAS`),
  ADD KEY `fk_ESTILISTAS_has_CITAS_CITAS1_idx` (`CITAS_IdCITAS`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`idFACTURAS`),
  ADD KEY `fk_FACTURAS_CLIENTES1_idx` (`CLIENTES_idCLIENTES`),
  ADD KEY `fk_FACTURAS_FORMAS_DE_PAGOS1_idx` (`FORMAS_DE_PAGOS_idFORMAS_DE_PAGOS`),
  ADD KEY `fk_FACTURAS_SERVICIOS1_idx` (`SERVICIOS_idSERVICIOS`),
  ADD KEY `fk_FACTURAS_PRODUCTOS1_idx` (`PRODUCTOS_idPRODUCTOS`);

--
-- Indices de la tabla `formas_de_pagos`
--
ALTER TABLE `formas_de_pagos`
  ADD PRIMARY KEY (`idFORMAS_DE_PAGOS`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idPRODUCTOS`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`IdROLES`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`idSERVICIOS`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUSUARIOS`),
  ADD KEY `fk_USUARIOS_ROLES_idx` (`ROLES_IdROLES`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `IdCITAS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCLIENTES` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  MODIFY `IdCOMISIONES` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estilistas`
--
ALTER TABLE `estilistas`
  MODIFY `idESTILISTAS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `idFACTURAS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formas_de_pagos`
--
ALTER TABLE `formas_de_pagos`
  MODIFY `idFORMAS_DE_PAGOS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idPRODUCTOS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `IdROLES` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `idSERVICIOS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUSUARIOS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `fk_CITAS_CLIENTES1` FOREIGN KEY (`CLIENTES_idCLIENTES`) REFERENCES `clientes` (`idCLIENTES`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_CLIENTES_USUARIOS1` FOREIGN KEY (`USUARIOS_idUSUARIOS`) REFERENCES `usuarios` (`idUSUARIOS`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comisiones`
--
ALTER TABLE `comisiones`
  ADD CONSTRAINT `fk_COMISIONES_ESTILISTAS1` FOREIGN KEY (`ESTILISTAS_idESTILISTAS`) REFERENCES `estilistas` (`idESTILISTAS`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_COMISIONES_FACTURAS1` FOREIGN KEY (`FACTURAS_idFACTURAS`) REFERENCES `facturas` (`idFACTURAS`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `estilistas`
--
ALTER TABLE `estilistas`
  ADD CONSTRAINT `fk_CLIENTES_USUARIOS10` FOREIGN KEY (`USUARIOS_idUSUARIOS`) REFERENCES `usuarios` (`idUSUARIOS`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `estilistas_has_citas`
--
ALTER TABLE `estilistas_has_citas`
  ADD CONSTRAINT `fk_ESTILISTAS_has_CITAS_CITAS1` FOREIGN KEY (`CITAS_IdCITAS`) REFERENCES `citas` (`IdCITAS`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ESTILISTAS_has_CITAS_ESTILISTAS1` FOREIGN KEY (`ESTILISTAS_idESTILISTAS`) REFERENCES `estilistas` (`idESTILISTAS`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `fk_FACTURAS_CLIENTES1` FOREIGN KEY (`CLIENTES_idCLIENTES`) REFERENCES `clientes` (`idCLIENTES`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_FACTURAS_FORMAS_DE_PAGOS1` FOREIGN KEY (`FORMAS_DE_PAGOS_idFORMAS_DE_PAGOS`) REFERENCES `formas_de_pagos` (`idFORMAS_DE_PAGOS`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_FACTURAS_PRODUCTOS1` FOREIGN KEY (`PRODUCTOS_idPRODUCTOS`) REFERENCES `productos` (`idPRODUCTOS`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_FACTURAS_SERVICIOS1` FOREIGN KEY (`SERVICIOS_idSERVICIOS`) REFERENCES `servicios` (`idSERVICIOS`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_USUARIOS_ROLES` FOREIGN KEY (`ROLES_IdROLES`) REFERENCES `roles` (`IdROLES`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
