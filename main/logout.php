<?php
include 'connectfbcnpm1.php';
    if (isset($_SESSION['idUser'])){
        unset($_SESSION['idUser']);

    }

    header('location:login.php');


?>