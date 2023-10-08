<?php
header("Content-Type: application/json");

// Conexión a la base de datos
$mysqli = new mysqli("localhost", "root", "", "integrantes");

if ($mysqli->connect_error) {
    die("Error en la conexión a la base de datos: " . $mysqli->connect_error);
}

// Definir una función para obtener todos los usuarios
function obtenerUsuarios($mysqli) {
    $usuarios = array();
    $query = "SELECT id, nombre_y_apellido, rango FROM integrantes2";
    $result = $mysqli->query($query);

    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }

    return $usuarios;
}

// Manejo de solicitudes
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Si es una solicitud GET, devuelve la lista de usuarios
    $usuarios = obtenerUsuarios($mysqli);
    echo json_encode($usuarios);
}

$mysqli->close();
?>
