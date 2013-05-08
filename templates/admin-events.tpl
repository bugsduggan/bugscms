{extends "admin-master.tpl"}

{block name=head}
{/block}

{block name=body}
<div class="container">

	<div class="page-header">
		<h1>Events</h1>
	</div>

	<div class="row">
		<div class="column span4">
			<p><a class="btn btn-primary" href="index.php?page=event">New event</a></p>
		</div>
		<div class="column span4">
		</div>
		<div class="column span4">
			{if isset($events)}
			<p><strong>Events:</strong> {count($events)}</p>
			{/if}
		</div>
	</div>

	<hr>

	{if isset($events)}
	<table class="table table-striped table-bordered">
		<tr><th>ID</th><th>Name</th><th>Location</th><th>Date</th><th>Time</th><th>Map</th><th>Buy</th><th>Edit</td></tr>
		{foreach $events as $event}
		<tr>
			<td>{$event.id}</td>
			<td>{$event.name}</td>
			<td>{$event.location}</td>
			<td>{$event.date|date_format:#date_format#}</td>
			<td>{$event.date|date_format:#time_format#}</td>
			<td>
			{if $event.map_link != ''}<a href="{$event.map_link}">Map</a>{/if}
			</td><td>
			{if $event.info_link != ''}<a href="{$event.info_link}">Info</a>{/if}
			</td>
			<td><a href="index.php?page=event&id={$event.id}">Edit</a></td>
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
