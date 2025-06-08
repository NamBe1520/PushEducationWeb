<?php
include 'connectfbcnpm1.php';

if (isset($_GET['idclass'])) {
    $idclass = $_GET['idclass'];
    $dateRollCall = $_GET['dateRollCall'];

    $sql_students = "SELECT student.idStudent, student.nameStudent, rollcall.note, rollcall.statusRollCall 
                     FROM student
                     JOIN studentClass ON student.idStudent = studentClass.idStudent
                     LEFT JOIN rollcall ON student.idStudent = rollcall.idStudent 
                     AND rollcall.idclass = studentClass.idclass 
                     AND rollcall.dateRollCall = '$dateRollCall'
                     WHERE studentClass.idclass = '$idclass'";
    $result_students = mysqli_query($conn, $sql_students);
    $students = mysqli_fetch_all($result_students, MYSQLI_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach ($_POST['students'] as $student_id => $student_data) {
            $note = $student_data['note'];
            $statusRollCall = $student_data['statusRollCall'];

            $sql_update = "REPLACE INTO rollcall (idStudent, idclass, dateRollCall, note, statusRollCall)
                           VALUES ('$student_id', '$idclass', '$dateRollCall', '$note', '$statusRollCall')";
            mysqli_query($conn, $sql_update);
        }

        header("Location: rollcall.php?idclass=" . $idclass);
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
    <title>Sửa Điểm Danh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>
<body>
    <div class="container">
        <h2>Sửa Điểm Danh</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="dateRollCall" class="form-label">Ngày Điểm Danh:</label>
                <input type="date" id="dateRollCall" name="dateRollCall" class="form-control" value="<?php echo htmlspecialchars($dateRollCall); ?>" readonly>
            </div>
            <h4>Danh Sách Học Sinh:</h4>
            <?php if (!empty($students)): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tên Học Sinh</th>
                            <th>Ghi Chú</th>
                            <th>Trạng Thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($student['nameStudent']); ?></td>
                                <td>
                                    <input type="text" name="students[<?php echo $student['idStudent']; ?>][note]" class="form-control" value="<?php echo htmlspecialchars($student['note']); ?>">
                                </td>
                                <td>
                                    <select name="students[<?php echo $student['idStudent']; ?>][statusRollCall]" class="form-select">
                                        <option value="0" <?php if ($student['statusRollCall'] == 0) echo 'selected'; ?>>Vắng</option>
                                        <option value="1" <?php if ($student['statusRollCall'] == 1) echo 'selected'; ?>>Có Mặt</option>
                                    </select>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Không có học sinh nào trong lớp này.</p>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary mt-3">Lưu Thay Đổi</button>
            <a href="rollcall.php?idclass=<?php echo htmlspecialchars($idclass); ?>" class="btn btn-secondary mt-3">Hủy</a>
        </form>
    </div>
</body>
</html>
