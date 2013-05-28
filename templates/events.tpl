{extends "master.tpl"}

{*
	events.tpl
*}


{block name=rightpanel}
{if $logged_in}
<p><a href="index.php?page=events_dash">Add/edit events</a></p>
{/if}
{/block}

{block name=centerpanel}
{if count($events) > 0}
<div class="info">
	<img class="img-polaroid event-map pull-right" src="{$event_map}" alt="Map of events">
	<div id="comment" class="span3"></div>
</div>
<table class="table table-striped table-bordered">
{foreach $events as $event}
<tr onmouseover="mouse_event(this, 'success', '{if $event->get_id() == $events[0]->get_id()}Next event:{/if}', '{$event->get_comment()}', '{$event->get_location()}', '{$event->get_date()|date_format:#date_format#}')"
		onmouseout="mouse_event(this, '', 'Next event:', '{$events[0]->get_comment()}', '{$events[0]->get_location()}', '{$events[0]->get_date()|date_format:#date_format#}')">
<td>{$event->get_location()}</td>
<td>{$event->get_date()|date_format:#date_format#}</td>
<td>{$event->get_date()|date_format:#time_format#}</td>
<td><a href="{$event->get_map_link()}">Map</a></td>
</tr>
{/foreach}
</table>
{else}
<p class="lead">No events</p>
{/if}
{/block}

{block name=style}
.event-map {
	margin-bottom: 40px;
}
.info {
	margin-bottom: 20px;
}
@media (max-width:797px) {
	.event-map {
		margin-left: 20px;
	}
}
{/block}

{block name=headscript}
<script type="text/javascript">
function mouse_event(obj, newClass, head, comment, loc, time) {
	obj.className = newClass;
	show_info(head, comment, loc, time);
}
function show_info(head, comment, loc, time) {
	console.log(comment);
	document.getElementById("comment").innerHTML='<p class="lead">'+head+'</p>'+comment+'<p>'+loc+'</p><p>'+time+'</p>';
}
</script>
{/block}

{block name=footerscript}
show_info('Next event:', _.unescape('{$events[0]->get_comment()}'), '{$events[0]->get_location()}', '{$events[0]->get_date()|date_format:#date_format#}');
{/block}
