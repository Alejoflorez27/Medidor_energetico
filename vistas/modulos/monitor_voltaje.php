

<?php
$item = null;
$valor = null;

//La siguiente variable solicita ya se mostrar un canciones o varias
$variables = ControladorMonitor::ctrMostrarMonitor($item, $valor);
//print_r($variables);
?>
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

</body>
</html>
