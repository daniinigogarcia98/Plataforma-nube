<?php 
require_once 'Bd.php';

//Conectar con la BD
$bd = new Bd();
if($bd->getConexion()==null){
    $error[] = 'No hay conexión con la BD';
}
else{
    $mensaje[]='Conexión establecida';
}

?>