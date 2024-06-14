<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_hotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre_articulo = $_POST['nombre_articulo'];
$descripcion = $_POST['descripcion'];
$cantidad = $_POST['cantidad'];
$proveedor_id = $_POST['proveedor_id'];

$sql = "INSERT INTO inventario (nombre_articulo, descripcion, cantidad, proveedor_id) VALUES ('$nombre_articulo', '$descripcion', '$cantidad', '$proveedor_id')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo artículo de inventario registrado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<a href="inventarios.php">Volver a Inventarios</a>
