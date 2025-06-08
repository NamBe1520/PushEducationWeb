<?php
include 'connectfbcnpm1.php';

if (isset($_POST['idUser'])) {
    $idUser = mysqli_real_escape_string($conn, $_POST['idUser']);
    $passwordUser = $_POST['passwordUser'];

    $sql = "SELECT * FROM user WHERE idUser = '$idUser'";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);

    if ($data && password_verify($passwordUser, $data['passwordUser'])) {
        $_SESSION['user'] = $data;
        if ($data['role'] == 'admin') {
            header('Location: main.php'); 
        } elseif ($data['role'] == 'teacher') {
            header('Location: mainTeacher.php'); 
        } else {
            header('Location: mainStudent.php');
        }
        exit();
    } else {
        echo "Tên đăng nhập hoặc mật khẩu không đúng";
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
    <title>Đăng Nhập</title>
</head>

<body>
    <header class="py-3 px-2 bg-danger">Trang Đăng Nhập</header>
    <div class="mt-5 container bg-body-secondary shadow d-block p-4 col-xl-3">
        <form action="login.php" method="post" class="d-flex flex-column gap-3">
            <div class="">
                <label for="idUser" class="form-label p-0 m-0">Username:</label>
                <input
                    type="text"
                    class="form-control"
                    id="idUser"
                    name="idUser"
                    placeholder="Tên đăng nhập"
                    required />
            </div>
            <div class="">
                <label for="passwordUser" class="form-label p-0 m-0">Password:</label>
                <input
                    type="passwordUser"
                    class="form-control"
                    id="passwordUser"
                    name="passwordUser"
                    placeholder="Mật khẩu"
                    required />
            </div>
            <div class="mt-3">
                <input class="btn btn-primary w-100" type="submit" value="Login" />
            </div>
            <div class="mt-2 text-center">
                <a href="register.php" class="btn btn-secondary w-100">Register</a>
            </div>
        </form>
    </div>
</body>

</html>