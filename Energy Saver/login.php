<?php
include 'db_connect.php';

$correo = $_POST['correo'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuario WHERE Correo = '$correo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if (isset($row['Contraseña']) && password_verify($password, $row['Contraseña'])) {
        echo "Login successful";
    } else {
        echo "Contraseña Incorrecta";
    }
} else {
    echo "El correo electrónico no se ha encontrado. Por favor, regístrate para poder ingresar.";
}

$conn->close();
?>
