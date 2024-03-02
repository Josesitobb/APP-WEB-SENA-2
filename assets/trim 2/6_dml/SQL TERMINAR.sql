-- Se visualizan las tablas 
select * from roles;
select * from usuarios;
select * from clientes;
select * from estilistas;
select * from servicios;
select * from productos;
select * from facturas;
select * from comisiones;

-- Se insertan los usuarios
INSERT INTO `usuarios`(`Nombre_Usuarios`, `Apellido_Usuarios`, `Correo_Usuarios`, `Telefono_Usuarios`, `Contraseña_Usuarios`, `Id_Rol`)
VALUES ('Rey1', 'Apellido1', 'rey1@gmail.com', '123456789', 'contraseña1', 2);

INSERT INTO `usuarios`(`Nombre_Usuarios`, `Apellido_Usuarios`, `Correo_Usuarios`, `Telefono_Usuarios`, `Contraseña_Usuarios`, `Id_Rol`)
VALUES ('Rey2', 'Apellido2', 'rey2@gmail.com', '123456789', 'contraseña2', 2);

INSERT INTO `usuarios`(`Nombre_Usuarios`, `Apellido_Usuarios`, `Correo_Usuarios`, `Telefono_Usuarios`, `Contraseña_Usuarios`, `Id_Rol`)
VALUES ('Rey3', 'Apellido3', 'rey3@gmail.com', '123456789', 'contraseña3', 2);

INSERT INTO `usuarios`(`Nombre_Usuarios`, `Apellido_Usuarios`, `Correo_Usuarios`, `Telefono_Usuarios`, `Contraseña_Usuarios`, `Id_Rol`)
VALUES ('Rey4', 'Apellido4', 'rey4@gmail.com', '123456789', 'contraseña4', 2);

INSERT INTO `usuarios`(`Nombre_Usuarios`, `Apellido_Usuarios`, `Correo_Usuarios`, `Telefono_Usuarios`, `Contraseña_Usuarios`, `Id_Rol`)
VALUES ('Rey5', 'Apellido5', 'rey5@gmail.com', '123456789', 'contraseña5', 2);
-- Se insertan los usuario a la tabla cliente
INSERT INTO `clientes`(`Id_Usuarios`)
VALUES (22); 
INSERT INTO `clientes`(`Id_Usuarios`)
VALUES (23); 
INSERT INTO `clientes`(`Id_Usuarios`)
VALUES (24); 
INSERT INTO `clientes`(`Id_Usuarios`)
VALUES (25); 
INSERT INTO `clientes`(`Id_Usuarios`)
VALUES (26); 

-- Se insertan los usuario a la tabla Estilista
INSERT INTO `estilistas`(`Id_Usuarios`)
VALUES (22); 
INSERT INTO `estilistas`(`Id_Usuarios`)
VALUES (23); 
INSERT INTO `estilistas`(`Id_Usuarios`)
VALUES (24); 
INSERT INTO `estilistas`(`Id_Usuarios`)
VALUES (25); 
INSERT INTO `clientes`(`Id_Usuarios`)
VALUES (26); 

-- Buscar todos los correo que comienzan en rey
SELECT Correo_Usuarios
FROM usuarios
WHERE Correo_Usuarios LIKE 'rey%';
-- borrar usuario
DELETE FROM usuarios WHERE Id_Usuarios IN (22, 23, 24, 25);
DELETE FROM usuarios WHERE Id_Usuarios = 22;

-- Crear producto
-- Producto 1
INSERT INTO Productos (Nombre_Productos, Precio_Productos, Cantidad_Productos, Descripcion_Productos, Imagen_Productos, Id_Clientes)
VALUES ('Producto1', 10.99, 100, 'Descripción del Producto 1', NULL, 1);

-- Producto 2
INSERT INTO Productos (Nombre_Productos, Precio_Productos, Cantidad_Productos, Descripcion_Productos, Imagen_Productos, Id_Clientes)
VALUES ('Producto2', 15.99, 50, 'Descripción del Producto 2', NULL, 2);

-- Producto 3
INSERT INTO Productos (Nombre_Productos, Precio_Productos, Cantidad_Productos, Descripcion_Productos, Imagen_Productos, Id_Clientes)
VALUES ('Producto3', 20.99, 75, 'Descripción del Producto 3', NULL, 3);

-- Producto 4
INSERT INTO Productos (Nombre_Productos, Precio_Productos, Cantidad_Productos, Descripcion_Productos, Imagen_Productos, Id_Clientes)
VALUES ('Producto4', 25.99, 30, 'Descripción del Producto 4', NULL, 4);

-- Producto 5
INSERT INTO Productos (Nombre_Productos, Precio_Productos, Cantidad_Productos, Descripcion_Productos, Imagen_Productos, Id_Clientes)
VALUES ('Producto5', 30.99, 60, 'Descripción del Producto 5', NULL, 5);

-- crear servicio
-- Servicio 1
INSERT INTO servicios (Nombre_Servicios, Valor_Servicios, Descripcion_Servicios, Imagen_Servicios)
VALUES ('Servicio1', 10.00, 'Descripción del Servicio 1', NULL);

-- Servicio 2
INSERT INTO servicios (Nombre_Servicios, Valor_Servicios, Descripcion_Servicios, Imagen_Servicios)
VALUES ('Servicio2', 20.00, 'Descripción del Servicio 2', NULL);

-- Servicio 3
INSERT INTO servicios (Nombre_Servicios, Valor_Servicios, Descripcion_Servicios, Imagen_Servicios)
VALUES ('Servicio3', 30.00, 'Descripción del Servicio 3', NULL);

-- Servicio 4
INSERT INTO servicios (Nombre_Servicios, Valor_Servicios, Descripcion_Servicios, Imagen_Servicios)
VALUES ('Servicio4', 40.00, 'Descripción del Servicio 4', NULL);

-- Servicio 5
INSERT INTO servicios (Nombre_Servicios, Valor_Servicios, Descripcion_Servicios, Imagen_Servicios)
VALUES ('Servicio5', 50.00, 'Descripción del Servicio 5', NULL);

-- Servicio 6
INSERT INTO servicios (Nombre_Servicios, Valor_Servicios, Descripcion_Servicios, Imagen_Servicios)
VALUES ('Servicio6', 60.00, 'Descripción del Servicio 6', NULL);

-- Servicio 7
INSERT INTO servicios (Nombre_Servicios, Valor_Servicios, Descripcion_Servicios, Imagen_Servicios)
VALUES ('Servicio7', 70.00, 'Descripción del Servicio 7', NULL);

-- Servicio 8
INSERT INTO servicios (Nombre_Servicios, Valor_Servicios, Descripcion_Servicios, Imagen_Servicios)
VALUES ('Servicio8', 80.00, 'Descripción del Servicio 8', NULL);

-- Servicio 9
INSERT INTO servicios (Nombre_Servicios, Valor_Servicios, Descripcion_Servicios, Imagen_Servicios)
VALUES ('Servicio9', 90.00, 'Descripción del Servicio 9', NULL);

-- Servicio 10
INSERT INTO servicios (Nombre_Servicios, Valor_Servicios, Descripcion_Servicios, Imagen_Servicios)
VALUES ('Servicio10', 100.00, 'Descripción del Servicio 10', NULL);





