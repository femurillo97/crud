<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_personas";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "SELECT * FROM personas WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Registro no encontrado";
        exit;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $dni = $_POST["dni"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];

    $sql = "UPDATE personas SET nombre='$nombre', dni='$dni', fecha_nacimiento='$fecha_nacimiento', correo='$correo', telefono='$telefono' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro actualizado exitosamente";
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Persona</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Editar Persona</h1>
    <form action="" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required>

        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" value="<?php echo $row['dni']; ?>" required>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $row['fecha_nacimiento']; ?>" required>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" value="<?php echo $row['correo']; ?>" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" value="<?php echo $row['telefono']; ?>" required>

        <input type="submit" value="Actualizar Persona">
    </form>
</body>
</html>

<?php
$conn->close();
?>
