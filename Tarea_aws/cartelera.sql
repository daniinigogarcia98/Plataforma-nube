drop database if exists cartelera;
create database cartelera;
use cartelera;

create table peliculas(
	id_pelicula int auto_increment primary key,
    titulo varchar(100) not null,
	director varchar(100) not null,
	S3Fotos varchar(255),
    año varchar(100) not null,
    genero varchar(100) not null,
    formato varchar(100) not null
)engine innodb;