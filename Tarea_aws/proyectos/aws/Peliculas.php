<?php
class Peliculas
{
    private $id_pelicula, $titulo, $director, $actor, $S3Fotos, $anio, $genero, $formato;

    public function __construct($id_pelicula, $titulo, $director, $actor, $S3Fotos, $anio, $genero, $formato)
    {
        $this->id_pelicula = $id_pelicula;
        $this->titulo = $titulo;
        $this->director = $director;
        $this->actor = $actor;
        $this->S3Fotos = $S3Fotos;
        $this->anio = $anio;
        $this->genero = $genero;
        $this->formato = $formato;
    }

    public function getId_pelicula()
    {
        return $this->id_pelicula;
    }

    public function setId_pelicula($id_pelicula)
    {
        $this->id_pelicula = $id_pelicula;
        return $this;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
        return $this;
    }

    public function getDirector()
    {
        return $this->director;
    }

    public function setDirector($director)
    {
        $this->director = $director;
        return $this;
    }

    public function getActor()
    {
        return $this->actor;
    }

    public function setActor($actor)
    {
        $this->actor = $actor;
        return $this;
    }

    public function getS3Fotos()
    {
        return $this->S3Fotos;
    }

    public function setS3Fotos($S3Fotos)
    {
        $this->S3Fotos = $S3Fotos;
        return $this;
    }

    public function getAnio()
    {
        return $this->anio;
    }

    public function setAnio($anio)
    {
        $this->anio = $anio;
        return $this;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function setGenero($genero)
    {
        $this->genero = $genero;
        return $this;
    }

    public function getFormato()
    {
        return $this->formato;
    }

    public function setFormato($formato)
    {
        $this->formato = $formato;
        return $this;
    }
}
