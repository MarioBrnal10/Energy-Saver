<?php
include 'db_connect.php';

function validate_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if (isset($_GET['brandId'])) {
    $brandId = validate_input($_GET['brandId']);
    
    if (filter_var($brandId, FILTER_VALIDATE_INT)) {
        $query = "SELECT e.Id, CONCAT(t.Nombre, ' ', m.Nombre) AS nombre, e.Potencia 
                  FROM Electrodomestico e
                  JOIN Marca ma ON e.Id_marca = ma.Id
                  JOIN Modelo m ON e.Id_modelo = m.Id
                  JOIN Tipo_electrodomestico t ON e.Id_tipo = t.Id
                  WHERE ma.Id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $brandId);
        $stmt->execute();
        $result = $stmt->get_result();

        $appliances = array();
        while ($row = $result->fetch_assoc()) {
            $appliances[] = array("id" => $row['Id'], "nombre" => $row['nombre'], "potencia" => $row['Potencia']);
        }

        echo json_encode($appliances);

        $stmt->close();
    } else {
        echo json_encode(array("error" => "Marca no válida"));
    }
} elseif (isset($_GET['id'])) {
    $id = validate_input($_GET['id']);
    
    if (filter_var($id, FILTER_VALIDATE_INT)) {
        $query = "SELECT Potencia FROM Electrodomestico WHERE Id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($potencia);
        $stmt->fetch();

        $response = array("potencia" => $potencia);

        echo json_encode($response);

        $stmt->close();
    } else {
        echo json_encode(array("error" => "ID no válido"));
    }
}

$conn->close();
?>
