$(document).ready(function(){
    $('#ma_khoa').change(function(){
    var ma_khoa = $('#ma_khoa').val(); 
    
    $.ajax({
        type: 'POST',
        url: 'fetch_lop.php',
        data: {ma_khoa:ma_khoa},  
        success: function(data)  
        {
            $('#ma_lop').html(data);
        }
        });
    });

    $('#ma_nganh').change(function(){
        var ma_nganh = $('#ma_nganh').val(); 
        
        $.ajax({
            type: 'POST',
            url: 'fetch_lop.php',
            data: {ma_nganh:ma_nganh},  
            success: function(data)  
            {
                $('#ma_lop').html(data);
            }
            });
        });

});

