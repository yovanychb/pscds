drop database PSCDS;

create database PSCDS;

use PSCDS;

create table Usuarios(
Dui varchar (10) primary key,
Imagen varchar (250) not null,
Nombres varchar(32) not null,
Apellidos varchar (32) not null,
Telefono varchar(9) not null,
Cargo varchar(32) not null,
Correo varchar(64) not null,
Contrasea varchar(20) not null
);

create table Cursos(
Id_Curso int not null auto_increment primary key,
Nombre varchar(32) not null,
Fecha_Inicio date not null,
Fecha_Fin date not null,
Cantidad_Convocatorias int not null,
Cantidad_Aprobados int not null,
Id_Usuario varchar (10) not null,
foreign key (Id_Usuario) references Usuarios(Dui)
);

create table Convocatorias(
Id_Convocatorias int not null primary key,
Titulo varchar(32) not null,
Fecha_Inicio date not null,
Fecha_Fin date not null,
Cantidad int not null,
Id_Curso int not null,
foreign key (Id_Curso) references Cursos(Id_Curso)
);

create table Aspirantes(
Nit varchar(17) not null primary key,
Nombre varchar(32) not null,
Apellido varchar (32) not null,
Dui varchar (10),
Correo varchar (64) not null,
Direccion varchar (250)  not null,
Facebook varchar (32),
Telefono1 varchar (9) not null,
Telefono2 varchar (9) ,
TelefonoFijo varchar (9) ,
NivelAcademico varchar (16),
NumConvocatoria int not null,
foreign key (NumConvocatoria) references Convocatorias(Id_Convocatorias)
);


create table Notas(
Id_Nota int not null auto_increment primary key,
Matematica double not null,
Logica double not null,
Perseverancia double not null,
HabComputacionales double not null,
Promedio double not null,
Id_Aspirante varchar(17) not null,
foreign key (Id_Aspirante) references Aspirantes(Nit)
);

create table Aprobados(
Id_Aprobado int not null auto_increment primary key,
Estado tinyint not null,
Id_Aspirante varchar(17) not null,
foreign key (Id_Aspirante) references Aspirantes(Nit)
);