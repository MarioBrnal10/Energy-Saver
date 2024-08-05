<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "energycomplete2";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Establecer el conjunto de caracteres a UTF-8
if (!$conn->set_charset("utf8")) {
    die("Error loading character set utf8: " . $conn->error);
}
?>
