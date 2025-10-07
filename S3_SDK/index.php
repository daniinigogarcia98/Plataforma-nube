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
            <legend>subir objetos a bucket</legend>
            <label for="bucket">Selecciona Bucket</label><br>
            <select name="bucket" id="bucket"></select><br>
            <label for="objeto">Selecciona objeto</label><br>
            <input type="file" name="objeto" id="objeto" placeholder="Selecciona Fichero"><br>
            <button type="submit" name="subir()">Subir objeto</button><br>
            <label for="texto">Texto</label><br>
            <textarea name="texto" id="texto"></textarea><br>
            <button type="submit" name="crear()">Subir  Crear objeto</button><br>
        </fieldset>
    </form>
    
    <form action="" method="post">
        <fieldset>
            <legend>Gestionar Objetos</legend>
            <label for="bucket">Selecciona Bucket</label><br>
            <select name="bucket" id="bucket"></select><br>
            <label for="objeto">Selecciona objeto</label><br>
            <select name="objeto" id="objeto"></select><br>
            <button type="submit" name="descargar()">Descargar/Ver Objeto</button><br>
            <button type="submit" name="borrar()">Borrar Objeto</button><br>
        </fieldset>
    </form>
</body>
</html>
