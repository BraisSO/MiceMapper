<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiceMapper</title>
    <style>
        .nightCells {
            background-color: #C8C8C8
        }
    </style>
</head>

<body>
    <?php
    include "LibreriaFunciones.php";
    include "Conexion.php";

    if (isset($_POST['descargar'])) {

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
    }


    if (isset($_POST['filtrarFechasConMediaYAcumulada'])) {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="datos.xls"');

        $conn = new mysqli($servername, $username, $password, "miceDB");

        $data = recuperarDatosBD($conn);

        if (isset($_POST['s_flow'])) {
            filtroConMediaYAcumulada("s_flow", $data);
        }
        if (isset($_POST['ref_o2'])) {
            filtroConMediaYAcumulada("ref_o2", $data);
        }

        if (isset($_POST['ref_co2'])) {
            filtroConMediaYAcumulada("ref_co2", $data);
        }
        if (isset($_POST['flow'])) {
            filtroConMediaYAcumulada("flow", $data);
        }

        if (isset($_POST['temp'])) {
            filtroConMediaYAcumulada("temp", $data);
        }
        if (isset($_POST['o2'])) {
            filtroConMediaYAcumulada("o2", $data);
        }
        if (isset($_POST['co2'])) {
            filtroConMediaYAcumulada("co2", $data);
        }
        if (isset($_POST['d_o2'])) {
            filtroConMediaYAcumulada("d_o2", $data);
        }
        if (isset($_POST['d_co2'])) {
            filtroConMediaYAcumulada("d_co2", $data);
        }

        if (isset($_POST['vo2_1'])) {
            filtroConMediaYAcumulada("vo2_1", $data);
        }

        if (isset($_POST['vo2_2'])) {
            filtroConMediaYAcumulada("vo2_2", $data);
        }

        if (isset($_POST['vo2_3'])) {
            filtroConMediaYAcumulada("vo2_3", $data);
        }

        if (isset($_POST['vco2_1'])) {
            filtroConMediaYAcumulada("vco2_1", $data);
        }

        if (isset($_POST['vco2_2'])) {
            filtroConMediaYAcumulada("vco2_2", $data);
        }

        if (isset($_POST['vco2_3'])) {
            filtroConMediaYAcumulada("vco2_3", $data);
        }

        if (isset($_POST['rer'])) {
            filtroConMediaYAcumulada("rer", $data);
        }

        if (isset($_POST['h_1'])) {
            filtroConMediaYAcumulada("h_1", $data);
        }

        if (isset($_POST['h_2'])) {
            filtroConMediaYAcumulada("h_2", $data);
        }

        if (isset($_POST['h_3'])) {
            filtroConMediaYAcumulada("h_3", $data);
        }

        if (isset($_POST['xt'])) {
            filtroConMediaYAcumulada("xt", $data);
        }
        if (isset($_POST['xa'])) {
            filtroConMediaYAcumulada("xa", $data);
        }
        if (isset($_POST['xf'])) {
            filtroConMediaYAcumulada("xf", $data);
        }
        if (isset($_POST['z'])) {
            filtroConMediaYAcumulada("z", $data);
        }
        if (isset($_POST['cent'])) {
            filtroConMediaYAcumulada("cent", $data);
        }
        if (isset($_POST['cena'])) {
            filtroConMediaYAcumulada("cena", $data);
        }
        if (isset($_POST['cenf'])) {
            filtroConMediaYAcumulada("cenf", $data);
        }
        if (isset($_POST['pert'])) {
            filtroConMediaYAcumulada("pert", $data);
        }
        if (isset($_POST['pera'])) {
            filtroConMediaYAcumulada("pera", $data);
        }
        if (isset($_POST['perf'])) {
            filtroConMediaYAcumulada("perf", $data);
        }

        if (isset($_POST['drink1'])) {
            filtroConMediaYAcumulada("drink1", $data);
        }

        if (isset($_POST['drink2'])) {
            filtroConMediaYAcumulada("drink2", $data);
        }
        if (isset($_POST['feed1'])) {
            filtroConMediaYAcumulada("feed1", $data);
        }
        if (isset($_POST['feed2'])) {
            filtroConMediaYAcumulada("feed2", $data);
        }

        $conn->close();
    }
    ?>