<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S3Formulario</title>
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <!-- Form for creating bucket -->
        <form action="" method="post">
            <fieldset class="border p-3 mb-4">
                <legend class="w-auto px-2">Crear bucket</legend>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombrebucket">
                </div>
                <button type="submit" name="crearB" class="btn btn-primary">Crear bucket</button>
            </fieldset>
        </form>

        <!-- Form for uploading objects to a bucket -->
        <form action="" method="post">
            <fieldset class="border p-3 mb-4">
                <legend class="w-auto px-2">Subir objetos a bucket</legend>
                <div class="mb-3">
                    <label for="bucket" class="form-label">Selecciona Bucket</label>
                    <select name="bucket" id="bucket" class="form-select"></select>
                </div>
                <div class="mb-3">
                    <label for="objeto" class="form-label">Selecciona objeto</label>
                    <input type="file" class="form-control" name="objeto" id="objeto" placeholder="Selecciona Fichero">
                </div>
                <button type="submit" name="subir" class="btn btn-success">Subir objeto</button>
                <div class="mt-3">
                    <label for="texto" class="form-label">Texto</label>
                    <textarea name="texto" id="texto" class="form-control"></textarea>
                </div>
                <button type="submit" name="crear" class="btn btn-warning mt-3">Subir / Crear objeto</button>
            </fieldset>
        </form>

        <!-- Form for managing objects -->
        <form action="" method="post">
            <fieldset class="border p-3 mb-4">
                <legend class="w-auto px-2">Gestionar Objetos</legend>
                <div class="mb-3">
                    <label for="bucket" class="form-label">Selecciona Bucket</label>
                    <select name="bucket" id="bucket" class="form-select"></select>
                </div>
                <div class="mb-3">
                    <label for="objeto" class="form-label">Selecciona objeto</label>
                    <select name="objeto" id="objeto" class="form-select"></select>
                </div>
                <button type="submit" name="descargar" class="btn btn-info">Descargar/Ver Objeto</button>
                <button type="submit" name="borrar" class="btn btn-danger mt-3">Borrar Objeto</button>
            </fieldset>
        </form>
    </div>

    <!-- Bootstrap 5.3.3 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
