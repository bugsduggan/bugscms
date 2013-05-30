google.maps.visualRefresh = true;

var map;
function initialize() {
	console.log('initializing map');

	var center = new google.maps.LatLng(locations[0]['lat'], locations[0]['lng']);
	var mapOptions = {
		zoom: 13,
		center: center,
		disableDefaultUI: true,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	var map = new google.maps.Map(document.getElementById('map'), mapOptions);

	var marker = new google.maps.Marker({
		position: center,
		map: map
	});
}

function mouse_over(id) {
	console.log('Displaying event map for event '+id);
}

function mouse_out(id) {
	console.log('Displaying main event map instead of event '+id);
}

google.maps.event.addDomListener(window, 'load', initialize);
