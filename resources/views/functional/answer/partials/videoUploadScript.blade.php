<script>
    $(document).on('click','.remove-video',function() {
        $('#removed-videos').val( $('#removed-videos').val()+"?"+$(this).val()) ;
        $(this).closest('tr').remove();
    });

    (function () {

        var filesToUpload = [];
        var images = document.getElementById("videos");
        var submitbutton = document.getElementById("submitbutton-video");

        // file selection
        function VideoFileSelectHandler(e) {
            // fetch FileList object
            var files = e.target.files || e.dataTransfer.files;
            $('#videos').empty();
            $('#removed-videos').val('');
            for (var i = 0, f; f = files[i]; i++) {
                filesToUpload.push(f);
                ParseFile(f);
            }
        }


        // output file information
        function ParseFile(file) {
            if (file.type.indexOf("video") == 0) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var a = $('<tr>').append(
                            '<td><strong>' + file.name + '</strong></td>' +
                            '<td><strong>' + file.size + ' Kb </strong>'+
                            '<button class="remove-video btn btn-danger custom-fl" name="' + file.name + '" value="' + file.name + '">x</button></td>'
                    );
                    a.attr('class', 'border-bottom');
                    $('#videos-table').append(a);
                }
                reader.readAsDataURL(file);
            }

        }

        // file select
        images.addEventListener("change", VideoFileSelectHandler, false);

    })();

</script>




