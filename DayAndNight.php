<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    th,
    tr,
    table,
    td {
        border: 1px solid black;
        text-align: center;
    }

    table {
        margin: auto;


        /*  Solo si disponemos las tablas en horizontal
    display: inline-block;
        margin-right: 20px;
        
    */
    }

    /* 
    .table-container {
        display: flex;
        overflow-x: auto;
        white-space: nowrap;
    }    

    */

    caption {
        font-weight: bolder;
        font-size: x-large;
    }

    nav {
        background-color: #333;
        overflow: hidden;
    }

    nav ul {
        margin: 0;
        padding: 0;
        list-style-type: none;
        overflow: hidden;
    }

    nav li {
        float: left;
    }

    nav li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    nav li a:hover {
        background-color: #4CAF50;
    }
</style>

<body>

    <?php
    include "LibreriaFunciones.php";
    include "Conexion.php";
    ?>

    <?php
        
            $conn = new mysqli($servername, $username, $password, "miceDB");
    
            //Recuperamos los Datos
            $data = recuperarDatosBD($conn);

            //Los mostramos pasando por parametro el dato a renderizar y el array de datos
            creacionTablaDatosDiaYNocheSaltandoHastaLasOcho("s_flow", $data);
            creacionTablaDatosDiaYNocheSaltandoHastaLasOcho("ref_o2", $data);
            creacionTablaDatosDiaYNocheSaltandoHastaLasOcho("ref_co2", $data);
            creacionTablaDatosDiaYNoche("flow", $data);
            creacionTablaDatosDiaYNoche("temp", $data);
            creacionTablaDatosDiaYNoche("o2", $data);
            creacionTablaDatosDiaYNoche("co2", $data);
            creacionTablaDatosDiaYNoche("d_o2", $data);
            creacionTablaDatosDiaYNoche("d_co2", $data);
            creacionTablaDatosDiaYNoche("vo2_1", $data);
            creacionTablaDatosDiaYNoche("vo2_2", $data);
            creacionTablaDatosDiaYNoche("vo2_3", $data);
            creacionTablaDatosDiaYNoche("vco2_1", $data);
            creacionTablaDatosDiaYNoche("vco2_2", $data);
            creacionTablaDatosDiaYNoche("vco2_3", $data);
            creacionTablaDatosDiaYNoche("rer", $data);
            creacionTablaDatosDiaYNoche("h_1", $data);
            creacionTablaDatosDiaYNoche("h_2", $data);
            creacionTablaDatosDiaYNoche("h_3", $data);
            creacionTablaDatosDiaYNoche("xt", $data);
            creacionTablaDatosDiaYNoche("xa", $data);
            creacionTablaDatosDiaYNoche("xf", $data);
            creacionTablaDatosDiaYNoche("z", $data);
            creacionTablaDatosDiaYNoche("cent", $data);
            creacionTablaDatosDiaYNoche("cena", $data);
            creacionTablaDatosDiaYNoche("cenf", $data);
            creacionTablaDatosDiaYNoche("pert", $data);
            creacionTablaDatosDiaYNoche("pera", $data);
            creacionTablaDatosDiaYNoche("perf", $data);
            creacionTablaDatosDiaYNoche("drink1", $data);
            creacionTablaDatosDiaYNoche("drink2", $data);
            creacionTablaDatosDiaYNoche("feed1", $data);
            creacionTablaDatosDiaYNoche("feed2", $data);

            // Cerramos la conexión a la BD y al fichero.
            $conn->close();
    
    ?>

    <form action="Index.html" method="post">
        <button>Volver</button>
    </form>

    <form action="DescargaExcel.php" method="post">
        <button>Descargar Excel</button>
    </form>

</body>

</html>