/**
 * Created by User on 9/20/2016.
 */



$(document).ready(function () {
    $(document).on('click', '.search', function () {

        $("nav li a").addClass("hidden");
        $(".all-search").removeClass("hidden");

    });



    $(document).on('click', '.close-search', function () {
        $("nav li a").removeClass("hidden");
        $(".all-search").addClass("hidden");

    });
});

