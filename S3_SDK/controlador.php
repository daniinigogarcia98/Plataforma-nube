<?php
require_once 'S3.php';

if(sizeof($_POST)>0){
    $awsS3 = new S3();
}

if(isset($_POST['crearB'])){
    if(empty($_POST['nombre'])){
        $error = 'El nombre del bucket no puede estar vacío';
    }
    else{
         if($awsS3->crearBucket($_POST['nombre'])){
            $mensaje = 'Bucket Creado';
         }
         else{
            $error = 'Error al crear el bucket:'.$error;  
         }
    }
   
}

?>