<!DOCTYPE html>
<html>
<head>
  <title>Gráficas de Variables de Corriente</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div style="display: flex; justify-content: space-between; width: 80%; margin: 0 auto;">
    <!-- Gráfica 1 (Izquierda) -->
    <div style="width: 30%;">
      <h2>Corriente</h2>
      <canvas id="myChart1" width="200" height="200"></canvas>
    </div>
    
    <!-- Gráfica 2 (Centro) -->
    <div style="width: 30%;">
      <h2>Voltage</h2>
      <canvas id="myChart2" width="200" height="200"></canvas>
    </div>

    <!-- Gráfica 3 (Derecha) -->
    <div style="width: 30%;">
      <h2>Amperios</h2>
      <canvas id="myChart3" width="200" height="200"></canvas>
    </div>
  </div>

  <!-- Añadir tres gráficas más abajo -->
  <div style="display: flex; justify-content: space-between; width: 80%; margin: 0 auto;">
    <!-- Gráfica 4 (Izquierda) -->
    <div style="width: 30%;">
      <h2>Fase 1</h2>
      <canvas id="myChart4" width="200" height="200"></canvas>
    </div>
    
    <!-- Gráfica 5 (Centro) -->
    <div style="width: 30%;">
      <h2>Fase 2</h2>
      <canvas id="myChart5" width="200" height="200"></canvas>
    </div>

    <!-- Gráfica 6 (Derecha) -->
    <div style="width: 30%;">
      <h2>Potencia</h2>
      <canvas id="myChart6" width="200" height="200"></canvas>
    </div>
  </div>

  <script>
    /* Datos para Gráfica 1
    var data1 = {
      labels: ["Variable A", "Variable B", "Variable C"],
      datasets: [
        {
          label: "Corriente",
          data: [10, 20, 15],
          backgroundColor: ["rgba(75, 192, 192, 0.2)", "rgba(255, 99, 132, 0.2)", "rgba(255, 206, 86, 0.2)"],
          borderColor: ["rgba(75, 192, 192, 1)", "rgba(255, 99, 132, 1)", "rgba(255, 206, 86, 1)"],
          borderWidth: 1
        }
      ]
    };
*/

    function generateRandomData() {
      return Array.from({ length: 3 }, () => Math.floor(Math.random() * 50) + 10);
    }

    // Datos iniciales para Gráfica 1
    var data1 = {
      labels: ["Variable A", "Variable B", "Variable C"],
      datasets: [
        {
          label: "Corriente",
          data: generateRandomData(),
          backgroundColor: ["rgba(75, 192, 192, 0.2)", "rgba(255, 99, 132, 0.2)", "rgba(255, 206, 86, 0.2)"],
          borderColor: ["rgba(75, 192, 192, 1)", "rgba(255, 99, 132, 1)", "rgba(255, 206, 86, 1)"],
          borderWidth: 1
        }
      ]
    };

    // Configuración de Gráfica 1
    var ctx1 = document.getElementById("myChart1").getContext("2d");
    var myChart1 = new Chart(ctx1, {
      type: "bar",
      data: data1,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Actualizar datos de Gráfica 1 cada segundo
    setInterval(function () {
      myChart1.data.datasets[0].data = generateRandomData();
      myChart1.update();
    }, 1000);

    // Datos para Gráfica 2
    var data2 = {
      labels: ["Variable D", "Variable E", "Variable F"],
      datasets: [
        {
          label: "Corriente",
          data: generateRandomData(),
          backgroundColor: ["rgba(75, 192, 192, 0.2)", "rgba(255, 99, 132, 0.2)", "rgba(255, 206, 86, 0.2)"],
          borderColor: ["rgba(75, 192, 192, 1)", "rgba(255, 99, 132, 1)", "rgba(255, 206, 86, 1)"],
          borderWidth: 1
        }
      ]
    };

    // Configuración de Gráfica 2
    var ctx1 = document.getElementById("myChart2").getContext("2d");
    var myChart2 = new Chart(ctx1, {
      type: "line",
      data: data2,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Actualizar datos de Gráfica 2 cada segundo
    setInterval(function () {
      myChart2.data.datasets[0].data = generateRandomData();
      myChart2.update();
    }, 1000);

    // Datos para Gráfica 3
    var data3 = {
      labels: ["Variable G", "Variable H", "Variable I"],
      datasets: [
        {
          label: "Amperios",
          data: [12, 25, 18],
          backgroundColor: ["rgba(75, 192, 192, 0.2)", "rgba(255, 99, 132, 0.2)", "rgba(255, 206, 86, 0.2)"],
          borderColor: ["rgba(75, 192, 192, 1)", "rgba(255, 99, 132, 1)", "rgba(255, 206, 86, 1)"],
          borderWidth: 1
        }
      ]
    };

    // Configuración de Gráfica 3
    var ctx1 = document.getElementById("myChart3").getContext("2d");
    var myChart3 = new Chart(ctx1, {
      type: "line",
      data: data3,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Actualizar datos de Gráfica 3 cada segundo
    setInterval(function () {
      myChart3.data.datasets[0].data = generateRandomData();
      myChart3.update();
    }, 1000);

    // Datos para Gráfica 4
    var data4 = {
      labels: ["Variable J", "Variable K", "Variable L"],
      datasets: [
        {
          label: "Corriente",
          data: [8, 17, 12],
          backgroundColor: ["rgba(75, 192, 192, 0.2)", "rgba(255, 99, 132, 0.2)", "rgba(255, 206, 86, 0.2)"],
          borderColor: ["rgba(75, 192, 192, 1)", "rgba(255, 99, 132, 1)", "rgba(255, 206, 86, 1)"],
          borderWidth: 1
        }
      ]
    };

    // Datos para Gráfica 5
    var data5 = {
      labels: ["Variable M", "Variable N", "Variable O"],
      datasets: [
        {
          label: "Corriente",
          data: [11, 22, 17],
          backgroundColor: ["rgba(75, 192, 192, 0.2)", "rgba(255, 99, 132, 0.2)", "rgba(255, 206, 86, 0.2)"],
          borderColor: ["rgba(75, 192, 192, 1)", "rgba(255, 99, 132, 1)", "rgba(255, 206, 86, 1)"],
          borderWidth: 1
        }
      ]
    };

    // Datos para Gráfica 6
    var data6 = {
      labels: ["Variable P", "Variable Q", "Variable R"],
      datasets: [
        {
          label: "Corriente",
          data: [9, 18, 13],
          backgroundColor: ["rgba(75, 192, 192, 0.2)", "rgba(255, 99, 132, 0.2)", "rgba(255, 206, 86, 0.2)"],
          borderColor: ["rgba(75, 192, 192, 1)", "rgba(255, 99, 132, 1)", "rgba(255, 206, 86, 1)"],
          borderWidth: 1
        }
      ]
    };

    // Configuración de Gráfica 1
    var ctx1 = document.getElementById("myChart1").getContext("2d");
    var myChart1 = new Chart(ctx1, {
      type: "bar",
      data: data1,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Configuración de Gráfica 2
    var ctx2 = document.getElementById("myChart2").getContext("2d");
    var myChart2 = new Chart(ctx2, {
      type: "line", // Puedes cambiar el tipo de gráfico aquí
      data: data2,
      options: {
        // Configuración específica para Gráfica 2
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Configuración de Gráfica 3
    var ctx3 = document.getElementById("myChart3").getContext("2d");
    var myChart3 = new Chart(ctx3, {
      type: "pie", // Puedes cambiar el tipo de gráfico aquí
      data: data3,
      options: {
        // Configuración específica para Gráfica 3
      }
    });

    // Configuración de Gráfica 4
    var ctx4 = document.getElementById("myChart4").getContext("2d");
    var myChart4 = new Chart(ctx4, {
      type: "bar", // Tipo de gráfico personalizado
      data: data4,
      options: {
        // Configuración específica para Gráfica 4
      }
    });

    // Configuración de Gráfica 5
    var ctx5 = document.getElementById("myChart5").getContext("2d");
    var myChart5 = new Chart(ctx5, {
      type: "line", // Tipo de gráfico personalizado
      data: data5,
      options: {
        // Configuración específica para Gráfica 5
      }
    });

    // Configuración de Gráfica 6
    var ctx6 = document.getElementById("myChart6").getContext("2d");
    var myChart6 = new Chart(ctx6, {
      type: "doughnut", // Tipo de gráfico personalizado
      data: data6,
      options: {
        // Configuración específica para Gráfica 6
      }
    });
  </script>
</body>
</html>
