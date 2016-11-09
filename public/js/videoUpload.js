
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

//                var d = '<div class="progress">'+
//                        '<div class="bar"></div >'+
//                        '<div class="percent">0%</div >'+
//                        '</div>';
            var d='<progress class="progress-bar-video" value="0" max="100" name="'+ file.name +'"  >70 %</progress>'
            $('#videos-table').append(d);

            var bar = $('.bar');


            reader.onprogress = function (e) {
                console.log(e.loaded);
                var percentVal = e.loaded*100/file.size;
                console.log(percentVal);
                var selector = 'progress[name="'+file.name+ '"';
                var percent = $(selector).attr('value',percentVal);
                percent.html(percentVal);
            }

            reader.onload = function (e) {
                console.log(e);
                var a = '<div class="block-for-photo">'+
                    '<button  type="button" class="remove-image" name="' + file.name + '" value="' + file.name + '"><i class="fa fa-times" aria-hidden="true"></i></button>'+
                    '<video src="' + e.target.result + '" alt=""></video>'+
                    '<div class="overlay"></div></div>';

//                    var a = $('<tr>').append(
//                            '<td><strong>' + file.name + '</strong></td>' +
//                            '<td><strong>' + file.size + ' Kb </strong>'+
//                            '<button class="remove-video btn btn-danger custom-fl" name="' + file.name + '" value="' + file.name + '">x</button></td>'
//                    );
//                    a.attr('class', 'border-bottom');
                var selector = 'progress[name="'+file.name+ '"';
                var percent = $(selector).remove();
                $('#videos-table').append(a);
            }
            reader.readAsDataURL(file);
        }

    }

    // file select
    images.addEventListener("change", VideoFileSelectHandler, false);

})();






