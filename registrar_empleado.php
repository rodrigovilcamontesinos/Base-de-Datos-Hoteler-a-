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
$puesto = $_POST['puesto'];
$salario = $_POST['salario'];

$sql = "INSERT INTO empleado (nombre, apellido, email, telefono, puesto, salario) VALUES ('$nombre', '$apellido', '$email', '$telefono', '$puesto', '$salario')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo empleado registrado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<a href="empleados.php">Volver a Empleados</a>
