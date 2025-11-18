<?php 
require_once 'controlador.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tareas</title>
    <!-- Agregar el enlace a Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
         <h1>Gestión de Tareas</h1>
    <fieldset class="mt-4">
        <legend>Crear Nueva Tarea</legend>
         <form action="" method="post">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título">
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción">
            </div>
            <div class="mb-3">
                <label for="prioridad" class="form-label">Prioridad</label>
                <select class="form-select" id="prioridad" name="prioridad">
                    <option>Baja</option>
                    <option>Media</option>
                    <option>Alta</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" id="estado" name="estado">
                    <option>Pendiente</option>
                    <option>En Proceso</option>
                    <option>Completada</option>
                </select>
            </div>
            <button type="submit" name="crear" class="btn btn-primary">+</button>
        </form>
    </fieldset>
    
    <fieldset class="mt-4">
        <legend>Lista de Tareas</legend>
        <form action="" method="post">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Fecha Creación</th>
                        <th>Prioridad</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $tareas = $bd->obtenerTareas();
                        foreach($tareas as $t){
                            echo '<tr>';
                            echo '<td>'.$t->getId().'</td>';
                            echo '<td>'.$t->getTitulo().'</td>';
                            echo '<td>'.$t->getDescripcion().'</td>';
                            echo '<td>'.$t->getFechaC().'</td>';
                            echo '<td>'.$t->getPrioridad().'</td>';
                            echo '<td>'.$t->getEstado().'</td>';
                            echo '<td>
                                <button type="submit" value="'.$t->getId().'" name="empezar" class="btn btn-warning btn-sm" '.($t->getEstado()!='pendiente' || $t->getEstado()=='completada'?'style="display:none"':'').'>Empezar</button>
                                <button type="submit" value="'.$t->getId().'" name="terminar" class="btn btn-success btn-sm" '.($t->getEstado()!='en proceso' || $t->getEstado()=='completada'?'style="display:none"':'').'>Terminar</button>
                                <button type="submit" value="'.$t->getId().'" name="borrar" class="btn btn-danger btn-sm">Borrar</button>
                            </td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </form>
    </fieldset>

    <!-- Mostrar mensajes de error o éxito -->
    <?php 
    if(isset($error)){
        echo '<div class="alert alert-danger">';
        foreach($error  as $e){
            echo '<p>'.$e.'</p>';
        }
        echo '</div>';
    }
     if(isset($mensaje)){
        echo '<div class="alert alert-success">';
        foreach($mensaje  as $m){
            echo '<p>'.$m.'</p>';
        }
        echo '</div>';
    }
    ?>

    <!-- Agregar el script de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
