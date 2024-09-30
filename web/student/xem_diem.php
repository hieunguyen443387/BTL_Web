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
        <div class = "xem_diem">
            <h2><i class="fa-solid fa-atom"></i>Xem điểm</h2>
            <table>
                <tr class="header_row">
                    <th>STT</th>
                    <th>Mã MH</th>
                    <th>Tên môn học</th>
                    <th id = "tin_chi">Số tín chỉ</th>
                    <th id = "diem">Điểm thi</th>
                    <th id = "diem">Điểm TK (10)</th>
                    <th id = "diem">Điểm TK (4)</th>
                    <th id = "diem">Điểm TK (C)</th>
                </tr>
                <?php 
                   
                   include('../home/home/config.php');
               
                   $msv = $_SESSION['msv'];
                   $sql_diem = "SELECT msv, ma_hoc_phan, diem_a, diem_tb_10, diem_tb_4, diem_tb_chu FROM diem_hoc_phan WHERE msv = '$msv'";
                   $result_diem = $conn->query($sql_diem);
               
                   if ($result_diem->num_rows > 0) {
                       //Lấy mã học phần
                       while($row_diem = $result_diem->fetch_assoc()) {
                            
                            echo '<tr id = "row" style="height: 30px;">';

                            $_SESSION['ma_hoc_phan'] = $row_diem["ma_hoc_phan"];
                            $ma_hoc_phan = $_SESSION["ma_hoc_phan"];
                  
                            $sql_hoc_phan = "SELECT ma_hoc_phan, ten_hoc_phan, so_tin_chi FROM hoc_phan WHERE ma_hoc_phan = '$ma_hoc_phan'";
                            $result_hoc_phan = $conn->query($sql_hoc_phan);

                            // Hiển thị mã học phần, tên học phần, số tín chỉ

                            if ($result_hoc_phan->num_rows > 0) {
                                $stt = 1;
                                while($row_hoc_phan = $result_hoc_phan->fetch_assoc()) {
                                    
                                    echo '<td>' . $stt++ . '</td>';
                                    echo '<td>' . $row_hoc_phan["ma_hoc_phan"] . '</td>';
                                    echo '<td>' . $row_hoc_phan["ten_hoc_phan"] . '</td>';
                                    echo '<td>' . $row_hoc_phan["so_tin_chi"] . '</td>';
                            } 

                            // Hiển thị bảng điểm của sinh viên
                            echo '<td>' . $row_diem["diem_a"] . '</td>';
                            echo '<td>' . $row_diem["diem_tb_10"] . '</td>';
                            echo '<td>' . $row_diem["diem_tb_4"] . '</td>';
                            echo '<td>' . $row_diem["diem_tb_chu"] . '</td>';
                            echo '</tr>';
                       }
                   } 
                }
                            
                ?>
            </table>
        </div>
    </main>
    <?php
        require "menu.php";
    ?>
    <?php
        require "footer.php";
    ?>

</body>
</html>