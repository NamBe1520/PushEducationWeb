<?php
include 'connectfbcnpm1.php';

if (isset($_GET['idTeacher'])) {
    $idTeacher = $_GET['idTeacher'];
    
    $sql = "DELETE FROM teacher WHERE idTeacher = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $idTeacher);
    $stmt->execute();
    
    header('Location: main.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xoá Giáo Viên</title>
</head>
<body>
    <h2>Xoá Giáo Viên</h2>
    <p>Bạn có chắc chắn muốn xoá giáo viên này không?</p>
    <a href="main.php" class="btn btn-secondary">Quay Lại</a>
    <a href="DeleteTeacher.php?idTeacher=<?php echo htmlspecialchars($_GET['idTeacher']); ?>" class="btn btn-danger">Xoá</a>
</body>
</html>
