$(".js-tab").click(function () {
    var tab = $(this).data("tab");
    var selector = 'div[data-tab="' + tab + '"]';

    localStorage.removeItem('tab');
    localStorage.setItem('tab', tab);

    var tabContent = $(".tabs-horizontal-content").find(selector);
    $(".js-active-tab").removeClass('js-active-tab');
    tabContent.addClass('js-active-tab');

});

var url = document.location;
var arr = url.pathname.split("/");
if (arr[2] == 'questions') {
    var tab = localStorage.getItem('tab') || 1;
    var selector = 'div[data-tab="' + tab + '"]';
    var tabContent = $(".tabs-horizontal-content").find(selector);
    $(".js-active-tab").removeClass('js-active-tab');
    tabContent.addClass('js-active-tab');
}





