<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Lista de Empleados</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Puesto</th>
            <th>Salario</th>
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

        $sql = "SELECT nombre, apellido, email, telefono, puesto, salario FROM empleado";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["nombre"]. "</td><td>" . $row["apellido"]. "</td><td>" . $row["email"]. "</td><td>" . $row["telefono"]. "</td><td>" . $row["puesto"]. "</td><td>" . $row["salario"]. "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay empleados</td></tr>";
        }

        $conn->close();
        ?>
    </table>

    <h2>Registrar Nuevo Empleado</h2>
    <form action="registrar_empleado.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required><br><br>
        <label for="puesto">Puesto:</label>
        <input type="text" id="puesto" name="puesto" required><br><br>
        <label for="salario">Salario:</label>
        <input type="text" id="salario" name="salario" required><br><br>
        <input type="submit" value="Registrar Empleado">
    </form>

    <a href="index.php">Volver al Inicio</a>
</body>
</html>
