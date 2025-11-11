<?php
require_once 'Tarea.php';

class Bd{
    private $conexion=null;

    public function __construct()
    {
        //Establecer la conexión con la BD
        try {
            //code...
            $crd=$this->obtenerCredenciales();
            $url='mysql:host='.$crd['HOST'].';port='.$crd['PUERTO'].';dbname='.$crd['NOMBREBD'];
            $this->conexion = new PDO($url,$crd['USUARIO'],$crd['PS']);
        } catch (\Throwable $th) {
           global $error;
           $error[]=$th->getMessage();
        }
    }

    /**
     * Get the value of conexion
     */ 
    public function getConexion()
    {
        return $this->conexion;
    }

    /**
     * Set the value of conexion
     *
     * @return  self
     */ 
    public function setConexion($conexion)
    {
        $this->conexion = $conexion;

        return $this;
    }

    private function obtenerCredenciales(){
        $resultado = array();
        if(file_exists('.env')){
            $datos = file('.env',FILE_IGNORE_NEW_LINES);
            foreach($datos as $d){
                $campos= explode('=',$d);
                $resultado[$campos[0]]=$campos[1];
            }
            if(!isset($resultado['HOST'])||!isset($resultado['PUERTO'])||
            !isset($resultado['NOMBREBD']) || !isset($resultado['USUARIO']) ||
            !isset($resultado['PS'])){
                throw new Exception('Datos de acceso incorrectos');
            }
        }
        else{
           throw new Exception('No existe fichero de creedenciales');
        }
        return $resultado;
    }
}
?>