<?php
require_once 'Bd.php';
$ad = new Bd();
if ($ad->getConexion() != null) {
    echo 'Se estableció conexión con la base de datos.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tareas</title>
</head>
<body>
    <h1>Gestion de Tareas</h1>
    <fieldset>
        <legend>Gestion de Tareas</legend>
         <form action="" method="post">
        <label>Título <input type="text" name="titulo" placeholder="Título"></label><br><br>
        <label>Descripción <input type="text" name="descripcion" placeholder="Descripción"></label><br><br>
        <label>Prioridad <select name="prioridad">
            <option>Baja</option>
            <option>Media</option>
            <option>Alta</option>
        </select></label><br><br>
         <label>Estado <select name="estado">
            <option>Pendiente</option>
            <option>En Proceso</option>
            <option>Completada</option>
        </select></label><br><br>
    </form>
    </fieldset>
   
</body>
</html>