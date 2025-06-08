<?php
include 'connectfbcnpm1.php';

if (isset($_GET['idStudent']) && isset($_GET['idclass'])) {
    $idStudent = $_GET['idStudent'];
    $idclass = $_GET['idclass'];

    $sql_payment = "SELECT isPaid FROM studentClass WHERE idStudent = '$idStudent' AND idclass = '$idclass'";
    $result_payment = mysqli_query($conn, $sql_payment);
    $payment_data = mysqli_fetch_assoc($result_payment);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $isPaid = $_POST['isPaid'];
        $notePayment = $_POST['notePayment'];


        $sql_update_payment = "INSERT INTO payment (idStudent, idclass, isPaid, notePayment) 
                               VALUES ('$idStudent', '$idclass', '$isPaid', '$notePayment') 
                               ON DUPLICATE KEY UPDATE 
                               isPaid = VALUES(isPaid), 
                               notePayment = VALUES(notePayment)";
        mysqli_query($conn, $sql_update_payment);

 
        if (mysqli_affected_rows($conn) > 0) {
            header("Location: main.php");
            exit();
        } else {
            echo "Lỗi: Không thể lưu thông tin thanh toán.";
        }
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
    <title>Thanh Toán Học Sinh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>
<body>
    <div class="container">
        <h2>Thanh Toán Học Sinh</h2>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="isPaid" class="form-label">Trạng Thái Thanh Toán:</label>
                <select id="isPaid" name="isPaid" class="form-select" required>
                    <option value="0" <?php echo ($payment_data['isPaid'] == 0) ? 'selected' : ''; ?>>Chưa Thanh Toán</option>
                    <option value="1" <?php echo ($payment_data['isPaid'] == 1) ? 'selected' : ''; ?>>Đã Thanh Toán</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="notePayment" class="form-label">Ghi Chú Thanh Toán:</label>
                <input type="text" id="notePayment" name="notePayment" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Lưu Thông Tin Thanh Toán</button>
            <a href="main.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>
</html>
