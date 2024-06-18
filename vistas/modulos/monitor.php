

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
                        <th>FRECUENCIA</th>
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
                                <td class="text-uppercase">'.$value["voltaje"].'</td>
                                <td class="text-uppercase">'.$value["frecuencia"].'</td>
                                <td class="text-uppercase">'.$value["fecha"].'</td>
                            </tr>';
                    }
                    ?>
                </tbody>

            </table>

        </div>
    </div>

</section>
<!--Secciòn para la grafica de voltaje -->
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

</section>


<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <!--Secciòn para la grafica de Frecuencia -->
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
</section>


</body>
</html>
