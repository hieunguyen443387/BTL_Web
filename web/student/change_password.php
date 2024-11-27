<?php

include('../home/home/config.php');

if (isset($_GET['msv'])) {
    $msv = $_GET['msv'];

    if (!empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
        // Truy vấn mật khẩu cũ từ cơ sở dữ liệu
        $sql_password = "SELECT mat_khau FROM sinh_vien WHERE msv = '$msv'";
        $result_password = $conn->query($sql_password);

        if ($result_password->num_rows > 0) {
            $row = $result_password->fetch_assoc();
            $mat_khau = $row['mat_khau'];

            // Kiểm tra mật khẩu cũ
            if ($_POST['old_password'] != $mat_khau) { 
                echo "Mật khẩu không đúng. Vui lòng nhập lại mật khẩu";
            } else {
                $new_password = $_POST['new_password'];
                $confirm_password = $_POST['confirm_password'];

                // Kiểm tra xem mật khẩu mới và mật khẩu xác nhận có khớp không
                if ($new_password !== $confirm_password) {
                    echo "Mật khẩu mới và xác nhận mật khẩu không khớp.";
                } else {
                    // Cập nhật mật khẩu mới
                    $sql_update_pasword = "UPDATE sinh_vien SET mat_khau = '$new_password' WHERE msv = '$msv'";
                    if ($conn->query($sql_update_pasword) === TRUE) {
                        echo "Đổi mật khẩu thành công";
                    } else {
                        echo "Lỗi khi đổi mật khẩu: " . $conn->error;
                    }
                }
            }
        } else {
            echo "Tài khoản không tồn tại.";
        }
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home_student.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Cổng thông tin Đào tạo đại học</title>
</head>
<body>
    <?php
        require "header.php";
    ?>

    <main>
        <form action="" method="post">
            <div class = "change_password_page">
                <h2><i class="fa-solid fa-user-shield"></i> Đặt lại mật khẩu</h2>
                <div class="form-group">
                    <label for="old_password">Mật khẩu cũ</label>
                    <input type="password" name="old_password">
                </div>

                <div class="form-group">
                    <label for="new_password">Mật khẩu mới</label>
                    <input type="password" name="new_password">
                </div>

                <div class="form-group">
                    <label for="confirm_password">Nhập lại mật khẩu mới</label>
                    <input type="password" name="confirm_password">
                </div>
                
            </div>
            <div id="button_change_password">
                <button type = "submit"><i class="fa-solid fa-rotate"></i> Thay đổi mật khẩu</button>
            </div>
        </form>
        <?php
            require "menu.php";
        ?>
    </main>

    <?php
        require "footer.php";
    ?>

</body>
</html>