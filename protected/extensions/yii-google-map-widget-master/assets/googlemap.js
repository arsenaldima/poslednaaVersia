/*
 * Google map javascript widget
 * 
 * @author disasterovich@mail.ru
 * @site: diz-blog.com.ua
 * @ license: GPL
 * 
 * @var google_maps_markers - array()
 * @var google_maps_params - array()
 */

var markers = new Array();
      
function initialize() 
    {
    mapOptions = 
        {
        zoom: google_maps_params['zoom'],        
        }
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    if ( google_maps_markers.length == 0)
        {
        myLatlng = new google.maps.LatLng( google_maps_params['lat'],google_maps_params['lng'] );
        map.setCenter(myLatlng); 
        }
    else
        {
        for( var i=0;i<google_maps_markers.length;i++ )
            {
            myLatlng = new google.maps.LatLng( google_maps_markers[i]['lat'],google_maps_markers[i]['lng'] );

            //По умолч. центрируем карту по первому маркеру
            if (i == 0) { map.setCenter(myLatlng); }

            markers[i] = new google.maps.Marker(
                {
                position: myLatlng,
                map: map,
                title: google_maps_markers[i]['title'],
                draggable:google_maps_markers[i]['draggable'],
                });
            }        
        }
    }

google.maps.event.addDomListener(window, 'load', initialize);