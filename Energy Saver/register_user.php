<?php
include 'db_connect.php';

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$id_genero = $_POST['id_genero'];
$correo = $_POST['correo'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hashing the password for security

$sql = "INSERT INTO usuario (nombre, apellidos, fecha_nacimiento, id_genero, correo, contraseña) VALUES ('$nombre', '$apellidos', '$fecha_nacimiento', '$id_genero', '$correo', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo registro creado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
