<?php
require_once 'BD.php';
$bd = new BD();
if ($bd->getConexion() == null) {
    $error[] = 'No hay conexión con la BD';
} else {
    if (isset($_POST['InsertarP'])) {
        if (
            empty($_POST['titulo']) || empty($_POST['director']) || empty($_POST['actor']) ||
            empty($_FILES['portada']['name']) || empty($_POST['anio']) || empty($_POST['genero']) || empty($_POST['formato'])
        ) {
            $error = 'Todos los campos son obligatorios';
        } else {

            $fecha = $_POST['anio'];
            $pelicula = new Peliculas(
                null,
                $_POST['titulo'],
                $_POST['director'],
                $_POST['actor'],
                $_FILES['portada'],
                $fecha,
                $_POST['genero'],
                $_POST['formato']
            );
            if ($bd->insertarPelicula($pelicula)) {
                $mensaje = 'Película Insertada con id: ' . $pelicula->getId_pelicula();
            } else {
                $error = (isset($error) ? 'Excepción: ' . $error : 'Error al insertar la película');
            }
        }
    }
    if (isset($_POST['ActualizarP'])) {
        if (empty($_POST['pelicula_id'])) {
            $error = 'Debe seleccionar una película para actualizar';
        } else {
            $pelicula_id = $_POST['pelicula_id'];
            $peliculas = $bd->obtenerPeliculas();
            $peliculaSeleccionada = null;

            foreach ($peliculas as $p) {
                if ($p->getId_pelicula() == $pelicula_id) {
                    $peliculaSeleccionada = $p;
                    break;
                }
            }
            if ($peliculaSeleccionada) {
                $peliculaAct = new Peliculas(
                    $pelicula_id,
                    $_POST['titulo'],
                    $_POST['director'],
                    $_POST['actor'],
                    $_FILES['portada'],
                    $_POST['anio'],
                    $_POST['genero'],
                    $_POST['formato']
                );
                if ($bd->actualizarPelicula($peliculaAct)) {
                    $mensaje = "Película actualizada exitosamente!";
                } else {
                    $error = "Error al actualizar la película";
                }
            } else {
                $error = 'Película no encontrada';
            }
        }
    }

    if (isset($_POST['BorrarP'])) {
        if (empty($_POST['pelicula_id'])) {
            $error = 'Debes seleccionar una Pelicula para poder Borrarla';
        } else {
            $pelicula_id = $_POST['pelicula_id'];
            $peliculas = $bd->obtenerPeliculas();
            $peliculaSeleccionada = null;
            foreach ($peliculas as $p) {
                if ($p->getId_pelicula() == $pelicula_id) {
                    $peliculaSeleccionada = $p;
                    break;
                }
            }
            if ($peliculaSeleccionada) {
                $resultado = $bd->borrarPelicula($peliculaSeleccionada);
                if ($resultado) {
                    $mensaje = "Película borrada exitosamente.";
                } else {
                    $error = "Error al borrar la película.";
                }
            } else {
                $error = "Película no encontrada en la base de datos.";
            }
        }
        header("Location: index.php");
        exit;
    }
}
