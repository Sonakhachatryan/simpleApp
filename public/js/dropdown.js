$( "#profile-menu" ).click(function(e){
    e.stopPropagation();
    $( "#profile-menu-dropdown" ).toggle();

});

$("#profile-menu-dropdown").click(function (e) {
    e.stopPropagation();
});

$(document).click(function () {
    $( "#profile-menu-dropdown" ).hide();
});