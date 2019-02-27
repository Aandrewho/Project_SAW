<?php
	session_start();
	
	
?>
<!DOCTYPE>
<html>
<head>
	<title>Segnalazioni</title>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Roboto:700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>        
</head>
<body>
    <div id="map"></div>
    <script>
		var map;
      	var marker;
      	var infowindow;
      	var messagewindow;
      	var newmarker = true;

      	function initMap() {
        	var genoa = {lat: 44.414165, lng: 8.942184};
        	map = new google.maps.Map(document.getElementById('map'), {center: genoa, zoom: 13});

        	infowindow = new google.maps.InfoWindow({
            	content: 	`<div id='form'>
        						<table>
        							<tr><td>Descrizione:</td> <td><input type='text' id='name'/> </td> </tr>
					        		<tr><td>Luogo:</td> <td><input type='text' id='address'/> </td> </tr>
					        		<tr><td>Tipo:</td> <td>
					        		<select id='type'> +
			                   			<option value='Altro...' SELECTED>Altro...</option>
			                   			<option value='Tombini intasati'>Tombini intasati</option>
                                        <option value='Rifiuti ingombranti'>Rifiuti ingombranti</option>
                                        <option value='Voragini'>Voragini</option>
				            		</select> </td></tr> 
				            		<tr><td></td><td><input type='button' value='Salva' onclick='saveData()'/></td></tr>
				        		</table>
				      		</div>`
        	})

        	messagewindow = new google.maps.InfoWindow({content: `<div>Marker salvato</div>`});

        	google.maps.event.addListener(map, 'click', function(event) {
            	if (newmarker)	{
	            	marker = new google.maps.Marker({position: event.latLng, map: map, draggable:true});
	            	newmarker = false;
	            }    
            	infowindow.open(map, marker);
        	});
      	}

      	function saveData() {
        	var name = escape(document.getElementById('name').value);
        	var address = escape(document.getElementById('address').value);
        	var type = document.getElementById('type').value;
        	var latlng = marker.getPosition();
        	var url = 'phpsqlinfo_addrow.php?name=' + name + '&address=' + address +
                  	'&type=' + type + '&lat=' + latlng.lat() + '&lng=' + latlng.lng();

        	downloadUrl(url, function(data, responseCode) {
            	if (responseCode == 200 && data.length <= 1) {
                	infowindow.close();
            		newmarker = true;
            		messagewindow.open(map, marker);
          		}	
        	});
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

      	function printSavedMarker(){
      		marker = new google.maps.Marker({position: event.latLng, map: map});
      		var latlng = new google.maps.LatLng(-24.397, 140.644);
      	    marker.setPosition(latlng);
      	}

      	function doNothing () {
      	}

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDipKv50SMB245Shn-hbvgRYfbY6YtlZQI&callback=initMap">
    </script>
  </body>
</html>