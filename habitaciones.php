<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habitaciones</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Lista de Habitaciones</h2>
    <table>
        <tr>
            <th>Número de Habitación</th>
            <th>Piso</th>
            <th>Estado</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gestion_hotel";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        $sql = "SELECT numero_habitacion, piso, estado FROM habitacion";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["numero_habitacion"]. "</td><td>" . $row["piso"]. "</td><td>" . $row["estado"]. "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No hay habitaciones</td></tr>";
        }

        $conn->close();
        ?>
    </table>
    <a href="index.php">Volver al Inicio</a>
</body>
</html>
