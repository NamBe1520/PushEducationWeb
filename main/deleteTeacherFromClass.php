<?php
include 'connectfbcnpm1.php';

if (isset($_GET['idTeacher']) && isset($_GET['idclass'])) {
    $idTeacher = $_GET['idTeacher'];
    $idclass = $_GET['idclass'];

    $sql_delete = "DELETE FROM classShift 
                   WHERE idTeacher = '$idTeacher' AND idclass = '$idclass'";
    if (mysqli_query($conn, $sql_delete)) {
        header("Location: rollcall.php?idclass=$idclass");
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
} else {
    echo "Thiếu thông tin cần thiết!";
}
?>
