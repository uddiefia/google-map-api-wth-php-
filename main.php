
<?php
require 'inc/functions.php';

    $array = get_location();
   // var_dump($array);die;
 ?>
<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>From Info Windows to a Database: Saving User-Added Form Data</title>
    <style>

      #map {
        height: 300%;
        width :85%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 50%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map" height="460px" width="85%"></div>
    <div id="form">
      <table>
      <tr><td>Location:</td> <td><input type='text' id='Location'/> </td> </tr>
      <tr><td>Description:</td> <td><input type='text'  id='Description'/> </td> </tr>


  date and time:
  <input type="datetime-local" id="dateTimeText" name="time">


      <tr><td>Type:</td> <td><select id='type'> +
                 <option value='Flood' SELECTED>Flood</option>
                 <option value='Landslide'>Landslide</option>
                 <option value='Fires'>Fire</option>
                 <option value='Road Side Accidents'>Road Side Accidents</option>
                 <option value='Electrical Breakdown Leakages'>Electrical Breakdown Leakages</option>
                 <option value='Cyclone'>Cyclone</option>
                 <option value='Other'>Other</option>
                 </select> </td></tr>
                  <tr><td>Threat Level   :</td> <td><select id='ThreatLevel'> +
                 <option value='High' SELECTED>High</option>
                 <option value='Medium'>Medium</option>
                 <option value='Low'>Low</option>

               </select> </td></tr>

                 <tr><td></td><td><input type='submit' value='Save' onclick='saveData()'/></td></tr>
      </table>
    </div>
    <div id="message">Location saved</div>
    <script>
    
function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };

    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(50);

    // Multiple markers location, latitude, and longitude
    var markers = [
        ['Brooklyn Museum, NY', 40.671531, -73.963588],
        ['Brooklyn Public Library, NY', 40.672587, -73.968146],
        ['Prospect Park Zoo, NY', 40.665588, -73.965336]
    ];

    // Info window content
    var infoWindowContent = [
        ['<div class="info_content">' +
        '<h3>Brooklyn Museum</h3>' +
        '<p>The Brooklyn Museum is an art museum located in the New York City borough of Brooklyn.</p>' + '</div>'],
        ['<div class="info_content">' +
        '<h3>Brooklyn Public Library</h3>' +
        '<p>The Brooklyn Public Library (BPL) is the public library system of the borough of Brooklyn, in New York City.</p>' +
        '</div>'],
        ['<div class="info_content">' +
        '<h3>Prospect Park Zoo</h3>' +
        '<p>The Prospect Park Zoo is a 12-acre (4.9 ha) zoo located off Flatbush Avenue on the eastern side of Prospect Park, Brooklyn, New York City.</p>' +
        '</div>']
    ];

    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;

    // Place each marker on the map
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });

        // Add info window to marker
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });

}
// Load initialize function
google.maps.event.addDomListener(window, 'load', initMap);


      function saveData() {

        var Location = escape(document.getElementById('Location').value);

        //var dateTime = document.getElementById('dateTimeText').value;

        var Description = escape(document.getElementById('Description').value);
        var type = document.getElementById('type').value;
        var latlng = marker.getPosition();
//console.log(dateTime);
        var ThreatLevel  = document.getElementById('ThreatLevel').value;

        var url = 'index.php?Location=' + Location +'&Description=' + Description +
                  '&type=' + type + '&lat=' + latlng.lat()  + '&lng=' + latlng.lng() + '&ThreatLevel=' +ThreatLevel;

        //var url = 'index.php?Location=' + Location +'&Description=' + Description +
                  //'&type=' + type + '&lat=' + latlng.lat()  + '&lng=' + latlng.lng() + '&ThreatLevel=' +ThreatLevel+'&dateTime='+dateTime;

        downloadUrl(url, function(data, responseCode) {

          if (responseCode == 200 && data.length <= 1) {
            infowindow.close();
            messagewindow.open(map, marker);
          }
        });

        setTimeout(function(){
            location.reload();
        } , 2000)
      }

      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request.responseText, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing () {
      }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdBnDkdtYS3SNge9vTfqwKyXTH3a2RzHY&callback=initMap">
    </script>
  </body>
</html>
