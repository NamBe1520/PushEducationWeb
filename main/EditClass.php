<?php
include 'connectfbcnpm1.php';

if (isset($_GET['idclass'])) {
    $idclass = $_GET['idclass'];

    $sql = "SELECT * FROM class WHERE idclass = '$idclass'";
    $result = mysqli_query($conn, $sql);
    $class = mysqli_fetch_assoc($result);

    if (isset($_POST['nameClass'])) {
        $nameClass = $_POST['nameClass'];
        $schedule = $_POST['schedule'];
        $startDate = $_POST['startDate'];
        $duration = $_POST['duration'];
        $classFee = $_POST['classFee'];

        $sql = "UPDATE class 
                SET nameClass = '$nameClass', schedule = '$schedule', startDate = '$startDate', 
                    duration = '$duration', classFee = '$classFee'
                WHERE idclass = '$idclass'";
        mysqli_query($conn, $sql);

        header("Location: main.php");
        exit();
    }
} else {
    header("Location: main.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Lớp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>
<body>
    <div class="container">
        <h2>Sửa Lớp</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="nameClass" class="form-label">Tên Lớp:</label>
                <input type="text" id="nameClass" name="nameClass" class="form-control" value="<?php echo htmlspecialchars($class['nameClass']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="schedule" class="form-label">Lịch Học:</label>
                <input type="text" id="schedule" name="schedule" class="form-control" value="<?php echo htmlspecialchars($class['schedule']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="startDate" class="form-label">Ngày Bắt Đầu:</label>
                <input type="date" id="startDate" name="startDate" class="form-control" value="<?php echo htmlspecialchars($class['startDate']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Thời Gian:</label>
                <input type="text" id="duration" name="duration" class="form-control" value="<?php echo htmlspecialchars($class['duration']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="classFee" class="form-label">Học Phí:</label>
                <input type="text" id="classFee" name="classFee" class="form-control" value="<?php echo htmlspecialchars($class['classFee']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
            <a href="main.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>
</html>
