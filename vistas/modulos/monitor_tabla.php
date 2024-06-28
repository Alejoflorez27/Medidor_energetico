

<?php
$item = null;
$valor = null;

//La siguiente variable solicita ya se mostrar un canciones o varias
$variables = ControladorMonitor::ctrMostrarMonitor($item, $valor);
//print_r($variables);
?>

<section class="content">

    <div class="box box-danger">
        <div class="box-body">
            <h1>Datos de medidor</h1>
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                
                <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>VOLTAJE</th>
                        <th>Ia</th>
                        <th>Ib</th>
                        <th>Ic</th>
                        <th>Pa</th>
                        <th>Pb</th>
                        <th>Pc</th>
                        <th>Ps</th>
                        <th>Qa</th>
                        <th>Qb</th>
                        <th>Qc</th>
                        <th>Qs</th>
                        <th>PFa</th>
                        <th>PFb</th>
                        <th>PFc</th>
                        <th>PFs</th>
                        <th>Sa</th>
                        <th>Sb</th>
                        <th>Sc</th>
                        <th>Ss</th>
                        <th>F</th>
                        <th>Consumo(Kwh)</th>
                        <th>FECHA</th>            
                    </tr>
                </thead>

                <tbody>
                    <?php
                    //La siguiente variable solicita ya se mostrar un canciones o varias
                    $canciones = ControladorCanciones::ctrMostrarCanciones($item, $valor);

                    //Para revisar que trae categorias
                    //var_dump($canciones);

                    //El foreach lo hacemos debido a que existe un array
                    foreach ($variables as $key => $value) {
                        echo '<tr>
                        <td>'.($key+1).'</td>
                        <td class="text-uppercase">'.$value["voltage"].' V</td>
                        <td class="text-uppercase">'.$value["currentA"].' A</td> 
                        <td class="text-uppercase">'.$value["currentB"].' A</td>
                        <td class="text-uppercase">'.$value["currentC"].' A</td>
                        <td class="text-uppercase">'.$value["powerA"].' W</td> 
                        <td class="text-uppercase">'.$value["powerB"].' W</td>
                        <td class="text-uppercase">'.$value["powerC"].' W</td>
                        <td class="text-uppercase">'.$value["totalPower"].' W</td>
                        <td class="text-uppercase">'.$value["reactivePowerA"].' var</td> 
                        <td class="text-uppercase">'.$value["reactivePowerB"].' var</td>
                        <td class="text-uppercase">'.$value["reactivePowerC"].' var</td>
                        <td class="text-uppercase">'.$value["totalReactivePower"].' var</td>
                        <td class="text-uppercase">'.$value["powerFactorA"].'</td> 
                        <td class="text-uppercase">'.$value["powerFactorB"].'</td>
                        <td class="text-uppercase">'.$value["powerFactorC"].'</td>
                        <td class="text-uppercase">'.$value["totalPowerFactor"].'</td>
                        <td class="text-uppercase">'.$value["apparentPowerA"].' VA</td> 
                        <td class="text-uppercase">'.$value["apparentPowerB"].' VA</td>
                        <td class="text-uppercase">'.$value["apparentPowerC"].' VA</td>
                        <td class="text-uppercase">'.$value["totalApparentPower"].' VA</td>
                        <td class="text-uppercase">'.$value["frequency"].' Hz</td>
                        <td class="text-uppercase">'.$value["energy"].' kWh</td>
                        <td class="text-uppercase">'.$value["timestamp"].'</td>
                    </tr>';
                
                    }
                    ?>
                </tbody>

            </table>

        </div>
    </div>

</section>
<!--Sección para la grafica de voltaje 
<section class="content">

    <div class="box box-danger">
        <div class="box-body">
        <?php
            $item = null;
            $valor = null;

            // Obtener los datos de la base de datos
            $variables = ControladorMonitor::ctrMostrarMonitor($item, $valor);

            // Verificar si se obtuvieron datos
            if (!empty($variables)) {
                // Array para almacenar los datos
                $data = array();

                // Iterar sobre los resultados y almacenarlos en el array
                foreach ($variables as $row) {
                    $data[] = array("fecha" => $row["fecha"], "voltaje" => $row["voltaje"]);
                }
            }
        ?>


        <head>
            <title>Gráfico de Corriente</title>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
        </head>
        <body>
            <canvas id="myChart" width="200" height="200"></canvas>
            <script>
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [<?php foreach ($data as $row) { echo '"' . $row['fecha'] . '",'; } ?>],
                        datasets: [{
                            label: 'Voltaje',
                            data: [<?php foreach ($data as $row) { echo $row['voltaje'] . ','; } ?>],
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>

        </div>
    </div>

</section>-->

<!--Sección para la grafica de Frecuencia 
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <?php
            $item = null;
            $valor = null;

            // Obtener los datos de la base de datos
            $variables = ControladorMonitor::ctrMostrarMonitor($item, $valor);

            // Verificar si se obtuvieron datos
            if (!empty($variables)) {
                // Array para almacenar los datos
                $data = array();

                // Iterar sobre los resultados y almacenarlos en el array
                foreach ($variables as $row) {
                    $data[] = array("fecha" => $row["fecha"], "frecuencia" => $row["frecuencia"]);
                }
            }
            ?>
            <canvas id="myChartFrecuencia" width="200" height="200"></canvas>
            <script>
                var ctx = document.getElementById('myChartFrecuencia').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [<?php foreach ($data as $row) { echo '"' . $row['fecha'] . '",'; } ?>],
                        datasets: [{
                            label: 'Frecuencia',
                            data: [<?php foreach ($data as $row) { echo $row['frecuencia'] . ','; } ?>],
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
</section>-->


</body>
</html>
