<?php
// Establecer una conexión a la base de datos
// $conexion = mysqli_connect("localhost", "usuario", "contraseña", "base_de_datos");
$conexion = mysqli_connect("localhost", "root", "", "integrantes");

// Comprobar la conexión y devolver error
if (mysqli_connect_errno()) {
    die("La conexión a la base de datos falló: " . mysqli_connect_error());
}

// Insertar datos en la tabla 'usuarios'
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["crear"])) {
	$nombre = $_POST["nombre"];
	$rango = $_POST["rango"];

				// Crear una declaración preparada
        $stmt = $conexion->prepare("INSERT INTO integrantes2 (nombre_y_apellido, rango) VALUES (?, ?)");
        $stmt->bind_param("ss", $nombre, $rango);

        // Ejecutar la declaración preparada
        if ($stmt->execute()) {
            echo "Registro creado con éxito. \n";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Datos de entrada inválidos.";
    }

    
// Leer (Seleccionar)
    $consulta = "SELECT * FROM integrantes2";
    $resultado = $conexion->query($consulta);
    
    if ($resultado->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>Nombre</th><th>Rango</th></tr>';

        while ($fila = $resultado->fetch_assoc()) {
            echo "ID: " . $fila["id"] . "<br>"; // generalmente no mostramos públicamente el id
            echo "nombre: " . $fila["nombre_y_apellido"] . "<br>";
            echo "rango: " . $fila["rango"] . "<br>";
            echo "<hr>";
        }
        echo '</table>';

    } else {
        echo "No se encontraron registros.";
    }
    

    // Actualizar
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["modificar"])) {
    $id = $_POST["id"];
    $nuevoNombre = $_POST["nuevo_nombre"];

    // Validar la entrada
    if (!empty($id) && !empty($nuevoNombre)) {
        // Crear una declaración preparada
        $stmt = $conexion->prepare("UPDATE integrantes2 SET nombre_y_apellido =? WHERE id=?");
        $stmt->bind_param("si", $nuevoNombre, $id);

        // Ejecutar la declaración preparada
        if ($stmt->execute()) {
            echo "Registro actualizado con éxito. \n";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Cerrar la declaración preparada
        $stmt->close();
    } else {
        echo "Datos de entrada inválidos.";
    }
}



// Eliminar
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["eliminar"])) {
    $id = $_POST["id"];

    // Validar la entrada
    if (!empty($id)) {
        // Crear una declaración preparada
        $stmt = $conexion->prepare("DELETE FROM integrantes2 WHERE id=?");
        $stmt->bind_param("i", $id);

        // Ejecutar la declaración preparada
        if ($stmt->execute()) {
            echo "Registro eliminado con éxito. \n";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Cerrar la declaración preparada
        $stmt->close();
    } else {
        echo "Datos de entrada inválidos.";
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>






