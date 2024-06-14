<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_hotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre_actividad = $_POST['nombre_actividad'];
$descripcion = $_POST['descripcion'];
$fecha_actividad = $_POST['fecha_actividad'];
$costo = $_POST['costo'];

$sql = "INSERT INTO actividad (nombre_actividad, descripcion, fecha_actividad, costo) VALUES ('$nombre_actividad', '$descripcion', '$fecha_actividad', '$costo')";

if ($conn->query($sql) === TRUE) {
    echo "Nueva actividad registrada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<a href="actividades.php">Volver a Actividades</a>
