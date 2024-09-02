<?php
// Configuración de la base de datos local
$servername = "localhost";
//local
/*$username = "root";
$password = "";
$dbname = "pos";*/

//aws
$username = "alejo";
$password = "Guiday624$";
$dbname = "pos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener los datos JSON enviados desde el ESP32
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['V']) && isset($data['Ia']) && isset($data['Ib']) && isset($data['Ic']) &&
    isset($data['Pa']) && isset($data['Pb']) && isset($data['Pc']) && isset($data['Ps']) &&
    isset($data['Qa']) && isset($data['Qb']) && isset($data['Qc']) && isset($data['Qs']) &&
    isset($data['PFA']) && isset($data['PFB']) && isset($data['PFC']) && isset($data['PFS']) &&
    isset($data['Sa']) && isset($data['Sb']) && isset($data['Sc']) && isset($data['Ss']) &&
    isset($data['F']) && isset($data['Energy'])) {

    $voltage = $data['V'];
    $currentA = $data['Ia'];
    $currentB = $data['Ib'];
    $currentC = $data['Ic'];
    $powerA = $data['Pa'];
    $powerB = $data['Pb'];
    $powerC = $data['Pc'];
    $totalPower = $data['Ps'];
    $reactivePowerA = $data['Qa'];
    $reactivePowerB = $data['Qb'];
    $reactivePowerC = $data['Qc'];
    $totalReactivePower = $data['Qs'];
    $powerFactorA = $data['PFA'];
    $powerFactorB = $data['PFB'];
    $powerFactorC = $data['PFC'];
    $totalPowerFactor = $data['PFS'];
    $apparentPowerA = $data['Sa'];
    $apparentPowerB = $data['Sb'];
    $apparentPowerC = $data['Sc'];
    $totalApparentPower = $data['Ss'];
    $frequency = $data['F'];
    $energy = $data['Energy'];

    // Validar los factores de potencia y calcular los ángulos
    $angleA = ($powerFactorA >= -1 && $powerFactorA <= 1) ? acos($powerFactorA) * 180 / M_PI : null;
    $angleB = ($powerFactorB >= -1 && $powerFactorB <= 1) ? acos($powerFactorB) * 180 / M_PI : null;
    $angleC = ($powerFactorC >= -1 && $powerFactorC <= 1) ? acos($powerFactorC) * 180 / M_PI : null;
    $totalAngle = ($totalPowerFactor >= -1 && $totalPowerFactor <= 1) ? acos($totalPowerFactor) * 180 / M_PI : null;

    // Manejar valores nulos o fuera de rango
    $angleA = is_null($angleA) ? 0 : $angleA;
    $angleB = is_null($angleB) ? 0 : $angleB;
    $angleC = is_null($angleC) ? 0 : $angleC;
    $totalAngle = is_null($totalAngle) ? 0 : $totalAngle;

    // Preparar y ejecutar la consulta SQL
    $stmt = $conn->prepare("INSERT INTO sensor_data (
        voltage, currentA, currentB, currentC, powerA, powerB, powerC, totalPower,
        reactivePowerA, reactivePowerB, reactivePowerC, totalReactivePower,
        powerFactorA, powerFactorB, powerFactorC, totalPowerFactor,
        apparentPowerA, apparentPowerB, apparentPowerC, totalApparentPower,
        frequency, energy, angleA, angleB, angleC, totalAngle
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("dddddddddddddddddddddddddd", $voltage, $currentA, $currentB, $currentC,
                      $powerA, $powerB, $powerC, $totalPower, $reactivePowerA, $reactivePowerB,
                      $reactivePowerC, $totalReactivePower, $powerFactorA, $powerFactorB,
                      $powerFactorC, $totalPowerFactor, $apparentPowerA, $apparentPowerB,
                      $apparentPowerC, $totalApparentPower, $frequency, $energy, $angleA, $angleB, $angleC, $totalAngle);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    echo "Invalid data received";
}

// Cerrar la conexión
$conn->close();
?>
