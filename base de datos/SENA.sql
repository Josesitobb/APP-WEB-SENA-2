CREATE DATABASE SGCitas;
use SGCitas;
-- drop database SGCitas;
create table Roles(
Id_Rol INT auto_increment,
Nombre_Rol varchar(45) NOT NULL,
primary key(Id_rol)
);

create table Usuarios(
Id_Usuarios INT auto_increment,
Nombre_Usuarios varchar(45) NOT NULL,
Apellido_Usuarios varchar(45) NOT NULL,
Correo_Usuarios varchar(45) NOT NULL,
Telefono_Usuarios varchar(45) NOT NULL,
Contraseña_Usuarios varchar(45) NOT NULL,
primary key(Id_Usuarios),
Id_Rol INT,
constraint FK_Id_Rol foreign key(Id_Rol) references Roles (Id_Rol)
ON DELETE CASCADE
ON UPDATE CASCADE
);
Select*from usuarios;

create table clientes(
Id_Clientes INT auto_increment,
primary key(Id_Clientes),
Id_Usuarios INT,
constraint Fk_Id_Usuarios foreign key(Id_Usuarios ) references Usuarios(Id_Usuarios)
ON DELETE CASCADE
ON UPDATE CASCADE
);
Select*from clientes;

create table Estilistas(
Id_Estilistas INT auto_increment,
Estado TINYINT NOT NULL ,
primary key(Id_Estilistas),
Id_Usuarios INT,
constraint Fk_2Id_Usuarios foreign key(Id_Usuarios ) references Usuarios(Id_Usuarios)
ON DELETE CASCADE
ON UPDATE CASCADE
);
select * from Estilistas;

create table Productos(
Id_Productos INT auto_increment,
Nombre_Productos varchar(45) NOT NULL,
Precio_Productos varchar(45) NOT NULL,
Imagen_Productos mediumblob NOT NULL,
primary key(Id_Productos), 
Id_Clientes INT,
constraint Fk_Id_Clientes foreign key (Id_Clientes) references clientes(Id_Clientes)
ON DELETE CASCADE
ON UPDATE CASCADE
);
Select * from Productos;

create table servicios (
Id_Servicios INT auto_increment,
Nombre_Servicios varchar(45) NOT NULL,
Valor_Servicios decimal(12,2) NOT NULL,
Cantidad_Servicios INT NOT NULL,
Imagen_Servicios mediumblob NOT NULL,
primary key(Id_Servicios)
);
Select * from servicios;

create table Citas(
Id_Citas INT auto_increment,
Fecha_Citas datetime NOT NULL,
primary key(Id_Citas),
Id_Clientes INT,
Id_Estilistas INT,
Id_Servicios INT,
constraint FK1_Id_Clientes foreign key(Id_Clientes) references clientes(Id_Clientes),
constraint FK2_Id_Estilistas foreign key(Id_Estilistas) references Estilistas(Id_Estilistas),
constraint FK3_Id_Servicios foreign key(Id_Servicios) references servicios(Id_Servicios)
ON DELETE CASCADE
ON UPDATE CASCADE
);
Select * from Citas;

create table facturas(
Id_Facturas INT auto_increment,
Fecha_Factura datetime NOT NULL ,
Factura_Total decimal(12,2) NOT NULL,
primary key(Id_Facturas),
Id_Productos INT,
Id_Servicios INT,
Id_Clientes INT,
constraint FK1_Id_Productos foreign key(Id_Productos) references Productos(Id_Productos),
constraint FK2_Id_Servicios foreign key(Id_Servicios) references servicios(Id_Servicios),
constraint FK3_Id_Clientes foreign key(Id_Clientes) references clientes(Id_Clientes)
ON DELETE CASCADE
ON UPDATE CASCADE
);
select * from facturas;

create table Comisiones(
Id_Comisiones INT auto_increment ,
Pagar_Comisiones decimal(12,2) NOT NULL,
Estado_De_Pago_Comisiones TINYINT NOT NULL,
primary key(Id_Comisiones),
Id_Facturas INT,
Id_Estilistas INT,
constraint Fk1_Id_Facturas foreign key (Id_Facturas) references facturas(Id_Facturas),
constraint Fk5_Id_Estilistas foreign key (Id_Estilistas) references Estilistas(Id_Estilistas)
ON DELETE CASCADE
ON UPDATE CASCADE
);

select * from Comisiones;
