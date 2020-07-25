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


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#preview-image-img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#photo").change(function() {
    readURL(this);
});

$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
