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
    
.nightCells{
    background-color: #C8C8C8
}

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

    form {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin: 20px;
}

div {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

label {
  font-weight: bold;
  margin-right: 10px;
}

input[type="date"] {
  border: 2px solid #ccc;
  border-radius: 5px;
  padding: 5px;
}

input[type="time"] {
  border: 2px solid #ccc;
  border-radius: 5px;
  padding: 5px;
}

.buttonFilter {
  background-color: #4CAF50;
  color: white;
  padding: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 1em;
}

.buttonFilter:hover {
  background-color: #3e8e41;
}
</style>

<body>
<form action="PruebaFunciones.php" method="get">
    <div>
        <label for="fechaInicio">Start:</label>
        <input type="date" id="fechaInicio" name="fechaInicio" required>
        <input type="time" name="horaInicio" value="13:30" required>
    </div>

    <div>
        <label for="fechaFinal">End:</label>
        <input type="date" id="fechaFinal" name="fechaFinal" required>
        <input type="time" name="horaFinal" value="13:30" required>
    </div>

    <div>
        <button type="submit" name="filtrarFechas">Filter</button>
    </div>
</form>


    <?php
    include "LibreriaFunciones.php";
    include "Conexion.php";
    
    ?>

    <?php
        
            $conn = new mysqli($servername, $username, $password, "miceDB");
    
            //Recuperamos los Datos
            $data = recuperarDatosBD($conn);

            //Los mostramos pasando por parametro el dato a renderizar y el array de datos
            filtroConMediaYAcumulada("vo2_1", $data);
            creacionTablaDatos("vo2_1", $data);
            creacionTablaDatosDiaYNoche("vo2_1", $data);
            creacionTablaDatos("s_flow", $data);

        

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