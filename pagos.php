<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Lista de Pagos</h2>
    <table>
        <tr>
            <th>ID de Pago</th>
            <th>ID de Reserva</th>
            <th>Fecha de Pago</th>
            <th>Monto</th>
            <th>Método de Pago</th>
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

        $sql = "SELECT pago_id, reserva_id, fecha_pago, monto, metodo_pago FROM pago";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["pago_id"]. "</td><td>" . $row["reserva_id"]. "</td><td>" . $row["fecha_pago"]. "</td><td>" . $row["monto"]. "</td><td>" . $row["metodo_pago"]. "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay pagos</td></tr>";
        }

        $conn->close();
        ?>
    </table>

    <h2>Registrar Nuevo Pago</h2>
    <form action="registrar_pago.php" method="POST">
        <label for="reserva_id">Reserva:</label>
        <select id="reserva_id" name="reserva_id">
            <?php
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = "SELECT reserva_id, fecha_entrada, fecha_salida FROM reserva";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["reserva_id"] . "'>Reserva ID: " . $row["reserva_id"] . " (" . $row["fecha_entrada"] . " - " . $row["fecha_salida"] . ")</option>";
                }
            }
            $conn->close();
            ?>
        </select><br><br>
        <label for="fecha_pago">Fecha de Pago:</label>
        <input type="date" id="fecha_pago" name="fecha_pago" required><br><br>
        <label for="monto">Monto:</label>
        <input type="text" id="monto" name="monto" required><br><br>
        <label for="metodo_pago">Método de Pago:</label>
        <input type="text" id="metodo_pago" name="metodo_pago" required><br><br>
        <input type="submit" value="Registrar Pago">
    </form>

    <a href="index.php">Volver al Inicio</a>
</body>
</html>
