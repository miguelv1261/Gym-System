<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>94 Fitness Center</title>
    <link rel="icon" type="image/png" href="../img/94logo.png">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="../css/fullcalendar.css" />
    <link rel="stylesheet" href="../css/matrix-style.css" />
    <link rel="stylesheet" href="../css/matrix-media.css" />
    <link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../font-awesome/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/jquery.gritter.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <style>
        body {
            justify-content: center;
            align-items: center;
        }

        .caja {
            background-color: #fff;
            padding: 100px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            text-align: center;
        }

        .caja h2 {
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input[type="number"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .boton {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .boton:hover {
            background-color: #218838;
        }

        #totalCobrado {
            margin-top: 20px;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 4px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>

<body>
    <div id="header">
        <h1><a href="dashboard.html">94 Fitness Center</a></h1>
    </div>
    <?php include 'includes/topheader.php' ?>
    <?php $page = 'cobro';
    include 'includes/sidebar.php' ?>

    <div id="content">
        <div id="content-header">
            <div class="caja">
                <h2>Registrar Cobro</h2>
                <form id="cobroForm" action="cobrar.php" method="POST">
                    <label for="monto">Monto (USD):</label>
                    <input type="number" id="monto" name="monto" step="0.01" required>
                    <button type="submit" class="boton">Registrar Cobro</button>
                </form>

                <h2>Total Cobrado Hoy</h2>
                <div id="totalCobrado">
                    <!-- El total cobrado se mostrará aquí -->
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/scripts.php'; ?>
    <script>
        // Función para actualizar el total cobrado
        function actualizarTotalCobrado() {
            fetch('total_cobrado.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('totalCobrado').innerHTML = data;
                });
        }

        // Actualizar el total cobrado al cargar la página
        window.onload = actualizarTotalCobrado;
    </script>
</body>

</html>