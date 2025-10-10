<?php
require_once 'controlador.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S3Formulario</title>
</head>
<body>
    <form action="" method="post">
        <fieldset>
            <legend>Crear bucket</legend>
            <label>Nombre</label>
            <input type="text" name="nombre" placeholder="Nombrebucket"><br>
            <button type="submit" name="crearB">Crear bucket</button><br>
        </fieldset>
    </form>
    
       <form action="" method="post">
        <fieldset>
            <legend>Crear Bucket</legend>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="nombreBucket">
            <button type="submit" name="crearB">Crear Bucket</button>
        </fieldset>
    </form>
    <form action="" method="post">
        <fieldset>
            <legend>Subir objetos a Bucket</legend>
            <label for="bucket">Selecciona Bucket</label><br>
            <select name="bucket" id="bucket">

            </select><br>
            <label for="objeto">Objeto</label><br>
            <input type="file" name="objeto" id="objeto" placeholder="Selecciona Fichero">
            <button type="submit" name="subirO">Subir Objeto</button><br>
            <label for="texto">Texto</label><br>
            <textarea name="texto" id="texto"></textarea>
            <button type="submit" name="crearO">Crear y subir Objeto</button>
        </fieldset>
    </form>
    <form action="" method="post">
        <fieldset>
            <legend>Gestionar Objetos</legend>
            <label for="bucket">Selecciona Bucket</label><br>
            <select name="bucket" id="bucket">

            </select><br>
            <label for="objeto">Selecciona Objeto</label><br>
            <select name="objeto" id="objeto">

            </select><br>
            <button type="submit" name="descargarO">Descargar/Ver Objeto</button><br>
            <button type="submit" name="borrarO">Borrar Objeto</button>
        </fieldset>
    </form>

</body>
</html>
