require('./bootstrap');
$('.likesButton').on('click',function(){
    var newsID = $(this).siblings('.newsID').val();
    var likesSpan = $(this).siblings('.likesCount');
    $.ajax({
        type: "POST",
        url: 'like/'+newsID,
        data: { _token:token}
    }).done(function() {
        $.ajax({
            type: "GET",
            url: 'like/'+newsID,
            data: { _token:token}
        }).done(function (res) {
            likesSpan.html(res);
        })
    });
});
