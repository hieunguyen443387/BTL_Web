$(document).ready(function(){
    $('#ma_khoa').change(function(){
    var ma_khoa = $('#ma_khoa').val(); 
    
    $.ajax({
        type: 'POST',
        url: 'fetch_giang_vien.php',
        data: {ma_khoa:ma_khoa},  
        success: function(data)  
        {
            $('#mgv').html(data);
        }
        });
    });

});

