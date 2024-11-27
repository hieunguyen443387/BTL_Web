<?php
session_start();
if (!isset($_SESSION['msv'])) {
    header("Location: /web/home/home/home.html");
    exit();
}

$msv = $_SESSION['msv'];
?> 


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home_teacher.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Cổng thông tin Đào tạo đại học</title>
</head>

<header>
    <ul>
    <li><a href="home_student.php"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
    </ul>
</header>