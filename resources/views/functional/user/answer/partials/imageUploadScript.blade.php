<script>
    $(document).on('click','.remove-image',function() {
        $('#removed-images').val( $('#removed-images').val()+"?"+$(this).val()) ;
        $(this).closest('tr').remove();
    });

    (function () {

        var filesToUpload = [];
        var images = document.getElementById("images");
        var submitbutton = document.getElementById("submitbutton-image");

        // file selection
        function FileSelectHandler(e) {

            // fetch FileList object
            var files = e.target.files || e.dataTransfer.files;
            $('#images').empty();
            $('#removed-images').val('');
            for (var i = 0, f; f = files[i]; i++) {
                filesToUpload.push(f);
                ParseFile(f);
            }
        }


        // output file information
        function ParseFile(file) {

            // display an image
            if (file.type.indexOf("image") == 0) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var a = $('<tr>').append(
                            '<td><img class = "upload-image" src="' + e.target.result + '" /></td>' +
                            '<td><strong>' + file.name + '</strong></td>' +
                            '<td><strong>' + file.size + ' Kb </strong>'+
                            '<button class="remove-image btn btn-danger custom-fl" name="' + file.name + '" value="' + file.name + '">x</button></td>'
                    );
                    a.attr('class', 'border-bottom');
                    $('#images-table').append(a);
                }
                reader.readAsDataURL(file);
            }

        }

        // file select
        images.addEventListener("change", FileSelectHandler, false);

    })();

</script>




