<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_hotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$reserva_id = $_POST['reserva_id'];
$fecha_pago = $_POST['fecha_pago'];
$monto = $_POST['monto'];
$metodo_pago = $_POST['metodo_pago'];

$sql = "INSERT INTO pago (reserva_id, fecha_pago, monto, metodo_pago) VALUES ('$reserva_id', '$fecha_pago', '$monto', '$metodo_pago')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo pago registrado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<a href="pagos.php">Volver a Pagos</a>
