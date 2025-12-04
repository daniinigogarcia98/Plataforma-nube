<?php
require_once 'Peliculas.php';
require_once 'S3.php';

class BD
{
    private $conexion = null;

    public function __construct()
    {
        try {
            $crd = $this->obtenerCredenciales();
            $url = 'mysql:host=' . $crd['HOST'] . ';port=' . $crd['PUERTO'] . ';dbname=' . $crd['NOMBREBD'];
            $this->conexion = new PDO($url, $crd['USUARIO'], $crd['PS']);
        } catch (\Throwable $th) {
            global $error;
            $error[] = $th->getMessage();
        }
    }

    public function getConexion()
    {
        return $this->conexion;
    }

    private function obtenerCredenciales()
    {
        $resultado = array();
        if (file_exists('.env')) {
            $datos = file('.env', FILE_IGNORE_NEW_LINES);
            foreach ($datos as $d) {
                $campos = explode('=', $d);
                $resultado[$campos[0]] = $campos[1];
            }
            if (
                !isset($resultado['HOST']) || !isset($resultado['PUERTO']) || !isset($resultado['NOMBREBD']) ||
                !isset($resultado['USUARIO']) || !isset($resultado['PS'])
            ) {
                throw new Exception('Datos de acceso incorrectos');
            }
        } else {
            throw new Exception('No existe fichero de credenciales');
        }
        return $resultado;
    }

    public function obtenerPeliculas()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->query('SELECT * from peliculas');
            while ($fila = $consulta->fetch()) {
                $resultado[] = new Peliculas(
                    $fila['id_pelicula'],
                    $fila['titulo'],
                    $fila['director'],
                    $fila['actor'],
                    $fila['S3Fotos'],
                    date('d/m/Y', strtotime($fila['anio'])),
                    $fila['genero'],
                    $fila['formato']
                );
            }
        } catch (\Throwable $th) {
            global $error;
            $error[] = $th->getMessage();
        }
        return $resultado;
    }

    public function insertarPelicula(Peliculas $pelicula)
    {
        $resultado = false;
        try {
            //Insertar la película en la base de datos
            $accesoS3 = $pelicula->getS3Fotos()['name'];
            $consulta = $this->conexion->prepare('INSERT INTO peliculas VALUES (null, ?, ?, ?, ?, ?, ?, ?)');
            $params = array(
                $pelicula->getTitulo(),
                $pelicula->getDirector(),
                $pelicula->getActor(),
                $accesoS3,
                $pelicula->getAnio(),
                $pelicula->getGenero(),
                $pelicula->getFormato(),
            );


            if ($consulta->execute($params) && $consulta->rowCount() > 0) {
                // Obtener el ID de la película recién insertada
                $pelicula->setId_pelicula($this->conexion->lastInsertId());

                // 2. Subir la foto a S3 solo después de la inserción en la BD
                $s3Fotos = new S3();
                if ($s3Fotos->cargarObjeto($pelicula->getS3Fotos()['tmp_name'], $accesoS3)) {
                    $resultado = true;  // Subida exitosa a S3
                } else {
                    // Si no se puede subir la foto a S3, eliminar la película
                    $consulta = $this->conexion->prepare('DELETE FROM peliculas WHERE id_pelicula = ?');
                    $params = array($pelicula->getId_pelicula());
                    $consulta->execute($params);  // Eliminar la película si falla la subida

                    $error = 'Error, la película fue insertada, pero no se pudo subir la foto a S3';
                }
            } else {
                $error = 'Error al insertar la película en la base de datos';
            }
        } catch (PDOException $e) {
            global $error;
            $error = 'ERROR BD: ' . $e->getMessage();
        } catch (\Throwable $th) {
            global $error;
            $error = 'ERROR GENERAL: ' . $th->getMessage();
        }
        return $resultado;
    }

    public function actualizarPelicula(Peliculas $pelicula)
    {
        $resultado = false;
        try {
            if (!empty($pelicula->getS3Fotos()['name'])) {
                $accesoS3 = $pelicula->getS3Fotos()['name'];
                $consulta = $this->conexion->prepare('UPDATE peliculas SET
                titulo = ?, director = ?, actor = ?, S3Fotos = ?, anio = ?, genero = ?, formato = ?
                WHERE id_pelicula = ?');
                $params = array(
                    $pelicula->getTitulo(),
                    $pelicula->getDirector(),
                    $pelicula->getActor(),
                    $accesoS3,
                    $pelicula->getAnio(),
                    $pelicula->getGenero(),
                    $pelicula->getFormato(),
                    $pelicula->getId_pelicula()
                );
            } else {
                $consulta = $this->conexion->prepare('UPDATE peliculas SET
                titulo = ?, director = ?, actor = ?, anio = ?, genero = ?, formato = ?
                WHERE id_pelicula = ?');
                $params = array(
                    $pelicula->getTitulo(),
                    $pelicula->getDirector(),
                    $pelicula->getActor(),
                    $pelicula->getAnio(),
                    $pelicula->getGenero(),
                    $pelicula->getFormato(),
                    $pelicula->getId_pelicula()
                );
            }
            if ($consulta->execute($params) && $consulta->rowCount() > 0) {

                if (!empty($accesoS3)) {
                    $s3Fotos = new S3();
                    if (!$s3Fotos->cargarObjeto($pelicula->getS3Fotos()['tmp_name'], $accesoS3)) {
                        $error = 'Película actualizada, pero no se pudo cargar la foto a S3';
                    }
                }
                $resultado = true;
            } else {
                $error = 'No se encontraron cambios para actualizar';
            }
        } catch (PDOException $e) {
            global $error;
            $error = 'ERROR BD: ' . $e->getMessage();
        } catch (\Throwable $th) {
            global $error;
            $error = 'ERROR GENERAL: ' . $th->getMessage();
        }
        return $resultado;
    }
    public function borrarPelicula(Peliculas $pelicula)
    {
        $resultado = false;
        try {
            $s3Fotos = new S3();
            $accesoS3 = $pelicula->getS3Fotos();  // Nombre del archivo en S3
            if ($accesoS3 && !$s3Fotos->borrarObjeto($accesoS3)) {
                throw new Exception('Error al eliminar la imagen en S3 es posible que las credenciales sean incorrectas o no sean validas');
            }
            $consulta = $this->conexion->prepare('DELETE FROM peliculas WHERE id_pelicula = ?');
            $params = array(
                $pelicula->getId_pelicula()
            );
            if ($consulta->execute($params) && $consulta->rowCount() > 0) {
                $mensaje = 'La pelicula ha sido borrada';
                $resultado = true;
            } else {
                $error = 'Error al borrar la pelicula';
            }
        } catch (PDOException $e) {
            global $error;
            $error = 'ERROR BD: ' . $e->getMessage();
        } catch (\Throwable $th) {
            global $error;
            $error = 'ERROR GENERAL: ' . $th->getMessage();
        }
        return $resultado;
    }
}
