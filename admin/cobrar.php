<?php
// Conexión a la base de datos
include 'dbcon.php';

// Insertar el cobro en la base de datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $monto = $_POST['monto'];
    $fecha = date('Y-m-d');

    $stmt = $con->prepare("INSERT INTO pagos (fecha, valor) VALUES (?, ?)");
    $stmt->bind_param('sd', $fecha, $monto);

    if ($stmt->execute()) {
        echo "Cobro registrado con éxito.";
    } else {
        echo "Error al registrar el cobro.";
    }

    $stmt->close();
    $con->close();
}
?>