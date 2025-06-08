<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Thanh Toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>
<body>
    <div class="container">
        <h2>Danh Sách Thanh Toán</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Lớp</th>
                    <th>ID Học Sinh</th>
                    <th>ID Thanh Toán</th>
                    <th>Đã Thanh Toán</th>
                    <th>Ghi Chú Thanh Toán</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <!-- Giả sử bạn lấy dữ liệu thanh toán từ cơ sở dữ liệu -->
                <?php
                include 'connectfbcnpm1.php';

                $sql = "SELECT * FROM payment";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['idclass']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['idStudent']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['paymentId']) . "</td>";
                    echo "<td>" . ($row['isPaid'] == 1 ? 'Đã Thanh Toán' : 'Chưa Thanh Toán') . "</td>";
                    echo "<td>" . htmlspecialchars($row['notePayment']) . "</td>";
                    echo "<td><a href='editPayment.php?idStudent=" . urlencode($row['idStudent']) . "&paymentId=" . urlencode($row['paymentId']) . "' class='btn btn-warning'>Sửa</a></td>";
                    echo "</tr>";
                }

                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
