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
            <legend>Crear Bucket</legend>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="nombreBucket">
            <button type="submit" name="crearB">Crear Bucket</button>
        </fieldset>
    </form>
    <form action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Subir objetos a Bucket</legend>
            <label for="bucket">Selecciona Bucket</label><br>
            <select name="bucket" id="bucket">
                <?php
                //insertar un option por cada buckets $buckets
                foreach ($buckets as $b) {
                    echo "<option>$b</option>";
                }
                ?>
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
            <select name="bucket" id="bucket" onclick="submit()">
                <?php
                //insertar un option por cada buckets $buckets
                foreach ($buckets as $b) {
                    echo "<option>$b</option>";
                }
                ?>
            </select><br>
            <label for="objeto">Selecciona Objeto</label><br>
            <?php
            $objetos = []; 

            if (isset($_POST['bucket']) || isset($buckets[0])) {
                $bucket = isset($_POST['bucket']) ? $_POST['bucket'] : $buckets[0];
                $result = $awsS3->obtenerObjetos($bucket);
                if (is_array($result)) {
                    $objetos = $result;
                }
            }
            ?>
            <select name="objeto" id="objeto">
                <?php
                foreach ($objetos as $o) {
                    echo '<option>' .$o. '</option>';
                }
                ?>
            </select><br>

            <button type="submit" name="descargarO">Descargar/Ver Objeto</button><br>
            <button type="submit" name="borrarO">Borrar Objeto</button>
        </fieldset>
    </form>
    <div>
        <?php
        if (isset($error)) {
            echo '<h3 style="color:red;">' . $error . '</h3>';
        }
        ?>
    </div>
    <div>
        <?php
        if (isset($mensaje)) {
            echo '<h3 style="color:green;">' . $mensaje . '</h3>';
        }
        ?>
    </div>
</body>

</html>