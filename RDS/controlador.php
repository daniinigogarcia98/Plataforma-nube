<?php 
require_once 'Bd.php';

//Conectar con la BD
$bd = new Bd();
if($bd->getConexion()==null){
    $error[] = 'No hay conexión con la BD';
}
else{
   if(isset($_POST['crear'])){
        //Chequear campos rellenos
        if(empty($_POST['titulo']) || empty($_POST['descripcion']) || 
        empty($_POST['prioridad']) || empty($_POST['estado'])){
            $error[] = 'Rellena todos los datos de la tarea';
        }
        else{
            //Creamos la tarea al pasar el parámetro al método
            //en lugar de usar un objeto declarado e instanciado antes.
            if($bd->crearTarea($t=new Tarea(null,
                                $_POST['titulo'],
                                $_POST['descripcion'],
                                null,
                                $_POST['prioridad'],
                                $_POST['estado']))){
                $mensaje[]='Tarea creada con id:'.$t->getId();
            }
            else{
                $error[] = 'Error al crear tarea';
            }
        }
   }
   elseif((isset($_POST['empezar']))){
    if($bd->cambiarEstado($_POST['empezar'],'en proceso')){
        $mensaje[]= 'Tarea en proceso';
    }
    else{
        $error[]='Error al comenzar la tarea';
    }
   }
    elseif((isset($_POST['terminar']))){
          if($bd->cambiarEstado($_POST['terminar'],'completada')){
        $mensaje[]= 'Tarea finalizada';
    }
    else{
        $error[]='Error al finalizar la tarea';
    }
   }
    elseif((isset($_POST['borrar']))){
          if($bd->borrar($_POST['borrar'])){
        $mensaje[]= 'Tarea borrar';
    }
    else{
        $error[]='Error al borrar la tarea';
    }
   }
}

?>