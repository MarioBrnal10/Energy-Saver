<?php
include 'db_connect.php';

$query = "SELECT Id, Nombre FROM Marca";
$result = $conn->query($query);

$brands = array();
while ($row = $result->fetch_assoc()) {
    $brands[] = array("id" => $row['Id'], "nombre" => $row['Nombre']);
}

echo json_encode($brands);

$conn->close();
?>
