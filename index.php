<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_personas";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $dni = $_POST["dni"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];

    $sql = "INSERT INTO personas (nombre, dni, fecha_nacimiento, correo, telefono) 
            VALUES ('$nombre', '$dni', '$fecha_nacimiento', '$correo', '$telefono')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo registro creado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$sql = "SELECT * FROM personas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Personas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>CRUD de Personas</h1>
    <form action="index.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required>

        <input type="submit" value="Agregar Persona">
    </form>

    <h2>Lista de Personas</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>DNI</th>
            <th>Fecha de Nacimiento</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row["id"]."</td>
                        <td>".$row["nombre"]."</td>
                        <td>".$row["dni"]."</td>
                        <td>".$row["fecha_nacimiento"]."</td>
                        <td>".$row["correo"]."</td>
                        <td>".$row["telefono"]."</td>
                        <td>
                            <a href='editar.php?id=".$row["id"]."'>Editar</a> | 
                            <a href='eliminar.php?id=".$row["id"]."'>Eliminar</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No hay personas registradas</td></tr>";
        }
        ?>
    </table>
    <script src="script.js"></script>
</body>
</html>

<?php
$conn->close();
?>
