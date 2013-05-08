{extends "master.tpl"}

{block name=head}
{/block}

{block name=body}
<div class="container">
	<div class="page-header">
		<h1>Events</h1>
	</div>

	{if isset($events)}
	<table class="table table-bordered table-striped">
		<tr><th>Name</th><th>Location</th><th>Date</th><th>Time</th><th>Map</th><th>Info</th></tr>
		{foreach $events as $event}
			<tr>
			<td>{$event.name}</td>
			<td>{$event.location}</td>
			<td>{$event.date|date_format:#date_format#}</td>
			<td>{$event.date|date_format:#time_format#}</td>
			<td>{if $event.map_link != ''}<a href="{$event.map_link}">Map</a>{else}&nbsp;{/if}</td>
			<td>{if $event.info_link != ''}<a href="{$event.info_link}">Buy</a>{else}&nbsp;{/if}</td>
			</tr>
		{/foreach}
	</table>
	{else}
	<p class="lead">No events to display</p>
	{/if}

</div>
{/block}

{block name=javascript}
{/block}
