$( "#url" ).click(function() {
    $(this).removeClass('error');
});

$( "#submit" ).click(function() {
    $.ajax({
        url: '/operation/generateUrl.php',
        method: 'get',
        dataType: 'html',
        data: {
            url: $('#url').val(),
        },
        success: function(data){
            let request = JSON.parse(data);
            if(request.status) {
                $('.error').html('');
                $('.result').html(request.message);
            } else {
                $('.result').html('');
                $('.error').html(request.message);
                $('#url').addClass('error');
            }
        },
        error: function (data) {
            $('.error').html(data);
        }
    });
});

