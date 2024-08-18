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

   
    $sql = "DELETE FROM personas WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro eliminado exitosamente";
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }
}

header("Location: index.php");
$conn->close();
?>
