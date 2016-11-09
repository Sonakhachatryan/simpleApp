$(document).on('click','.remove-image',function() {
    $('#removed-images').val( $('#removed-images').val()+"?"+$(this).val()) ;
    $(this).closest('div').remove();
});

(function () {
    var filesToUpload = [];
    var images = document.getElementById("images");
    var submitbutton = document.getElementById("submitbutton-image");
    function FileSelectHandler(e) {
        var files = e.target.files || e.dataTransfer.files;
        $('#images').empty();
        $('#images-table').empty();
        $('#removed-images').val('');
        for (var i = 0, f; f = files[i]; i++) {
            filesToUpload.push(f);
            ParseFile(f);
        }
    }

    function ParseFile(file) {
        if (file.type.indexOf("image") == 0) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var a = '<div class="block-for-photo">'+
                    '<button  type="button" class="remove-image" name="' + file.name + '" value="' + file.name + '"><i class="fa fa-times" aria-hidden="true"></i></button>'+
                    '<img src="' + e.target.result + '" alt="">'+
                    '<div class="overlay"></div></div>';

                $('#images-table').append(a);
            }
            reader.readAsDataURL(file);
        }
    }
    images.addEventListener("change", FileSelectHandler, false);

})();