<?php
    require_once 'vendor/autoload.php';

    use Aws\S3\S3Client;

    class S3{
        private $region = 'us-east-1';
        private $conexion;

        public function __construct(){
           try {
             //Conectar con S3
            $this->conexion = new S3Client([
                'version' => 'latest',
                'region' => $this->region
            ]);
             echo '<h3 style="color:green;">Conexión establecida</h3>';
           } catch (\Throwable $th) {
                global $error;
                $error=$th->getMessage();
           }
        }

        public function crearBucket($nombre){
            $resultado = false;
            try {
                $this->conexion->createBucket([
                    'Bucket' => $nombre
                ]);
                $resultado = true;
            } catch (\Throwable $th) {
               global  $error;
               $error=$th->getMessage();
            }

            return $resultado;
        }
    }
?>