<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_hotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$cliente_id = $_POST['cliente_id'];
$habitacion_id = $_POST['habitacion_id'];
$fecha_entrada = $_POST['fecha_entrada'];
$fecha_salida = $_POST['fecha_salida'];
$monto_total = $_POST['monto_total'];

$sql = "INSERT INTO reserva (cliente_id, habitacion_id, fecha_entrada, fecha_salida, monto_total) VALUES ('$cliente_id', '$habitacion_id', '$fecha_entrada', '$fecha_salida', '$monto_total')";

if ($conn->query($sql) === TRUE) {
    echo "Nueva reserva registrada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<a href="reservas.php">Volver a Reservas</a>
