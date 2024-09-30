<?php

if (!isset($_SESSION['msv'])) {
    header("Location: /web/home/home/home.html");
    exit();
}

$mgv = $_SESSION['msv'];
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home_teacher.css">
    <title>Document</title>
</head>
<body>
    <div class="login">
        <h2><i class="fa-solid fa-user"></i> Đăng nhập</h2>
        <hr>
        <ul>
        <li>Tài khoản: <?php echo $_SESSION['msv']; ?></li>
        <li>
            <?php 
                include('../home/home/config.php');

                $mgv = $_SESSION['msv'];
                $sql = "SELECT msv, ho_dem, ten FROM sinh_vien WHERE msv = '$msv'";
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

            ?>
        </li>
            
        </ul>
        <button><a href="/web/home/login/logout.php"><b>Đăng xuất</b></a></button>
        
    </div>

    <div class="menu">
        <h2><i class="fa-solid fa-gears"></i> Tính năng</h2>
        <hr>
        <ul>
            <a href="xem_diem.php"><li>> Xem điểm</li></a>
        </ul>
    </div>

</body>
</html>
