<?php
include 'connectfbcnpm1.php';


if (isset($_GET['idTeacher'])) {
    $idTeacher = $_GET['idTeacher'];

    $sql = "SELECT * FROM teacher WHERE idTeacher = '$idTeacher'";
    $result = mysqli_query($conn, $sql);
    $teacher = mysqli_fetch_assoc($result);

    if (isset($_POST['nameTeacher'])) {
        $nameTeacher = $_POST['nameTeacher'];
        $idUser = $_POST['idUser'];
        $passwordUser = $_POST['passwordUser'];
        $dateJoin = $_POST['dateJoin'];
        $sdtTeacher = $_POST['sdtTeacher'];

        $sql = "UPDATE teacher 
                SET idUser = '$idUser', passwordUser = '$passwordUser', nameTeacher = '$nameTeacher', 
                    dateJoin = '$dateJoin', sdtTeacher = '$sdtTeacher'
                WHERE idTeacher = '$idTeacher'";
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
    <title>Sửa Giáo Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>
<body>
    <div class="container">
        <h2>Sửa Giáo Viên</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="idUser" class="form-label">ID Người Dùng:</label>
                <input type="text" id="idUser" name="idUser" class="form-control" value="<?php echo htmlspecialchars($teacher['idUser']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="passwordUser" class="form-label">Mật Khẩu:</label>
                <input type="password" id="passwordUser" name="passwordUser" class="form-control" value="<?php echo htmlspecialchars($teacher['passwordUser']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="nameTeacher" class="form-label">Tên Giáo Viên:</label>
                <input type="text" id="nameTeacher" name="nameTeacher" class="form-control" value="<?php echo htmlspecialchars($teacher['nameTeacher']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="dateJoin" class="form-label">Ngày Gia Nhập:</label>
                <input type="date" id="dateJoin" name="dateJoin" class="form-control" value="<?php echo htmlspecialchars($teacher['dateJoin']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="sdtTeacher" class="form-label">Số Điện Thoại:</label>
                <input type="text" id="sdtTeacher" name="sdtTeacher" class="form-control" value="<?php echo htmlspecialchars($teacher['sdtTeacher']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
            <a href="main.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>
</html>
