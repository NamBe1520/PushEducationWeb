<?php
include 'connectfbcnpm1.php';

if (isset($_GET['idStudent']) && isset($_GET['idclass']) && isset($_GET['dateRollCall'])) {
    $idStudent = $_GET['idStudent'];
    $idclass = $_GET['idclass'];
    $dateRollCall = $_GET['dateRollCall'];

    $sql = "DELETE FROM rollcall WHERE idStudent = ? AND idclass = ? AND dateRollCall = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iis', $idStudent, $idclass, $dateRollCall);
    $stmt->execute();
    
    header("Location: rollcallDetails.php?idclass=$idclass&dateRollCall=$dateRollCall");
    exit();
} else {
    header("Location: rollcall.php");
    exit();
}
