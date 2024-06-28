<?php
$item = null;
$valor = null;

// Obtener los datos de la base de datos
$variables = ControladorMonitor::ctrMostrarMonitor($item, $valor);

// Verificar si se obtuvieron datos
$data = array();
if (!empty($variables)) {
    foreach ($variables as $row) {
        $data[] = array("fecha" => $row["timestamp"],
                        "voltaje" => $row["voltage"],

                        "currentA" => $row["currentA"],
                        "currentB" => $row["currentB"],
                        "currentC" => $row["currentC"],

                        "powerA" => $row["powerA"],
                        "powerB" => $row["powerB"],
                        "powerC" => $row["powerC"],
                        "totalPower" => $row["totalPower"],

                        "reactivePowerA" => $row["reactivePowerA"],
                        "reactivePowerB" => $row["reactivePowerB"],
                        "reactivePowerC" => $row["reactivePowerC"],
                        "totalReactivePower" => $row["totalReactivePower"],

                        "powerFactorA" => $row["powerFactorA"],
                        "powerFactorB" => $row["powerFactorB"],
                        "powerFactorC" => $row["powerFactorC"],
                        "totalPowerFactor" => $row["totalPowerFactor"],

                        "apparentPowerA" => $row["apparentPowerA"],
                        "apparentPowerB" => $row["apparentPowerB"],
                        "apparentPowerC" => $row["apparentPowerC"],
                        "totalApparentPower" => $row["totalApparentPower"],

                        "frequency" => $row["frequency"],

                        "energy" => $row["energy"]
                    );
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Incluir jsPDF y Chart.js -->
    <script src="vistas/js/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px; /* Ajusta el espacio entre los gráficos según sea necesario */
        }
        .grid-item {
            border: 1px solid #ccc; /* Opcional, para visualización */
            padding: 10px; /* Opcional, para visualización */
        }
        canvas {
            width: 100%; /* Asegúrate de que los gráficos ocupen todo el ancho del contenedor */
            height: 400px; /* Ajusta la altura según sea necesario */
        }
        @media (max-width: 768px) {
            .grid-container {
                grid-template-columns: 1fr; /* Una columna en pantallas más estrechas */
            }
        }
    </style>
</head>
<body>

    <!-- Botón para generar el PDF -->
    <button class="btn btn-primary" id="generar-pdf">Generar Informe</button>
    <br>

    <!-- Contenedor para el gráfico -->
    <div class="grid-container">
        <div class="grid-item"><canvas id="grafico"></canvas></div>
        <div class="grid-item"><canvas id="grafico1"></canvas></div>
        <div class="grid-item"><canvas id="grafico2"></canvas></div>
        <div class="grid-item"><canvas id="grafico3"></canvas></div>
        <div class="grid-item"><canvas id="grafico4"></canvas></div>
        <div class="grid-item"><canvas id="grafico5"></canvas></div>
        <div class="grid-item"><canvas id="grafico6"></canvas></div>
        <div class="grid-item"><canvas id="grafico7"></canvas></div>
        <div class="grid-item"><canvas id="grafico8"></canvas></div>
        <div class="grid-item"><canvas id="grafico9"></canvas></div>
        <div class="grid-item"><canvas id="grafico10"></canvas></div>
        <div class="grid-item"><canvas id="grafico11"></canvas></div>
        <div class="grid-item"><canvas id="grafico12"></canvas></div>
        <div class="grid-item"><canvas id="grafico13"></canvas></div>
        <div class="grid-item"><canvas id="grafico14"></canvas></div>
        <div class="grid-item"><canvas id="grafico15"></canvas></div>
        <div class="grid-item"><canvas id="grafico16"></canvas></div>
        <div class="grid-item"><canvas id="grafico17"></canvas></div>
        <div class="grid-item"><canvas id="grafico18"></canvas></div>
        <div class="grid-item"><canvas id="grafico19"></canvas></div>
        <div class="grid-item"><canvas id="grafico20"></canvas></div>
        <div class="grid-item"><canvas id="grafico21"></canvas></div>
    </div>

    <!--<canvas id="grafico22"></canvas>
    <canvas id="grafico23"></canvas>
    <canvas id="grafico24"></canvas>
    <canvas id="grafico25"></canvas>
    <canvas id="grafico26"></canvas>-->




    <!-- Tu otro contenido aquí -->

    <script>
    // Convertir datos PHP a JavaScript
    const data = <?php echo json_encode($data); ?>;

    // Extraer etiquetas y valores para el gráfico
    const labels = data.map(d => d.fecha);

    const valoresVoltaje = data.map(d => d.voltaje);

    const currentA = data.map(d => d.currentA);
    const currentB = data.map(d => d.currentB);
    const currentC = data.map(d => d.currentC);

    const powerA = data.map(d => d.powerA);
    const powerB = data.map(d => d.powerB);
    const powerC = data.map(d => d.powerC);
    const totalPower = data.map(d => d.totalPower);

    const reactivePowerA = data.map(d => d.reactivePowerA);
    const reactivePowerB = data.map(d => d.reactivePowerB);
    const reactivePowerC = data.map(d => d.reactivePowerC);
    const totalReactivePower = data.map(d => d.totalReactivePower);

    const powerFactorA = data.map(d => d.powerFactorA);
    const powerFactorB = data.map(d => d.powerFactorB);
    const powerFactorC = data.map(d => d.powerFactorC);
    const totalPowerFactor = data.map(d => d.totalPowerFactor);

    const apparentPowerA = data.map(d => d.apparentPowerA);
    const apparentPowerB = data.map(d => d.apparentPowerB);
    const apparentPowerC = data.map(d => d.apparentPowerC);
    const totalApparentPower = data.map(d => d.totalApparentPower);

    const frecuencia = data.map(d => d.frequency);

    const energy = data.map(d => d.energy);


    // Crear el gráfico con Chart.js Voltaje
    const ctx = document.getElementById('grafico').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Voltaje',
                data: valoresVoltaje,
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

    // Crear el gráfico con Chart.js Frecuencia
    const ctx1 = document.getElementById('grafico1').getContext('2d');
    const myChart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Frecuencia',
                data: frecuencia,
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

    // Crear el gráfico con Chart.js Fase de corriente A
    const ctx2 = document.getElementById('grafico2').getContext('2d');
    const myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Fase de corriente A',
                data: currentA,
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

    // Crear el gráfico con Chart.js Fase de corriente B
    const ctx3 = document.getElementById('grafico3').getContext('2d');
    const myChart3 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Fase de corriente B',
                data: currentB,
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

    // Crear el gráfico con Chart.js Fase de corriente C
    const ctx4 = document.getElementById('grafico4').getContext('2d');
    const myChart4 = new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Fase de corriente C',
                data: currentC,
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

    // Crear el gráfico con Chart.js Potencia activa de fase A
    const ctx5 = document.getElementById('grafico5').getContext('2d');
    const myChart5 = new Chart(ctx5, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Potencia activa de fase A',
                data: powerA,
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

    // Crear el gráfico con Chart.js Potencia activa de fase B
    const ctx6 = document.getElementById('grafico6').getContext('2d');
    const myChart6 = new Chart(ctx6, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Potencia activa de fase B',
                data: powerB,
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

    // Crear el gráfico con Chart.js Potencia activa de fase C
    const ctx7 = document.getElementById('grafico7').getContext('2d');
    const myChart7 = new Chart(ctx7, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Potencia activa de fase C',
                data: powerC,
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

    // Crear el gráfico con Chart.js Total Potencia activa
    const ctx8 = document.getElementById('grafico8').getContext('2d');
    const myChart8 = new Chart(ctx8, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Total Potencia activa',
                data: totalPower,
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

    // Crear el gráfico con Chart.js Potencia reactiva de fase A
    const ctx9 = document.getElementById('grafico9').getContext('2d');
    const myChart9 = new Chart(ctx9, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Potencia reactiva de fase A',
                data: reactivePowerA,
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

    // Crear el gráfico con Chart.js Potencia reactiva de fase B
    const ctx10 = document.getElementById('grafico10').getContext('2d');
    const myChart10 = new Chart(ctx10, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Potencia reactiva de fase B',
                data: reactivePowerB,
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

    // Crear el gráfico con Chart.js Potencia reactiva de fase C
    const ctx11 = document.getElementById('grafico11').getContext('2d');
    const myChart11 = new Chart(ctx11, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Potencia reactiva de fase C',
                data: reactivePowerC,
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

    // Crear el gráfico con Chart.js Total Potencia reactiva
    const ctx12 = document.getElementById('grafico12').getContext('2d');
    const myChart12 = new Chart(ctx12, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Total Potencia reactiva',
                data: totalReactivePower,
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

    // Crear el gráfico con Chart.js Factor de potencia fase A
    const ctx13 = document.getElementById('grafico13').getContext('2d');
    const myChart13 = new Chart(ctx13, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Factor de potencia fase A',
                data: powerFactorA,
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

    // Crear el gráfico con Chart.js Factor de potencia fase B
    const ctx14 = document.getElementById('grafico14').getContext('2d');
    const myChart14 = new Chart(ctx14, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Factor de potencia fase B',
                data: powerFactorB,
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

    // Crear el gráfico con Chart.js Factor de potencia fase C
    const ctx15 = document.getElementById('grafico15').getContext('2d');
    const myChart15 = new Chart(ctx15, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Factor de potencia fase C',
                data: powerFactorC,
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

    // Crear el gráfico con Chart.js Factor de potencia total
    const ctx16 = document.getElementById('grafico16').getContext('2d');
    const myChart16 = new Chart(ctx16, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Factor de potencia total',
                data: totalPowerFactor,
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

    // Crear el gráfico con Chart.js Potencia aparente fase A
    const ctx17 = document.getElementById('grafico17').getContext('2d');
    const myChart17 = new Chart(ctx17, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Potencia aparente fase A',
                data: apparentPowerA,
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

    // Crear el gráfico con Chart.js Potencia aparente fase A
    const ctx18 = document.getElementById('grafico18').getContext('2d');
    const myChart18 = new Chart(ctx18, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Potencia aparente fase B',
                data: apparentPowerB,
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

    // Crear el gráfico con Chart.js Potencia aparente fase C
    const ctx19 = document.getElementById('grafico19').getContext('2d');
    const myChart19 = new Chart(ctx19, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Potencia aparente fase C',
                data: apparentPowerC,
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

    // Crear el gráfico con Chart.js Potencia aparente total
    const ctx20 = document.getElementById('grafico20').getContext('2d');
    const myChart20 = new Chart(ctx20, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Potencia aparente total',
                data: totalApparentPower,
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

    // Crear el gráfico con Chart.js Consumo Energetico
    const ctx21 = document.getElementById('grafico21').getContext('2d');
    const myChart21 = new Chart(ctx21, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Consumo Energetico',
                data: energy,
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
/*
    // Crear el gráfico con Chart.js Potencia activa de fase C
    const ctx22 = document.getElementById('grafico22').getContext('2d');
    const myChart22 = new Chart(ctx22, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Potencia activa de fase C',
                data: powerC,
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

    // Crear el gráfico con Chart.js Potencia activa de fase C
    const ctx23 = document.getElementById('grafico23').getContext('2d');
    const myChart23 = new Chart(ctx23, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Potencia activa de fase C',
                data: powerC,
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

    // Crear el gráfico con Chart.js Potencia activa de fase C
    const ctx24 = document.getElementById('grafico24').getContext('2d');
    const myChart24 = new Chart(ctx24, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Potencia activa de fase C',
                data: powerC,
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

    // Crear el gráfico con Chart.js Potencia activa de fase C
    const ctx25 = document.getElementById('grafico25').getContext('2d');
    const myChart25 = new Chart(ctx25, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Potencia activa de fase C',
                data: powerC,
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

    // Crear el gráfico con Chart.js Potencia activa de fase C
    const ctx26 = document.getElementById('grafico26').getContext('2d');
    const myChart26 = new Chart(ctx26, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Potencia activa de fase C',
                data: powerC,
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
*/

        // Selección del botón para generar el PDF
        const btnGenerarPDF = document.getElementById('generar-pdf');

        // Cuando se hace clic en el botón
        btnGenerarPDF.addEventListener('click', () => {
            // Crear una instancia de jsPDF
            const doc = new jsPDF();

            // Agregar el título centrado voltaje
            const title = 'Informe de Lecturas de Voltaje (V)';
            doc.setFontSize(18);
            const textWidth = doc.getTextWidth(title);
            const pageWidth = doc.internal.pageSize.width;
            const x = (pageWidth - textWidth) / 2;
            doc.text(title, x, 20);

            // Obtener el gráfico como imagen base64
            const imgData = myChart.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData, 'JPEG', 10, 30, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de voltaje registradas durante el periodo indicado.', 10, 140);

            // Añadir nueva página para el gráfico de frecuencia
            //doc.addPage();

            // Agregar el título centrado frecuencia
            const title1 = 'Informe de Lecturas de frecuencia (Hz)';
            doc.setFontSize(18);
            const textWidth1 = doc.getTextWidth(title1);
            const pageWidth1 = doc.internal.pageSize.width;
            const x1 = (pageWidth - textWidth) / 2;
            doc.text(title1, x1, 150);

            // Obtener el gráfico como imagen base64
            const imgData1 = myChart1.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData1, 'JPEG', 10, 155, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Frecuencia registradas durante el periodo indicado.', 10, 270);

            // Añadir nueva página para el gráfico de Fase de corriente A y Fase de corriente B
            doc.addPage();

            // Agregar el título centrado Fase de corriente A
            const title2 = 'Informe de Lecturas de Fase de corriente A (A)';
            doc.setFontSize(18);
            const textWidth2 = doc.getTextWidth(title2);
            const pageWidth2 = doc.internal.pageSize.width;
            const x2 = (pageWidth2 - textWidth2) / 2;
            doc.text(title2, x2, 20);

            // Obtener el gráfico como imagen base64
            const imgData2 = myChart2.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData2, 'JPEG', 10, 30, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Fase de corriente A registradas durante el periodo indicado.', 10, 140);


            // Agregar el título centrado Fase de corriente B
            const title3 = 'Informe de Lecturas de Fase de corriente B (A)';
            doc.setFontSize(18);
            const textWidth3 = doc.getTextWidth(title3);
            const pageWidth3 = doc.internal.pageSize.width;
            const x3 = (pageWidth3 - textWidth3) / 2;
            doc.text(title3, x3, 150);

            // Obtener el gráfico como imagen base64
            const imgData3 = myChart3.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData3, 'JPEG', 10, 155, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Fase de corriente B registradas durante el periodo indicado.', 10, 270);

            // Añadir nueva página para el gráfico de Fase de corriente C y Potencia activa de fase A
            doc.addPage();

            // Agregar el título centrado Fase de corriente C
            const title4 = 'Informe de Lecturas de Fase de corriente C (A)';
            doc.setFontSize(18);
            const textWidth4 = doc.getTextWidth(title4);
            const pageWidth4 = doc.internal.pageSize.width;
            const x4 = (pageWidth4 - textWidth4) / 2;
            doc.text(title4, x4, 20);

            // Obtener el gráfico como imagen base64
            const imgData4 = myChart4.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData4, 'JPEG', 10, 30, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Fase de corriente C registradas durante el periodo indicado.', 10, 140);


            // Agregar el título centrado Fase de corriente B
            const title5 = 'Informe de Lecturas de Potencia activa de fase A (W)';
            doc.setFontSize(18);
            const textWidth5 = doc.getTextWidth(title5);
            const pageWidth5 = doc.internal.pageSize.width;
            const x5 = (pageWidth5 - textWidth5) / 2;
            doc.text(title5, x5, 150);

            // Obtener el gráfico como imagen base64
            const imgData5 = myChart5.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData5, 'JPEG', 10, 155, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Potencia activa de fase A registradas durante el periodo indicado.', 10, 270);

            // Añadir nueva página para el gráfico de Potencia activa de fase B y Potencia activa de fase C
            doc.addPage();

            // Agregar el título centrado Potencia activa de fase B
            const title6 = 'Informe de Lecturas de Potencia activa de fase B (W)';
            doc.setFontSize(18);
            const textWidth6 = doc.getTextWidth(title6);
            const pageWidth6 = doc.internal.pageSize.width;
            const x6 = (pageWidth6 - textWidth6) / 2;
            doc.text(title6, x6, 20);

            // Obtener el gráfico como imagen base64
            const imgData6 = myChart6.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData6, 'JPEG', 10, 30, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Potencia activa de fase B registradas durante el periodo indicado.', 10, 140);


            // Agregar el título centrado Potencia activa de fase C
            const title7 = 'Informe de Lecturas de Potencia activa de fase C (W)';
            doc.setFontSize(18);
            const textWidth7 = doc.getTextWidth(title7);
            const pageWidth7 = doc.internal.pageSize.width;
            const x7 = (pageWidth7 - textWidth7) / 2;
            doc.text(title7, x7, 150);

            // Obtener el gráfico como imagen base64
            const imgData7 = myChart7.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData7, 'JPEG', 10, 155, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Potencia activa de fase C registradas durante el periodo indicado.', 10, 270);

// ======================================================================================================================================
            // Añadir nueva página para el gráfico de Total Potencia activa y Potencia reactiva de fase A
            doc.addPage();

            // Agregar el título centrado Total Potencia activa
            const title8 = 'Informe de Lecturas de Total Potencia activa (W)';
            doc.setFontSize(18);
            const textWidth8 = doc.getTextWidth(title8);
            const pageWidth8 = doc.internal.pageSize.width;
            const x8 = (pageWidth8 - textWidth8) / 2;
            doc.text(title8, x8, 20);

            // Obtener el gráfico como imagen base64
            const imgData8 = myChart8.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData8, 'JPEG', 10, 30, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Total Potencia activa registradas durante el periodo indicado.', 10, 140);


            // Agregar el título centrado Potencia reactiva de fase A
            const title9 = 'Informe de Lecturas de Potencia reactiva de fase A (VAr)';
            doc.setFontSize(18);
            const textWidth9 = doc.getTextWidth(title9);
            const pageWidth9 = doc.internal.pageSize.width;
            const x9 = (pageWidth9 - textWidth9) / 2;
            doc.text(title9, x9, 150);

            // Obtener el gráfico como imagen base64
            const imgData9 = myChart9.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData9, 'JPEG', 10, 155, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Potencia reactiva de fase A registradas durante el periodo indicado.', 10, 270);

            // Añadir nueva página para el gráfico de Potencia reactiva de fase B y Potencia reactiva de fase C
            doc.addPage();

            // Agregar el título centrado Potencia reactiva de fase C
            const title10 = 'Informe de Lecturas de Potencia reactiva de fase C (VAr)';
            doc.setFontSize(18);
            const textWidth10 = doc.getTextWidth(title10);
            const pageWidth10 = doc.internal.pageSize.width;
            const x10 = (pageWidth10 - textWidth10) / 2;
            doc.text(title10, x10, 20);

            // Obtener el gráfico como imagen base64
            const imgData10 = myChart10.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData10, 'JPEG', 10, 30, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Potencia reactiva de fase C registradas durante el periodo indicado.', 10, 140);


            // Agregar el título centrado Potencia reactiva total
            const title11 = 'Informe de Lecturas de Potencia reactiva total (VAr)';
            doc.setFontSize(18);
            const textWidth11 = doc.getTextWidth(title11);
            const pageWidth11 = doc.internal.pageSize.width;
            const x11 = (pageWidth11 - textWidth11) / 2;
            doc.text(title11, x11, 150);

            // Obtener el gráfico como imagen base64
            const imgData11 = myChart11.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData11, 'JPEG', 10, 155, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Potencia reactiva total registradas durante el periodo indicado.', 10, 270);

            // Añadir nueva página para el gráfico de Factor de potencia fase A y Factor de potencia fase B
            doc.addPage();

            // Agregar el título centrado Factor de potencia fase A
            const title12 = 'Informe de Lecturas de Factor de potencia fase A';
            doc.setFontSize(18);
            const textWidth12 = doc.getTextWidth(title12);
            const pageWidth12 = doc.internal.pageSize.width;
            const x12 = (pageWidth12 - textWidth12) / 2;
            doc.text(title12, x12, 20);

            // Obtener el gráfico como imagen base64
            const imgData12 = myChart6.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData12, 'JPEG', 10, 30, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Factor de potencia fase A registradas durante el periodo indicado.', 10, 140);


            // Agregar el título centrado Factor de potencia fase B
            const title13 = 'Informe de Lecturas de Factor de potencia fase B';
            doc.setFontSize(18);
            const textWidth13 = doc.getTextWidth(title13);
            const pageWidth13 = doc.internal.pageSize.width;
            const x13 = (pageWidth13 - textWidth13) / 2;
            doc.text(title13, x13, 150);

            // Obtener el gráfico como imagen base64
            const imgData13 = myChart13.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData13, 'JPEG', 10, 155, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Factor de potencia fase B registradas durante el periodo indicado.', 10, 270);

            // Añadir nueva página para el gráfico de Factor de potencia fase C y Factor de potencia total
            doc.addPage();

            // Agregar el título centrado Factor de potencia fase C
            const title14 = 'Informe de Lecturas de Factor de potencia fase C';
            doc.setFontSize(18);
            const textWidth14 = doc.getTextWidth(title14);
            const pageWidth14 = doc.internal.pageSize.width;
            const x14 = (pageWidth14 - textWidth14) / 2;
            doc.text(title14, x14, 20);

            // Obtener el gráfico como imagen base64
            const imgData14 = myChart14.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData14, 'JPEG', 10, 30, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Factor de potencia fase C registradas durante el periodo indicado.', 10, 140);


            // Agregar el título centrado Potencia activa de fase C
            const title15 = 'Informe de Lecturas de Factor de potencia total';
            doc.setFontSize(18);
            const textWidth15 = doc.getTextWidth(title15);
            const pageWidth15 = doc.internal.pageSize.width;
            const x15 = (pageWidth15 - textWidth15) / 2;
            doc.text(title15, x15, 150);

            // Obtener el gráfico como imagen base64
            const imgData15 = myChart15.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData15, 'JPEG', 10, 155, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Factor de potencia total registradas durante el periodo indicado.', 10, 270);

            // Añadir nueva página para el gráfico de Factor de potencia total y Potencia aparente fase A
            doc.addPage();

            // Agregar el título centrado Factor de potencia total
            const title16 = 'Informe de Lecturas de Factor de potencia total';
            doc.setFontSize(18);
            const textWidth16 = doc.getTextWidth(title16);
            const pageWidth16 = doc.internal.pageSize.width;
            const x16 = (pageWidth16 - textWidth16) / 2;
            doc.text(title16, x16, 20);

            // Obtener el gráfico como imagen base64
            const imgData16 = myChart16.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData16, 'JPEG', 10, 30, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Factor de potencia total registradas durante el periodo indicado.', 10, 140);


            // Agregar el título centrado Potencia aparente fase A
            const title17 = 'Informe de Lecturas de Potencia aparente fase A (VA)';
            doc.setFontSize(18);
            const textWidth17 = doc.getTextWidth(title17);
            const pageWidth17 = doc.internal.pageSize.width;
            const x17 = (pageWidth17 - textWidth17) / 2;
            doc.text(title17, x17, 150);

            // Obtener el gráfico como imagen base64
            const imgData17 = myChart17.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData17, 'JPEG', 10, 155, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Potencia aparente fase A registradas durante el periodo indicado.', 10, 270);

            // Añadir nueva página para el gráfico de Potencia aparente fase B (VA) y Potencia aparente total
            doc.addPage();

            // Agregar el título centrado Potencia aparente fase C
            const title18 = 'Informe de Lecturas de Potencia aparente fase B (VA)';
            doc.setFontSize(18);
            const textWidth18 = doc.getTextWidth(title18);
            const pageWidth18 = doc.internal.pageSize.width;
            const x18 = (pageWidth18 - textWidth18) / 2;
            doc.text(title18, x18, 20);

            // Obtener el gráfico como imagen base64
            const imgData18 = myChart18.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData18, 'JPEG', 10, 30, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Potencia aparente fase B registradas durante el periodo indicado.', 10, 140);


            // Agregar el título centrado Potencia aparente fase C
            const title19 = 'Informe de Lecturas de Potencia aparente fase C (VA)';
            doc.setFontSize(18);
            const textWidth19 = doc.getTextWidth(title19);
            const pageWidth19 = doc.internal.pageSize.width;
            const x19 = (pageWidth19 - textWidth19) / 2;
            doc.text(title19, x19, 150);

            // Obtener el gráfico como imagen base64
            const imgData19 = myChart19.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData19, 'JPEG', 10, 155, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Potencia aparente total registradas durante el periodo indicado.', 10, 270);
            // Añadir nueva página para el gráfico de Potencia activa de fase B y Potencia activa de fase C

            doc.addPage();

            // Agregar el título centrado Potencia aparente total
            const title20 = 'Informe de Lecturas de Potencia aparente total (W)';
            doc.setFontSize(18);
            const textWidth20 = doc.getTextWidth(title20);
            const pageWidth20 = doc.internal.pageSize.width;
            const x20 = (pageWidth20 - textWidth20) / 2;
            doc.text(title20, x20, 20);

            // Obtener el gráfico como imagen base64
            const imgData20 = myChart20.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData20, 'JPEG', 10, 30, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Potencia aparente total registradas durante el periodo indicado.', 10, 140);


            // Agregar el título centrado Consumo Energetico
            const title21 = 'Informe de Lecturas de Consumo Energetico (Kwh)';
            doc.setFontSize(18);
            const textWidth21 = doc.getTextWidth(title21);
            const pageWidth21 = doc.internal.pageSize.width;
            const x21 = (pageWidth21 - textWidth21) / 2;
            doc.text(title21, x21, 150);

            // Obtener el gráfico como imagen base64
            const imgData21 = myChart21.toBase64Image();

            // Agregar el gráfico al PDF
            doc.addImage(imgData21, 'JPEG', 10, 155, 180, 100);

            // Agregar un mensaje explicativo
            doc.setFontSize(12);
            doc.text('El gráfico muestra las lecturas de Consumo Energetico registradas durante el periodo indicado.', 10, 270);
            // Obtener la URL del PDF y abrirlo en una nueva pestaña
            const pdfURL = doc.output('bloburl');
            window.open(pdfURL, '_blank');
        });
    </script>
</body>
</html>
