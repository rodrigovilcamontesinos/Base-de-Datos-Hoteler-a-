<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_hotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre_evento = $_POST['nombre_evento'];
$fecha_evento = $_POST['fecha_evento'];
$descripcion = $_POST['descripcion'];
$nombre_organizador = $_POST['nombre_organizador'];
$contacto_organizador = $_POST['contacto_organizador'];

$sql = "INSERT INTO evento (nombre_evento, fecha_evento, descripcion, nombre_organizador, contacto_organizador) VALUES ('$nombre_evento', '$fecha_evento', '$descripcion', '$nombre_organizador', '$contacto_organizador')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo evento registrado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<a href="eventos.php">Volver a Eventos</a>
