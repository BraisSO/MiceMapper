<?php

function creacionTabla($conn)
{
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

    $conn->query($sql);
}

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

                //print("<pre>".print_r($data,true)."</pre>");   ->Pretty print de los datos del array
                

            );
        }
    }
    return $data;
}



//Creación de la tabla genérica. Debemos indicar el tipo de dato que vamos a renderizar.
function creacionTablaDatos($tipoDeDato, $data)
{
    // Creación de la cabecera HTML
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


        if ($arrayInterior[$i]['time_'] < "08:00" || $arrayInterior[$i]['time_'] >= "20:00") {
            foreach ($data as  $arrayInterior2) {
                echo "<td class='nightCells'>";
                if (isset($arrayInterior2[$i])) {
                    // Agregamos los datos que queremos mostrar
                    echo $arrayInterior2[$i][$tipoDeDato] . "<br>";
                }
                echo "</td>";
            }
        } else {
            foreach ($data as  $arrayInterior2) {
                echo "<td>";

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
echo "</tbody>
    </table>";


//En esta función se busca mostrar todos los datos ordenándolos por días y noches.
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

    // Inicializamos un array temporal para almacenar las filas que cumplen el criterio
    $filas_noche = array();
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
        // Agregamos la fila al array temporal correspondiente
        if ($arrayInterior[$i]['time_'] < "08:00" || $arrayInterior[$i]['time_'] >= "20:00") {
            $filas_noche[] = $fila;
        } else {
            echo $fila;
        }
    }

    // Imprimimos las filas que cumplen el criterio de horario
    foreach ($filas_noche as $fila) {
        echo $fila;
    }

    echo "</tbody>";
    echo "</table>";
}


//Con esta función se busca mostrar solo los datos seleccionados (tipo-fechas), 
//ordenados por día y noche y de esos datos mostrar además 
//el calculo de la media y la acumulada.
function filtroConMediaYAcumulada($tipoDeDato, $data)
{
    if (isset($_POST['filtrarFechasConMediaYAcumulada'])) {
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFinal = $_POST['fechaFinal'];
        $horaInicio = $_POST['horaInicio'];
        $horaFinal = $_POST['horaFinal'];
    
        // Inicializamos las variables que contendrán los rangos de fechas que deseamos mostrar
        $fechaHoraInicio = DateTime::createFromFormat('Y-m-d H:i', $fechaInicio . ' ' . $horaInicio);
        $fechaHoraFinal = DateTime::createFromFormat('Y-m-d H:i', $fechaFinal . ' ' . $horaFinal);
    
        // Les asignamos formato a las fechas para poder manejarlas
        $fechaInicioFormateada = $fechaHoraInicio->format('d/m/Y H:i:s');
        $fechaFinalFormateada = $fechaHoraFinal->format('d/m/Y H:i:s');

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



        // Inicializamos los arrays para almacenar los valores de las columnas
        $valores_dia = array();
        $valores_noche = array();
        $filas_noche = array();

        foreach ($data as $claveExterior => $arrayInterior) {
            // Obtenemos el número de filas necesarias para esta caja
            $num_filas = count($arrayInterior);
        }

        // Recorremos las filas y creamos las celdas para cada columna
        for ($i = 0; $i < $num_filas; $i++) {
            // Le damos el mismo formato a las fechas y horas de nuestros datos con el objetivo de compararlas con el rango que seleccionamos
            $fecha = DateTime::createFromFormat('d/m/Y',  $arrayInterior[$i]['dates']);
            $hora = DateTime::createFromFormat('H:i:s', $arrayInterior[$i]['time_']);

            // Combinamos fecha y hora para hacer la comparativa
            $fechaHora = clone $fecha;
            $fechaHora->setTime($hora->format('H'), $hora->format('i'), $hora->format('s'));
            $fechaHoraFormateada = $fechaHora->format('d/m/Y H:i:s');

            // Hacemos la comparativa entre el rango de fechas y la de nuestros datos, para que se filtre solo lo que esté en el rango
            if (strcmp($fechaHoraFormateada, $fechaInicioFormateada) >= 0 && strcmp($fechaHoraFormateada, $fechaFinalFormateada) < 0) {
                // Agregamos fecha y hora
                $fila = "<tr>";
                $fila .= "<td>" . $arrayInterior[$i]['dates'] . "</td>";
                $fila .= "<td>" . $arrayInterior[$i]['time_'] . "</td>";

                // Agregamos los datos de cada caja y actualizamos los arrays de valores
                foreach ($data as $claveExterior2 => $arrayInterior2) {
                    if ($arrayInterior[$i]['time_'] < "08:00" || $arrayInterior[$i]['time_'] >= "20:00") {
                        $valor = isset($arrayInterior2[$i][$tipoDeDato]) ? $arrayInterior2[$i][$tipoDeDato] : 0;
                        if (!isset($valores_noche[$claveExterior2])) {
                            $valores_noche[$claveExterior2] = array();
                        }
                        $valores_noche[$claveExterior2][] = $valor;
                        $fila .= "<td class='nightCells'>" . $valor . "</td>";
                    } else {
                        $valor = isset($arrayInterior2[$i][$tipoDeDato]) ? $arrayInterior2[$i][$tipoDeDato] : 0;
                        if (!isset($valores_dia[$claveExterior2])) {
                            $valores_dia[$claveExterior2] = array();
                        }
                        $valores_dia[$claveExterior2][] = $valor;
                        $fila .= "<td>" . $valor . "</td>";
                    }
                }

                if ($arrayInterior[$i]['time_'] < "08:00" || $arrayInterior[$i]['time_'] >= "20:00") {
                    $filas_noche[] = $fila;
                } else {
                    echo $fila;
                }
            }
        }
        // Imprimimos las filas correspondientes a la noche al final
        foreach ($filas_noche as $fila) {
            echo $fila;
        }

        // Como tenemos ya unos arrays con los datos separados por día y noche
        //realizamos el calculo de dichas medias
        if(!empty($valores_dia) && !empty($valores_noche)){
        echo "</tbody>";
        echo "<tr>";
        echo "<th rowspan=2 class='media'>Media</th>";
        echo "<th class='dia'>Día</th>";
        foreach ($data as $claveExterior => $arrayInterior) {
            $total_dia = is_array($valores_dia) ? array_sum($valores_dia[$claveExterior]) : 0;
            $media_dia = $total_dia / count($valores_dia[$claveExterior]);

            echo "<th class='mediaDia'>" . number_format($media_dia, 2) . "</th>";
        }

        echo "<tr>";
        echo "<th class='noche'>Noche</th>";
        foreach ($data as $claveExterior => $arrayInterior) {
            $total_noche = is_array($valores_noche) ? array_sum($valores_noche[$claveExterior]) : 0;
            $media_noche =  $total_noche / count($valores_noche[$claveExterior]);

            echo "<th class='mediaNoche'>" . number_format($media_noche, 2) . "</th>";
        }

        //Hacemos el mismo proceso con la acumulada
        echo "<tr>";
        echo "<th rowspan=2 class='acumulada'>Acumulada</th>";
        echo "<th class='dia'>Día</th>";
        $acumulado_dia = 0;
        foreach ($valores_dia as $value) {
            foreach ($value as $valor) {
                $acumulado_dia = ($valor * 0.5) + $acumulado_dia;
            }
            echo "<th class='mediaDia'>" . number_format($acumulado_dia, 2) . "</th>";
            acumulado_dia = 0;
        }

        echo "<tr>";
        echo "<th class='noche'>Noche</th>";
        $acumulado_noche = 0;
        foreach ($valores_noche as $value) {
            foreach ($value as $valor) {
                $acumulado_noche = ($valor * 0.5) + $acumulado_noche;
            }
            echo "<th class='mediaNoche'>" . number_format($acumulado_noche, 2) . "</th>";
            $acumulado_noche = 0;
        }
    }
}

    echo "</tr>";
    echo "</table>";
}

