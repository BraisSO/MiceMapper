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

</head>

<body>

    <?php
    include "LibreriaFunciones.php";
    include "Conexion.php";
    ?>

    <!-- Menu de navegación -->
    <nav>
        <ul>
            <li><a href="../index.html">Homepage</a></li>
            <form action="descargaExcel.php" method="POST">
                <li class="download-button"><button name="descargar">Download all data</button></li>
            </form>
            <li><a href="descargaPersonalizada.php">Personaliced download</a></li>
            <li><a href="../Portfolio/index.html">About</a></li>
        </ul>
    </nav>

    <div class="mainButtons">
        <form action="main.php" method="POST">
            <button type="submit" class="botonesMuestra" name="mostrarTodo">View All</button>
        </form>

        <form action="main.php" method="POST">
            <button type="submit" class="botonesMuestra" name="diasYNoches">Day & Night</button>
        </form>
    </div>

    <form class="filterForm" action="main.php" method="POST">
        <div class="accordion">
            <button type="button" class="accordion-toggle">Filter</button>
            <div class="accordion-content">
                <div class="divData">
                    <label for="fechaInicio">Start:</label>
                    <input type="date" id="fechaInicio" name="fechaInicio" required>
                    <input type="time" name="horaInicio" value="13:30" required>
                </div>

                <div class="divData">
                    <label for="fechaFinal">End:</label>
                    <input type="date" id="fechaFinal" name="fechaFinal" required>
                    <input type="time" name="horaFinal" value="13:30" required>
                </div>

                <!--Checkbox para los filtros-->
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
                <button type="submit" class="buttonFilter" name="filtrarFechasConMediaYAcumulada">Submit</button>
            </div>
        </div>

    </form>


    <?php
    if (isset($_POST['envioCSV'])) {
        //GESTION INICIAL DE LA BASE DE DATOS
        // Eliminación de la base de datos si ya existe
        $sql = "DROP DATABASE IF EXISTS miceDB";
        $conn->query($sql);

        //Creación de la base de datos
        $sql = "CREATE DATABASE miceDB";
        $conn->query($sql);

        // Conexión a la base de datos que acabamos de crear
        $conn = new mysqli($servername, $username, $password, "miceDB");

        // Eliminación de la tabla si existe
        $sql = "DROP TABLE IF EXISTS MiceData";
        $conn->query($sql);

        // Creación de la nueva tabla
        creacionTabla($conn);


        //GESTION DEL CSV
        if (isset($_FILES['csvData'])) {
            $file_name = $_FILES['csvData']['name'];
            $file_tmp = $_FILES['csvData']['tmp_name'];
            $file_type = $_FILES['csvData']['type'];
            if (!empty($file_name && $file_type == 'text/csv' || $file_type == 'application/vnd.ms-excel')) {

                // Nombre de la nueva carpeta
                $nombre_carpeta = "csvData";

                // Ruta completa de la nueva carpeta
                $ruta_carpeta = dirname(__FILE__) . '/' . $nombre_carpeta;

                // Creación de la carpeta si no existe
                if (!file_exists($ruta_carpeta)) {
                    mkdir($ruta_carpeta, 0777, true);
                }

                //Purga de las subidas anteriores para no sobrecargar de datos innecesarios
                $carpeta = $nombre_carpeta;

                $archivos = glob($carpeta . "/*");

                foreach ($archivos as $archivo) {
                    if (is_file($archivo)) {
                        unlink($archivo);
                    }
                }

                //Colocación del archivo subido en la ruta
                $ubicacion_archivo = $ruta_carpeta . '/' . $file_name;
                move_uploaded_file($file_tmp, $ubicacion_archivo);


                // Lector de CSV
                $file = fopen($ubicacion_archivo, "r");

                // Se saltan los datos que no interesan, hasta encontrar el patrón.
                while (($data = fgetcsv($file, 10000, ";")) !== FALSE) {
                    if (preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $data[0])) {
                        insertData($data, $conn);
                        break;
                    }
                }

                // Leemos los datos y los volcamos en la tabla.
                while (($data = fgetcsv($file, 10000, ";")) !== FALSE) {
                    insertData($data, $conn);
                }

                // Cerramos la conexión a la BD y al fichero.
                fclose($file);

                /*echo "<p style='text-align:center'><img src='https://media.tenor.com/aZaBI_yXoXUAAAAM/dorime-rat-dancing.gif'></p>";*/  // -> .GIF que se colocó tras el primer volcado existoso de datos

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

                $conn->close();
            }
        }
    }


    if (isset($_POST['mostrarTodo'])) {
        //Recuperamos los Datos
        $conn = new mysqli($servername, $username, $password, "miceDB");
        $data = recuperarDatosBD($conn);

        //Mostramos todos los datos
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

        $conn->close();
    }

    if (isset($_POST['diasYNoches'])) {
        //Recuperamos los datos 
        $conn = new mysqli($servername, $username, $password, "miceDB");
        $data = recuperarDatosBD($conn);

        //Mostramos todos los datos ordenados por días y por noches
        creacionTablaDatosDiaYNoche("s_flow", $data);
        creacionTablaDatosDiaYNoche("ref_o2", $data);
        creacionTablaDatosDiaYNoche("ref_co2", $data);
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

        $conn->close();
    }

    if (isset($_POST['filtrarFechasConMediaYAcumulada'])) {
        //Recuperamos los datos
        $conn = new mysqli($servername, $username, $password, "miceDB");
        $data = recuperarDatosBD($conn);

        //Mostramos únicamente aquellos datos que el usuario haya seleccionado, así como la media y la acumulada de dichos datos.
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

    <script src="../js/script.js"></script>
</body>

</html>