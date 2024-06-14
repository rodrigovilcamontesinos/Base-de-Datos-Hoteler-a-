<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Lista de Reservas</h2>
    <table>
        <tr>
            <th>Cliente</th>
            <th>Habitación</th>
            <th>Fecha de Entrada</th>
            <th>Fecha de Salida</th>
            <th>Monto Total</th>
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

        $sql = "SELECT r.reserva_id, c.nombre, c.apellido, h.numero_habitacion, r.fecha_entrada, r.fecha_salida, r.monto_total, r.estado 
                FROM reserva r
                JOIN cliente c ON r.cliente_id = c.cliente_id
                JOIN habitacion h ON r.habitacion_id = h.habitacion_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["nombre"]. " " . $row["apellido"]. "</td><td>" . $row["numero_habitacion"]. "</td><td>" . $row["fecha_entrada"]. "</td><td>" . $row["fecha_salida"]. "</td><td>" . $row["monto_total"]. "</td><td>" . $row["estado"]. "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay reservas</td></tr>";
        }

        $conn->close();
        ?>
    </table>

    <h2>Registrar Nueva Reserva</h2>
    <form action="registrar_reserva.php" method="POST">
        <label for="cliente_id">Cliente:</label>
        <select id="cliente_id" name="cliente_id">
            <?php
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = "SELECT cliente_id, nombre, apellido FROM cliente";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["cliente_id"] . "'>" . $row["nombre"] . " " . $row["apellido"] . "</option>";
                }
            }
            $conn->close();
            ?>
        </select><br><br>
        <label for="habitacion_id">Habitación:</label>
        <select id="habitacion_id" name="habitacion_id">
            <?php
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = "SELECT habitacion_id, numero_habitacion FROM habitacion WHERE estado = 'Disponible'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["habitacion_id"] . "'>" . $row["numero_habitacion"] . "</option>";
                }
            }
            $conn->close();
            ?>
        </select><br><br>
        <label for="fecha_entrada">Fecha de Entrada:</label>
        <input type="date" id="fecha_entrada" name="fecha_entrada" required><br><br>
        <label for="fecha_salida">Fecha de Salida:</label>
        <input type="date" id="fecha_salida" name="fecha_salida" required><br><br>
        <label for="monto_total">Monto Total:</label>
        <input type="text" id="monto_total" name="monto_total" required><br><br>
        <input type="submit" value="Registrar Reserva">
    </form>

    <a href="index.php">Volver al Inicio</a>
</body>
</html>
