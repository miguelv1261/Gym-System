<?php
include 'dbcon.php';

// Obtener el total cobrado hoy
$fecha = date('Y-m-d');
$resultado = $con->query("SELECT SUM(valor) AS total FROM pagos WHERE fecha = '$fecha'");

if ($fila = $resultado->fetch_assoc()) {
    echo "Total cobrado hoy: $" . number_format($fila['total'], 2);
} else {
    echo "No se ha registrado ningún cobro hoy.";
}

$con->close();
?>