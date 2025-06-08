<?php
include 'connectfbcnpm1.php';

if (isset($_GET['idStudent']) && isset($_GET['idclass'])) {
    $idStudent = $_GET['idStudent'];
    $idclass = $_GET['idclass'];

    $sql = "DELETE FROM studentClass WHERE idStudent = ? AND idclass = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $idStudent, $idclass);
    $stmt->execute();

    header("Location: rollcall.php?idclass=" . $idclass);
    exit();
} else {
    header("Location: main.php");
    exit();
}
