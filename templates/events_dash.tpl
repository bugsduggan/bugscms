{extends "master.tpl"}

{*
	events_dash.tpl
*}

{block name=centerpanel}
{if count($events) > 0}
<table class="table table-striped table-bordered">
{foreach $events as $event}
<tr>
<td>{$event->get_location()}</td>
<td>{$event->get_date()|date_format:#date_format#}</td>
<td>{$event->get_date()|date_format:#time_format#}</td>
<td><a href="{$event->get_map_link()}">Map</a></td>
<td><a href="index.php?page=edit_event&id={$event->get_id()}">Edit</a></td>
<td><a href="index.php?action=delete_event&id={$event->get_id()}">Delete</a></td>
</tr>
{/foreach}
</table>
{else}
<p class="lead">No events</p>
{/if}

{/block}
