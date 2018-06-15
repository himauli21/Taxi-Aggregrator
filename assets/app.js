

/*
 * Here is an example of how to use Backstretch as a slideshow.
 * Just pass in an array of images, and optionally a duration and fade value.
 */

// Duration is the amount of time in between slides,
// and fade is value that determines how quickly the next image will fade in
$.backstretch([
    "assets/images/1.jpg"
    , "assets/images/2.jpg"
], {duration: 3000, fade: 750});


$(window).load(function(){
    $('.loadingBar').fadeOut("slow");
});

function showLoadingBar()
{
    $('.loadingBar').fadeIn("slow");
}

function hideLoadingBar()
{
    $('.loadingBar').fadeOut("slow");
}


// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see the error "The Geolocation service
// failed.", it means you probably did not give permission for the browser to
// locate you.
var map, infoWindow;
function initMap() {

    var ac_inputs = document.getElementById('Location_from');
    var ac_inputs2 = document.getElementById('Location_to');
    new google.maps.places.Autocomplete(ac_inputs);
    new google.maps.places.Autocomplete(ac_inputs2);

    if( ac_inputs.val() == "" || ac_inputs.val() == null ){
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                console.log( position );
                displayLocation( pos.lat , pos.lng );

            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
    infoWindow.open(map);
}

function displayLocation(latitude,longitude){
    var request = new XMLHttpRequest();

    var method = 'GET';
    var url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='+latitude+','+longitude+'&sensor=true';
    var async = true;

    request.open(method, url, async);
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            var address = data.results[0];
            console.log( address );
            $('[name="Location[from]"]').val( address.formatted_address );
        }
    };
    request.send();
};

var successCallback = function(position){
    var x = position.coords.latitude;
    var y = position.coords.longitude;
    displayLocation(x,y);
};

var errorCallback = function(error){
    var errorMessage = 'Unknown error';
    switch(error.code) {
        case 1:
            errorMessage = 'Permission denied';
            break;
        case 2:
            errorMessage = 'Position unavailable';
            break;
        case 3:
            errorMessage = 'Timeout';
            break;
    }
    document.write(errorMessage);
};

var options = {
    enableHighAccuracy: true,
    timeout: 1000,
    maximumAge: 0
};


