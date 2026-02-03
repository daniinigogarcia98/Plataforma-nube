<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información PHP y del Servidor</title>
    <link rel="shortcut icon" href="amazon.svg" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .container {
            max-width: 800px;
        }
        .info-box {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .footer {
            background-color: #343a40;
            color: #ffffff;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="container">
        <a class="btn btn-primary mb-4" href="/index.php" role="button">Inicio</a>

        <div class="info-box">
            <h1 class="display-4">Información del Servidor</h1>
            
            <?php
            $os = PHP_OS_FAMILY;
            $os2 = php_uname('a');
            ?>

            <h3><strong>Sistema Operativo:</strong> <?php echo $os; ?></h3>
            <h3><strong>Detalles del Sistema:</strong> <?php echo $os2; ?></h3>

            <?php
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                echo '<p>Este servidor está usando Windows.</p>';
            } else {
                echo '<p>Este servidor NO usa Windows. Sistema: ' . PHP_OS_FAMILY . '</p>';
            }
            ?>
        </div>

        <div class="info-box mt-4">
            <h2 class="display-5">Detalles de PHP</h2>
            <?php
            // Mostrar la información completa de PHP
            phpinfo();
            ?>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2025 Información PHP - Todos los derechos reservados</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybF0mL57gH8y00I4KpQ6z+6twLXV79+TfYo/7t3RMTVJ6kXcD" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-cu5R0t5i9HJcq9/zLlHtOmD4mHg7PlIMoTqgJei4YXw3xIFqFpfbsFcD+4G9JZsl" crossorigin="anonymous"></script>

</body>

</html>
