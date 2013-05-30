{extends "master.tpl"}

{*
	events.tpl
*}

{block name=rightpanel}
{if $logged_in}
<p><a href="index.php?page=events_dash">Add/edit events</a></p>
{/if}
{/block}

{block name=leftpanel}
	<div id="comment"></div>
{/block}

{block name=centerpanel}

<div id="map" style="width: 600px;height:400px"><p>Map failed to load</p></div>

{if count($events) > 0}
<table class="table table-striped table-bordered">
{foreach $events as $event}
<tr onmouseover="mouse_event(this, 'success', '{if $event->get_id() == $events[0]->get_id()}Next event:{/if}', '{escape_quotes string=$event->get_comment()}', '{escape_quotes string=$event->get_location()}', '{$event->get_date()|date_format:#date_format#}', {$event->get_lat()}, {$event->get_lng()})"
		onmouseout="mouse_event(this, '', 'Next event:', '{escape_quotes string=$events[0]->get_comment()}', '{escape_quotes string=$events[0]->get_location()}', '{$events[0]->get_date()|date_format:#date_format#}', {$events[0]->get_lat()}, {$events[0]->get_lng()})">
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
#map {
	display: block;
	margin-left: auto;
	margin-right: auto;
	margin-bottom: 40px;
}
.info {
	margin-bottom: 20px;
}
@media (max-width:797px) {
	#map {
		margin-left: 20px;
	}
}
{/block}

{block name=headscript}
<script type="text/javascript" src="js/map.js"></script>
<script type="text/javascript">
var locations = new Array();
{foreach $events as $event}
	locations.push({ldelim}
		id: "{$event->get_id()}",
		location: _.unescape('{$event->get_location()}'),
		date: "{$event->get_date()}",
		comment: _.unescape('{$event->get_comment()}'),
		lat: "{$event->get_lat()}",
		lng: "{$event->get_lng()}"
	{rdelim});
{/foreach}
</script>
{/block}

{block name=footerscript}
show_info('Next event:', locations[0]['comment'], locations[0]['location'], locations[0]['date']);

init_map(locations);
{/block}
