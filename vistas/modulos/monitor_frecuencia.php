

<?php
$item = null;
$valor = null;

//La siguiente variable solicita ya se mostrar un canciones o varias
$variables = ControladorMonitor::ctrMostrarMonitor($item, $valor);
//print_r($variables);
?>
<!--Sección para la grafica de Frecuencia -->
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
                    $data[] = array("fecha" => $row["timestamp"], "frecuencia" => $row["frequency"]);
                }
            }
            ?>
            <canvas id="myChartFrecuencia" width="200" height="200"></canvas>
            <script>
                var ctx = document.getElementById('myChartFrecuencia').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [<?php foreach ($data as $row) { echo '"' . $row['timestamp'] . '",'; } ?>],
                        datasets: [{
                            label: 'Frecuencia',
                            data: [<?php foreach ($data as $row) { echo $row['frequency'] . ','; } ?>],
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
