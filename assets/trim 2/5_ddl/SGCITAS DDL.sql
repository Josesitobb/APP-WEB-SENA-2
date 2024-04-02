CREATE DATABASE sgcitas;
USE sgcitas;

CREATE TABLE `citas` (
  `Id_Citas` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `Id_Clientes` int(11) DEFAULT NULL,
  `Id_Estilistas` int(11) DEFAULT NULL,
  `Id_Servicios` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;





CREATE TABLE `clientes` (
  `Id_Clientes` int(11) NOT NULL,
  `Id_Usuarios` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `comisiones` (
  `Id_Comisiones` int(11) NOT NULL,
  `Pagar_Comisiones` decimal(12,2) NOT NULL,
  `Estado_De_Pago_Comisiones` tinyint(4) NOT NULL,
  `Id_Facturas` int(11) DEFAULT NULL,
  `Id_Estilistas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `estilistas` (
  `Id_Estilistas` int(11) NOT NULL,
  `Estado` tinyint(4) NOT NULL,
  `Id_Usuarios` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `facturas` (
  `Id_Facturas` int(11) NOT NULL,
  `Fecha_Factura` datetime NOT NULL,
  `Factura_Total` decimal(12,2) NOT NULL,
  `Id_Productos` int(11) DEFAULT NULL,
  `Id_Servicios` int(11) DEFAULT NULL,
  `Id_Clientes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `productos` (
  `Id_Productos` int(11) NOT NULL,
  `Nombre_Productos` varchar(45) NOT NULL,
  `Precio_Productos` decimal(12,2) NOT NULL,
  `Cantidad_Productos` int(11) NOT NULL,
  `Descripcion_Productos` varchar(200) DEFAULT NULL,
  `Imagen_Productos` mediumblob NOT NULL,
  `Id_Clientes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `roles` (
  `Id_Rol` int(11) NOT NULL,
  `Nombre_Rol` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `servicios` (
  `Id_Servicios` int(11) NOT NULL,
  `Nombre_Servicios` varchar(45) NOT NULL,
  `Valor_Servicios` decimal(12,2) NOT NULL,
  `Descripcion_Servicios` varchar(200) DEFAULT NULL,
  `Imagen_Servicios` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `usuarios` (
  `Id_Usuarios` int(11) NOT NULL,
  `Nombre_Usuarios` varchar(45) NOT NULL,
  `Apellido_Usuarios` varchar(45) NOT NULL,
  `Correo_Usuarios` varchar(45) NOT NULL,
  `Telefono_Usuarios` varchar(45) NOT NULL,
  `Contraseña_Usuarios` varchar(45) NOT NULL,
  `Id_Rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `citas`
  ADD PRIMARY KEY (`Id_Citas`),
  ADD KEY `FK1_Id_Clientes` (`Id_Clientes`),
  ADD KEY `FK2_Id_Estilistas` (`Id_Estilistas`),
  ADD KEY `FK3_Id_Servicios` (`Id_Servicios`);


ALTER TABLE `clientes`
  ADD PRIMARY KEY (`Id_Clientes`),
  ADD KEY `Fk_Id_Usuarios` (`Id_Usuarios`);


ALTER TABLE `comisiones`
  ADD PRIMARY KEY (`Id_Comisiones`),
  ADD KEY `Fk1_Id_Facturas` (`Id_Facturas`),
  ADD KEY `Fk5_Id_Estilistas` (`Id_Estilistas`);


ALTER TABLE `estilistas`
  ADD PRIMARY KEY (`Id_Estilistas`),
  ADD KEY `Fk_2Id_Usuarios` (`Id_Usuarios`);


ALTER TABLE `facturas`
  ADD PRIMARY KEY (`Id_Facturas`),
  ADD KEY `FK1_Id_Productos` (`Id_Productos`),
  ADD KEY `FK2_Id_Servicios` (`Id_Servicios`),
  ADD KEY `FK3_Id_Clientes` (`Id_Clientes`);


ALTER TABLE `productos`
  ADD PRIMARY KEY (`Id_Productos`),
  ADD KEY `Fk_Id_Clientes` (`Id_Clientes`);


ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id_Rol`);


ALTER TABLE `servicios`
  ADD PRIMARY KEY (`Id_Servicios`);


ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id_Usuarios`),
  ADD KEY `FK_Id_Rol` (`Id_Rol`);

--

--
ALTER TABLE `citas`
  MODIFY `Id_Citas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--

--
ALTER TABLE `clientes`
  MODIFY `Id_Clientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;


--
ALTER TABLE `comisiones`
  MODIFY `Id_Comisiones` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `estilistas`
  MODIFY `Id_Estilistas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;



ALTER TABLE `facturas`
  MODIFY `Id_Facturas` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `productos`
  MODIFY `Id_Productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `roles`
  MODIFY `Id_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `servicios`
  MODIFY `Id_Servicios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `usuarios`
  MODIFY `Id_Usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;



ALTER TABLE `citas`
  ADD CONSTRAINT `FK1_Id_Clientes` FOREIGN KEY (`Id_Clientes`) REFERENCES `clientes` (`Id_Clientes`),
  ADD CONSTRAINT `FK2_Id_Estilistas` FOREIGN KEY (`Id_Estilistas`) REFERENCES `estilistas` (`Id_Estilistas`),
  ADD CONSTRAINT `FK3_Id_Servicios` FOREIGN KEY (`Id_Servicios`) REFERENCES `servicios` (`Id_Servicios`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `clientes`
  ADD CONSTRAINT `Fk_Id_Usuarios` FOREIGN KEY (`Id_Usuarios`) REFERENCES `usuarios` (`Id_Usuarios`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `comisiones`
  ADD CONSTRAINT `Fk1_Id_Facturas` FOREIGN KEY (`Id_Facturas`) REFERENCES `facturas` (`Id_Facturas`),
  ADD CONSTRAINT `Fk5_Id_Estilistas` FOREIGN KEY (`Id_Estilistas`) REFERENCES `estilistas` (`Id_Estilistas`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `estilistas`
  ADD CONSTRAINT `Fk_2Id_Usuarios` FOREIGN KEY (`Id_Usuarios`) REFERENCES `usuarios` (`Id_Usuarios`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `facturas`
  ADD CONSTRAINT `FK1_Id_Productos` FOREIGN KEY (`Id_Productos`) REFERENCES `productos` (`Id_Productos`),
  ADD CONSTRAINT `FK2_Id_Servicios` FOREIGN KEY (`Id_Servicios`) REFERENCES `servicios` (`Id_Servicios`),
  ADD CONSTRAINT `FK3_Id_Clientes` FOREIGN KEY (`Id_Clientes`) REFERENCES `clientes` (`Id_Clientes`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `productos`
  ADD CONSTRAINT `Fk_Id_Clientes` FOREIGN KEY (`Id_Clientes`) REFERENCES `clientes` (`Id_Clientes`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_Id_Rol` FOREIGN KEY (`Id_Rol`) REFERENCES `roles` (`Id_Rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
