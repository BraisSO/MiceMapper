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


    <nav>
        <ul>
            <li><a href="Index.html">Inicio</a></li>
            <li><a href="DescargaExcel.php">Descargar Excel</a></li>
            <li><a href="About.php">About</a></li>
        </ul>
    </nav>

    <?php
    // Eliminación de la base de datos si ya existe
    $sql = "DROP DATABASE IF EXISTS miceDB";

    if ($conn->query($sql) === TRUE) {
        echo "La base se datos se ha eliminado correctamente</br>";
    } else {
        echo "Error eliminando la base de datos: " . $conn->error . "</br>";
    }

    // Creación de la base de datos
    $sql = "CREATE DATABASE miceDB";

    if ($conn->query($sql) === TRUE) {
        echo "La base de datos se ha creado correctamente</br>";
    } else {
        echo "Error creando la base de datos: " . $conn->error . "</br>";
    }

    // Conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, "miceDB");

    // Revición de la conexión
    if ($conn->connect_error) {
        die("Fallo de conexión: " . $conn->connect_error);
    }

    // Eliminación de la tabla si existe
    $sql = "DROP TABLE IF EXISTS MiceData";

    if ($conn->query($sql) === TRUE) {
        echo "La tabla se ha eliminado correctamente</br>";
    } else {
        echo "Error eliminando la tabla: " . $conn->error . "</br>";
    }

    // Creación de la nueva tabla
    $sql = "CREATE TABLE MiceData (
dates VARCHAR(15),
time_ TIME,
animals_no INT,
boxes INT,
s_flow FLOAT,
ref_o2 FLOAT,
ref_co2 FLOAT,
flow FLOAT,
temp FLOAT,
o2 FLOAT,
co2 FLOAT,
d_o2 FLOAT,
d_co2 FLOAT,
vo2_1 INT,
vo2_2 INT,
vo2_3 INT,
vco2_1 INT,
vco2_2 INT,
vco2_3 INT,
rer FLOAT,
h_1 FLOAT,
h_2 FLOAT,
h_3 FLOAT,
xt INT,
xa INT,
xf INT,
z INT,
cent INT,
cena INT,
cenf INT,
pert INT,
pera INT,
perf INT,
drink1 FLOAT,
drink2 FLOAT,
feed1 FLOAT,
feed2 FLOAT
)";

    if ($conn->query($sql) === TRUE) {
        echo "La tabla MiceData se ha creado correctamente</br>";
    } else {
        echo "Error creando la tabla: " . $conn->error;
    }

    if (isset($_FILES['csvData'])) {
        $file_name = $_FILES['csvData']['name'];
        $file_tmp = $_FILES['csvData']['tmp_name'];
        $file_type = $_FILES['csvData']['type'];
        if (!empty($file_name && $file_type == 'text/csv' || $file_type == 'application/vnd.ms-excel')) {

            // Nombre de la nueva carpeta
            $nombre_carpeta = "csvData";

            // Ruta completa de la nueva carpeta
            $ruta_carpeta = dirname(__FILE__) . '/' . $nombre_carpeta;

            // Crear la carpeta si no existe
            if (!file_exists($ruta_carpeta)) {
                mkdir($ruta_carpeta, 0777, true);
            }

            //Purgar carpeta de las subidas anteriores para no sobrecargar de datos innecesarios
            $carpeta = $nombre_carpeta;

            // Obtener una lista de archivos en la carpeta
            $archivos = glob($carpeta . "/*");

            // Eliminar cada archivo de la lista
            foreach ($archivos as $archivo) {
                if (is_file($archivo)) {
                    unlink($archivo);
                }
            }

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

            echo "Los datos se han isertado correctamente<br>";

            echo "<p style='text-align:center'><img src='https://media.tenor.com/aZaBI_yXoXUAAAAM/dorime-rat-dancing.gif'></p>";

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
            fclose($file);
        } else {
            echo "Error: no se especificó un archivo CSV válido.";
        }
    } else {
        echo "Error: no se recibió ningún archivo CSV.";
    }

    ?>

    <form action="Index.html" method="post">
        <button>Volver</button>
    </form>

    <form action="DescargaExcel.php" method="post">
        <button>Descargar Excel</button>
    </form>

</body>

</html>