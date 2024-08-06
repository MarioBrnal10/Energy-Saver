<?php
session_start();
$nombreUsuario = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Energy Saver/css/estilos.css">
    <link rel="icon" href="../Energy Saver/img/logotipo.ico" type="image/x-icon">
    <title>Historial de Cálculos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .transparent-container {
            background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco con 80% de opacidad */
            padding: 20px;
            border-radius: 10px;
        }
        .button-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        .button-container button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body style="margin: 0; font-family: Arial, sans-serif; background-color: #00A698;">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.html">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="calcu.html">Calculadora</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="productos.html">Asociaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacto.html">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="title-container transparent-container">
        <h1>Historial de Cálculos de Consumo Energético</h1>
        <p>Bienvenido<?php echo $nombreUsuario; ?>. Aquí puedes ver todos los cálculos de consumo energético que has realizado.</p>
    </div>
    <br>
    <div class="table-section transparent-container">
        <div class="container">
            <h2>Lista de Cálculos Realizados</h2>
            <table id="historyTable">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Electrodoméstico</th>
                        <th>Horas Activas</th>
                        <th>Consumo (Wh/día)</th>
                        <th>Consumo (kWh/mes)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include 'obtener_historial.php'; ?>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="button-container">
        <button onclick="window.location.href='calcu.html'">Hacer Otro Cálculo</button>
    </div>
    <br>
</body>
</html>
