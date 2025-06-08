<?php
include 'connectfbcnpm1.php';

$student = null;

// Nhận idStudent từ form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idStudent'])) {
    $idStudent = $_POST['idStudent'];

    $sql = "SELECT idStudent, idUser, passwordUser, nameStudent, guardianPhone, referralId 
            FROM student 
            WHERE idStudent = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $idStudent);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $student = $result->fetch_assoc();
        }

        $stmt->close();
    } else {
        echo "Lỗi truy vấn: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm học sinh</title>
</head>
<body>
    <div class="collapse" id="SearchStudent"> 
        <h2>Tìm kiếm học sinh</h2>
        <form action="search_student.php" method="post">
            <label for="idStudent">Nhập ID học sinh:</label>
            <input type="text" id="idStudent" name="idStudent" required>
            <button type="submit">Tìm kiếm</button>
        </form>

        <h1>Kết quả tìm kiếm học sinh</h1>

        <?php if ($student): ?>
            <h2>Thông tin học sinh</h2>
            <table border="1">
                <tr>
                    <th>ID Học Sinh</th>
                    <th>ID Người Dùng</th>
                    <th>Mật Khẩu</th>
                    <th>Tên Học Sinh</th>
                    <th>Số Điện Thoại Người Giám Hộ</th>
                    <th>ID Người Giới Thiệu</th>
                </tr>
                <tr>
                    <td><?php echo htmlspecialchars($student['idStudent']); ?></td>
                    <td><?php echo htmlspecialchars($student['idUser']); ?></td>
                    <td><?php echo htmlspecialchars($student['passwordUser']); ?></td>
                    <td><?php echo htmlspecialchars($student['nameStudent']); ?></td>
                    <td><?php echo htmlspecialchars($student['guardianPhone']); ?></td>
                    <td><?php echo htmlspecialchars($student['referralId']); ?></td>
                </tr>
            </table>
        <?php else: ?>
            <p>Không tìm thấy học sinh với ID đã nhập.</p>
        <?php endif; ?>
    </div>
</body>
</html>
