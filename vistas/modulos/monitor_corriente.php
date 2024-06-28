

<?php
$item = null;
$valor = null;

//La siguiente variable solicita ya se mostrar un canciones o varias
$variables = ControladorMonitor::ctrMostrarMonitor($item, $valor);
//print_r($variables);
?>
<!--Sección para la tabla de mediciones -->
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
                                <td class="text-uppercase">'.$value["voltage"].'</td>
                                <td class="text-uppercase">'.$value["frequency"].'</td>
                                <td class="text-uppercase">'.$value["timestamp"].'</td>
                            </tr>';
                    }
                    ?>
                </tbody>

            </table>

        </div>
    </div>

</section>


</body>
</html>
