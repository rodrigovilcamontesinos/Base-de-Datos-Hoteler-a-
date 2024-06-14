<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventarios</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Lista de Inventarios</h2>
    <table>
        <tr>
            <th>Nombre del Artículo</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Proveedor</th>
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

        $sql = "SELECT i.nombre_articulo, i.descripcion, i.cantidad, p.nombre_empresa 
                FROM inventario i 
                LEFT JOIN proveedor p ON i.proveedor_id = p.proveedor_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["nombre_articulo"]. "</td><td>" . $row["descripcion"]. "</td><td>" . $row["cantidad"]. "</td><td>" . $row["nombre_empresa"]. "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No hay inventarios</td></tr>";
        }

        $conn->close();
        ?>
    </table>

    <h2>Registrar Nuevo Artículo</h2>
    <form action="registrar_inventario.php" method="POST">
        <label for="nombre_articulo">Nombre del Artículo:</label>
        <input type="text" id="nombre_articulo" name="nombre_articulo" required><br><br>
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion"><br><br>
        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" required><br><br>
        <label for="proveedor_id">Proveedor:</label>
        <select id="proveedor_id" name="proveedor_id">
            <?php
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = "SELECT proveedor_id, nombre_empresa FROM proveedor";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["proveedor_id"] . "'>" . $row["nombre_empresa"] . "</option>";
                }
            }
            $conn->close();
            ?>
        </select><br><br>
        <input type="submit" value="Registrar Artículo">
    </form>

    <a href="index.php">Volver al Inicio</a>
</body>
</html>
