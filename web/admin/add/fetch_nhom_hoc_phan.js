$(document).ready(function(){
    

    $('#ma_nganh').change(function(){
    var ma_nganh = $('#ma_nganh').val(); 

    $.ajax({
        type: 'POST',
        url: 'fetch_nhom_hoc_phan.php',
        data: {ma_nganh:ma_nganh},  
        success: function(data)  
        {
            $('#ma_hp').html(data);
        }
        });
    });

    

});

