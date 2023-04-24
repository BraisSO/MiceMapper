<?php
/*Funcion que sirve para obviar los datos hasta las 8 del segundo día*/
/*
function creacionTablaDatosDiaYNocheSaltandoHastaLasOcho($tipoDeDato, $data)
{

    // Creación de la cabecera HTML
    echo "<table>";
    echo "<caption>$tipoDeDato</caption>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Date</th>";
    echo "<th>Time</th>";
    foreach ($data as $claveExterior => $arrayInterior) {
        echo "<th>Box " . $claveExterior  . "<br>" . "(Animal no." . $arrayInterior[$claveExterior]['animals_no'] . ")" . "</th>";
    }
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Inicializamos un arreglo temporal para almacenar las filas que cumplen el criterio
    $filas_noche = array();

    // Recorremos las filas y creamos las celdas para cada columna
    foreach ($data as $claveExterior => $arrayInterior) {
        // Obtenemos el número de filas necesarias para esta caja
        $num_filas = count($arrayInterior);
    }
    // Variable para indicar si se ha encontrado la primera fila que cumple el criterio
    $start_found = false;
    $first_different_date = "";


    //FUNCION PARA ENCONTRAR LA PRIMERA FECHA Y LA PRIMERA DISTINTA 
    $first_date = $data[1][0]['dates']; // obtener la primera fecha de la lista
    for ($i = 1; $i < count($data); $i++) { // use count($data) instead of count($data[0]['dates'])
        for ($j = 1; $j < count($data); $j++) {
            if ($data[$i][$j]['dates'] != $first_date) {
                $first_different_date = $data[$i][$j]['dates']; // si la fecha es diferente, asignarla a una variable y salir del bucle
                break;
            }
        }
    }

    for ($i = 0; $i < $num_filas; $i++) {
        // Comprobamos si la fila cumple el criterio de horario
        if ($arrayInterior[$i]['dates'] <= $first_date || ($arrayInterior[$i]['dates'] == $first_different_date && $arrayInterior[$i]['time_'] <= "08:00")) {
        } else {
            // Si la primera fila que cumple el criterio no ha sido encontrada, la encontramos y cambiamos el valor de la variable
            if (!$start_found) {
                $start_found = true;
            }

            // Agregamos fecha y hora
            $fila = "<tr>";
            $fila .= "<td>" . $arrayInterior[$i]['dates'] . "</td>";
            $fila .= "<td>" . $arrayInterior[$i]['time_'] . "</td>";

            // Agregamos los datos de cada caja
            foreach ($data as $arrayInterior2) {
                if ($arrayInterior[$i]['time_'] < "08:00" || $arrayInterior[$i]['time_'] >= "20:00") {
                    $fila .= "<td style='background-color: #C8C8C8;'>";
                } else {
                    $fila .= "<td>";
                }
                if (isset($arrayInterior2[$i])) {
                    $fila .= $arrayInterior2[$i][$tipoDeDato] . "<br>";
                }
                $fila .= "</td>";
            }
            $fila .= "</tr>";

            // Si la primera fila que cumple el criterio ha sido encontrada, agregamos la fila al arreglo temporal correspondiente
            if ($start_found && $arrayInterior[$i]['time_'] < "08:00" || $arrayInterior[$i]['time_'] >= "20:00") {
                $filas_noche[] = $fila;
            } else {
                echo $fila;
            }
        }
    }

    // Imprimimos las filas que cumplen el criterio de horario
    foreach ($filas_noche as $fila) {
        echo $fila;
    }

    echo "</tbody>";
    echo "</table>";
}






#PRIMER FILTRO QUE SE HIZO

function tablaHorasFiltradas($tipoDeDato, $data)
{

    if (isset($_GET['filtrarFechas'])) {
        $fechaInicio = $_GET['fechaInicio'];
        $fechaInicio = new DateTime($fechaInicio);
        $fechaInicio = $fechaInicio->format('d/m/Y');

        $fechaFinal = $_GET['fechaFinal'];
        $fechaFinal = new DateTime($fechaFinal);
        $fechaFinal = $fechaFinal->format('d/m/Y');


        $horaInicio = $_GET['horaInicio'];
        $horaFinal = $_GET['horaFinal'];


        // Creación de la cabecera HTML
        echo "<table>";
        echo "<caption>$tipoDeDato</caption>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Date</th>";
        echo "<th>Time</th>";
        foreach ($data as $claveExterior => $arrayInterior) {
            echo "<th>Box " . $claveExterior  . "<br>" . "(Animal no." . $arrayInterior[$claveExterior]['animals_no'] . ")" . "</th>";
        }
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        // Recorremos las filas y creamos las celdas para cada columna
        foreach ($data as $claveExterior => $arrayInterior) {
            // Obtenemos el número de filas necesarias para esta caja
            $num_filas = count($arrayInterior);
        }

        echo ("Mostrando los resultados de " . "<b>$fechaInicio</b>" . " - " . "<b>$horaInicio</b>" . " a " . $fechaFinal . " - " . $horaFinal);

        for ($i = 0; $i < $num_filas; $i++) {
            // Comprobamos si la fila cumple el criterio de horario
            if (
                $arrayInterior[$i]['dates'] >= $fechaInicio && $arrayInterior[$i]['dates'] <= $fechaFinal && (
                    ($arrayInterior[$i]['dates'] == $fechaInicio && $arrayInterior[$i]['time_'] >= $horaInicio) ||
                    ($arrayInterior[$i]['dates'] == $fechaFinal && $arrayInterior[$i]['time_'] <= $horaFinal) ||
                    ($arrayInterior[$i]['dates'] != $fechaInicio && $arrayInterior[$i]['dates'] != $fechaFinal)
                )
            ) {

                // Agregamos fecha y hora
                echo "<td>" . $arrayInterior[$i]['dates'] . "</td>
                    <td>" . $arrayInterior[$i]['time_'] . "</td>";

                if ($arrayInterior[$i]['time_']  >= "18:00") {
                    foreach ($data as  $arrayInterior2) {
                        echo "<td>";

                        if (isset($arrayInterior2[$i])) {
                            // Agregamos los datos que queremos mostrar
                            echo $arrayInterior2[$i][$tipoDeDato] . "<br>";
                        }
                        echo "</td>";
                    }
                } else {
                    foreach ($data as  $arrayInterior2) {
                        echo "<<td class='nightCells'>";

                        if (isset($arrayInterior2[$i])) {
                            // Agregamos los datos que queremos mostrar
                            echo $arrayInterior2[$i][$tipoDeDato] . "<br>";
                        }
                        echo "</td>";
                    }
                }
                echo "</tr>";
            }
        }
        echo "</tr>";
        echo "</tbody>
</table>";
    }
}








#FILTRADOS DIAS Y NOCHES
function filtradosDiasYNoches($tipoDeDato, $data)
{

    if (isset($_POST['filtrarFechas'])) {
        $fechaInicio = $_POST['fechaInicio'];
        $fechaInicio = new DateTime($fechaInicio);
        $fechaInicio = $fechaInicio->format('d/m/Y');

        $fechaFinal = $_POST['fechaFinal'];
        $fechaFinal = new DateTime($fechaFinal);
        $fechaFinal = $fechaFinal->format('d/m/Y');


        $horaInicio = $_POST['horaInicio'];
        $horaFinal = $_POST['horaFinal'];

        // Creación de la cabecera HTML
        echo "<table>";
        echo "<caption>$tipoDeDato</caption>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Date</th>";
        echo "<th>Time</th>";
        foreach ($data as $claveExterior => $arrayInterior) {
            echo "<th>Box " . $claveExterior  . "<br>" . "(Animal no." . $arrayInterior[$claveExterior]['animals_no'] . ")" . "</th>";
        }
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        // Inicializamos un arreglo temporal para almacenar las filas que cumplen el criterio
        $filas_dia = array();
        // Recorremos las filas y creamos las celdas para cada columna
        foreach ($data as $claveExterior => $arrayInterior) {
            // Obtenemos el número de filas necesarias para esta caja
            $num_filas = count($arrayInterior);
        }
        for ($i = 0; $i < $num_filas; $i++) {
            // Comprobamos si la fila cumple el criterio de horario
            if (
                $arrayInterior[$i]['dates'] >= $fechaInicio && $arrayInterior[$i]['dates'] <= $fechaFinal && (
                    ($arrayInterior[$i]['dates'] == $fechaInicio && $arrayInterior[$i]['time_'] >= $horaInicio) ||
                    ($arrayInterior[$i]['dates'] == $fechaFinal && $arrayInterior[$i]['time_'] <= $horaFinal) ||
                    ($arrayInterior[$i]['dates'] != $fechaInicio && $arrayInterior[$i]['dates'] != $fechaFinal)
                )
            ) {
                // Agregamos fecha y hora
                $fila = "<tr>";
                $fila .= "<td>" . $arrayInterior[$i]['dates'] . "</td>";
                $fila .= "<td>" . $arrayInterior[$i]['time_'] . "</td>";
                // Agregamos los datos de cada caja
                foreach ($data as $arrayInterior2) {
                    if ($arrayInterior[$i]['time_'] < "08:00" || $arrayInterior[$i]['time_'] >= "20:00") {
                        $fila .= "<td class='nightCells'>";
                    } else {
                        $fila .= "<td>";
                    }
                    if (isset($arrayInterior2[$i])) {
                        $fila .= $arrayInterior2[$i][$tipoDeDato] . "<br>";
                    }
                    $fila .= "</td>";
                }
                $fila .= "</tr>";
                // Agregamos la fila al arreglo temporal correspondiente
                if ($arrayInterior[$i]['time_'] < "08:00" || $arrayInterior[$i]['time_'] >= "20:00") {
                    $filas_dia[] = $fila;
                } else {
                    echo $fila;
                }
            }
        }

        // Imprimimos las filas que cumplen el criterio de horario
        foreach ($filas_dia as $fila) {
            echo $fila;
        }

        echo "</tbody>";
        echo "</table>";
    }
}









*/
?>