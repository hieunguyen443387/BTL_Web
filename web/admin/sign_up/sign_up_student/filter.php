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
<button type = "submit">Lọc</button>

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
<button type = "submit">Lọc</button>
    
<!-- Lọc theo chuyên ngành -->
<select name="ma_chuyen_nganh" id="ma_chuyen_nganh">
    <option value="">Lọc theo chuyên ngành</option>
    <?php
    
    $sql_chuyen_nganh = "SELECT ma_chuyen_nganh, ten_chuyen_nganh FROM chuyen_nganh";

    $result_chuyen_nganh = $conn->query($sql_chuyen_nganh);
    if ($result_chuyen_nganh->num_rows > 0) {
        while($row = $result_chuyen_nganh->fetch_assoc()) {
            echo '<option value="' . $row['ma_chuyen_nganh'] . '">' . $row['ten_chuyen_nganh'] . '</option>';
        }
    }
    ?>
</select>
<button type = "submit">Lọc</button>
    
    <!-- Lọc theo lớp -->
<select name="ma_lop" id="ma_lop">
    <option value="">Lọc theo lớp</option>
    <?php
        
    $sql_lop = "SELECT ma_lop FROM lop";

    $result_lop = $conn->query($sql_lop);

    if ($result_lop->num_rows > 0) {
        while($row = $result_lop->fetch_assoc()) {
            echo '<option value="' . $row['ma_lop'] . '">' . $row['ma_lop'] . '</option>';
        }
    }
    ?>
</select>
<button type = "submit">Lọc</button>