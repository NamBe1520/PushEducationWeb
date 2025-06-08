<?php
include 'connectfbcnpm1.php';


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
// thêm vào bảng studentClass
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

// Xử lý khi người dùng nhấn nút cập nhật
if (isset($_POST['updatePayment'])) {
      $idStudent = $_POST['idStudent'];
      $paymentId = $_POST['paymentId'];
      $isPaid = $_POST['isPaid'];
      $notePayment = $_POST['notePayment'];

      // Cập nhật thông tin trong bảng payment
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
                                         
                        <h6><a class="link-dark text-decoration-none" href="#" onclick="showContent('SearchStudent')">Tìm kiếm học sinh</a></h6>
                        
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
                        <!-- Quản lý lớp -->
                        <div class="collapse" id="classManagement">
                              <h2>Quản lý lớp</h2>
                              <!-- Div thêm mới các thứ -->
                              <div class=" d-flex justify-content-between flex-wrap">
                                    


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


                                   


                              </div>

                              

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