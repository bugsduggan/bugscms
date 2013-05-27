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
<table class="table table-striped table-bordered">
{foreach $events as $event}
<tr>
<td>{$event->get_location()}</td>
<td>{$event->get_date()|date_format:#date_format#} - {$event->get_date()|date_format:#time_format#}</td>
<td><a href="{$event->get_map_link()}">Map</a></td>
</tr>
{/foreach}
</table>
<img class="img-polaroid event-map" src="{$event_map}" alt="Map of events">
{else}
<p class="lead">No events</p>
{/if}
{/block}

{block name=style}
@media (min-width: 1200px) {
	.event-map {
		margin-left: 50px;
	}
}
{/block}
