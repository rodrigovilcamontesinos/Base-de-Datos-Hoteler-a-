<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividades</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Lista de Actividades</h2>
    <table>
        <tr>
            <th>Nombre de la Actividad</th>
            <th>Descripción</th>
            <th>Fecha de la Actividad</th>
            <th>Costo</th>
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

        $sql = "SELECT nombre_actividad, descripcion, fecha_actividad, costo FROM actividad";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["nombre_actividad"]. "</td><td>" . $row["descripcion"]. "</td><td>" . $row["fecha_actividad"]. "</td><td>" . $row["costo"]. "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No hay actividades</td></tr>";
        }

        $conn->close();
        ?>
    </table>

    <h2>Registrar Nueva Actividad</h2>
    <form action="registrar_actividad.php" method="POST">
        <label for="nombre_actividad">Nombre de la Actividad:</label>
        <input type="text" id="nombre_actividad" name="nombre_actividad" required><br><br>
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion"><br><br>
        <label for="fecha_actividad">Fecha de la Actividad:</label>
        <input type="date" id="fecha_actividad" name="fecha_actividad" required><br><br>
        <label for="costo">Costo:</label>
        <input type="text" id="costo" name="costo" required><br><br>
        <input type="submit" value="Registrar Actividad">
    </form>

    <a href="index.php">Volver al Inicio</a>
</body>
</html>
