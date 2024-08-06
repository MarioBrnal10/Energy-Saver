<?php
session_start();
include 'db_connect.php'; // Asegúrate de que este archivo contiene la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];
    $id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : NULL;

    // Preparar y ejecutar la consulta
    $sql = "INSERT INTO contacto (Id_usuario, Nombre, Correo, Descripción, Fecha) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $id_usuario, $nombre, $correo, $mensaje);

    if ($stmt->execute()) {
        $alertMessage = "Mensaje enviado correctamente";
    } else {
        $alertMessage = "Error al enviar el mensaje: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    echo "<script>alert('$alertMessage'); window.location.href='contacto.html';</script>";
}
?>
