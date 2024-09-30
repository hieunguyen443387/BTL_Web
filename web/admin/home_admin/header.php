<?php
    session_start();
    if (!isset($_SESSION['id_admin'])) {
        header("Location: ../home_admin/home_admin.html");
        exit();
    }

    $id_admin = $_SESSION['id_admin'];

?> 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/web/admin/home_admin/home_admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />`
    
    
</head>

    <header>
        <ul>
            <li><a href="/web/admin/home_admin/home_admin.php"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
            <li>Tài khoản: <?php echo $_SESSION['id_admin']?></li>
            <li>
                <?php 
                    include('config.php');
                    
                    $id_admin = $_SESSION['id_admin'];

                    $sql = "SELECT id_admin, ho_dem, ten FROM admin WHERE id_admin = '$id_admin'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "Họ và tên: ". $row["ho_dem"]. " " . $row["ten"] ;
                        }
                    } else {
                        echo "Không tìm được tài khoản";
                    }

                ?>
            </li>
            <li>
                <div class="dropdown">
                    <button class="dropbtn" onclick="myOpenSign_up()">Quản lý tài khoản <i class="fa fa-caret-down"></i></button>
                    <div class="dropdown-content" id="myDropdown">
                        <a href="../sign_up/sign_up_admin/quan_ly_admin.php">Admin</a>
                        <a href="/web/admin/sign_up/sign_up_teacher/quan_ly_giang_vien.php">Giảng viên</a>
                        <a href="/web/admin/sign_up/sign_up_student/quan_ly_sinh_vien.php">Sinh viên</a>
                    </div>
                </div>
            </li>

            
        </ul>
        <script>
            function myOpenSign_up() {
            document.getElementById("myDropdown").classList.toggle("show");
            }

            window.onclick = function(e) {
                if (!e.target.matches('.dropbtn')) {
                var myDropdown = document.getElementById("myDropdown");
                    if (myDropdown.classList.contains('show')) {
                    myDropdown.classList.remove('show');
                    }
                }
            }

        </script>
    </header>
</body>
</html>
