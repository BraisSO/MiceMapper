<?php

//Función para insertar los datos en la base de datos
function insertData($data, $conn)
{
    $dates = $data[0];
    $time_ = $data[1];
    $animals_no = $data[2];
    $boxes = $data[3];
    $s_flow = (float) str_replace(',', '.', $data[4]);
    $ref_o2 = (float) str_replace(',', '.', $data[5]);
    $ref_co2 = (float) str_replace(',', '.', $data[6]);
    $flow = (float) str_replace(',', '.', $data[7]);
    $temp = (float) str_replace(',', '.', $data[8]);
    $o2 = (float) str_replace(',', '.', $data[9]);
    $co2 = (float) str_replace(',', '.', $data[10]);
    $d_o2 = (float) str_replace(',', '.', $data[11]);
    $d_co2 = (float) str_replace(',', '.', $data[12]);
    $vo2_1 = (int)$data[13];
    $vo2_2 = (int) $data[14];
    $vo2_3 = (int) $data[15];
    $vco2_1 = (int) $data[16];
    $vco2_2 = (int) $data[17];
    $vco2_3 = (int) str_replace(',', '.', $data[18]);
    $rer = (float) str_replace(',', '.', $data[19]);
    $h_1 = (float) str_replace(',', '.', $data[20]);
    $h_2 = (float) str_replace(',', '.', $data[21]);
    $h_3 = (float) str_replace(',', '.', $data[22]);
    $xt = (int)$data[23];
    $xa = (int)$data[24];
    $xf = (int)$data[25];
    $z = (int)$data[26];
    $cent = (int)$data[27];
    $cena = (int)$data[28];
    $cenf = (int)$data[29];
    $pert = (int)$data[30];
    $pera = (int)$data[31];
    $perf = (int)$data[32];
    $drink1 = (float) str_replace(',', '.', $data[33]);
    $drink2 = (float) str_replace(',', '.', $data[34]);
    $feed1 = (float) str_replace(',', '.', $data[35]);
    $feed2 = (float) str_replace(',', '.', $data[36]);

    $sql = "INSERT INTO MiceData (dates, time_, animals_no, boxes, s_flow, ref_o2, ref_co2, flow, temp, o2, co2, d_o2, d_co2, vo2_1, vo2_2, vo2_3, vco2_1, vco2_2, vco2_3, rer, h_1, h_2, h_3, xt, xa, xf, z, cent, cena, cenf, pert, pera, perf, drink1, drink2, feed1, feed2)
    VALUES ('$dates', '$time_', '$animals_no', '$boxes', '$s_flow', '$ref_o2', '$ref_co2', '$flow', '$temp', '$o2', '$co2', '$d_o2', '$d_co2', '$vo2_1', '$vo2_2', '$vo2_3', '$vco2_1', '$vco2_2', '$vco2_3', '$rer', '$h_1', '$h_2', '$h_3', '$xt', '$xa', '$xf', '$z', '$cent', '$cena','$cenf', '$pert', '$pera', '$perf', '$drink1', '$drink2', '$feed1', '$feed2')";

    try {
        $conn->query($sql);
    } catch (Exception $e) {
        exit("Error en la inserción de datos: " . $e->getMessage());
    }
}

//Recuperación de los datos de la BD
function recuperarDatosBD($conexion)
{
    $conn = $conexion;
    $data = array();

    $sql = "SELECT * FROM MiceData";
    $resultado = $conn->query($sql);
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $box = $fila['boxes'];
            $data[$box][] = array(
                'box' => $box,
                'dates' => $fila['dates'],
                'time_' => $fila['time_'],
                'animals_no' => $fila['animals_no'],
                's_flow' => $fila['s_flow'],
                'ref_o2' => $fila['ref_o2'],
                'ref_co2' => $fila['ref_co2'],
                'flow' => $fila['flow'],
                'temp' => $fila['temp'],
                'o2' => $fila['o2'],
                'co2' => $fila['co2'],
                'd_o2' => $fila['d_o2'],
                'd_co2' => $fila['d_co2'],
                'vo2_1' => $fila['vo2_1'],
                'vo2_2' => $fila['vo2_2'],
                'vo2_3' => $fila['vo2_3'],
                'vco2_1' => $fila['vco2_1'],
                'vco2_2' => $fila['vco2_2'],
                'vco2_3' => $fila['vco2_3'],
                'rer' => $fila['rer'],
                'h_1' => $fila['h_1'],
                'h_2' => $fila['h_2'],
                'h_3' => $fila['h_3'],
                'xt' => $fila['xt'],
                'xa' => $fila['xa'],
                'xf' => $fila['xf'],
                'z' => $fila['z'],
                'cent' => $fila['cent'],
                'cena' => $fila['cena'],
                'cenf' => $fila['cenf'],
                'pert' => $fila['pert'],
                'pera' => $fila['pera'],
                'perf' => $fila['perf'],
                'drink1' => $fila['drink1'],
                'drink2' => $fila['drink2'],
                'feed1' => $fila['feed1'],
                'feed2' => $fila['feed2'],
            );
        }
    }
    return $data;
}


//Creación de la tabla genérica. Debemos indicar el tipo de dato que vamos a renderizar.
function creacionTablaDatos($tipoDeDato, $data)
{
    // Creación de la cabecera HTML
    
    #Si queremos poner la tabla en horizontal (no queda bien)
    # echo "<div class='table-container'>";
    echo "<table>
    <caption>$tipoDeDato</caption>
    <thead>
        <tr>
            <th>Date</th>
            <th>Time</th>";

    foreach ($data as $claveExterior => $arrayInterior) {
        echo "<th>Box " . $claveExterior  . "<br>" . "(Animal no." . $arrayInterior[$claveExterior]['animals_no'] . ")" . "</th>";
    }

    echo "</tr>
    </thead>
    <tbody>";


    foreach ($data as $claveExterior => $arrayInterior) {
        // Obtenemos el número de filas necesarias para esta caja
        $num_filas = count($arrayInterior);
        
    }
        // Recorremos las filas y creamos las celdas para cada columna
        for ($i = 0; $i < $num_filas; $i++) {
            echo "<tr>";

            // Agregamos fecha y hora
            echo "<td>" . $arrayInterior[$i]['dates'] . "</td>
            <td>" . $arrayInterior[$i]['time_'] . "</td>";


            /*  SI QUEREMOS PINTAR AS CELDAS EN FUNCION DE SE SON HORAS DE DÍA OU DE NOITE
            
            if($arrayInterior[$i]['time_']  >= "18:00"){
                foreach ($data as  $arrayInterior2) {
                    echo "<td>";
    
                    if (isset($arrayInterior2[$i])) {
                        // Agregamos los datos que queremos mostrar
                        echo $arrayInterior2[$i][$tipoDeDato] . "<br>";
                    }
                    echo "</td>";
                }

            }
            else{
                foreach ($data as  $arrayInterior2) {
                    echo "<td style='background-color: #C8C8C8;'>";
    
                    if (isset($arrayInterior2[$i])) {
                        // Agregamos los datos que queremos mostrar
                        echo $arrayInterior2[$i][$tipoDeDato] . "<br>";
                    }
                    echo "</td>";
                }
                */

            foreach ($data as  $arrayInterior2) {
                echo "<td>";

                if (isset($arrayInterior2[$i])) {
                    // Agregamos los datos que queremos mostrar
                    echo $arrayInterior2[$i][$tipoDeDato] . "<br>";
                }
                echo "</td>";
            }
            echo "</tr>";
        }
    }
    echo "</tbody>
    </table>";

    #echo "</div";



    function creacionTablaDatosDiaYNoche($tipoDeDato, $data)
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
    $filas_dia = array();
    // Recorremos las filas y creamos las celdas para cada columna
    foreach ($data as $claveExterior => $arrayInterior) {
        // Obtenemos el número de filas necesarias para esta caja
        $num_filas = count($arrayInterior);
    }
        for ($i = 0; $i < $num_filas; $i++) {
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
            // Agregamos la fila al arreglo temporal correspondiente
            if ($arrayInterior[$i]['time_'] < "08:00" || $arrayInterior[$i]['time_'] >= "20:00") {
                $filas_dia[] = $fila;
            } else {
                echo $fila;
            }
        }
    

    // Imprimimos las filas que cumplen el criterio de horario
    foreach ($filas_dia as $fila) {
        echo $fila;
    }

    echo "</tbody>";
    echo "</table>";
}


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
    $filas_dia = array();

    // Recorremos las filas y creamos las celdas para cada columna
    foreach ($data as $claveExterior => $arrayInterior) {
        // Obtenemos el número de filas necesarias para esta caja
        $num_filas = count($arrayInterior);

    }
        // Variable para indicar si se ha encontrado la primera fila que cumple el criterio
        $start_found = false;
        $first_different_date= "";
        

        //FUNCION PARA ENCONTRAR LA PRIMERA FECHA Y LA PRIMERA DISTINTA (PREGUNTAR SI SIEMPRE LAS CAJAS EMPIEZAN EN 1)
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
            }
            else{
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



