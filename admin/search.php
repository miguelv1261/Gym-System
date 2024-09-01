<?php

if (isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];

    // Conectar a la base de datos
    include 'dbcon.php';

    // Buscar al usuario basado en la cédula
    $qry = "SELECT * FROM members WHERE username='$cedula'";
    $result = mysqli_query($con,$qry);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];

        // Redirigir al perfil del usuario
        header("Location: ver-member.php?cedula=" . urlencode($username));
        exit();
    } else {
        echo "Usuario no encontrado.";
    }
}
?>