<?php
$conexion = mysqli_connect("localhost", "root", "", "integrantes");
// Seleccionar todos los registros de la tabla 'usuarios'
$consulta = "SELECT * FROM integrantes2";
$resultado = mysqli_query($conexion, $consulta);

// Mostrar los datos
echo "<table>";


while ($fila = mysqli_fetch_assoc($resultado)) {
    echo "<tr>"; 
    echo "<td>" . "nombre: " . $fila['nombre_y_apellido'] ."</td>";
    echo "<td>" . "rango: " . $fila['rango'] ."</td>";
    echo "</tr>";
}

echo "</table>";
?>
