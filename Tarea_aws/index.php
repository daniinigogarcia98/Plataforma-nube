<!doctype html>
<html lang="en">

<head>
    <title>Apache Server Daniel Iñigo</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="amazon.svg" type="image/x-icon" />
    <!-- Bootstrap CSS v5.3.2 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
    <!-- Agregar los iconos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body style="background: linear-gradient(135deg, #FF9900, #FF6600, #0066CC, #333333);">
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
                        <a class="nav-link disabled" style="color:black;" href="proyectos/aws">Cartelera de Peliculas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/infophp.php">PHPINFO</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <style>
        /* Efecto de hover para los cards */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Transición suave */
        }

        .card:hover {
            transform: translateY(-10px); /* Levanta el card ligeramente */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Sombra para dar el efecto de elevación */
        }
    </style>
    <main>
        <div class="container mt-5">
            <!-- Primer Card: Cartelera de Peliculas -->
            <div class="card" style="width: 18rem;">
            <img src="https://s3.us-east-1.amazonaws.com/dinnigog01.app.proyecto/CARTELERA-CARTEL-01.png" class="card-img-top" alt="Cartelera de Peliculas">
                <div class="card-body">
                    <h5 class="card-title">Cartelera de Peliculas</h5>
                    <p class="card-text">Explora las últimas películas disponibles en la nube con nuestro sistema de cartelera.</p>
                    <a href="proyectos/aws/index.php" class="btn btn-warning">Ir a Cartelera</a>
                </div>
            </div>

            <!-- Segundo Card: Información de AWS Academy -->
            <div class="card mt-4" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">¿Eres Estudiante?</h5>
                    <p class="card-text">Entra en AWS Academy y comienza a desarrollar tus proyectos en la nube.</p>
                    <p>Haz clic aquí para acceder: <i class="bi bi-arrow-down"></i></p>
                    <a href="https://www.awsacademy.com/vforcesite/LMS_Login">
                        <img src="https://www.awsacademy.com/vforcesite/resource/1576451101000/logo" alt="AWS Academy Logo" class="img-fluid" style="background-color: #333333;">
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
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
        <div class="container text-center mt-3">
            <?php
            echo "Servidor: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";
            echo "Dirección IP: " . $_SERVER['SERVER_ADDR'] . "<br>";
            echo "Puerto: " . $_SERVER['SERVER_PORT'] . "<br>";
            ?>
        </div>
    </footer>

    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>
