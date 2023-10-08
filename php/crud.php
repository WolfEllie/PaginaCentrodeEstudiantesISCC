<?php
// Utilizamos declaraciones preparadas con marcadores (?) para realizar de manera segura las operaciones de inserción, actualización y eliminación de datos.
// Validamos la entrada de datos mediante funciones de PHP como filter_var() y empty() para asegurarnos de que los datos tengan el formato esperado y no estén vacíos.
// Comprobamos el método de solicitud ($_SERVER["REQUEST_METHOD"]) para determinar si se envió un formulario mediante POST antes de procesar la operación CRUD correspondiente.
// Vinculamos parámetros a las declaraciones preparadas utilizando bind_param() para garantizar que la entrada del usuario se trate como datos y no como código SQL ejecutable.
// Manejamos los errores de manera adecuada y proporcionamos mensajes de error apropiados.

include("config.php");


// Crear (Insertar)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["create"])) {
	$nombre = $_POST["nombre"];
	$rango = $_POST["rango"];

    // Validar la entrada (puedes agregar más validaciones según sea necesario)
    if (!empty($nombre) && filter_var($rango)) {
  
				// Crear una declaración preparada
        $stmt = $conexion->prepare("INSERT INTO integrantes2 (nombre_y_apellido, rango) VALUES (?, ?)");
        $stmt->bind_param("ss", $nombre, $rango);

        // Ejecutar la declaración preparada
        if ($stmt->execute()) {
            echo "Registro creado con éxito. \n";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Cerrar la declaración preparada
        $stmt->close();
    } else {
        echo "Datos de entrada inválidos.";
    }
}

// Leer (Seleccionar)
$consulta = "SELECT * FROM integrantes2";
$resultado = $conexion->query($consulta);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "ID: " . $fila["id"] . "<br>"; // generalmente no mostramos públicamente el id
        echo "nombre: " . $fila["nombre"] . "<br>";
        echo "rango: " . $fila["rango"] . "<br>";
        echo "<hr>";
    }
} else {
    echo "No se encontraron registros.";
}

// Actualizar
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update"])) {
    $id = $_POST["id"];
    $nuevoNombre = $_POST["nuevo_nombre"];

    // Validar la entrada
    if (!empty($id) && !empty($nuevoNombre)) {
        // Crear una declaración preparada
        $stmt = $conexion->prepare("UPDATE integrates SET nombre_y_apellido=? WHERE id=?");
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
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])) {
    $id = $_POST["id"];

    // Validar la entrada
    if (!empty($id)) {
        // Crear una declaración preparada
        $stmt = $conexion->prepare("DELETE FROM integrantes WHERE id=?");
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
$conexion->close();
?>
