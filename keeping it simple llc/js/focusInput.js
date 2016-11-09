$( ".input-blocks input" ).focus(function() {
    // $(".left-block-forms .input-blocks").each(function () {
    //     $(this).find("label").css( "display", "none" );
    //     //$(this).find("input").attr( "placeholder",'sss' );
    // })
    $(this).parent().find("label").css( "display", "inline" );

    $(this).attr('placeholder', '');
    //$(this).parent().find("input").removeAttr( "placeholder" );
});

$( ".input-blocks input" ).blur(function() {
    $(this).parent().find("label").css( "display", "none" );
    var val = $(this).data('value');
    $(this).attr('placeholder', val);

    console.log($(this).attr('lian'))
    //$(this).parent().find("input").removeAttr( "placeholder" );
});
