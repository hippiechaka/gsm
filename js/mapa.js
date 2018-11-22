$(document).ready(function() {


    document.getElementById("fullMap").style.height = screen.availHeight;
    var marker1,
    infowindow,
    map;
    var MY_MAPTYPE_ID = 'hiphop';
    function initialize() {
        var stylez = [
    {
        "featureType": "administrative",
        "elementType": "labels",
        "stylers": [
            {
                "saturation": "100"
            },
            {
                "hue": "#134fbd"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#444444"
            },
            {
                "lightness": "-100"
            },
            {
                "weight": "0.01"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "saturation": "18"
            },
            {
                "hue": "#134fbd"
            }
        ]
    },
    {
        "featureType": "administrative.locality",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "hue": "#0070ff"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
            {
                "color": "#f2f2f2"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 45
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "saturation": "-28"
            },
            {
                "hue": "#00ccff"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "color": "#1a4260"
            },
            {
                "visibility": "on"
            },
            {
                "lightness": "21"
            },
            {
                "gamma": "1.07"
            },
            {
                "saturation": "-65"
            }
        ]
    }
];
        var myLatlng = new google.maps.LatLng(20.674382,-103.387323);
        var mapOptions = {
          zoom: 14,
          center: myLatlng,
          mapTypeControlOptions: {
             mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
          },
          mapTypeId: MY_MAPTYPE_ID,
          panControl: false,
          zoomControl: true,
          mapTypeControl: false,
          scaleControl: false,
          streetViewControl: true,
          overviewMapControl: false,
          scrollwheel: false    
        };
        map = new google.maps.Map(document.getElementById("map_canvas"),mapOptions);
        var styledMapOptions = {
          name: ""
        };
        var jayzMapType = new google.maps.StyledMapType(stylez, styledMapOptions);
        map.mapTypes.set(MY_MAPTYPE_ID, jayzMapType);
        infowindow = new google.maps.InfoWindow({maxWidth:400});


/////////////////////////////////////////////////////////////////////////

        marker1 = new google.maps.Marker({
            position: new google.maps.LatLng(20.674382,-103.387323),
            map: map,
            title: 'Fenix',
            icon: 'images/pin.png'
        });
        google.maps.event.addListener(marker1, 'click', function() {
          cargainfo(marker1,"fenix-info");
        });
/////////////////////////////////////////////////////////////////////////

    }
    function cargainfo(marcador,classinfo){
        infowindow.setContent($("."+classinfo).html());
        infowindow.open(map,marcador);
    }
    initialize();
    

});