<?php
include 'connectfbcnpm1.php';

if (isset($_GET['idclass'])) {
    $idclass = $_GET['idclass'];

    $sql = "DELETE FROM class WHERE idclass = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $idclass);
    $stmt->execute();

    header('Location: main.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xoá Lớp</title>
</head>
<body>
    <h2>Xoá Lớp</h2>
    <p>Bạn có chắc chắn muốn xoá lớp này không?</p>
    <a href="main.php" class="btn btn-secondary">Quay Lại</a>
    <a href="DeleteClass.php?idclass=<?php echo htmlspecialchars($_GET['idclass']); ?>" class="btn btn-danger">Xoá</a>
</body>
</html>
