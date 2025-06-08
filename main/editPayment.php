<?php
include 'connectfbcnpm1.php';

if (isset($_GET['idStudent'])) {
    $idStudent = $_GET['idStudent'];

    // Lấy thông tin từ bảng payment dựa trên idStudent
    $sql = "SELECT * FROM payment WHERE idStudent = '$idStudent'";
    $result = mysqli_query($conn, $sql);
    $payment = mysqli_fetch_assoc($result);

    if (isset($_POST['idclass'])) {
        $idclass = $_POST['idclass'];
        $paymentId = $_POST['paymentId'];
        $isPaid = $_POST['isPaid'];
        $notePayment = $_POST['notePayment'];

        // Cập nhật thông tin vào bảng payment
        $sql = "UPDATE payment 
                SET idclass = '$idclass', isPaid = '$isPaid', notePayment = '$notePayment'
                WHERE idStudent = '$idStudent' AND paymentId = '$paymentId'";
        
        if (mysqli_query($conn, $sql)) {
            header("Location: main.php");
            exit();
        } else {
            echo "Lỗi khi cập nhật: " . mysqli_error($conn);
        }
    }
} else {
    header("Location: main.php");
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Thanh Toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>
<body>
    <div class="container">
        <h2>Sửa Thông Tin Thanh Toán</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="idclass" class="form-label">ID Lớp:</label>
                <input type="text" id="idclass" name="idclass" class="form-control" value="<?php echo htmlspecialchars($payment['idclass']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="idStudent" class="form-label">ID Học Sinh:</label>
                <input type="text" id="idStudent" name="idStudent" class="form-control" value="<?php echo htmlspecialchars($payment['idStudent']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="paymentId" class="form-label">Mã Thanh Toán:</label>
                <input type="text" id="paymentId" name="paymentId" class="form-control" value="<?php echo htmlspecialchars($payment['paymentId']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="isPaid" class="form-label">Trạng Thái Thanh Toán:</label>
                <select id="isPaid" name="isPaid" class="form-control" required>
                    <option value="1" <?php if ($payment['isPaid'] == 1) echo 'selected'; ?>>Đã Thanh Toán</option>
                    <option value="0" <?php if ($payment['isPaid'] == 0) echo 'selected'; ?>>Chưa Thanh Toán</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="notePayment" class="form-label">Ghi Chú Thanh Toán:</label>
                <input type="text" id="notePayment" name="notePayment" class="form-control" value="<?php echo htmlspecialchars($payment['notePayment']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
            <a href="main.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>
</html>
