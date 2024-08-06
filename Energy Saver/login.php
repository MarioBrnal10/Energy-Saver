<?php
session_start();
include 'db_connect.php'; // Asegúrate de que este archivo está en el mismo directorio y contiene la configuración correcta de la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $contraseña = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';

    if ($correo && $contraseña) {
        $sql = "SELECT * FROM usuario WHERE Correo = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('s', $correo);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                if (password_verify($contraseña, $user['Contraseña'])) {
                    $_SESSION['id_usuario'] = $user['Id'];
                    $_SESSION['nombre'] = $user['Nombre'];
                    echo "Login successful";
                } else {
                    echo 'Correo o contraseña incorrectos';
                }
            } else {
                echo 'Correo o contraseña incorrectos';
            }

            $stmt->close();
        } else {
            echo 'Error en la preparación de la consulta: ' . $conn->error;
        }
    } else {
        echo 'Por favor, complete todos los campos';
    }
} else {
    header('Location: login.html');
    exit();
}
?>
