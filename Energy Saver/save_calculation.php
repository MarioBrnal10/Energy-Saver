<?php
session_start();
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "energycomplete2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Conexión fallida: ' . $conn->connect_error]));
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($_SESSION['id_usuario'])) {
    $usuarioId = $_SESSION['id_usuario'];
    $nombre = $conn->real_escape_string($data['applianceText']);
    $electrodomesticoId = (int) $data['applianceId'];
    $horasActivas = (int) $data['hours'] + ((int) $data['minutes'] / 60);
    $consumo = (float) $data['dailyConsumption'];

    $sql = "INSERT INTO calculo (Id_usuario, Nombre, Id_electrodomestico, Horas_activas, Consumo) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isidd", $usuarioId, $nombre, $electrodomesticoId, $horasActivas, $consumo);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Cálculo guardado exitosamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al guardar el cálculo']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
}

$conn->close();
?>
