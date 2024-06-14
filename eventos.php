<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Lista de Eventos</h2>
    <table>
        <tr>
            <th>Nombre del Evento</th>
            <th>Fecha del Evento</th>
            <th>Descripción</th>
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

        $sql = "SELECT nombre_evento, fecha_evento, descripcion FROM evento";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["nombre_evento"]. "</td><td>" . $row["fecha_evento"]. "</td><td>" . $row["descripcion"]. "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No hay eventos</td></tr>";
        }

        $conn->close();
        ?>
    </table>

    <h2>Registrar Nuevo Evento</h2>
    <form action="registrar_evento.php" method="POST">
        <label for="nombre_evento">Nombre del Evento:</label>
        <input type="text" id="nombre_evento" name="nombre_evento" required><br><br>
        <label for="fecha_evento">Fecha del Evento:</label>
        <input type="date" id="fecha_evento" name="fecha_evento" required><br><br>
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion"><br><br>
        <label for="nombre_organizador">Nombre del Organizador:</label>
        <input type="text" id="nombre_organizador" name="nombre_organizador"><br><br>
        <label for="contacto_organizador">Contacto del Organizador:</label>
        <input type="text" id="contacto_organizador" name="contacto_organizador"><br><br>
        <input type="submit" value="Registrar Evento">
    </form>

    <a href="index.php">Volver al Inicio</a>
</body>
</html>
