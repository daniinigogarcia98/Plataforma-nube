<?php

use function PHPSTORM_META\elementType;

require_once 'S3.php';

function rellenarSeleccionado($bucket){
    if (isset($_POST['bucket']) && $_POST['bucket']==$bucket) {
        return 'selected';
    }
}
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
       
    } elseif (isset($_POST['crearO'])) {
          //Comprobar que se ha escrito algo en el textarea
          if (!empty($_POST['texto']) &&!empty($_POST['bucket'])) {
            if($awsS3->crearObjeto($_POST['bucket'],$_POST['texto'])){
                $mensaje='<h3 style="color:green;">Objeto Creado</h3>';
            }else{
                 $error = '<h3 style="color:red;">Error al cargar objeto'.$error.'</h3>';
            }
          } else {
            $error = '<h3 style="color:red;">Error:Debes rellenar el texto</h3>';
          }
         
    }
     elseif (isset($_POST['descargarO'])){
        if(isset($_POST['bucket']) && isset($_POST['objeto'])){
            $datos=$awsS3->descargarObjetos($_POST['bucket'],$_POST['objeto']);
            if($datos==null){
                $error='No se ha encontado el objeto';
            }
            
        }else{
                $error='Rellena bucket y objeto';
            }

     } elseif (isset($_POST['borrarO'])){
        if(isset($_POST['bucket']) && isset($_POST['objeto'])){
            if($awsS3->borrarObjetos($_POST['bucket'],$_POST['objeto'])){
                 $mensaje='Objeto borrado';
            }else{
             $error='Error al borrar Objeto';
           
        }
        }else{
            $error='Rellena bucket y objeto';
        }
       
     } 
     
} else {
    $error = '<h3 style="color:red;">No se puede Conectar con S3</h3>';
}
