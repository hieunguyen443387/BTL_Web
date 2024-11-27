<?php
    $sql_get_nganh = "SELECT * FROM nganh WHERE ma_nganh = '$ma_nganh'";
    $result_get_nganh = $conn->query($sql_get_nganh); // chạy query
    $pass_nganh = $result_get_nganh->fetch_assoc();

    $sql = "SELECT ma_khoa, ten_khoa FROM khoa ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
    while($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['ma_khoa'] . '"' ;
        if ($row['ma_khoa'] == $pass_nganh['ma_khoa']) {
            echo ' selected';
        }
        echo '>' . $row['ten_khoa'] . '</option>';
        }
    }    

?>