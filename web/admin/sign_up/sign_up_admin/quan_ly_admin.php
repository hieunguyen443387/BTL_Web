<!DOCTYPE html>
<html>

<style>
    .add_student{
        text-decoration: none; 
        background-color: #219DE5; 
        color: white; 
        display: inline-block; 
        width: 100px; 
        height: 50px; 
        border-radius: 5px;
        border: 2px solid grey;
        text-align: center; 
        line-height: 50px;
        margin-left: 300px;
        margin-top: 20px;
    }
</style>

<body>
    <div class="container">
        <?php
            require "../../home_admin/header.php";
            require "../../home_admin/menu.php";
        ?>
        <main>
        <form method="post" action="">

            <a href="sign_up.php" class="add_student" ><i class="fa-solid fa-plus" style="color: white;"></i></a>
            <table style = "margin_top = 100px">
            <!-- Mở danh sách sinh viên -->
            <caption class="note"><b>Danh sách giảng viên</b></caption>
            <tr id="header_row">
                <th>STT</th>
                <th>Mã cán bộ</th>
                <th>Cán bộ</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
                <th>Tác vụ</th>
            </tr>
            <?php
                
                $sql_admin = "SELECT id_admin, ho_dem, ten, sdt, email, ngay_sinh, gioi_tinh FROM admin";
                
                $result_admin = $conn->query($sql_admin);

                if ($result_admin->num_rows > 0) {
                    $stt = 1;
                    while($row = $result_admin->fetch_assoc()) {
                        $id_admin = $row["id_admin"];
                        $ho_dem = $row["ho_dem"];
                        $ten = $row["ten"];
                        $sdt = $row["sdt"];
                        $email = $row["email"];
                        $ngay_sinh = $row["ngay_sinh"];
                        $gioi_tinh = $row["gioi_tinh"]; 
                        echo '<tr id="row">';
                        echo '<td style="width: 50px;">' . $stt++ . '</td>';
                        echo '<td style="width: 100px;">' . $id_admin . '</td>';
                        echo '<td style="width: 235px;">' . $ho_dem  . " " . $ten . '</td>';
                        echo '<td>' . $sdt . '</td>';
                        echo '<td>' . $email . '</td>';
                        echo '<td>' . $ngay_sinh . '</td>';
                        echo '<td>' . $gioi_tinh . '</td>';
                        
                        //Tác vụ
                        echo '<td id="task"><a href="sign_up.php"><i class="fa-solid fa-plus"></i></a><a href="/web/admin/sign_up/sign_up_admin/update_admin.php?id_admin=' . $id_admin . '""><i class="fa-solid fa-pen"></i></a><a href="../delete.php?id_admin=' . $id_admin . '"><i class="fa-solid fa-trash"></i></a></td>';
                        
                        echo '</tr>';
                    }
                } else {
                    echo "0 results";
                }
            ?>
            </table>
            <div class = "space"></div>
        </form>
        </main>
    </div>
    
    <?php
        require "../../home_admin/footer.php";
    ?>
    
</body>
</html>