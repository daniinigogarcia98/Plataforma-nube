<?php
class Bd {
    private $conexion = null;

    public function __construct() {
        try {
            $env = $this->obtenerDatos();
            if ($env != null) {
                // Establecer conexión con la base de datos
                $this->conexion = new PDO(
                    'mysql:host=' . $env['HOST'] .
                    ';port=' . $env['PORT'] . ';dbname=' . $env['DATABASE'],
                    $env['USERNAME'],
                    $env['PS']
                );
                echo "Se estableció conexión con la base de datos.";
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    private function obtenerDatos() {
        $resultado = array();
        if (file_exists('.env')) {
            $datosF = file('.env', FILE_IGNORE_NEW_LINES);
            foreach ($datosF as $linea) {
                $campos = explode('=', $linea);
                
                // Verificar que la línea contiene exactamente dos elementos (clave y valor)
                if (count($campos) == 2) {
                    $resultado[$campos[0]] = $campos[1];
                } else {
                    echo "Línea inválida en .env: $linea\n"; // Para depuración
                }
            }
        } else {
            return null;
        }
        return $resultado;
    }

    /**
     * Obtener la conexión a la base de datos
     */ 
    public function getConexion() {
        return $this->conexion;
    }

    /**
     * Establecer la conexión a la base de datos
     *
     * @return  self
     */ 
    public function setConexion($conexion) {
        $this->conexion = $conexion;
        return $this;
    }
}
?>
