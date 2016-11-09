$( "#checkbox2" ).click(function(){
    // $( ".transperent" ).removeClass( "hidden" );
    //var checked = $(this).checked;
    var checked = this.checked ;

    if(checked) $( ".transperent" ).fadeIn( "slow" );

});

$('.transperent').click(function (event) {
    $(this).fadeOut("slow");
    document.getElementById("checkbox2").checked = false;
});

$('.pop-up').click(function (event) {
    event.stopPropagation();
});


// $( "#checkbox1" ).click(function(){
//     // $( ".transperent" ).removeClass( "hidden" );
//     //var checked = $(this).checked;
//     var checked = this.checked ;
//
//     if(checked) $( ".transperent" ).fadeIn( "slow" );
//
// });



$( "#checkbox1" ).click(function(){
    // $( ".transperent" ).removeClass( "hidden" );
    //var checked = $(this).checked;
    var checked = this.checked ;

    if(checked){ $( ".gold" ).css("color"," #a0b59f");
    $( ".silver" ).css("color"," #6c6c6c");}

   else{
        $( ".gold" ).css("color","#6c6c6c" );
        $( ".silver" ).css("color","#a0b59f");



    }

});