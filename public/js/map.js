/**
 * Created by User on 9/27/2016.
 */


var click= false;

$(document).ready(function () {
    $(document).on('click', ' .back', function () {
        if(!click) {
            console.log(22);
            click = true;
            $("#map").removeClass("hidden");
            myMap();
        }
    });
});


function myMap() {
    var mapCanvas = document.getElementById("map");
    var lang, lat;

    $.get("http://keepingitsimple.app/getLocation", function(result){
        lang = result.lang;
        lat = result.lat;
        var myLatlng = new google.maps.LatLng(lat,lang);
        var mapOptions = {
            center: myLatlng,
            zoom: 10
        }
        var marker = new google.maps.Marker({
            position: myLatlng,
        });
        var map = new google.maps.Map(mapCanvas, mapOptions);
        marker.setMap(map);
    });
}


