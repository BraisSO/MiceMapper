<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../imagenes/miceIcon.ico">
    <title>MiceMapper</title>
    <!--Estilos Y Scripts-->
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/script.js"></script>

</head>

<!--Esta página sirve para filtrar la descarga del excel, dejándote escoger que parametros deseas descargar-->

<body>

    <?php
    include "LibreriaFunciones.php";
    include "Conexion.php";
    ?>


    <nav>
        <ul>
            <li><a href="../index.html">Homepage</a></li>
            <li><a href="main.php">Data</a></li>
            <li><a href="../Portfolio/index.html">About</a></li>
        </ul>
    </nav>
    
    <form class="filterForm" action="descargaExcel.php" method="POST">
        <div class="divData" style="margin-top: 1em;">
            <label for="fechaInicio">Start:</label>
            <input type="date" id="fechaInicio" name="fechaInicio" required>
            <input type="time" name="horaInicio" value="13:30" required>
        </div>

        <div class="divData">
            <label for="fechaFinal">End:</label>
            <input type="date" id="fechaFinal" name="fechaFinal" required>
            <input type="time" name="horaFinal" value="13:30" required>
        </div>

        <div class="container">
        <label>
            <input type="checkbox" name="s_flow"> s_flow
        </label>
        <label>
            <input type="checkbox" name="ref_o2"> ref_o2
        </label>
        <label>
            <input type="checkbox" name="ref_co2"> ref_co2
        </label>
        <label>
            <input type="checkbox" name="flow"> flow
        </label>
        <label>
            <input type="checkbox" name="temp"> temp
        </label>
        <label>
            <input type="checkbox" name="o2"> o2
        </label>
        <label>
            <input type="checkbox" name="co2"> co2
        </label>
        <label>
            <input type="checkbox" name="d_o2"> d_o2
        </label>
        <label>
            <input type="checkbox" name="d_co2"> d_co2
        </label>
        <label>
            <input type="checkbox" name="vo2_1"> vo2_1
        </label>
        <label>
            <input type="checkbox" name="vo2_2"> vo2_2
        </label>
        <label>
            <input type="checkbox" name="vo2_3"> vo2_3
        </label>
        <label>
            <input type="checkbox" name="vco2_1"> vco2_1
        </label>
        <label>
            <input type="checkbox" name="vco2_2"> vco2_2
        </label>
        <label>
            <input type="checkbox" name="vco2_3"> vco2_3
        </label>
        <label>
            <input type="checkbox" name="rer"> rer
        </label>
        <label>
            <input type="checkbox" name="h_1"> h_1
        </label>
        <label>
            <input type="checkbox" name="h_2"> h_2
        </label>
        <label>
            <input type="checkbox" name="h_3"> h_3
        </label>
        <label>
            <input type="checkbox" name="xt"> xt
        </label>
        <label>
            <input type="checkbox" name="xa"> xa
        </label>
        <label>
            <input type="checkbox" name="xf"> xf
        </label>
        <label>
            <input type="checkbox" name="z"> z
        </label>
        <label>
            <input type="checkbox" name="cent"> cent
        </label>
        <label>
            <input type="checkbox" name="cena"> cena
        </label>
        <label>
            <input type="checkbox" name="cenf"> cenf
        </label>
        <label>
            <input type="checkbox" name="pert"> pert
        </label>
        <label>
            <input type="checkbox" name="pera"> pera
        </label>

        <label>
            <input type="checkbox" name="perf"> perf
        </label>

        <label>
            <input type="checkbox" name="drink1"> drink1
        </label>

        <label>
            <input type="checkbox" name="drink2"> drink2
        </label>

        <label>
            <input type="checkbox" name="feed1"> feed1
        </label>
        <label>
            <input type="checkbox" name="feed2"> feed2
        </label>
        </div>
            <button type="submit" class="buttonFilter" name="filtrarFechasConMediaYAcumulada">Download</button>
            
    </form>
