<?php
include 'connectfbcnpm1.php'; 

$results = [];

$sql = "
    SELECT idUser, passwordUser
    FROM student
    UNION
    SELECT idUser, passwordUser
    FROM teacher;
";

if ($stmt = $conn->prepare($sql)) {
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }

    $stmt->close();
} else {
    echo "Lỗi trong câu truy vấn: " . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Người Dùng</title>
</head>
<body>
    <h2>Thông Tin Người Dùng</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID User</th>
                <th>Mật khẩu</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($results)): ?>
                <?php foreach ($results as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['idUser']); ?></td>
                        <td><?php echo htmlspecialchars($row['passwordUser']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2">Không có thông tin người dùng nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
