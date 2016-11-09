
var url = document.location;
var arr = url.pathname.split("/");

var selector;
 switch (arr[1])
 {
     case 'home':
         $('#menu-home').addClass('menu-active');
         break;
     case 'about':
         $('#menu-about').addClass('menu-active');
         break;
     case 'partnerWithUS':
         $('#menu-partnerWithUS').addClass('menu-active');
         break;
     case 'search':
         $('#menu-search').addClass('menu-active');
         break;
     case 'contact':
         $('#menu-contact').addClass('menu-active');
         break;
 }

