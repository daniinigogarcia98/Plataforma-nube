<?php
require_once 'S3.php';
//Crear Conexión con S3
$awsS3 = new S3();

//Recuperar los buckets para mostrar en los selects

if ($awsS3 != null) {
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
    //Recuperar los buckets para mostrar en los selects
    $buckets = $awsS3->obtenerBuckets();
    if (isset($_POST['subirO'])) {
        //Comprobar que se ha seleccionado un fichero en el formulario
        if (!empty($_FILES['objeto']['name']) && !empty($_POST['bucket'])) {
            //subir el objeto al bucket
            if($awsS3->cargarObjeto($_POST['bucket'],$_FILES['objeto']['tmp_name'],$_FILES['objeto']['name'])){
                $mensaje='<h3 style="color:green;">Objeto Cargado</h3>';
            }else {
                $error = '<h3 style="color:red;">Error al cargar objeto</h3>'; 
            }
        } else {
            $error = '<h3 style="color:red;">Error:Debes rellenar el bucket y el objeto</h3>';
        }
    }
} else {
    $error = '<h3 style="color:red;">No se puede Conectar con S3</h3>';
}
