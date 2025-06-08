<?php
include 'connectfbcnpm1.php';

// add giáo viên
if (isset($_POST['idTeacher']) && isset($_POST['idUser']) && isset($_POST['passwordUser']) && isset($_POST['nameTeacher']) && isset($_POST['dateJoin']) && isset($_POST['sdtTeacher']) && isset($_POST['role'])) {
      $idTeacher = $_POST['idTeacher'];
      $idUser = $_POST['idUser'];
      $passwordUser = $_POST['passwordUser'];
      $nameTeacher = $_POST['nameTeacher'];
      $dateJoin = $_POST['dateJoin'];
      $sdtTeacher = $_POST['sdtTeacher'];
      $role = $_POST['role'];

      $hashedPassword = password_hash($passwordUser, PASSWORD_DEFAULT);
      $sql = "INSERT INTO teacher (idTeacher, idUser, passwordUser, nameTeacher, dateJoin, sdtTeacher) 
            VALUES ('$idTeacher', '$idUser', '$passwordUser', '$nameTeacher', '$dateJoin', '$sdtTeacher')";
      $query = mysqli_query($conn, $sql);


      $hashedPassword = password_hash($passwordUser, PASSWORD_DEFAULT);

      $sql = "INSERT INTO user (idUser, passwordUser, role) 
                VALUES ('$idUser', '$hashedPassword', '$role')";
      $query = mysqli_query($conn, $sql);
}
// kiểm tra trùng teacher
if (isset($_POST['idTeacher']) && isset($_POST['idclass']) && isset($_POST['startTime'])) {
      $idTeacher = $_POST['idTeacher'];
      $idclass = $_POST['idclass'];
      $startTime = $_POST['startTime'];

      $sql = "SELECT * FROM classShift WHERE idclass = ? AND idTeacher = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ii", $idclass, $idTeacher); 
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
            echo "Giáo viên đã được phân vào lớp này. Không thể thêm!";
      } else {
            $insertSql = "INSERT INTO classShift (idTeacher, idclass, startTime) VALUES (?, ?, ?)";
            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->bind_param("iis", $idTeacher, $idclass, $startTime); 

            if ($insertStmt->execute()) {
                  echo "Đã thêm giáo viên vào lớp thành công!";
            } else {
                  echo "Có lỗi xảy ra khi thêm!";
            }

            $insertStmt->close();
      }

      $stmt->close();
      $conn->close();
}
// add lop
if (isset($_POST['idclass']) && isset($_POST['nameClass']) && isset($_POST['schedule']) && isset($_POST['startDate']) && isset($_POST['duration']) && isset($_POST['classFee'])) {
      $idclass = $_POST['idclass'];
      $nameClass = $_POST['nameClass'];
      $schedule = $_POST['schedule'];
      $startDate = $_POST['startDate'];
      $duration = $_POST['duration'];
      $classFee = $_POST['classFee'];

      $sql = "INSERT INTO class (idclass, nameClass, schedule, startDate, duration, classFee) 
            VALUES ('$idclass', '$nameClass', '$schedule', '$startDate', '$duration', '$classFee')";
      $query = mysqli_query($conn, $sql);
}
// add học sinh
if (isset($_POST['idStudent']) && isset($_POST['idUser']) && isset($_POST['passwordUser']) && isset($_POST['nameStudent']) && isset($_POST['guardianPhone']) && isset($_POST['referralId']) && isset($_POST['role'])) {
      $idStudent = $_POST['idStudent'];
      $idUser = $_POST['idUser'];
      $passwordUser = $_POST['passwordUser'];
      $nameStudent = $_POST['nameStudent'];
      $guardianPhone = $_POST['guardianPhone'];
      $referralId = $_POST['referralId'];
      $role = $_POST['role'];

      $hashedPassword = password_hash($passwordUser, PASSWORD_DEFAULT);

      $sql = "INSERT INTO student (idStudent, idUser, passwordUser, nameStudent, guardianPhone, referralId) 
            VALUES ('$idStudent', '$idUser', '$passwordUser', '$nameStudent', '$guardianPhone', '$referralId')";
      $query = mysqli_query($conn, $sql);

      $hashedPassword = password_hash($passwordUser, PASSWORD_DEFAULT);


      $sql = "INSERT INTO user (idUser, passwordUser, role) 
            VALUES ('$idUser', '$hashedPassword', '$role')";
      $query = mysqli_query($conn, $sql);
}

//tìm kiếm học sinh
$studentDetails = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['searchStudentId'])) {
            $searchStudentId = $_POST['searchStudentId'];

            if (!empty($searchStudentId)) {
                  $sql = "
                SELECT 
                    s.idStudent,
                    s.idUser,
                    s.passwordUser,
                    s.nameStudent,
                    s.guardianPhone,
                    s.referralId,
                    cs.idclass,
                    cs.dateJoin,
                    cs.paymentId,
                    cs.isPaid
                FROM 
                    student s
                LEFT JOIN 
                    studentClass cs ON s.idStudent = cs.idStudent
                WHERE 
                    s.idStudent = ?";

                  $stmt = $conn->prepare($sql);
                  $stmt->bind_param("i", $searchStudentId);
                  $stmt->execute();
                  $result = $stmt->get_result();

                  if ($result->num_rows > 0) {
                        $studentDetails = [];
                        while ($row = $result->fetch_assoc()) {
                              $studentDetails[] = $row;
                        }
                  } else {
                        $studentDetails = null;
                  }

                  $stmt->close();
            }
      }
}





// thêm vào bảng phụ classShift
if (isset($_POST['idTeacher']) && isset($_POST['idclass']) && isset($_POST['startTime'])) {
      $idTeacher = $_POST['idTeacher'];
      $idclass = $_POST['idclass'];
      $startTime = $_POST['startTime'];
      $sql = "INSERT INTO classShift (idTeacher, idclass, startTime) 
            VALUES ('$idTeacher', '$idclass', '$startTime')";
      $query = mysqli_query($conn, $sql);
}
// thêm vào bảng phụ studentClass
if (isset($_POST['idStudent']) && isset($_POST['idclass']) && isset($_POST['dateJoin']) && isset($_POST['paymentId']) && isset($_POST['isPaid']) && isset($_POST['notePayment'])) {
      $idStudent = $_POST['idStudent'];
      $idclass = $_POST['idclass'];
      $dateJoin = $_POST['dateJoin'];
      $paymentId = $_POST['paymentId'];
      $isPaid = $_POST['isPaid'];
      $notePayment = $_POST['notePayment'];

      $sql = "INSERT INTO studentClass (idStudent, idclass, dateJoin, paymentId, isPaid) 
            VALUES ('$idStudent', '$idclass', '$dateJoin', '$paymentId', '$isPaid')";
      $query = mysqli_query($conn, $sql);

      $sql = "INSERT INTO payment (idStudent, idclass, paymentId,isPaid,notePayment) 
                        VALUES ('$idStudent', '$idclass', '$paymentId', '$isPaid','$notePayment')";
      $query = mysqli_query($conn, $sql);
}

// Xử lý khi người dùng nhấn nút tìm kiếm
if (isset($_POST['searchStudent']) && isset($_POST['idStudent'])) {
      $idStudent = $_POST['idStudent'];

      $sql = "SELECT * FROM payment WHERE idStudent = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $idStudent);
      $stmt->execute();
      $result = $stmt->get_result();
      $payments = $result->fetch_all(MYSQLI_ASSOC);
}

// update payment
if (isset($_POST['updatePayment'])) {
      $idStudent = $_POST['idStudent'];
      $paymentId = $_POST['paymentId'];
      $isPaid = $_POST['isPaid'];
      $notePayment = $_POST['notePayment'];

      $sql = "UPDATE payment SET isPaid = ?, notePayment = ? WHERE idStudent = ? AND paymentId = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("issi", $isPaid, $notePayment, $idStudent, $paymentId);
      $stmt->execute();
      echo "Thông tin thanh toán đã được cập nhật!";
}




// Lấy danh sách giáo viên từ cơ sở dữ liệu
$sql = "SELECT * FROM teacher";
$result = mysqli_query($conn, $sql);
$teachers = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Lấy danh sách lớp từ cơ sở dữ liệu-
$sql = "SELECT * FROM class";
$result = mysqli_query($conn, $sql);
$classes = mysqli_fetch_all($result, MYSQLI_ASSOC);


// lấy danh sách học sinh từ cơ sở dữ liệu
$sql = "SELECT * FROM student";
$result = mysqli_query($conn, $sql);
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>


<!DOCTYPE html>
<html lang="vi">

<head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
      <title>Quản lý giáo viên và lớp học</title>
</head>

<body>
      <div class="d-flex">
            <!-- Side nav -->
            <div class="col-xl-2 col-4 collapse-horizontal overflow-hidden border" id="navbarToggleExternalContent">
                  <div class="text-center py-4 border">
                        <img class="w-50" src="https://thanglong.edu.vn/themes/md_tlu/img/logo.svg" alt="" />
                  </div>
                  <div class=" py-4 px-4 d-flex flex-column gap-3 border">
                        <h6><a class="link-dark text-decoration-none" href="#" onclick="showContent('teacherManagement')">Quản lý giáo viên</a></h6>
                        <h6><a class="link-dark text-decoration-none" href="#" onclick="showContent('classManagement')">Quản lý lớp</a></h6>
                        <h6><a class="link-dark text-decoration-none" href="#" onclick="showContent('studentManagement')">Quản lý học sinh</a></h6>
                        <h6><a class="link-dark text-decoration-none" href="#" onclick="showContent('SearchStudent')">Tìm kiếm học sinh</a></h6>
                        <h6><a class="link-dark text-decoration-none" href="#" onclick="showContent('SearchPayment')">Thanh toán </a></h6>
                  </div>

            </div>
            <!-- Main content -->
            <div class="col-xl-10 col-8">
                  <div class="bg-danger py-2 px-5 d-flex justify-content-between flex-wrap">
                        <div class="">
                              <p class=" fs-1 fw-bold">Trung Tâm Ngoại Ngữ</p>

                        </div>
                        <div class="fs-5 align-items-center border rounded-3 border-primary py-3 px-3 bg-primary">
                              <a class="text-decoration-none text-white" href="logout.php">Đăng Xuất</a>
                        </div>
                  </div>
                  <div class="px-4">

                        <!-- TIm kiem hoc sinh -->
                        <div class="collapse" id="SearchStudent">
                              <h2> Tìm Kiếm Học Sinh</h2>
                              <form method="POST" class="mt-3">
                                    <input type="text" name="searchStudentId" placeholder="Tìm kiếm học sinh theo ID" class="form-control" />
                                    <button type="submit" class="btn btn-primary mt-2">Tìm kiếm</button>
                              </form>
                              <?php if (isset($studentDetails)): ?>
                                    <?php if ($studentDetails): ?>
                                          <h3>Thông tin học sinh</h3>
                                          <?php foreach ($studentDetails as $detail): ?>
                                                <p>ID: <?php echo htmlspecialchars($detail['idStudent']); ?></p>
                                                <p>ID User: <?php echo htmlspecialchars($detail['idUser']); ?></p>
                                                <p>Mật khẩu: <?php echo htmlspecialchars($detail['passwordUser']); ?></p>
                                                <p>Tên: <?php echo htmlspecialchars($detail['nameStudent']); ?></p>
                                                <p>Số điện thoại phụ huynh: <?php echo htmlspecialchars($detail['guardianPhone']); ?></p>
                                                <p>ID giới thiệu: <?php echo htmlspecialchars($detail['referralId']); ?></p>
                                                <p>ID lớp: <?php echo htmlspecialchars($detail['idclass']); ?></p>
                                                <p>Ngày gia nhập: <?php echo htmlspecialchars($detail['dateJoin']); ?></p>
                                                <p>ID thanh toán: <?php echo htmlspecialchars($detail['paymentId']); ?></p>
                                                <p>Đã thanh toán: <?php echo htmlspecialchars($detail['isPaid'] ? 'Đã thanh toán' : 'Chưa thanh toán'); ?></p>
                                                <hr />
                                          <?php endforeach; ?>
                                    <?php else: ?>
                                          <p>Không tìm thấy học sinh với ID này.</p>
                                    <?php endif; ?>
                              <?php endif; ?>
                        </div>
                        <!-- Quản lý giáo viên -->
                        <div class="collapse" id="teacherManagement">
                              <!-- Div -->
                              <div class="d-flex justify-content-between flex-wrap">

                                    <div class="col-xl-3 col-12">
                                          <h2>Quản lý giáo viên</h2>
                                          <div>
                                                <h3>Thêm mới giáo viên</h3>
                                                <form action="main.php" method="POST">
                                                      <div class="mb-3">
                                                            <label for="idTeacher" class="form-label">ID Giáo Viên:</label>
                                                            <input type="text" id="idTeacher" name="idTeacher" class="form-control"
                                                                  placeholder="Nhập ID giáo viên" required>
                                                      </div class="">
                                                      <div class="mb-3">
                                                            <label for="idUser" class="form-label">ID Người Dùng:</label>
                                                            <input type="text" id="idUser" name="idUser" class="form-control"
                                                                  placeholder="Nhập ID người dùng" required>
                                                      </div>
                                                      <div class="mb-3">
                                                            <label for="passwordUser" class="form-label">Mật Khẩu:</label>
                                                            <input type="password" id="passwordUser" name="passwordUser" class="form-control"
                                                                  placeholder="Nhập mật khẩu" required>
                                                      </div>
                                                      <div class="mb-3">
                                                            <label for="nameTeacher" class="form-label">Tên Giáo Viên:</label>
                                                            <input type="text" id="nameTeacher" name="nameTeacher" class="form-control"
                                                                  placeholder="Nhập tên giáo viên" required>
                                                      </div>
                                                      <div class="mb-3">
                                                            <label for="dateJoin" class="form-label">Ngày Gia Nhập:</label>
                                                            <input type="date" id="dateJoin" name="dateJoin" class="form-control" required>
                                                      </div>
                                                      <div class="mb-3">
                                                            <label for="sdtTeacher" class="form-label">Số Điện Thoại:</label>
                                                            <input type="text" id="sdtTeacher" name="sdtTeacher" class="form-control"
                                                                  placeholder="Nhập số điện thoại" required>
                                                      </div>
                                                      <div class="mb-3">
                                                            <label for="role" class="form-label">Nhập vai trò:</label>
                                                            <input type="text" id="role" name="role" class="form-control" required>
                                                      </div>
                                                      <button type="submit" name="submit" class="btn btn-primary">Thêm Giáo Viên</button>
                                                </form>
                                          </div>

                                    </div>

                                    <!-- Danh sách giáo viên -->
                                    <div class="col-xl-8 col-12">
                                          <div class="mt-4">
                                                <h3>Danh sách giáo viên</h3>
                                                <table class="table table-bordered">
                                                      <thead>
                                                            <tr>
                                                                  <th>STT</th>
                                                                  <th>ID Giáo Viên</th>
                                                                  <th>ID Người Dùng</th>
                                                                  <th>Mật Khẩu</th>
                                                                  <th>Tên Giáo Viên</th>
                                                                  <th>Ngày Gia Nhập</th>
                                                                  <th>Số Điện Thoại</th>
                                                                  <th>Thao Tác</th>
                                                            </tr>
                                                      </thead>
                                                      <tbody>
                                                            <?php if (!empty($teachers)): ?>
                                                                  <?php foreach ($teachers as $index => $teacher): ?>
                                                                        <tr>
                                                                              <td><?php echo $index + 1; ?></td>
                                                                              <td><?php echo htmlspecialchars($teacher['idTeacher']); ?></td>
                                                                              <td><?php echo htmlspecialchars($teacher['idUser']); ?></td>
                                                                              <td><?php echo htmlspecialchars($teacher['passwordUser']); ?></td>
                                                                              <td><?php echo htmlspecialchars($teacher['nameTeacher']); ?></td>
                                                                              <td><?php echo htmlspecialchars($teacher['dateJoin']); ?></td>
                                                                              <td><?php echo htmlspecialchars($teacher['sdtTeacher']); ?></td>
                                                                              <td>
                                                                                    <a href="EditTeacher.php?idTeacher=<?php echo $teacher['idTeacher']; ?>" class="btn btn-info">Sửa</a>
                                                                                    <a href="DeleteTeacher.php?idTeacher=<?php echo $teacher['idTeacher']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xoá giáo viên này?');">Xoá</a>
                                                                              </td>
                                                                        </tr>
                                                                  <?php endforeach; ?>
                                                            <?php else: ?>
                                                                  <tr>
                                                                        <td colspan="8">Không có giáo viên nào.</td>
                                                                  </tr>
                                                            <?php endif; ?>
                                                      </tbody>
                                                </table>
                                          </div>

                                    </div>
                              </div>
                        </div>
                        <!-- Quản lý lớp -->
                        <div class="collapse" id="classManagement">
                              <h2>Quản lý lớp</h2>
                              <!-- Div thêm mới các thứ -->
                              <div class=" d-flex justify-content-between flex-wrap">
                                    <!-- Tạo lớp mới -->
                                    <div class="col-xl-3 col-12">
                                          <h3>Tạo lớp mới</h3>
                                          <form action="main.php" method="POST">
                                                <div class="mb-3">
                                                      <label for="idclass" class="form-label">ID Lớp:</label>
                                                      <input type="text" id="idclass" name="idclass" class="form-control"
                                                            placeholder="Nhập ID lớp" required>
                                                </div>
                                                <div class="mb-3">
                                                      <label for="nameClass" class="form-label">Tên Lớp:</label>
                                                      <input type="text" id="nameClass" name="nameClass" class="form-control"
                                                            placeholder="Nhập tên lớp" required>
                                                </div>
                                                <div class="mb-3">
                                                      <label for="schedule" class="form-label">Thời Khóa Biểu:</label>
                                                      <input type="text" id="schedule" name="schedule" class="form-control"
                                                            placeholder="Nhập thời khóa biểu" required>
                                                </div>
                                                <div class="mb-3">
                                                      <label for="startDate" class="form-label">Ngày Bắt Đầu:</label>
                                                      <input type="date" id="startDate" name="startDate" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                      <label for="duration" class="form-label">Thời Gian (tuần):</label>
                                                      <input type="number" id="duration" name="duration" class="form-control" placeholder="Nhập thời gian" required>
                                                </div>
                                                <div class="mb-3">
                                                      <label for="classFee" class="form-label">Học Phí:</label>
                                                      <input type="number" id="classFee" name="classFee" class="form-control" placeholder="Nhập học phí" required>
                                                </div>
                                                <button type="submit" name="submit" class="btn btn-primary">Tạo Lớp</button>
                                          </form>
                                    </div>


                                    <!-- Thêm học sinh vào lớp -->
                                    <div class="mt-4 col-xl-3 col-12">
                                          <h3>Thêm học sinh vào lớp</h3>
                                          <form action="main.php" method="POST">
                                                <div class="mb-3">
                                                      <label for="idStudent" class="form-label">Chọn Học Sinh:</label>
                                                      <select id="idStudent" name="idStudent" class="form-select" required>
                                                            <?php foreach ($students as $student): ?>
                                                                  <option value="<?php echo $student['idStudent']; ?>">
                                                                        <?php echo $student['nameStudent']; ?>
                                                                  </option>
                                                            <?php endforeach; ?>
                                                      </select>
                                                </div>
                                                <div class="mb-3">
                                                      <label for="idclass" class="form-label">Chọn Lớp:</label>
                                                      <select id="idclass" name="idclass" class="form-select" required>
                                                            <?php foreach ($classes as $class): ?>
                                                                  <option value="<?php echo $class['idclass']; ?>">
                                                                        <?php echo $class['nameClass']; ?>
                                                                  </option>
                                                            <?php endforeach; ?>
                                                      </select>
                                                </div>
                                                <div class="mb-3">
                                                      <label for="dateJoin" class="form-label">Nhập thời gian tham gia:</label>
                                                      <input type="date" id="dateJoin" name="dateJoin" class="form-control"
                                                            placeholder="Nhập thời gian tham gia" required>
                                                </div>

                                                <div class="mb-3">
                                                      <label for="paymentId" class="form-label">Nhập mã thanh toán:</label>
                                                      <input type="text" id="paymentId" name="paymentId" class="form-control"
                                                            placeholder="Nhập mã thanh toán" required>
                                                </div>

                                                <div class="mb-3">
                                                      <label for="isPaid" class="form-label">Tình trạng thanh toán:</label>
                                                      <input type="text" id="isPaid" name="isPaid" class="form-control"
                                                            placeholder="Tình trạng thanh toán" required>
                                                </div>

                                                <div class="mb-3">
                                                      <label for="notePayment" class="form-label">Nhập nội dung thanh toán:</label>
                                                      <input type="text" id="notePayment" name="notePayment" class="form-control"
                                                            placeholder="Nhập nội dung thanh toán" required>
                                                </div>

                                                <button type="submit" name="submit" class="btn btn-primary">Thêm vào Lớp</button>
                                          </form>
                                    </div>


                                    <!-- Thêm giáo viên vào lớp -->
                                    <div class="mt-4 col-xl-3 col-12">
                                          <h3 class="mt-4">Thêm Giáo Viên vào Lớp</h3>
                                          <form action="" method="POST">
                                                <div class="mb-3">
                                                      <label for="idTeacher" class="form-label">Chọn Giáo Viên:</label>
                                                      <select id="idTeacher" name="idTeacher" class="form-select" required>
                                                            <?php foreach ($teachers as $teacher): ?>
                                                                  <option value="<?php echo htmlspecialchars($teacher['idTeacher']); ?>">
                                                                        <?php echo htmlspecialchars($teacher['nameTeacher']); ?>
                                                                  </option>
                                                            <?php endforeach; ?>
                                                      </select>
                                                </div>
                                                <div class="mb-3">
                                                      <label for="idclass" class="form-label">Chọn Lớp:</label>
                                                      <select id="idclass" name="idclass" class="form-select" required>
                                                            <?php foreach ($classes as $class): ?>
                                                                  <option value="<?php echo htmlspecialchars($class['idclass']); ?>">
                                                                        <?php echo htmlspecialchars($class['nameClass']); ?>
                                                                  </option>
                                                            <?php endforeach; ?>
                                                      </select>
                                                </div>
                                                <div class="mb-3">
                                                      <label for="startTime" class="form-label">Nhập Thời Gian Tham Gia:</label>
                                                      <input type="date" id="startTime" name="startTime" class="form-control" placeholder="Nhập thời gian tham gia" required>
                                                </div>
                                                <button type="submit" name="addTeacherToClass" class="btn btn-primary">Thêm Giáo Viên vào Lớp</button>
                                          </form>
                                    </div>


                              </div>

                              <!-- Danh sách lớp -->

                              <div class="mt-4">
                                    <h3>Danh sách lớp</h3>
                                    <table class="table table-bordered">
                                          <thead>
                                                <tr>
                                                      <th>STT</th>
                                                      <th>ID Class</th>
                                                      <th>Name Class</th>
                                                      <th>Schedule</th>
                                                      <th>Start Date</th>
                                                      <th>Duration</th>
                                                      <th>Class Fee</th>
                                                      <th>Thao tác</th>
                                                      <th>Điểm danh</th>
                                                </tr>
                                          </thead>
                                          <tbody>
                                                <?php if (!empty($classes)): ?>
                                                      <?php foreach ($classes as $index => $class): ?>
                                                            <tr>
                                                                  <td><?php echo $index + 1; ?></td>
                                                                  <td><?php echo htmlspecialchars($class['idclass']); ?></td> <!-- Hiển thị ID lớp -->
                                                                  <td><?php echo htmlspecialchars($class['nameClass']); ?></td> <!-- Hiển thị tên lớp -->
                                                                  <td><?php echo htmlspecialchars($class['schedule']); ?></td> <!-- Hiển thị lịch học -->
                                                                  <td><?php echo htmlspecialchars($class['startDate']); ?></td> <!-- Hiển thị ngày bắt đầu -->
                                                                  <td><?php echo htmlspecialchars($class['duration']); ?></td> <!-- Hiển thị thời lượng -->
                                                                  <td><?php echo htmlspecialchars($class['classFee']); ?></td> <!-- Hiển thị học phí -->
                                                                  <td>
                                                                        <a href="EditClass.php?idclass=<?php echo $class['idclass']; ?>" class="btn btn-info">Sửa</a>
                                                                        <a href="DeleteClass.php?idclass=<?php echo $class['idclass']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xoá lớp này?');">Xoá</a>
                                                                  </td>
                                                                  <td>
                                                                        <a href="rollcall.php?idclass=<?php echo $class['idclass']; ?>" class="btn btn-warning">Điểm danh</a>
                                                                  </td>
                                                            </tr>
                                                      <?php endforeach; ?>
                                                <?php else: ?>
                                                      <tr>
                                                            <td colspan="9">Không có lớp học nào.</td>
                                                      </tr>
                                                <?php endif; ?>
                                          </tbody>
                                    </table>
                              </div>

                        </div>
                        <!-- Quản lý học sinh -->
                        <div class="collapse " id="studentManagement">
                              <div class="flex-wrap d-flex justify-content-between">
                                    <div class="col-12 col-xl-3">
                                          <h2>Quản lý học sinh</h2>
                                          <div>
                                                <h3>Thêm mới học sinh</h3>
                                                <form action="main.php" method="post">
                                                      <div class="mb-3">
                                                            <label for="idStudent" class="form-label">ID Học Sinh:</label>
                                                            <input type="text" id="idStudent" name="idStudent" class="form-control" placeholder="Nhập ID học sinh" required>
                                                      </div>
                                                      <div class="mb-3">
                                                            <label for="idUser" class="form-label">ID User:</label>
                                                            <input type="text" id="idUser" name="idUser" class="form-control" placeholder="Nhập ID user" required>
                                                      </div>
                                                      <div class="mb-3">
                                                            <label for="passwordUser" class="form-label">Mật Khẩu:</label>
                                                            <input type="password" id="passwordUser" name="passwordUser" class="form-control" placeholder="Nhập mật khẩu" required>
                                                      </div>
                                                      <div class="mb-3">
                                                            <label for="nameStudent" class="form-label">Tên Học Sinh:</label>
                                                            <input type="text" id="nameStudent" name="nameStudent" class="form-control" placeholder="Nhập tên học sinh" required>
                                                      </div>
                                                      <div class="mb-3">
                                                            <label for="guardianPhone" class="form-label">Số Điện Thoại Người Giám Hộ:</label>
                                                            <input type="text" id="guardianPhone" name="guardianPhone" class="form-control" placeholder="Nhập số điện thoại người giám hộ" required>
                                                      </div>
                                                      <div class="mb-3">
                                                            <label for="referralId" class="form-label">ID Người Giới Thiệu:</label>
                                                            <input type="text" id="referralId" name="referralId" class="form-control" placeholder="Nhập ID người giới thiệu" required>
                                                      </div>

                                                      <div class="mb-3">
                                                            <label for="role" class="form-label">Nhập vai trò:</label>
                                                            <input type="text" id="role" name="role" class="form-control" required>
                                                      </div>


                                                      <button type="submit" name="submit" class="btn btn-primary">Thêm Học Sinh</button>
                                                </form>
                                          </div>
                                    </div>
                                    <div class="mt-4 col-xl-8 col-12">
                                          <h3>Danh sách học sinh</h3>
                                          <table class="table table-bordered">
                                                <thead>
                                                      <tr>
                                                            <th>STT</th>
                                                            <th>ID Sinh Viên</th>
                                                            <th>User</th>
                                                            <th>Mật khẩu</th>
                                                            <th>Tên Học Sinh</th>
                                                            <th>Số Điện Thoại Người Giám Hộ</th>
                                                            <th>ID Giới thiệu</th>
                                                            <th>Thao Tác</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      <?php foreach ($students as $index => $student): ?>
                                                            <tr>
                                                                  <td><?php echo $index + 1; ?></td>
                                                                  <td><?php echo htmlspecialchars($student['idStudent']); ?></td>
                                                                  <td><?php echo htmlspecialchars($student['idUser']); ?></td>
                                                                  <td><?php echo htmlspecialchars($student['passwordUser']); ?></td>
                                                                  <td><?php echo htmlspecialchars($student['nameStudent']); ?></td>
                                                                  <td><?php echo htmlspecialchars($student['guardianPhone']); ?></td>
                                                                  <td><?php echo htmlspecialchars($student['referralId']); ?></td>
                                                                  <td>
                                                                        <a href="EditStudent.php?idStudent=<?php echo $student['idStudent']; ?>" class="btn btn-info">Sửa</a>
                                                                        <a href="DeleteStudent.php?idStudent=<?php echo $student['idStudent']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa học sinh này?');">Xóa</a>
                                                                  </td>

                                                            </tr>
                                                      <?php endforeach; ?>
                                                </tbody>
                                          </table>
                                    </div>



                              </div>
                        </div>
                        <!-- Thanh toán -->
                        <div class="collapse" id="SearchPayment">
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



                  </div>
            </div>

      </div>

</body>

</html>


<script>
      function showContent(id) {
            document.querySelectorAll(".collapse").forEach(function(element) {
                  let siblings = [...element.parentNode.children].filter(function(sibling) {
                        return sibling !== element;
                  });
                  siblings.forEach(function(sibling) {
                        sibling.classList.remove("show");
                  });
            });

            var content = document.getElementById(id);
            if (content) {
                  content.classList.add("show");
                  localStorage.setItem("activeContent", id);
            }
      }
      document.addEventListener("DOMContentLoaded", function() {
            var activeContentId = localStorage.getItem("activeContent");
            if (activeContentId) {
                  showContent(activeContentId);
            }
      });
</script>



<!-- AI Chatbot Giao Diện -->
<div id="ai-chatbot">
    <div id="ai-header" onclick="toggleChat()">🧠 AI Hỗ Trợ</div>
    <div id="ai-body">
        <div id="ai-messages"></div>
        <input type="text" id="ai-input" placeholder="Nhập câu hỏi..." onkeypress="handleKeyPress(event)">
        <button onclick="sendMessage()">Gửi</button>
    </div>
</div>

<!-- CSS -->
<style>
    #ai-chatbot {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 300px;
        background: white;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        font-family: Arial, sans-serif;
    }
    #ai-header {
        background: #ff69b4;
        color: white;
        padding: 10px;
        text-align: center;
        cursor: pointer;
        font-weight: bold;
    }
    #ai-body {
        display: none;
        padding: 10px;
    }
    #ai-messages {
        max-height: 200px;
        overflow-y: auto;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }
    #ai-input {
        width: 75%;
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    #ai-body button {
        width: 20%;
        background: #ff69b4;
        color: white;
        border: none;
        padding: 5px;
        border-radius: 5px;
        cursor: pointer;
    }
</style>

<!-- JavaScript -->
<script>
    function toggleChat() {
        var body = document.getElementById("ai-body");
        body.style.display = (body.style.display === "block") ? "none" : "block";
    }

    function handleKeyPress(event) {
        if (event.key === "Enter") {
            sendMessage();
        }
    }

    function sendMessage() {
        var input = document.getElementById("ai-input");
        var messages = document.getElementById("ai-messages");
        var userMessage = input.value.trim();
        if (userMessage === "") return;

        // Hiển thị câu hỏi của người dùng
        var userBubble = `<div><strong>Bạn:</strong> ${userMessage}</div>`;
        messages.innerHTML += userBubble;

        // Xử lý phản hồi AI
        var aiResponse = getAIResponse(userMessage);
        var aiBubble = `<div style="color: blue;"><strong>AI:</strong> ${aiResponse}</div>`;
        
        // Đảm bảo tin nhắn AI xuất hiện sau một chút thời gian
        setTimeout(() => {
            messages.innerHTML += aiBubble;
            messages.scrollTop = messages.scrollHeight; // Cuộn xuống tin nhắn mới nhất
        }, 500);

        input.value = ""; // Xóa nội dung nhập
    }

    function getAIResponse(question) {
        var lowerQuestion = question.toLowerCase();
        
        if (lowerQuestion.includes("lịch học của tôi")) {
            return "Lịch học của bạn: <br>Thứ 3: 19h00 -> 21h00<br>Thứ 5: 20h00 -> 22h00<br>Thứ 7: 18h00 -> 19h00";
        } else if (lowerQuestion.includes("Sửa cho tôi câu sau cho đúng ngữ pháp how long you come VietNam")) {
            return "Tất nhiên rồi! Câu đúng: ✅ **How long have you been in Vietnam?**";
        } else if (lowerQuestion.includes("dấu hiệu nhận biết danh từ")) {
            return "Các đuôi nhận biết danh từ: <br>**-tion/-sion (education), -ment (development), -ness (happiness), -ity/-ty (ability), -ance/-ence (importance), -er/-or/-ist/-ian (teacher), -ship (friendship), -hood (childhood), -age (marriage), -al (arrival), -ism (tourism), -ure (failure), -cy (democracy)**.";
        } else if (lowerQuestion.includes("hôm nay tôi không khoẻ")) {
            return "Bạn cần uống thuốc và nghỉ ngơi.";
        } else if (lowerQuestion.includes("cấu trúc của thì hiện tại hoàn thành")) {
            return "Cấu trúc thì hiện tại hoàn thành: **S + have/has + V3/ed + (O)**. Ví dụ: *I have finished my homework.*";
        } else if (lowerQuestion.includes("phân biệt 'some' và 'any'")) {
            return "'Some' dùng trong câu khẳng định (*I have some apples.*), 'Any' dùng trong câu phủ định và nghi vấn (*Do you have any apples?*).";
        } else if (lowerQuestion.includes("cách phát âm đuôi -ed")) {
            return "Có 3 cách phát âm đuôi *-ed*: <br>- /t/: worked, watched.<br>- /d/: played, called.<br>- /ɪd/: needed, wanted.";
        } else if (lowerQuestion.includes("danh từ đếm được và không đếm được")) {
            return "Danh từ **đếm được** có dạng số ít/số nhiều (*apple/apples*). Danh từ **không đếm được** không có dạng số nhiều (*water, rice, sugar*).";
        } else {
            return "Xin lỗi, tôi chưa hiểu câu hỏi của bạn.";
        }
    }
</script>



