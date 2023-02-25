create database SpeedBiker;
use SpeedBiker;

create table cliente(
id int ,
email varchar(30),
nombre varchar(30),
telefono double,
primary key (id)
);

create table categoria(
id int,
nombre varchar(20),
primary key (id)
);

create table subcategoria(
id int,
nombre varchar(30),
id_categoria int,
primary key (id)
);

create table categoria_subCategoria(
id_categoria int,
id_subCategoria int,
foreign key (id_categoria)references categoria(id),
foreign key (id_subCategoria) references subcategoria(id)
);

create table producto(
id int,
nombre varchar(20),
stock int,
precio float,
id_categoria int,
id_subcategoria int,
primary key(id),
foreign key (id_categoria) references categoria(id),
foreign key (id_subcategoria) references subcategoria(id)
);


create table cargoEmpleado(
id int,
nombre varchar (15),
primary key(id)
);

create table empleado (
id int,
nombre varchar(20),
apellido varchar (20),
clave varchar(16),
id_cargo int,
primary key(id),
foreign key (id_cargo) references cargoEmpleado(id));



create table ot(
id int,
id_cliente int,
id_producto int,
id_empleado int,
fecha_entrada date,
fecha_salida date,
placa varchar(6),
descripcion varchar(200),
primary key(id),
foreign key(id_cliente) references cliente(id)
);

create table empleado_ot(
id_empleado int,
id_ot int,
foreign key (id_empleado) references empleado(id),
foreign key (id_ot) references ot(id)
);

create table producto_ot(
id_producto int,
id_ot int,
foreign key (id_producto) references producto(id),
foreign key (id_ot) references ot(id)
);

create table factura(
id int,
id_ot int,
fecha date,
precio double,
iva double,
total double,
primary key(id),
foreign key (id_ot) references ot(id)
);
show tables;
