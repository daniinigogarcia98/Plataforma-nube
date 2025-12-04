<?php
require_once 'vendor/autoload.php';

use Aws\S3\S3Client;

$bucket = 'dinnigog01.app.proyecto';

class S3
{
    private $region;
    private $bucket;
    private $conexion;

    public function __construct()
    {
        try {
            $cfg = $this->obtenerCredencialesS3();

            $this->region = $cfg['AWS_REGION'];
            $this->bucket = $cfg['AWS_BUCKET'];

            $this->conexion = new S3Client([
                'version' => 'latest',
                'region'  => $cfg['AWS_REGION'],
                'credentials' => [
                    'key'    => $cfg['AWS_ACCESS_KEY_ID'],
                    'secret' => $cfg['AWS_SECRET_ACCESS_KEY'],
                    'token'  => $cfg['AWS_SESSION_TOKEN'],
                ],
            ]);
        } catch (\Throwable $th) {
            global $error;
            $error = "Error al conectar con S3: " . $th->getMessage();
        }
    }

    private function obtenerCredencialesS3()
    {
        $resultado = array();
        if (file_exists('.env')) {
            $datos = file('.env', FILE_IGNORE_NEW_LINES);
            foreach ($datos as $d) {
                $campos = explode('=', $d, 2);
                $resultado[$campos[0]] = $campos[1];
            }
        }
        return $resultado;
    }
    public function cargarObjeto($rutaObjeto, $nombreObjeto)
    {
        $resultado = false;
        try {
            if ($this->conexion === null) {
                throw new Exception("La conexión con S3 no está activa.");
            }

            $this->conexion->putObject([
                'Bucket'     => $this->bucket,
                'Key'        => $nombreObjeto,
                'SourceFile' => $rutaObjeto,
                'ContentType' => mime_content_type($rutaObjeto)
            ]);
            $resultado = true;
        } catch (\Throwable $th) {
            global $error;
            $error = $th->getMessage();
        }
        return $resultado;
    }

    public function descargarObjeto($objeto)
    {
        $resultado = null;
        global $bucket;

        try {
            // Verificar si la conexión está activa
            if ($this->conexion === null) {
                throw new Exception("La conexión con S3 no está activa.");
            }

            // Descargar el archivo de S3
            $r = $this->conexion->getObject([
                'Bucket' => $bucket,
                'Key' => $objeto
            ]);
            if (isset($r['Body'])) {
                $resultado['tipo'] = $r['ContentType'];
                $resultado['contenido'] = $r['Body'];
            }
        } catch (\Throwable $th) {
            global $error;
            $error = $th->getMessage();
        }
        return $resultado;
    }

    public function borrarObjeto($objeto)
    {
        $resultado = false;
        global $bucket;

        try {
            // Verificar si la conexión está activa
            if ($this->conexion === null) {
                throw new Exception("La conexión con S3 no está activa.");
            }

            // Borrar el archivo de S3
            $r = $this->conexion->deleteObject([
                'Bucket' => $bucket,
                'Key' => $objeto
            ]);
            $resultado = true;
        } catch (\Throwable $th) {
            global $error;
            $error = $th->getMessage();
        }

        return $resultado;
    }
}
