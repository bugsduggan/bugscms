function mouse_event(obj, newClass, head, comment, loc, time) {
	obj.className = newClass;
	show_info(head, comment, loc, time);
}

function show_info(head, comment, loc, time) {
	console.log(comment);
	document.getElementById("comment").innerHTML='<p class="lead">'+head+'</p>'+comment+'<p>'+loc+'</p><p>'+time+'</p>';
}

function show_map(loc_string) {
	console.log(loc_string);
	map_string = 'http://maps.googleapis.com/maps/api/staticmap?size=512x256&maptype=roadmap\&markers=size:mid%7Ccolor:red'+loc_string+'&sensor=false';
	document.getElementById("map").innerHTML='<img class="imp-polaroid event-map" src="'+map_string+'" alt="Map of events">';
}
