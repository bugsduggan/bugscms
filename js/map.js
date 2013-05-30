google.maps.visualRefresh = true;

var map;
var bounds;
function initialize() {
	console.log('initializing map');

	var center = new google.maps.LatLng(locations[0]['lat'], locations[0]['lng']);
	var mapOptions = {
		zoom: 13,
		center: center,
		disableDefaultUI: true,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	map = new google.maps.Map(document.getElementById('map'), mapOptions);

	bounds = new google.maps.LatLngBounds();
	for (i = 0; i < locations.length; i++) {
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(
									locations[i]['lat'], locations[i]['lng']),
			map: map
		});
		bounds.extend(marker.position);
	}
	map.fitBounds(bounds);
}

function mouse_over(id) {
	console.log('Displaying event map for event '+id);
	locations.forEach(function(loc) {
		if (id == loc['id']) {
			map.panTo(new google.maps.LatLng(loc['lat'], loc['lng']));
		}
	});
}

function mouse_out(id) {
	console.log('Displaying main event map instead of event '+id);
	map.panTo(bounds.getCenter());
}

google.maps.event.addDomListener(window, 'load', initialize);
