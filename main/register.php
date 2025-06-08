<?php
include 'connectfbcnpm1.php';
$err = [];

if (isset($_POST['idUser'])) {
    $idUser = mysqli_real_escape_string($conn, $_POST['idUser']);
    $passwordUser = $_POST['passwordUser'];
    $RpasswordUser = $_POST['RpasswordUser'];
    $role = $_POST['role']; // Lấy quyền từ form

    if (empty($idUser)) {
        $err['idUser'] = 'Bạn chưa nhập idUser';
    }
    if (empty($passwordUser)) {
        $err['passwordUser'] = 'Bạn chưa nhập mật khẩu';
    }
    if ($passwordUser !== $RpasswordUser) {
        $err['RpasswordUser'] = 'Mật khẩu nhập lại không đúng';
    }
    if (empty($err)) {
        $hashedPassword = password_hash($passwordUser, PASSWORD_DEFAULT);

        // Kiểm tra xem idUser đã tồn tại chưa
        $sql_check = "SELECT * FROM user WHERE idUser = '$idUser'";
        $query_check = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($query_check) > 0) {
            $err['idUser'] = 'Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác.';
        } else {
            $sql = "INSERT INTO user (idUser, passwordUser, role) VALUES ('$idUser', '$hashedPassword', '$role')";
            $query = mysqli_query($conn, $sql);
            if ($query) {
                header('Location: login.php');
                exit();
            } else {
                $err['db'] = 'Đã xảy ra lỗi khi đăng ký. Vui lòng thử lại.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <title>Đăng Ký</title>
</head>

<body>
    <header class="py-3 px-2 bg-danger">Trang Đăng Ký</header>
    <div class="mt-5 container bg-body-secondary shadow d-block p-4 col-xl-3">
        <form action="register.php" method="post" class="d-flex flex-column gap-3">
            <div class="">
                <label for="idUser" class="form-label p-0 m-0">Username:</label>
                <input
                    type="text"
                    class="form-control"
                    id="idUser"
                    name="idUser"
                    placeholder="Tên đăng nhập"
                    required />
                <?php if (isset($err['idUser'])): ?>
                    <p><?php echo htmlspecialchars($err['idUser']); ?></p>
                <?php endif; ?>
            </div>

            <div class="">
                <label for="passwordUser" class="form-label p-0 m-0">Password</label>
                <input
                    type="password"
                    id="passwordUser"
                    class="form-control"
                    name="passwordUser"
                    placeholder="Mật khẩu"
                    required />
                <?php if (isset($err['passwordUser'])): ?>
                    <p><?php echo htmlspecialchars($err['passwordUser']); ?></p>
                <?php endif; ?>
            </div>
            <div class="">
                <label for="RpasswordUser" class="form-label p-0 m-0">Confirm password</label>
                <input
                    type="password"
                    id="RpasswordUser"
                    class="form-control"
                    name="RpasswordUser"
                    placeholder="Nhập lại mật khẩu"
                    required />
                <?php if (isset($err['RpasswordUser'])): ?>
                    <p><?php echo htmlspecialchars($err['RpasswordUser']); ?></p>
                <?php endif; ?>
            </div>
            <div class="">
                <label for="role" class="form-label p-0 m-0">You are:</label>
                <select id="role" name="role" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="teacher">Giáo viên</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="mt-3">
                <input class="btn btn-primary w-100" type="submit" value="submit" />
                <?php if (isset($err['db'])): ?>
                    <p><?php echo htmlspecialchars($err['db']); ?></p>
                <?php endif; ?>
            </div>
            <div class="mt-2 text-center">
                <a href="login.php" class="btn btn-secondary w-100">Back to Login</a>
            </div>
        </form>
    </div>
</body>

</html>