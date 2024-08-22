<?php
include 'dbcon.php';

if (isset($_POST['cedula'])) {
    $cedula = $_POST['cedula'];

    $query = "SELECT COUNT(*) as count FROM members WHERE username = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    echo json_encode(['exists' => $count > 0]);
}
?>