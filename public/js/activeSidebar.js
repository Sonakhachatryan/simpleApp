
var url = document.location;
var arr = url.pathname.split("/");

console.log(arr);
var selector;
switch (arr[2])
{
    case 'account':
        $('#sidebar-account').addClass('sidebar-active');
        break;
    case 'notification':
        $('#sidebar-notification').addClass('sidebar-active');
        break;
    case 'questions':
    case 'question':
        $('#sidebar-questions').addClass('sidebar-active');
        break;
    case 'account-details':
        $('#sidebar-account-details').addClass('sidebar-active');
        break;
}
