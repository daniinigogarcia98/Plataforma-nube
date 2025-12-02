drop database if exists cartelera;
create database cartelera;
use cartelera;

create table peliculas(
	id_pelicula int auto_increment primary key,
    titulo varchar(100) not null,
	director varchar(100) not null,
    actor varchar(100) not null,
	S3Fotos varchar(255),
    anio varchar(100) not null,
    genero varchar(100) not null,
    formato enum('Streaming','Digital','DVD') not null default 'Streaming'
)engine innodb;

insert into peliculas values(
    default,'Bad Boys: Ride or Die','Adil El Arbi, Bilall Fallah','Will Smith',null,'2024-05-22','Acción/Comedia','Streaming'
);