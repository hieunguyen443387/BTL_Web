<?php

include('../home/home/config.php');

if (isset($_GET['mgv'])) {
    $mgv = $_GET['mgv'];

    if (!empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
        // Truy vấn mật khẩu cũ từ cơ sở dữ liệu
        $sql_password = "SELECT mat_khau FROM giang_vien WHERE mgv = '$mgv'";
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
                    $sql_update_pasword = "UPDATE giang_vien SET mat_khau = '$new_password' WHERE mgv = '$mgv'";
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
    
    <title>Cổng thông tin Đào tạo đại học</title>
</head>
<style>
    .verify {
    font-family: Arial, Helvetica, sans-serif;
    height: 155px;
    width: 500px;
    border-radius: 5px;
    border: 1px solid #CED4DA;
    background-color: #FFFFFF;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: none; /* Ban đầu ẩn */
    align-items: center;
    justify-content: center;
    z-index: 1000;
    }

    .verify .fa-xmark {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        color: #333;
        cursor: pointer;
    }

    #button_verify {
        color: #3FA7E8;
        background-color: #F7F7F7;
        height: 46px;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 245px;
        border: 1px solid #3FA7E8;
        padding-left: 10px;
        cursor: pointer;
        font-size: 16px;
    }

    #button_verify:hover {
        background-color: #2FA4E7;
        color: #FFFFFF;
    }
</style>
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
                <button  type = "button" onclick="openVerify()"><i class="fa-solid fa-rotate"></i> Thay đổi mật khẩu</button>
            </div>
            <div class="verify" id="verify">
                <i class="fa-solid fa-xmark" onclick="closeVerify()"></i>
                <button type="submit" id="button_verify">Xác nhận đổi mật khẩu</button>
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
<script>
function openVerify() {
        document.getElementById("verify").style.display = "flex";
    }

    function closeVerify() {
        document.getElementById("verify").style.display = "none";
    }
</script>
</html>