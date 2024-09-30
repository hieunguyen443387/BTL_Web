<!DOCTYPE html>
<html>
<script src="https://code.jquery.com/jquery-3.6.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="app.js"></script>
<script src="fetch_nhom_hoc_phan.js"></script>
<title>Thống kê sinh viên trượt môn</title>
<style>
    .menu ul a #truot{
        background-color: #0F6CBF;
        color: #FFFFFF;
    }
</style>
<body>
    <div class="container">
        <?php
            require "../home_admin/header.php";
        ?>
        
        <div class="failure">
            <?php
                require "../home_admin/menu.php";
            ?>
            <div class="failure_add">
                <h2><i class="fa-solid fa-gears"></i>Thống kê sinh viên trượt môn</h2>
                <hr>
                <form action="sinh_vien_truot_mon.php" method="post">
                    <div class = "filter" style="margin-left: 10px;margin-top: 7px;">
                        <!-- Lọc theo khoa -->
                        <select name="ma_khoa" id="ma_khoa" >
                            <option value="">Lọc theo khoa</option>
                            <?php
                            include('../home_admin/config.php');
                            $sql = "SELECT ma_khoa, ten_khoa FROM khoa";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['ma_khoa'] . '">' . $row['ten_khoa'] . '</option>';
                                }
                            }
                            ?>
                        </select>      

                        <!-- Lọc theo ngành -->
                        <select name="ma_nganh" id="ma_nganh">
                            <option value="">Lọc theo ngành</option>
                            <?php

                            $sql_nganh = "SELECT ma_nganh, ten_nganh FROM nganh"; 
                            $result_nganh = $conn->query($sql_nganh);

                            if ($result_nganh->num_rows > 0) {
                                while($row = $result_nganh->fetch_assoc()) {
                                    echo '<option value="' . $row['ma_nganh'] . '">' . $row['ten_nganh'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                            
                        <!-- Lọc theo chuyên ngành -->
                        <select name="ma_hoc_phan" id="ma_hp">
                            <option value="">Lọc theo học phần</option>
                            <?php
                            
                            $sql_hoc_phan = "SELECT ma_hoc_phan, ten_hoc_phan FROM hoc_phan ";  
                            $result_hoc_phan = mysqli_query($conn, $sql_hoc_phan);
                            if ($result_hoc_phan->num_rows > 0) {
                                while($row = $result_hoc_phan->fetch_assoc()) {
                                    echo '<option value="' . $row['ma_hoc_phan'] . '">' . $row['ten_hoc_phan'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <button type = "submit">Lọc</button>
                    </div>
                        <br>
                        <br>
                        <hr>
                        
                    <table>
                        <tr id="header_row">
                            <th>STT</th>
                            <th>Mã học phần</th>
                            <th>Học phần</th>
                            <th>Mã sinh viên</th>
                            <th>Sinh viên</th>
                        </tr>
                        <?php  
                            
                            if (isset($_POST['ma_khoa']) && !empty($_POST['ma_khoa'])) {
                                $ma_khoa = $_POST['ma_khoa'];
                                $sql_truot = "SELECT ma_hoc_phan, msv FROM sinh_vien_truot_mon WHERE msv in
                                (select msv from danh_sach_sinh_vien_khoa where ma_khoa = '$ma_khoa')";
                            } 
                            elseif (isset($_POST['ma_nganh']) && !empty($_POST['ma_nganh'])) {
                                $ma_nganh = $_POST['ma_nganh'];
                                $sql_truot = "SELECT ma_hoc_phan, msv FROM sinh_vien_truot_mon WHERE msv in
                                (select msv from danh_sach_sinh_vien_nganh where ma_nganh = '$ma_nganh')";
                            }
                            elseif (isset($_POST['ma_nganh']) && !empty($_POST['ma_nganh'])){
                                $sql_truot = "SELECT ma_hoc_phan, msv FROM sinh_vien_truot_mon WHERE ma_hoc_phan = '$ma_hoc_phan'";
                            }
                            else{
                                $sql_truot = "SELECT ma_hoc_phan, msv FROM sinh_vien_truot_mon ";
                            }
                                                        
                            $result_truot = $conn->query($sql_truot);

                            if ($result_truot->num_rows > 0) {
                                $stt = 1;
                                while ($row = $result_truot->fetch_assoc()) {
                                    echo '<tr id = "row" style="height: 30px;">';     
                                    echo '<td>' . $stt++ . '</td>';
                                    echo '<td>' . $row["ma_hoc_phan"] . '</td>';
                                    $_SESSION['ma_hoc_phan'] = $row["ma_hoc_phan"];
                                    $msv = $row["msv"];
                                    
                                    // Truy vấn tên học phần
                                    $ma_hoc_phan = $_SESSION['ma_hoc_phan'];
                                    $sql_hoc_phan = "SELECT ma_hoc_phan, ten_hoc_phan FROM hoc_phan WHERE ma_hoc_phan = '$ma_hoc_phan'";
                                    $result_hoc_phan = $conn->query($sql_hoc_phan);
                                    if ($result_hoc_phan->num_rows > 0){
                                        while ($row = $result_hoc_phan->fetch_assoc()){
                                            echo '<td>' . $row["ten_hoc_phan"] . '</td>';
                                        }
                                    }
                                    // Truy vấn tên sinh viên
                                    
                                    echo '<td>' . $msv . '</td>';
                                    $sql_sinh_vien = "SELECT ho_dem, ten FROM sinh_vien WHERE msv = '$msv'";
                                    $result_sinh_vien = $conn->query($sql_sinh_vien);
                                    if ($result_sinh_vien->num_rows > 0) {
                                        while ($row = $result_sinh_vien->fetch_assoc()) {
                                            echo '<td>' . $row["ho_dem"] . " " . $row["ten"] . '</td>';
                                        }
                                    }
                                    
                                    echo '</tr>';
                                } 
                            } 
                            
                            else { 
                                echo "Chưa có sinh viên";
                            }
                            
                        ?>

                    </table>
                </form>
            </div>
        </div>
    </div>
    <div class = "space"></div>
    <?php
        require "../home_admin/footer.php";
    ?>
</body>
</html>