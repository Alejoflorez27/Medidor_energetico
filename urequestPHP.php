<?php
/*//local
$GLOBALS["conexion"] = new PDO('mysql:host=localhost; dbname=pos', 'root', '');
//aws
//$GLOBALS["conexion"] = new PDO('mysql:host=localhost; dbname=pos', 'alejo', 'Guiday624$');
$GLOBALS["conexion"] -> exec("set names utf8");

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

$json = file_get_contents('php://input');
$data = json_decode($json);
//$led1on = $data->led1on;

$sq = $conexion -> prepare("");
$sq -> execute();

echo json_encode("ok");*/



// insertsion de datos
// Configuración de la base de datos local
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pos";

// Configuración de la base de datos local
$servername = "localhost";
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

if (isset($data['F']) && isset($data['V']) && isset($data['C'])) {
    $frequency = $data['F'];
    $voltage = $data['V'];
    $current = $data['C'];

    // Preparar y ejecutar la consulta SQL
    $stmt = $conn->prepare("INSERT INTO sensor_data (frequency, voltage, current) VALUES (?, ?, ?)");
    $stmt->bind_param("ddd", $frequency, $voltage, $current);

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