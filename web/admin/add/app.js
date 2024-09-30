$(document).ready(function(){
    $('#ma_khoa').change(function(){
    var ma_khoa = $('#ma_khoa').val(); 
    
    $.ajax({
        type: 'POST',
        url: 'fetch.php',
        data: {ma_khoa:ma_khoa},  
        success: function(data)  
        {
            $('#ma_nganh').html(data);
        }
        });
    });

    $('#ma_nganh').change(function(){
    var ma_nganh = $('#ma_nganh').val(); 

    $.ajax({
        type: 'POST',
        url: 'fetch.php',
        data: {ma_nganh:ma_nganh},  
        success: function(data)  
        {
            $('#ma_chuyen_nganh').html(data);
        }
        });
    });

    $('#ma_chuyen_nganh').change(function(){
    var ma_chuyen_nganh = $('#ma_chuyen_nganh').val(); 

    $.ajax({
        type: 'POST',
        url: 'fetch.php',
        data: {ma_chuyen_nganh:ma_chuyen_nganh},  
        success: function(data)  
        {
            $('#ma_lop').html(data);
        }
        });
    });

});

