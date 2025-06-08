<?php
include 'connectfbcnpm1.php';

if (isset($_GET['idStudent'])) {
    $idStudent = $_GET['idStudent'];
    
    $sql = "DELETE FROM student WHERE idStudent = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $idStudent);
    $stmt->execute();
    
    header('Location: main.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xoá Sinh Viên</title>
</head>
<body>
    <h2>Xoá Sinh Viên</h2>
    <p>Bạn có chắc chắn muốn xoá sinh viên này không?</p>
    <a href="main.php" class="btn btn-secondary">Quay Lại</a>
    <a href="DeleteStudent.php?idStudent=<?php echo htmlspecialchars($_GET['idStudent']); ?>" class="btn btn-danger">Xoá</a>
</body>
</html>
