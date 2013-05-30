function mouse_event(obj, newClass, head, comment, loc, time, lat, lng) {
	obj.className = newClass;
	show_info(head, comment, loc, time);
	show_map(lat, lng);
}

function show_info(head, comment, loc, time) {
	document.getElementById("comment").innerHTML='<p class="lead">'+head+'</p>'+comment+'<p>'+loc+'</p><p>'+time+'</p>';
}

function show_map(lat, lng) {
	var latLng = new google.maps.LatLng(lat, lng);
	var mapOptions = {
		zoom: 13,
		center: latLng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	var map = new google.maps.Map(document.getElementById('map'), mapOptions);
	var marker = new google.maps.Marker({
		position: latLng,
		map: map
	});
}
