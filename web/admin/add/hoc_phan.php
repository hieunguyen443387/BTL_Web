<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập khoa</title>
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="app.js"></script>
    <style>
        .menu ul a #hoc_phan{
            background-color: #0F6CBF;
            color: #FFFFFF;
        }

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
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
            require "../home_admin/header.php";
        ?>
        <div class="menu_add">
            <?php
                require "../home_admin/menu.php";
            ?> 
            <form method="post" action="">   
                <div class="filter">
                    <!-- Lọc theo khoa -->
                    <select name="ma_khoa" id="ma_khoa">
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
                    <button type="submit">Lọc</button>
                    <a href="/web/admin/add/create_hoc_phan.php" class="add_student"><i class="fa-solid fa-plus" style="color: white;"></i></a>
                </div>

                <table>
                    <caption class="note"><b>Danh sách học phần</b></caption>
                    <tr id="header_row">
                        <th>STT</th>
                        <th>Mã học phần</th>
                        <th>Tên học phần</th>
                        <th>Số tính chỉ</th>
                        <th>Trực thuộc ngành</th>
                        <th>Tác vụ</th>
                    </tr>

                    <?php
                    require "phan_trang.php";

                    // Lọc dữ liệu theo khoa hoặc ngành
                    if (isset($_POST['ma_khoa']) && !empty($_POST['ma_khoa'])) {
                        $ma_khoa = $_POST['ma_khoa'];
                        $sql_hoc_phan = "SELECT ma_hoc_phan, ten_hoc_phan, ma_nganh, so_tin_chi FROM hoc_phan WHERE ma_nganh IN 
                                        (SELECT ma_nganh FROM nganh WHERE ma_khoa = '$ma_khoa') LIMIT $limit OFFSET $offset";
                    } elseif (isset($_POST['ma_nganh']) && !empty($_POST['ma_nganh'])) {
                        $ma_nganh = $_POST['ma_nganh'];
                        $sql_hoc_phan = "SELECT ma_hoc_phan, ten_hoc_phan, ma_nganh, so_tin_chi FROM hoc_phan WHERE ma_nganh = '$ma_nganh' LIMIT $limit OFFSET $offset";
                    } else {
                        // Lấy danh sách toàn bộ học phần
                        $sql_hoc_phan = "SELECT ma_hoc_phan, ten_hoc_phan, ma_nganh, so_tin_chi FROM hoc_phan LIMIT $limit OFFSET $offset";
                    }

                    $result_hoc_phan = $conn->query($sql_hoc_phan);
                    $stt = $offset + 1;

                    if ($result_hoc_phan->num_rows > 0) {
                        while($row = $result_hoc_phan->fetch_assoc()) {
                            $ma_hoc_phan = $row["ma_hoc_phan"];
                            $ma_nganh = $row["ma_nganh"];
                            echo '<tr id="row">';
                            echo '<td>' . $stt++ . '</td>';
                            echo '<td>' . $ma_hoc_phan . '</td>';
                            echo '<td>' . $row["ten_hoc_phan"] . '</td>';
                            echo '<td>' . $row["so_tin_chi"] . '</td>';

                            $sql_nganh = "SELECT ten_nganh FROM nganh WHERE ma_nganh = '$ma_nganh'";
                            $result_nganh = $conn->query($sql_nganh);
                            if ($result_nganh->num_rows > 0) {
                                while($row_nganh = $result_nganh->fetch_assoc()) {
                                    echo '<td>' . $row_nganh["ten_nganh"] . '</td>';
                                }
                            }

                            echo '<td id="task"><a href="update_hoc_phan.php?ma_hoc_phan=' . $ma_hoc_phan . '"><i class="fa-solid fa-pen"></i></a>
                                <a href="delete.php?ma_hoc_phan=' . $ma_hoc_phan . '"><i class="fa-solid fa-trash"></i></a></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "0 results";
                    }
                
                    ?>
                </table>
            </form>  
        </div>
        <?php
            $sql_trang = "SELECT COUNT(*) AS total FROM hoc_phan";
            $result_trang = $conn->query($sql_trang);
            require "so_trang.php";
        ?>
        <?php
            require "../home_admin/footer.php";
        ?>
    </div>
</body>
</html>
