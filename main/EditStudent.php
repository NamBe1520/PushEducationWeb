<?php
include 'connectfbcnpm1.php';

if (isset($_GET['idStudent'])) {
    $idStudent = $_GET['idStudent'];

    // Lấy thông tin sinh viên từ cơ sở dữ liệu
    $sql = "SELECT * FROM student WHERE idStudent = '$idStudent'";
    $result = mysqli_query($conn, $sql);
    $student = mysqli_fetch_assoc($result);

    if (isset($_POST['nameStudent'])) {
        $nameStudent = $_POST['nameStudent'];
        $idUser = $_POST['idUser'];
        $passwordUser = $_POST['passwordUser'];
        $guardianPhone = $_POST['guardianPhone'];
        $referralId = $_POST['referralId'];

        // Cập nhật thông tin sinh viên
        $sql = "UPDATE student 
                SET idUser = '$idUser', passwordUser = '$passwordUser', nameStudent = '$nameStudent', 
                    guardianPhone = '$guardianPhone', referralId = '$referralId'
                WHERE idStudent = '$idStudent'";
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
    <title>Sửa Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>
<body>
    <div class="container">
        <h2>Sửa Sinh Viên</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="idUser" class="form-label">ID Người Dùng:</label>
                <input type="text" id="idUser" name="idUser" class="form-control" value="<?php echo htmlspecialchars($student['idUser']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="passwordUser" class="form-label">Mật Khẩu:</label>
                <input type="password" id="passwordUser" name="passwordUser" class="form-control" value="<?php echo htmlspecialchars($student['passwordUser']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="nameStudent" class="form-label">Tên Sinh Viên:</label>
                <input type="text" id="nameStudent" name="nameStudent" class="form-control" value="<?php echo htmlspecialchars($student['nameStudent']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="guardianPhone" class="form-label">Số Điện Thoại Người Giám Hộ:</label>
                <input type="text" id="guardianPhone" name="guardianPhone" class="form-control" value="<?php echo htmlspecialchars($student['guardianPhone']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="referralId" class="form-label">ID Giới Thiệu:</label>
                <input type="text" id="referralId" name="referralId" class="form-control" value="<?php echo htmlspecialchars($student['referralId']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
            <a href="main.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>
</html>
