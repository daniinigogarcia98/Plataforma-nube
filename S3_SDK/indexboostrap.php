<?php
require_once 'controlador.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S3Formulario</title>
    
    <!-- Enlace a Bootstrap CSS (última versión) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Enlace a Font Awesome para iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
</head>

<body class="container py-4">

    <h2 class="mb-4">Gestión de Buckets y Objetos S3</h2>
    
    <!-- Formulario Crear Bucket -->
    <form action="" method="post" class="mb-4">
        <fieldset class="border p-4">
            <legend class="w-auto">Crear Bucket</legend>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="nombreBucket">
            </div>
            <button type="submit" name="crearB" class="btn btn-primary"><i class="fas fa-cloud-upload-alt"></i> Crear Bucket</button>
        </fieldset>
    </form>

    <!-- Formulario Subir objetos a Bucket -->
    <form action="" method="post" enctype="multipart/form-data" class="mb-4">
        <fieldset class="border p-4">
            <legend class="w-auto">Subir objetos a Bucket</legend>
            <div class="mb-3">
                <label for="bucket" class="form-label">Selecciona Bucket</label>
                <select name="bucket" id="bucket" class="form-select">
                    <?php
                    // Insertar un option por cada bucket en $buckets
                    foreach ($buckets as $b) {
                        echo "<option>$b</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="objeto" class="form-label">Objeto</label>
                <input type="file" name="objeto" id="objeto" class="form-control" placeholder="Selecciona Fichero">
            </div>
            <button type="submit" name="subirO" class="btn btn-success"><i class="fas fa-upload"></i> Subir Objeto</button>
            <div class="mb-3 mt-4">
                <label for="texto" class="form-label">Texto</label>
                <textarea name="texto" id="texto" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" name="crearO" class="btn btn-info"><i class="fas fa-cloud-upload-alt"></i> Crear y Subir Objeto</button>
        </fieldset>
    </form>

    <!-- Formulario Gestionar Objetos -->
    <form action="" method="post" class="mb-4">
        <fieldset class="border p-4">
            <legend class="w-auto">Gestionar Objetos</legend>
            <div class="mb-3">
                <label for="bucket" class="form-label">Selecciona Bucket</label>
                <select name="bucket" id="bucket" class="form-select">
                    <?php
                    // Insertar un option por cada bucket en $buckets
                    foreach ($buckets as $b) {
                        echo "<option>$b</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="objeto" class="form-label">Selecciona Objeto</label>
                <select name="objeto" id="objeto" class="form-select">
                    <!-- Aquí se insertarán los objetos disponibles -->
                </select>
            </div>
            <button type="submit" name="descargarO" class="btn btn-warning"><i class="fas fa-download"></i> Descargar/Ver Objeto</button>
            <button type="submit" name="borrarO" class="btn btn-danger mt-2"><i class="fas fa-trash-alt"></i> Borrar Objeto</button>
        </fieldset>
    </form>

    <!-- Mensajes de error y éxito -->
    <div>
        <?php
        if (isset($error)) {
            echo '<h3 class="text-danger">' . $error . '</h3>';
        }
        ?>
    </div>
    <div>
        <?php
        if (isset($mensaje)) {
            echo '<h3 class="text-success">' . $mensaje . '</h3>';
        }
        ?>
    </div>

    <!-- Enlace a Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>
