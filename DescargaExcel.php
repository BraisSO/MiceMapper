<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include "LibreriaFunciones.php";
    include "Conexion.php";
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="datos.xls"');

    $conn = new mysqli($servername, $username, $password, "miceDB");
    
            //Recuperamos los Datos
            $data = recuperarDatosBD($conn);

            //Los mostramos pasando por parametro el dato a renderizar y el array de datos
            creacionTablaDatos("s_flow", $data);
            creacionTablaDatos("ref_o2", $data);
            creacionTablaDatos("ref_co2", $data);
            creacionTablaDatos("flow", $data);
            creacionTablaDatos("temp", $data);
            creacionTablaDatos("o2", $data);
            creacionTablaDatos("co2", $data);
            creacionTablaDatos("d_o2", $data);
            creacionTablaDatos("d_co2", $data);
            creacionTablaDatos("vo2_1", $data);
            creacionTablaDatos("vo2_2", $data);
            creacionTablaDatos("vo2_3", $data);
            creacionTablaDatos("vco2_1", $data);
            creacionTablaDatos("vco2_2", $data);
            creacionTablaDatos("vco2_3", $data);
            creacionTablaDatos("rer", $data);
            creacionTablaDatos("h_1", $data);
            creacionTablaDatos("h_2", $data);
            creacionTablaDatos("h_3", $data);
            creacionTablaDatos("xt", $data);
            creacionTablaDatos("xa", $data);
            creacionTablaDatos("xf", $data);
            creacionTablaDatos("z", $data);
            creacionTablaDatos("cent", $data);
            creacionTablaDatos("cena", $data);
            creacionTablaDatos("cenf", $data);
            creacionTablaDatos("pert", $data);
            creacionTablaDatos("pera", $data);
            creacionTablaDatos("perf", $data);
            creacionTablaDatos("drink1", $data);
            creacionTablaDatos("drink2", $data);
            creacionTablaDatos("feed1", $data);
            creacionTablaDatos("feed2", $data);

            // Cerramos la conexión a la BD y al fichero.
            $conn->close();

    ?>