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

<div id="map" style="width: 600px;height:400px"></div>

{if count($events) > 0}
<table class="table table-striped table-bordered">
{foreach $events as $event}
<tr onmouseover="mouse_event(this, 'success', '{if $event->get_id() == $events[0]->get_id()}Next event:{/if}', '{escape_quotes string=$event->get_comment()}', '{escape_quotes string=$event->get_location()}', '{$event->get_date()|date_format:#date_format#}')"
		onmouseout="mouse_event(this, '', 'Next event:', '{escape_quotes string=$events[0]->get_comment()}', '{escape_quotes string=$events[0]->get_location()}', '{$events[0]->get_date()|date_format:#date_format#}')">
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
{/block}

{block name=footerscript}
show_info('Next event:', _.unescape('{$events[0]->get_comment()}'), _.unescape('{$events[0]->get_location()}'), '{$events[0]->get_date()|date_format:#date_format#}');
show_map('{$events[0]->get_location()}');
{/block}
