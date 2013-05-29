function mouse_event(obj, newClass, head, comment, loc, time) {
	obj.className = newClass;
	show_info(head, comment, loc, time);
	show_map(loc);
}

function show_info(head, comment, loc, time) {
	document.getElementById("comment").innerHTML='<p class="lead">'+head+'</p>'+comment+'<p>'+loc+'</p><p>'+time+'</p>';
}

function show_map(loc) {
	loc = loc.replace('&#039;', '\'');
	loc = encodeURIComponent(loc);

	var start = new google.maps.LatLng(59.3426606750, 18.0736160278);
	$('#map').gmap({
		'center': start
	});
}
