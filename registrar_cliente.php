<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_hotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

$sql = "INSERT INTO cliente (nombre, apellido, email, telefono, direccion) VALUES ('$nombre', '$apellido', '$email', '$telefono', '$direccion')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo cliente registrado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<a href="clientes.php">Volver a Clientes</a>
