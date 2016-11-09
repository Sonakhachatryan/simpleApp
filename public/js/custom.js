//delete message after 5 secs

setTimeout(function() {
    $("#success").remove();
}, 3000);


//confirm deleting
$(".delete").on('click',function() {
    var form = $(this).closest('form').find('.button-delete');
    var id = $(this).val();
    var token = $(this).attr('data');
    var method = 'DELETE';
    swal({
        title: "Are you sure?",
        text: "The record will be removed!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, remove it!",

        closeOnConfirm: true
    }, function () {
        form.click();
    })
})