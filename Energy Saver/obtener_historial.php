<?php
$usuarioId = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 0;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "energycomplete2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT u.Nombre AS Usuario, 
               CONCAT(te.Nombre, ' ', m.Nombre, ' ', mo.Nombre) AS Electrodomestico, 
               c.Horas_activas, 
               c.Consumo
        FROM calculo c
        JOIN usuario u ON c.Id_usuario = u.Id
        JOIN electrodomestico e ON c.Id_electrodomestico = e.Id
        JOIN tipo_electrodomestico te ON e.Id_tipo = te.Id
        JOIN marca m ON e.Id_marca = m.Id
        JOIN modelo mo ON e.Id_modelo = mo.Id
        WHERE c.Id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuarioId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Usuario"] . "</td>";
        echo "<td>" . $row["Electrodomestico"] . "</td>";
        echo "<td>" . $row["Horas_activas"] . "</td>";
        echo "<td>" . $row["Consumo"] . "</td>";
        echo "<td>" . ($row["Consumo"] * 30 / 1000) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No hay cálculos registrados</td></tr>";
}
$conn->close();
?>
