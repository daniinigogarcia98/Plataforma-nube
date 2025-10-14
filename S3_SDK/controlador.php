<?php
require_once 'S3.php';


$awsS3 = new S3();

//Recuperar los buckets para mostrar en los selects

if ($awsS3 !=null) {
   $buckets = $awsS3->obtenerBuckets();


if (isset($_POST['crearB'])) {
    if (empty($_POST['nombre'])) {
        $error = 'El nombre del bucket no puede estar vacío';
    } else {
        if ($awsS3->crearBucket($_POST['nombre'])) {
            $mensaje = 'Bucket Creado';
        } else {
            $error = 'Error al crear el bucket:' . $error;
        }
    }
}
}else {
    $error='<h3 style="color:red;">No se puede Conectar con S3</h3>';
}