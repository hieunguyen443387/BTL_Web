<?php

if (!isset($_SESSION['mgv'])) {
    header("Location: /web/home/home/home.html");
    exit();
}

$mgv = $_SESSION['mgv'];
?> 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home_teacher.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Cổng thông tin Đào tạo đại học</title>
    <title>Document</title>
</head>
<body>
    <div class="login">
        <h2><i class="fa-solid fa-user"></i> Đăng nhập</h2>
        <hr>
        <ul>
            <li>Tài khoản: <?php echo $_SESSION['mgv']; ?></li>
            
            <li><?php 
                include('../home/home/config.php');

                $mgv = $_SESSION['mgv'];
                $sql = "SELECT mgv, ho_dem, ten FROM giang_vien WHERE mgv = '$mgv'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "Họ và tên: ". $row["ho_dem"]. " " . $row["ten"] ;
                    }
                } else {
                    echo "Không tìm được tài khoản";
                }

                $conn->close();

            ?></li>
            
        </ul>
        <button><a href="/web/home/login/logout.php"><b>Đăng xuất</b></a></button>
        
    </div>
    <div class="menu">
        <h2><i class="fa-solid fa-gears"></i> Tính năng</h2>
        <hr>
        <ul>
            <a href="trang_nhap_drl.php"><li>> Nhập điểm rèn luyện</li></a>
            <a href="trang_nhap_diem.php"><li>> Nhập điểm</li></a>
            <a href="cap_nhat_diem.php"><li>> Cập nhật điểm</li></a>
        </ul>
    </div>
</body>
</html>