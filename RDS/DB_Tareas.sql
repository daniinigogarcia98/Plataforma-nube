drop database if exists tareas;
create database tareas;
use tareas;

create table tareas(
id int primary key auto_increment,
titulo varchar(100) not null,
descripcion varchar(255) not null,
fechaC datetime not null,
prioridad enum('baja','media','alta') not null default 'media',
estado enum('pendiente','en proceso','completada') not null default 'pendiente'
) engine innodb;