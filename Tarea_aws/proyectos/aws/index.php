<?php
require_once 'controlador.php';
?>
<!doctype html>
<html lang="en">

<head>
    <title>Cartelera de Peliculas</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="/amazon.svg" type="image/x-icon" />
    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- Agregar los iconos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body style="background-color:lightblue;">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="/index.php"> <i class="bi bi-amazon"></i> Plataformas en la Nube(AWS)</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/index.php" aria-current="page">Inicio <span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/proyectos/aws">Cartelera de Peliculas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/infophp.php">PHPINFO</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container my-5">
            <div class="row">
                <!-- Columna para el formulario -->
                <div class="col-lg-4 col-md-6 col-12">
                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- Selección de película para modificar -->
                        <div class="form-group">
                            <label for="pelicula_id">Seleccionar Película</label>
                            <select id="pelicula_id" name="pelicula_id" class="form-control" onchange="this.form.submit()">
                                <option value="">Seleccione una película</option>
                                <?php
                                // Obtener todas las películas
                                $peliculas = $bd->obtenerPeliculas();
                                foreach ($peliculas as $p) {
                                    echo '<option value="' . $p->getId_pelicula() . '" ';
                                    if (isset($_POST['pelicula_id']) && $_POST['pelicula_id'] == $p->getId_pelicula()) {
                                        echo 'selected';  // Si la película está seleccionada, marcarla como "selected"
                                    }
                                    echo '>' . $p->getTitulo() . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <?php
                        // Si se selecciona una película, obtener sus datos y mostrarlos
                        if (isset($_POST['pelicula_id']) && !empty($_POST['pelicula_id'])) {
                            $pelicula_id = $_POST['pelicula_id'];
                            // Obtener la película de la base de datos
                            $peliculas = $bd->obtenerPeliculas();
                            $peliculaSeleccionada = null;
                            foreach ($peliculas as $p) {
                                if ($p->getId_pelicula() == $pelicula_id) {
                                    $peliculaSeleccionada = $p;
                                    break;
                                }
                            }
                            if ($peliculaSeleccionada) {
                        ?>
                                <div class="form-group">
                                    <label for="titulo">Titulo</label>
                                    <input type="text" id="titulo" name="titulo" class="form-control" value="<?php echo $peliculaSeleccionada->getTitulo(); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="director">Director</label>
                                    <input type="text" id="director" name="director" class="form-control" value="<?php echo $peliculaSeleccionada->getDirector(); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="actor">Actor</label>
                                    <input type="text" id="actor" name="actor" class="form-control" value="<?php echo $peliculaSeleccionada->getActor(); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="portada">Portada</label>
                                    <input type="file" id="portada" name="portada" class="form-control" accept="image/*">
                                    <?php
                                    if ($peliculaSeleccionada->getS3Fotos()) {
                                        echo '<img src="https://s3.us-east-1.amazonaws.com/' . $bucket . '/' . $peliculaSeleccionada->getS3Fotos() . '" width="100" class="mt-2"/>';
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="anio">Año</label>
                                    <input type="date" id="anio" name="anio" class="form-control" value="<?php echo $peliculaSeleccionada->getAnio(); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="genero">Genero</label>
                                    <input type="text" id="genero" name="genero" class="form-control" value="<?php echo $peliculaSeleccionada->getGenero(); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="formato">Formato</label>
                                    <input type="text" id="formato" name="formato" class="form-control" value="<?php echo $peliculaSeleccionada->getFormato(); ?>" required>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="form-group">
                                <label for="titulo">Titulo</label>
                                <input type="text" id="titulo" name="titulo" class="form-control" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="director">Director</label>
                                <input type="text" id="director" name="director" class="form-control" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="actor">Actor</label>
                                <input type="text" id="actor" name="actor" class="form-control" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="portada">Portada</label>
                                <input type="file" id="portada" name="portada" class="form-control" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="anio">Año</label>
                                <input type="date" id="anio" name="anio" class="form-control" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="genero">Genero</label>
                                <input type="text" id="genero" name="genero" class="form-control" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="formato">Formato</label>
                                <input type="text" id="formato" name="formato" class="form-control" value="" required>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="form-group my-2">
                            <button type="submit" class="btn btn-success m-2 btn-sm" name="InsertarP">Insertar Película</button>
                            <button type="submit" class="btn btn-info m-2 btn-sm" name="ActualizarP">Actualizar Película</button>
                            <button type="submit" class="btn btn-danger m-2 btn-sm" name="BorrarP">Borrar Película</button>
                        </div>
                    </form>
                </div>


                <div class="col-lg-8 col-md-12 col-12">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark text-center">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Director/es</th>
                                <th scope="col">Actor</th>
                                <th scope="col">Portada</th>
                                <th scope="col">Año</th>
                                <th scope="col">Genero</th>
                                <th scope="col">Formato</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $peliculas = $bd->obtenerPeliculas();
                            foreach ($peliculas as $p) {
                                echo '<tr>';
                                echo '<td class="text-center">' . $p->getId_pelicula() . '</td>';
                                echo '<td>' . $p->getTitulo() . '</td>';
                                echo '<td>' . $p->getDirector() . '</td>';
                                echo '<td>' . $p->getActor() . '</td>';
                                echo '<td class="text-center"><img width="100px" src="https://s3.us-east-1.amazonaws.com/' . $bucket . '/' . $p->getS3Fotos() . '"/></td>';
                                echo '<td>' . $p->getAnio() . '</td>';
                                echo '<td>' . $p->getGenero() . '</td>';
                                echo '<td>' . $p->getFormato() . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="container">
            <?php
            if (isset($error)) {
                echo '<h3 style="color:red;">' . $error . '</h3>';
            }
            ?>
        </div>
        <div class="container">
            <?php
            if (isset($mensaje)) {
                echo '<h3 style="color:green;">' . $mensaje . '</h3>';
            }
            ?>
        </div>
    </main>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p>Desarrollado por <a href="https://github.com/daniinigogarcia98" target="_blank" class="text-white">Daniel Iñigo García</a></p>
            <div>
                <a href="https://github.com/daniinigogarcia98" target="_blank" class="text-white me-3">
                    <i class="bi bi-github"></i> GitHub
                </a>
                <a href="https://www.linkedin.com" target="_blank" class="text-white me-3">
                    <i class="bi bi-linkedin"></i> LinkedIn
                </a>
                <a href="https://X.com" target="_blank" class="text-white">
                    <i class="bi bi-twitter-x"></i> X
                </a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>