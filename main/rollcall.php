<?php
include 'connectfbcnpm1.php';

if (isset($_GET['idclass'])) {
    $idclass = $_GET['idclass'];

    // Lấy danh sách học sinh trong lớp
    $sql_students = "SELECT * FROM studentClass
                     JOIN student ON studentClass.idStudent = student.idStudent
                     WHERE studentClass.idclass = '$idclass'";
    $result_students = mysqli_query($conn, $sql_students);
    $students = mysqli_fetch_all($result_students, MYSQLI_ASSOC);

    // Lấy thông tin giáo viên phụ trách lớp
    $sql_teachers = "SELECT teacher.nameTeacher, teacher.idTeacher 
                     FROM teacher
                     JOIN classShift ON teacher.idTeacher = classShift.idTeacher
                     WHERE classShift.idclass = '$idclass'";
    $result_teachers = mysqli_query($conn, $sql_teachers);
    $teachers = mysqli_fetch_all($result_teachers, MYSQLI_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dateRollCall = $_POST['dateRollCall'];
    $idclass = $_POST['idclass'];

    foreach ($_POST['idStudent'] as $index => $idStudent) {
        $statusRollCall = $_POST['statusRollCall'][$index];
        $note = $_POST['note'][$index];

        // Thêm dữ liệu vào bảng rollcall
        $sql = "INSERT INTO rollcall (idStudent, dateRollCall, note, idclass, statusRollCall) 
                VALUES ('$idStudent', '$dateRollCall', '$note', '$idclass', '$statusRollCall')";
        mysqli_query($conn, $sql);
    }

    echo "Điểm danh thành công!";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Điểm danh</title>
</head>
<body>
<div class="container">
    <h2>Điểm danh lớp</h2>

    <form action="rollcall.php?idclass=<?php echo $idclass; ?>" method="POST">
        <input type="hidden" name="idclass" value="<?php echo $idclass; ?>">

        <div class="mb-3">
            <label for="dateRollCall" class="form-label">Ngày điểm danh:</label>
            <input type="date" id="dateRollCall" name="dateRollCall" class="form-control" required>
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên học sinh</th>
                <th>Điểm danh</th>
                <th>Ghi chú</th>
                <th>Số buổi có mặt</th>
                <th>Số buổi vắng</th>
                <th>Chi tiết điểm danh</th>
    
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($students)): ?>
                <?php foreach ($students as $index => $student): ?>
                    <?php
                    $idStudent = $student['idStudent'];
                    $sql_rollcall = "SELECT 
                                        SUM(CASE WHEN statusRollCall = 1 THEN 1 ELSE 0 END) AS buoi_co_mat,
                                        SUM(CASE WHEN statusRollCall = 0 THEN 1 ELSE 0 END) AS buoi_vang 
                                    FROM rollcall 
                                    WHERE idStudent = '$idStudent' AND idclass = '$idclass'";
                    $result_rollcall = mysqli_query($conn, $sql_rollcall);
                    $rollcall_info = mysqli_fetch_assoc($result_rollcall);
                    ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($student['nameStudent']); ?></td>
                        <td>
                            <input type="hidden" name="idStudent[]" value="<?php echo $student['idStudent']; ?>">
                            <select name="statusRollCall[]" class="form-select" required>
                                <option value="1">Có mặt</option>
                                <option value="0">Vắng</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" name="note[]" class="form-control" placeholder="Ghi chú">
                        </td>
                        <td><?php echo $rollcall_info['buoi_co_mat']; ?></td>
                        <td><?php echo $rollcall_info['buoi_vang']; ?></td>
                        <td>
                            <a href="viewRollCallDetails.php?idStudent=<?php echo $student['idStudent']; ?>&idclass=<?php echo $idclass; ?>" class="btn btn-info">Xem chi tiết</a>                    
                            <a href="deleteStudentFromClass.php?idStudent=<?php echo $student['idStudent']; ?>&idclass=<?php echo $idclass; ?>" class="btn btn-danger">Xóa học sinh khỏi lớp</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Không có học sinh nào trong lớp này.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>

        <div class="mb-3">
            <label for="teacher" class="form-label">Giáo viên phụ trách:</label>
            <ul>
                <?php if (!empty($teachers)): ?>
                    <?php foreach ($teachers as $teacher): ?>
                        <li>
                            <?php echo htmlspecialchars($teacher['nameTeacher']); ?>
                            <a href="deleteTeacherFromClass.php?idTeacher=<?php echo $teacher['idTeacher']; ?>&idclass=<?php echo $idclass; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa giáo viên này khỏi lớp?');">Xóa</a>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>Không có giáo viên nào cho lớp này.</li>
                <?php endif; ?>
            </ul>
        </div>

        <button type="submit" class="btn btn-primary">Lưu điểm danh</button>
        <a href="main.php" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
</body>
</html>
